@extends('layouts.app_no_header')
@section('title')
    CONFIG YOUR CHEAT
@endsection
@section('css')
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 80px;
            height: 34px;
            margin-top: -6px;
            margin-left: 10px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #faca3b;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #faca3b;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(46px);
            -ms-transform: translateX(46px);
            transform: translateX(46px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .dropdown-colorselector > .dropdown-menu {
            top: 80%;
            left: -7px;
            padding: 4px;
            min-width: 130px;
            max-width: 130px
        }

        .dropdown-colorselector > .dropdown-menu > li {
            display: block;
            float: left;
            width: 20px;
            height: 20px;
            margin: 2px
        }

        .dropdown-colorselector > .dropdown-menu > li > .color-btn {
            display: block;
            width: 20px;
            height: 20px;
            margin: 0;
            padding: 0;
            border-radius: 0;
            position: relative;
            -webkit-transition: all ease .1s;
            transition: all ease .1s
        }

        .dropdown-colorselector > .dropdown-menu > li > .color-btn:hover {
            text-decoration: none;
            opacity: .8;
            filter: alpha(opacity=80);
            -webkit-transform: scale(1.08);
            -ms-transform: scale(1.08);
            transform: scale(1.08)
        }

        .dropdown-colorselector > .dropdown-menu > li > .color-btn.selected:after {
            content: "\e013";
            font-family: 'Glyphicons Halflings';
            display: inline-block;
            font-size: 11px;
            color: #FFF;
            position: absolute;
            left: 0;
            right: 0;
            text-align: center;
            line-height: 20px
        }

        .dropdown-menu.dropdown-caret:after, .dropdown-menu.dropdown-caret:before {
            content: "";
            display: inline-block;
            position: absolute
        }

        .btn-colorselector {
            display: inline-block;
            width: 20px;
            height: 20px;
            background-color: #DDD;
            vertical-align: middle;
            border-radius: 0
        }

        .dropdown-menu.dropdown-caret:before {
            border-bottom: 7px solid rgba(0, 0, 0, .2);
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            left: 9px;
            top: -7px
        }

        .dropdown-menu.dropdown-caret:after {
            border-bottom: 6px solid #FFF;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            left: 10px;
            top: -6px
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-2 text-center">
                <div class="card">
                    @if(!app('request')->input('key'))
                        <div class="card-header col-sm-offset-1">{{ __('CONFIG YOUR CHEAT') }}</div>
                    @endif
                    @if(app('request')->input('key') && DB::table('keys')->where('key', app('request')->input('key'))->where('tool_id', 6)->get()->count()==0)
                        <h3 class="text-primary">KEY IS INCORRECT</h3>
                    @endif
                    <div class="card-body">
                        @if(!app('request')->input('key'))
                            <form action="" method="GET">
                                <div class="form-group row">
                                    <label for="key"
                                           class="col-sm-3 col-form-label text-sm-right">{{ __('Input your key') }}</label>
                                    <div class="col-sm-8">
                                        <input id="key" type="text" required
                                               class="form-control{{ $errors->has('key') ? ' is-invalid' : '' }}"
                                               name="key" value="{{ old('key') }}" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-sm-12">
                                        <div id="charge-form-notice"></div>
                                    </div>

                                    <div class="col-sm-8 col-sm-offset-3">
                                        <button type="submit" class="btn btn-warning buy-now my-btn col-sm-12">CONFIG
                                            NOW
                                        </button>
                                    </div>
                                </div>
                            </form>
                        @endif

                        @if(app('request')->input('key') && DB::table('keys')->where('key', app('request')->input('key'))->where('tool_id', 6)->get()->count()>0)
                            <div id="config">
                                <form action="{{ route('save_config_pubgpc') }}" method="POST" id="config_data"
                                      name="config_data">
                                    <input class="hidden" id="key" name="key"
                                           value="{{ app('request')->input('key') }}">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <button type="button" class="btn btn-primary buy-now my-btn col-sm-12"
                                                    onclick="SetDefault()">Reset
                                                to Default?
                                            </button>
                                        </div>
                                    </div>
                                    <h3 class="text-center">Thread Manager</h3>

                                    <div class="form-group row">
                                        <label for="FPS_thread_1_min"
                                               class="col-sm-4 col-form-label text-sm-right">FPS Thread 1 Min</label>
                                        <div class="col-sm-4">
                                            <input id="FPS_thread_1_min" name="FPS_thread_1_min"
                                                   type="number" required min="1" max="100" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="FPS_thread_1_max"
                                               class="col-sm-4 col-form-label text-sm-right">FPS Thread 1 Max</label>
                                        <div class="col-sm-4">
                                            <input id="FPS_thread_1_max" name="FPS_thread_1_max"
                                                   type="number" required min="1" max="100" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="FPS_thread_2_min"
                                               class="col-sm-4 col-form-label text-sm-right">FPS Thread 2 Min</label>
                                        <div class="col-sm-4">
                                            <input id="FPS_thread_2_min" name="FPS_thread_2_min"
                                                   type="number" required min="1" max="100" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="FPS_thread_2_max"
                                               class="col-sm-4 col-form-label text-sm-right">FPS Thread 2 Max</label>
                                        <div class="col-sm-4">
                                            <input id="FPS_thread_2_max" name="FPS_thread_2_max"
                                                   type="number" required min="1" max="100" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="FPS_thread_3_min"
                                               class="col-sm-4 col-form-label text-sm-right">FPS Thread 3 Min</label>
                                        <div class="col-sm-4">
                                            <input id="FPS_thread_3_min" name="FPS_thread_3_min"
                                                   type="number" required min="1" max="100" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="FPS_thread_3_max"
                                               class="col-sm-4 col-form-label text-sm-right">FPS Thread 3 Max</label>
                                        <div class="col-sm-4">
                                            <input id="FPS_thread_3_max" name="FPS_thread_3_max"
                                                   type="number" required min="1" max="100" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="FPS_thread_4_min"
                                               class="col-sm-4 col-form-label text-sm-right">FPS Thread 4 Min</label>
                                        <div class="col-sm-4">
                                            <input id="FPS_thread_4_min" name="FPS_thread_4_min"
                                                   type="number" required min="1" max="100" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="FPS_thread_4_max"
                                               class="col-sm-4 col-form-label text-sm-right">FPS Thread 4 Max</label>
                                        <div class="col-sm-4">
                                            <input id="FPS_thread_4_max" name="FPS_thread_4_max"
                                                   type="number" required min="1" max="100" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="FPS_thread_5_min"
                                               class="col-sm-4 col-form-label text-sm-right">FPS Thread 5 Min</label>
                                        <div class="col-sm-4">
                                            <input id="FPS_thread_5_min" name="FPS_thread_5_min"
                                                   type="number" required min="1" max="100" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="FPS_thread_5_max"
                                               class="col-sm-4 col-form-label text-sm-right">FPS Thread 5 Max</label>
                                        <div class="col-sm-4">
                                            <input id="FPS_thread_5_max" name="FPS_thread_5_max"
                                                   type="number" required min="1" max="100" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="FPS_thread_6_min"
                                               class="col-sm-4 col-form-label text-sm-right">FPS Thread 6 Min</label>
                                        <div class="col-sm-4">
                                            <input id="FPS_thread_6_min" name="FPS_thread_6_min"
                                                   type="number" required min="1" max="100" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="FPS_thread_6_max"
                                               class="col-sm-4 col-form-label text-sm-right">FPS Thread 6 Max</label>
                                        <div class="col-sm-4">
                                            <input id="FPS_thread_6_max" name="FPS_thread_6_max"
                                                   type="number" required min="1" max="100" class="form-control">
                                        </div>
                                    </div>

                                    <h3 class="text-center">Option Misc</h3>

                                    <div class="form-group row">
                                        <label for="F1S_show"
                                               class="col-sm-4 text-sm-right">F1S_show</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="F1S_show" name="F1S_show"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="P1ng_show"
                                               class="col-sm-4 text-sm-right">P1ng_show</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="P1ng_show" name="P1ng_show"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Del4y_show"
                                               class="col-sm-4 text-sm-right">Delay Show</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Del4y_show" name="Del4y_show"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="A4ct0rCount_show"
                                               class="col-sm-4 text-sm-right">A4ct0rCount_show</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="A4ct0rCount_show" name="A4ct0rCount_show"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_color"
                                               class="col-sm-4 text-sm-left">Show Color</label>
                                        <div class="col-sm-2 text-sm-left">
                                            <select id="Sh0w_color" name="Sh0w_color">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Cr0ssH4ir_show"
                                               class="col-sm-4 text-sm-right">Crosshair Show</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Cr0ssH4ir_show" name="Cr0ssH4ir_show"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Cr0ssH4ir_size"
                                               class="col-sm-4 col-form-label text-sm-right">Crosshair Size</label>
                                        <div class="col-sm-4">
                                            <input id="Cr0ssH4ir_size" name="Cr0ssH4ir_size"
                                                   type="number" required min="1" max="100" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Cr0ssH4ir_color"
                                               class="col-sm-4 text-sm-left">Crosshair Color</label>
                                        <div class="col-sm-2 text-sm-left">
                                            <select id="Cr0ssH4ir_color" name="Cr0ssH4ir_color">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Resolution_automode"
                                               class="col-sm-4 text-sm-right">Resolution Automode</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Resolution_automode" name="Resolution_automode"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Resolution_width"
                                               class="col-sm-4 col-form-label text-sm-right">Resolution Width</label>
                                        <div class="col-sm-4">
                                            <input id="Resolution_width" name="Resolution_width"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Resolution_height"
                                               class="col-sm-4 col-form-label text-sm-right">Resolution Height</label>
                                        <div class="col-sm-4">
                                            <input id="Resolution_height" name="Resolution_height"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <h3 class="text-center">Option Show Object</h3>

                                    <div class="form-group row">
                                        <label for="enableSh0w"
                                               class="col-sm-4 text-sm-right">Enable Show</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="enableSh0w" name="enableSh0w"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_P14yer"
                                               class="col-sm-4 text-sm-right">Show Player</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_P14yer" name="Sh0w_P14yer"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_Meter"
                                               class="col-sm-4 text-sm-right">Show Player Meter</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_Pl4yer_Meter" name="Sh0w_Pl4yer_Meter"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_Meter_VeryNear"
                                               class="col-sm-4 col-form-label text-sm-right">Show Player Meter Very
                                            Near</label>
                                        <div class="col-sm-4">
                                            <input id="Sh0w_Pl4yer_Meter_VeryNear" name="Sh0w_Pl4yer_Meter_VeryNear"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_Meter_VeryNearColor"
                                               class="col-sm-4 text-sm-left">Show Player Meter Very Near Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_Meter_VeryNearColor"
                                                    name="Sh0w_Pl4yer_Meter_VeryNearColor">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_Meter_Near"
                                               class="col-sm-4 col-form-label text-sm-right">Show Player Meter
                                            Near</label>
                                        <div class="col-sm-4">
                                            <input id="Sh0w_Pl4yer_Meter_Near" name="Sh0w_Pl4yer_Meter_Near"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_Meter_NearColor"
                                               class="col-sm-4 text-sm-left">Show Player Meter Near Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_Meter_NearColor" name="Sh0w_Pl4yer_Meter_NearColor">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_Meter_SafeColor"
                                               class="col-sm-4 text-sm-left">Show Player Meter Safe Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_Meter_SafeColor" name="Sh0w_Pl4yer_Meter_SafeColor">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_Meter_KnockdownColor"
                                               class="col-sm-4 text-sm-left">Show Player Meter Knockdown Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_Meter_KnockdownColor"
                                                    name="Sh0w_Pl4yer_Meter_KnockdownColor">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Te4mL1ne"
                                               class="col-sm-4 text-sm-right">Show Team Line</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_Te4mL1ne" name="Sh0w_Te4mL1ne"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_M4pSize"
                                               class="col-sm-4 text-sm-right">Show Player Map Size</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_Pl4yer_M4pSize" name="Sh0w_Pl4yer_M4pSize"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_M4p"
                                               class="col-sm-4 text-sm-right">Show Player Map</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_Pl4yer_M4p" name="Sh0w_Pl4yer_M4p"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_R4d4r"
                                               class="col-sm-4 text-sm-right">Show Player Radar</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_Pl4yer_R4d4r" name="Sh0w_Pl4yer_R4d4r"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_M4p_RecSize"
                                               class="col-sm-4 col-form-label text-sm-right">Show Player Map Rec Size</label>
                                        <div class="col-sm-4">
                                            <input id="Sh0w_Pl4yer_M4p_RecSize" name="Sh0w_Pl4yer_M4p_RecSize"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_R4d4r_RecSize"
                                               class="col-sm-4 col-form-label text-sm-right">Show Player Radar Rec Size</label>
                                        <div class="col-sm-4">
                                            <input id="Sh0w_Pl4yer_R4d4r_RecSize" name="Sh0w_Pl4yer_R4d4r_RecSize"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_M4p_Me"
                                               class="col-sm-4 text-sm-left">Show Player Map Me</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_M4p_Me" name="Sh0w_Pl4yer_M4p_Me">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_M4p_Te4mm4te"
                                               class="col-sm-4 text-sm-left">Show Player Map Teamate</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_M4p_Te4mm4te" name="Sh0w_Pl4yer_M4p_Te4mm4te">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_M4p_3n3my"
                                               class="col-sm-4 text-sm-left">Show Player Map Enemy</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_M4p_3n3my" name="Sh0w_Pl4yer_M4p_3n3my">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_M4p_Kn0ckd0wn"
                                               class="col-sm-4 text-sm-left">Show Player Map Knockdown</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_M4p_Kn0ckd0wn" name="Sh0w_Pl4yer_M4p_Kn0ckd0wn">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_M4p_C4reP4ck4ge"
                                               class="col-sm-4 text-sm-left">Show Player Map Care Package</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_M4p_C4reP4ck4ge" name="Sh0w_Pl4yer_M4p_C4reP4ck4ge">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_M4p_Fl4r3C4reP4ck4ge"
                                               class="col-sm-4 text-sm-left">Show Player Map Flare Care Package</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_M4p_Fl4r3C4reP4ck4ge"
                                                    name="Sh0w_Pl4yer_M4p_Fl4r3C4reP4ck4ge">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_M4p_De4thDr0p"
                                               class="col-sm-4 text-sm-left">Show Player Death Drop</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_M4p_De4thDr0p" name="Sh0w_Pl4yer_M4p_De4thDr0p">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_He4dB0x"
                                               class="col-sm-4 text-sm-right">Show Player Headbox</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_Pl4yer_He4dB0x" name="Sh0w_Pl4yer_He4dB0x"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_He4dB0x_Sk3l3ton"
                                               class="col-sm-4 text-sm-right">Show Player HeadBox Skeleton</label>
                                        <label class="col-sm-7 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_Pl4yer_He4dB0x_Sk3l3ton"
                                                   name="Sh0w_Pl4yer_He4dB0x_Sk3l3ton"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_He4dB0x_Dist4nce"
                                               class="col-sm-4 col-form-label text-sm-right">Show Player Headbox
                                            Distance</label>
                                        <div class="col-sm-4">
                                            <input id="Sh0w_Pl4yer_He4dB0x_Dist4nce" name="Sh0w_Pl4yer_He4dB0x_Dist4nce"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_He4dB0x_Sk3l3ton_Dist4nce"
                                               class="col-sm-4 col-form-label text-sm-right">Show Player HeadBox
                                            Skeleton Distance</label>
                                        <div class="col-sm-4">
                                            <input id="Sh0w_Pl4yer_He4dB0x_Sk3l3ton_Dist4nce"
                                                   name="Sh0w_Pl4yer_He4dB0x_Sk3l3ton_Dist4nce"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_He4dB0x_Dist4nce_TextColor"
                                               class="col-sm-4 text-sm-left">Show Player HeadBox Distance Text
                                            Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_He4dB0x_Dist4nce_TextColor"
                                                    name="Sh0w_Pl4yer_He4dB0x_Dist4nce_TextColor">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_He4dB0x_L1ne"
                                               class="col-sm-4 text-sm-left">Show Player HeadBox Line</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_He4dB0x_L1ne" name="Sh0w_Pl4yer_He4dB0x_L1ne">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_He4dB0x_He4thB4r"
                                               class="col-sm-4 text-sm-left">Show Player HeadBox Heath Bar</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_He4dB0x_He4thB4r"
                                                    name="Sh0w_Pl4yer_He4dB0x_He4thB4r">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Pl4yer_He4dB0x_Sk3l3ton_Color"
                                               class="col-sm-4 text-sm-left">Show Player HeadBox
                                            Skeleton Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Pl4yer_He4dB0x_Sk3l3ton_Color"
                                                    name="Sh0w_Pl4yer_He4dB0x_Sk3l3ton_Color">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_V3h1cl3"
                                               class="col-sm-4 text-sm-right">Show Vehicle</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_V3h1cl3" name="Sh0w_V3h1cl3"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_V3h1cl3_TextColor"
                                               class="col-sm-4 text-sm-left">Show Vehicle Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_V3h1cl3_TextColor" name="Sh0w_V3h1cl3_TextColor">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_V3h1cl3_He4thFu3lColor"
                                               class="col-sm-4 text-sm-left">Show Vehicle Heath Full Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_V3h1cl3_He4thFu3lColor" name="Sh0w_V3h1cl3_He4thFu3lColor">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_V3h1cl3_W4rn1ngColor"
                                               class="col-sm-4 text-sm-left">Show Vehicle Waring Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_V3h1cl3_W4rn1ngColor" name="Sh0w_V3h1cl3_W4rn1ngColor">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_V3h1cl3_M4p"
                                               class="col-sm-4 text-sm-left">Show Vehicle Map</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_V3h1cl3_M4p" name="Sh0w_V3h1cl3_M4p">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Proj"
                                               class="col-sm-4 text-sm-right">Show Project</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_Proj" name="Sh0w_Proj"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Proj_TextColor"
                                               class="col-sm-4 text-sm-left">Show Project Text Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Proj_TextColor" name="Sh0w_Proj_TextColor">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Proj_M4p"
                                               class="col-sm-4 text-sm-left">Show Project Map</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Proj_M4p" name="Sh0w_Proj_M4p">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Sh0w_It3m"
                                               class="col-sm-4 text-sm-right">Show Item</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_It3m" name="Sh0w_It3m"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Sh0w_It3m_Sp3ci4l"
                                               class="col-sm-4 text-sm-right">Show Item Special</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_It3m_Sp3ci4l" name="Sh0w_It3m_Sp3ci4l"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Sh0w_It3m_Gvn"
                                               class="col-sm-4 text-sm-right">Show Item GVN</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_It3m_Gvn" name="Sh0w_It3m_Gvn"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_It3m_Gvn_TextColor"
                                               class="col-sm-4 text-sm-left">Show Item GVN Text Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_It3m_Gvn_TextColor" name="Sh0w_It3m_Gvn_TextColor">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_It3m_4tt4chm3nt"
                                               class="col-sm-4 text-sm-right">Show Item Attachment</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_It3m_4tt4chm3nt" name="Sh0w_It3m_4tt4chm3nt"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_It3m_4tt4chm3nt_TextColor"
                                               class="col-sm-4 text-sm-left">Show Item Attachment Text Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_It3m_4tt4chm3nt_TextColor"
                                                    name="Sh0w_It3m_4tt4chm3nt_TextColor">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_It3m_H34l"
                                               class="col-sm-4 text-sm-right">Show Item Heal</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_It3m_H34l" name="Sh0w_It3m_H34l"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_It3m_H34l_TextColor"
                                               class="col-sm-4 text-sm-left">Show Item Heal Text Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_It3m_H34l_TextColor" name="Sh0w_It3m_H34l_TextColor">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_It3m_4mm0_5"
                                               class="col-sm-4 text-sm-right">Show Item Ammo 5</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_It3m_4mm0_5" name="Sh0w_It3m_4mm0_5"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_It3m_4mm0_5_TextColor"
                                               class="col-sm-4 text-sm-left">Show Item Ammo Text Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_It3m_4mm0_5_TextColor" name="Sh0w_It3m_4mm0_5_TextColor">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_It3m_4mm0_7"
                                               class="col-sm-4 text-sm-right">Show Item Ammo 7</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_It3m_4mm0_7" name="Sh0w_It3m_4mm0_7"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_It3m_4mm0_7_TextColor"
                                               class="col-sm-4 text-sm-left">Show Item Ammo 7 Text Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_It3m_4mm0_7_TextColor" name="Sh0w_It3m_4mm0_7_TextColor">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_It3m_4mm0_9"
                                               class="col-sm-4 text-sm-right">Show Item Ammo 9</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_It3m_4mm0_9" name="Sh0w_It3m_4mm0_9"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_It3m_4mm0_9_TextColor"
                                               class="col-sm-4 text-sm-left">Show Item Ammo 9 Text Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_It3m_4mm0_9_TextColor" name="Sh0w_It3m_4mm0_9_TextColor">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Item_Ammo_300Magnum"
                                               class="col-sm-4 text-sm-right">Show Item Ammo 300 Magnum</label>
                                        <label class="col-sm-7 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_Item_Ammo_300Magnum"
                                                   name="Sh0w_Item_Ammo_300Magnum"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Item_Ammo_300Magnum_TextColor"
                                               class="col-sm-4 text-sm-left">Show Item Ammo 300 Magnum Text
                                            Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Item_Ammo_300Magnum_TextColor"
                                                    name="Sh0w_Item_Ammo_300Magnum_TextColor">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Sh0w_Item_Ammo_Flare"
                                               class="col-sm-4 text-sm-right">Show Item Ammo Flare</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_Item_Ammo_Flare" name="Sh0w_Item_Ammo_Flare"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Item_Ammo_Flare_TextColor"
                                               class="col-sm-4 text-sm-left">Show Item Ammo Flare Text Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Item_Ammo_Flare_TextColor"
                                                    name="Sh0w_Item_Ammo_Flare_TextColor">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Bull3t"
                                               class="col-sm-4 text-sm-right">Show Bullet</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_Bull3t" name="Sh0w_Bull3t"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Sh0w_Bull3t_Color"
                                               class="col-sm-4 text-sm-left">Show Bullet Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="Sh0w_Bull3t_Color" name="Sh0w_Bull3t_Color">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Bull3t_Size"
                                               class="col-sm-4 col-form-label text-sm-right">Show Bullet Size</label>
                                        <div class="col-sm-4">
                                            <input id="Sh0w_Bull3t_Size" name="Sh0w_Bull3t_Size"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="Sh0w_Bull3t_vs_hitpoint"
                                               class="col-sm-4 text-sm-right">Show Bullet vs Hitpoint</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="Sh0w_Bull3t_vs_hitpoint"
                                                   name="Sh0w_Bull3t_vs_hitpoint"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <h3 class="text-center">Option AIMBOT</h3>

                                    <div class="form-group row">
                                        <label for="keym0d3"
                                               class="col-sm-4 col-form-label text-sm-right">Key Mode</label>
                                        <div class="col-sm-4">
                                            <input id="keym0d3" name="keym0d3"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="enable4imb0t"
                                               class="col-sm-4 text-sm-right">Enable AIMBOT</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="enable4imb0t"
                                                   name="enable4imb0t"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>


                                    <div class="form-group row">
                                        <label for="NearMode_RangeTo4im"
                                               class="col-sm-4 col-form-label text-sm-right">Near Mode Range To
                                            AIM</label>
                                        <div class="col-sm-4">
                                            <input id="NearMode_RangeTo4im" name="NearMode_RangeTo4im"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="NearMode_4imF0U"
                                               class="col-sm-4 col-form-label text-sm-right">Near Mode AIM FOU</label>
                                        <div class="col-sm-4">
                                            <input id="NearMode_4imF0U" name="NearMode_4imF0U"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="NormalMode_4imFOU"
                                               class="col-sm-4 col-form-label text-sm-right">Normal Mode AIM FOU</label>
                                        <div class="col-sm-4">
                                            <input id="NormalMode_4imFOU" name="NormalMode_4imFOU"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="aimRange"
                                               class="col-sm-4 col-form-label text-sm-right">AIM Range</label>
                                        <div class="col-sm-4">
                                            <input id="aimRange" name="aimRange"
                                                   type="text" required class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="aimClickFreg"
                                               class="col-sm-4 col-form-label text-sm-right">AIM Click Freg</label>
                                        <div class="col-sm-4">
                                            <input id="aimClickFreg" name="aimClickFreg"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="aimInitspeed"
                                               class="col-sm-4 col-form-label text-sm-right">AIM Init Speed</label>
                                        <div class="col-sm-4">
                                            <input id="aimInitspeed" name="aimInitspeed"
                                                   type="text" required class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="Sm00thStep"
                                               class="col-sm-4 col-form-label text-sm-right">Smooth Step</label>
                                        <div class="col-sm-4">
                                            <input id="Sm00thStep" name="Sm00thStep"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="DelayMode"
                                               class="col-sm-4 text-sm-right">DelayMode</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="DelayMode" name="DelayMode"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>


                                    <div class="form-group row">
                                        <label for="maxInstantStep"
                                               class="col-sm-4 col-form-label text-sm-right">Max Instant Step</label>
                                        <div class="col-sm-4">
                                            <input id="maxInstantStep" name="maxInstantStep"
                                                   type="text" required class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="minInstantStep"
                                               class="col-sm-4 col-form-label text-sm-right">Min Instant Step</label>
                                        <div class="col-sm-4">
                                            <input id="minInstantStep" name="minInstantStep"
                                                   type="text" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="M1ssPercent"
                                               class="col-sm-4 col-form-label text-sm-right">Miss Percent</label>
                                        <div class="col-sm-4">
                                            <input id="M1ssPercent" name="M1ssPercent"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="F0reHe4dPercent"
                                               class="col-sm-4 col-form-label text-sm-right">Fore Head Percent</label>
                                        <div class="col-sm-4">
                                            <input id="F0reHe4dPercent" name="F0reHe4dPercent"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="He4dPercent"
                                               class="col-sm-4 col-form-label text-sm-right">Head Percent</label>
                                        <div class="col-sm-4">
                                            <input id="He4dPercent" name="He4dPercent"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="lastChange4imPercent"
                                               class="col-sm-4 col-form-label text-sm-right">Last Change AIM
                                            Percent</label>
                                        <div class="col-sm-4">
                                            <input id="lastChange4imPercent" name="lastChange4imPercent"
                                                   type="number" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="lastChangeZer0LevelTick"
                                               class="col-sm-4 col-form-label text-sm-right">Last Change Zero Level
                                            Tick</label>
                                        <div class="col-sm-4">
                                            <input id="lastChangeZer0LevelTick" name="lastChangeZer0LevelTick"
                                                   type="number" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="show4imP0int"
                                               class="col-sm-4 text-sm-right">Show AIM Point</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="show4imP0int" name="show4imP0int"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="A1mP0int_VisibleColor"
                                               class="col-sm-4 text-sm-left">AIM Point Visible Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="A1mP0int_VisibleColor" name="A1mP0int_VisibleColor">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="A1mP0int_InvisibleColor"
                                               class="col-sm-4 text-sm-left">AIM Point Invisible Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="A1mP0int_InvisibleColor" name="A1mP0int_InvisibleColor">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="showH1tP0int"
                                               class="col-sm-4 text-sm-right">Show Hit Point</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="showH1tP0int" name="showH1tP0int"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>


                                    <div class="form-group row">
                                        <label for="H1tP0intColor"
                                               class="col-sm-4 text-sm-left">Hit Point Color</label>
                                        <div class="col-sm-2 text-sm-right">
                                            <select id="H1tP0intColor" name="H1tP0intColor">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="ChangeZer0LevelDelay"
                                               class="col-sm-4 col-form-label text-sm-right">Change Zero Level
                                            Delay</label>
                                        <div class="col-sm-4">
                                            <input id="ChangeZer0LevelDelay" name="ChangeZer0LevelDelay"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="test_addToAimPointZ_all"
                                               class="col-sm-4 col-form-label text-sm-right">Test Add To AIM PointZ All</label>
                                        <div class="col-sm-4">
                                            <input id="test_addToAimPointZ_all" name="test_addToAimPointZ_all"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="test_addToAimPointZ_below_angle"
                                               class="col-sm-4 col-form-label text-sm-right">Test Add To AIM PointZ Below Angle</label>
                                        <div class="col-sm-4">
                                            <input id="test_addToAimPointZ_below_angle"
                                                   name="test_addToAimPointZ_below_angle"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="test_addToAimPointZ_below"
                                               class="col-sm-4 col-form-label text-sm-right">Test Add To AIM PointZ Below</label>
                                        <div class="col-sm-4">
                                            <input id="test_addToAimPointZ_below" name="test_addToAimPointZ_below"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="test_addToAimPointZ_running"
                                               class="col-sm-4 col-form-label text-sm-right">Test Add To AIM PointZ Running</label>
                                        <div class="col-sm-4">
                                            <input id="test_addToAimPointZ_running" name="test_addToAimPointZ_running"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="meter_UseMeter"
                                               class="col-sm-4 text-sm-right">Meter Use Meter</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="meter_UseMeter" name="meter_UseMeter"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="meter_HeghtFromHitPoint"
                                               class="col-sm-4 col-form-label text-sm-right">Meter Height From Hit
                                            Point</label>
                                        <div class="col-sm-4">
                                            <input id="meter_HeghtFromHitPoint" name="meter_HeghtFromHitPoint"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="aimpoint_smart_mode"
                                               class="col-sm-4 text-sm-right">AIM Point Smart Mode</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="aimpoint_smart_mode" name="aimpoint_smart_mode"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="manual_aimpoint"
                                               class="col-sm-4 col-form-label text-sm-right">Manual AIM Point</label>
                                        <div class="col-sm-4">
                                            <input id="manual_aimpoint" name="manual_aimpoint"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <h3 class="text-center">
                                        Option Weapon Mod
                                    </h3>

                                    <div class="form-group row">
                                        <label for="noSwayOrigin"
                                               class="col-sm-4 col-form-label text-sm-right">No Sway Origin</label>
                                        <div class="col-sm-4">
                                            <input id="noSwayOrigin" name="noSwayOrigin"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="noRecoilOrigin"
                                               class="col-sm-4 col-form-label text-sm-right">No Recoil Origin</label>
                                        <div class="col-sm-4">
                                            <input id="noRecoilOrigin" name="noRecoilOrigin"
                                                   type="number" required class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="isNoSway"
                                               class="col-sm-4 text-sm-right">Is No Sway</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="isNoSway" name="isNoSway"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <label for="isNoRecoil"
                                               class="col-sm-4 text-sm-right">Is No Recoil</label>
                                        <label class="col-sm-8 text-sm-right switch">
                                            <input type="checkbox" id="isNoRecoil" name="isNoRecoil"
                                                   onclick="Checked(this);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button type="submit" class="btn btn-warning buy-now my-btn col-sm-12">SAVE
                                                CONFIG
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>


                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        !function (t) {
            "use strict";
            var o = function (o, e) {
                this.options = e, this.$select = t(o), this._init()
            };
            o.prototype = {
                constructor: o, _init: function () {
                    var o = this.options.callback, e = this.$select.val(),
                        a = this.$select.find("option:selected").data("color"),
                        l = t("<ul>").addClass("dropdown-menu").addClass("dropdown-caret"),
                        s = t("<div>").addClass("dropdown").addClass("dropdown-colorselector"),
                        c = t("<span>").addClass("btn-colorselector").css("background-color", a),
                        n = t("<a>").attr("data-toggle", "dropdown").addClass("dropdown-toggle").attr("href", "#").append(c);
                    t("option", this.$select).each(function () {
                        var o = t(this), a = o.attr("value"), s = o.data("color"), c = o.text(),
                            n = t("<a>").addClass("color-btn");
                        (o.prop("selected") === !0 || e === s) && n.addClass("selected"), n.css("background-color", s), n.attr("href", "#").attr("data-color", s).attr("data-value", a).attr("title", c), l.append(t("<li>").append(n))
                    }), s.append(n), s.append(l), this.$select.hide(), this.$selector = t(s).insertAfter(this.$select), this.$select.on("change", function () {
                        var e = t(this).val(), a = t(this).find("option[value='" + e + "']").data("color"),
                            l = t(this).find("option[value='" + e + "']").text();
                        t(this).next().find("ul").find("li").find(".selected").removeClass("selected"), t(this).next().find("ul").find("li").find("a[data-color='" + a + "']").addClass("selected"), t(this).next().find(".btn-colorselector").css("background-color", a), o(e, a, l)
                    }), l.on("click.colorselector", t.proxy(this._clickColor, this))
                }, _clickColor: function (o) {
                    var e = t(o.target);
                    return e.is(".color-btn") ? (this.$select.val(e.data("value")).change(), o.preventDefault(), !0) : !1
                }, setColor: function (o) {
                    var e = t(this.$selector).find("li").find("a[data-color='" + o + "']").data("value");
                    this.setValue(e)
                }, setValue: function (t) {
                    this.$select.val(t).change()
                }
            }, t.fn.colorselector = function (e) {
                var a = Array.apply(null, arguments);
                return a.shift(), this.each(function () {
                    var l = t(this), s = l.data("colorselector"),
                        c = t.extend({}, t.fn.colorselector.defaults, l.data(), "object" == typeof e && e);
                    s || l.data("colorselector", s = new o(this, c)), "string" == typeof e && s[e].apply(s, a)
                })
            }, t.fn.colorselector.defaults = {
                callback: function () {
                }, colorsPerRow: 8
            }, t.fn.colorselector.Constructor = o
        }(jQuery, window, document);
    </script>
    <script>
        function addColor() {
            $(".form-group select").append('<option value="Colors::Green" data-color="#32CD32" selected>green</option>');
            $(".form-group select").append('<option value="Colors::DarkOrange" data-color="#FF8C00">darkorange</option>');
            $(".form-group select").append('<option value="Colors::DarkRed" data-color="#8b0000">darkred</option>');
            $(".form-group select").append('<option value="Colors::Red" data-color="#ff0000">red</option>');
            $(".form-group select").append('<option value="Colors::DarkGreen" data-color="#013220">darkgreen</option>');
            $(".form-group select").append('<option value="Colors::DarkGray" data-color="#a9a9a9">darkgray</option>');
            $(".form-group select").append('<option value="Colors::White" data-color="#FFFFFF">white</option>');
            $(".form-group select").append('<option value="ImColor(0, 82, 204, 255)" data-color="#0052CC">(0, 82, 204, 255)</option>');
            $(".form-group select").append('<option value="ImColor(255, 51, 0, 255)" data-color="#FF3300">(255, 51, 0, 255)</option>');
            $(".form-group select").append('<option value="ImColor(38, 38, 38, 255)" data-color="#262626">(38, 38, 38, 255)</option>');
            $(".form-group select").append('<option value="ImColor(51, 204, 51, 255)" data-color="#33CC33">(51, 204, 51, 255)</option>');
            $(".form-group select").append('<option value="ImColor(255, 255, 0, 255)" data-color="#FFFF00">(255, 255, 0, 255)</option>');
            $(".form-group select").append('<option value="ImColor(50, 50, 50, 255)" data-color="#323232">(50, 50, 50, 255)</option>');
            $(".form-group select").append('<option value="ImColor(255, 0, 0, 255)" data-color="#FF0000">(255, 0, 0, 255)</option>');
            $(".form-group select").append('<option value="ImColor(0, 204, 0, 50)" data-color="#00CC00">(0, 204, 0, 50)</option>');
            $(".form-group select").append('<option value="ImColor(51, 204, 51, 255)" data-color="#33CC33">(51, 204, 51, 255)</option>');
            $(".form-group select").append('<option value="ImColor(0, 0, 153, 255)" data-color="#000099">(0, 0, 153, 255)</option>');
            $(".form-group select").append('<option value="ImColor(51, 0, 51, 255)" data-color="#330033">(51, 0, 51, 255)</option>');
            $(".form-group select").append('<option value="ImColor(0, 38, 77, 255)" data-color="#00264D">(0, 38, 77, 255)</option>');
            $(".form-group select").append('<option value="ImColor(0, 153, 0, 255)" data-color="#009900">(0, 153, 0, 255)</option>');
            $(".form-group select").append('<option value="ImColor(204, 153, 0, 255)" data-color="#CC9900">(204, 153, 0, 255)</option>');
            $(".form-group select").append('<option value="ImColor(255, 65, 0, 255)" data-color="#FF4100">(255, 65, 0, 255)</option>');
            $(".form-group select").append('<option value="ImColor(5, 55, 20, 255)" data-color="#053714">(5, 55, 20, 255)</option>');
            $(".form-group select").append('<option value="ImColor(204, 0, 153, 255)" data-color="#CC0099">(204, 0, 153, 255)</option>');
        }

        function loadColor() {
            $('#Sh0w_color').colorselector();
            $('#Cr0ssH4ir_color').colorselector();
            $('#Sh0w_Pl4yer_Meter_VeryNearColor').colorselector();
            $('#Sh0w_Pl4yer_Meter_NearColor').colorselector();
            $('#Sh0w_Pl4yer_Meter_SafeColor').colorselector();
            $('#Sh0w_Pl4yer_M4p_Me').colorselector();
            $('#Sh0w_Pl4yer_M4p_Te4mm4te').colorselector();
            $('#Sh0w_Pl4yer_M4p_3n3my').colorselector();
            $('#Sh0w_Pl4yer_M4p_Kn0ckd0wn').colorselector();
            $('#Sh0w_Pl4yer_M4p_C4reP4ck4ge').colorselector();
            $('#Sh0w_Pl4yer_M4p_Fl4r3C4reP4ck4ge').colorselector();
            $('#Sh0w_Pl4yer_M4p_De4thDr0p').colorselector();
            $('#Sh0w_Pl4yer_He4dB0x_Dist4nce_TextColor').colorselector();
            $('#Sh0w_Pl4yer_He4dB0x_L1ne').colorselector();
            $('#Sh0w_Pl4yer_He4dB0x_He4thB4r').colorselector();
            $('#Sh0w_Pl4yer_He4dB0x_Sk3l3ton_Color').colorselector();
            $('#Sh0w_V3h1cl3_TextColor').colorselector();
            $('#Sh0w_V3h1cl3_He4thFu3lColor').colorselector();
            $('#Sh0w_V3h1cl3_W4rn1ngColor').colorselector();
            $('#Sh0w_V3h1cl3_M4p').colorselector();
            $('#Sh0w_Proj_TextColor').colorselector();
            $('#Sh0w_Proj_M4p').colorselector();
            $('#Sh0w_It3m_Gvn_TextColor').colorselector();
            $('#Sh0w_It3m_4tt4chm3nt_TextColor').colorselector();
            $('#Sh0w_It3m_H34l_TextColor').colorselector();
            $('#Sh0w_It3m_4mm0_5_TextColor').colorselector();
            $('#Sh0w_It3m_4mm0_9_TextColor').colorselector();
            $('#Sh0w_Item_Ammo_300Magnum_TextColor').colorselector();
            $('#Sh0w_Item_Ammo_Flare_TextColor').colorselector();
            $('#Sh0w_Bull3t_Color').colorselector();
            $('#Sh0w_It3m_4mm0_7_TextColor').colorselector();
            $('#A1mP0int_VisibleColor').colorselector();
            $('#A1mP0int_InvisibleColor').colorselector();
            $('#Sh0w_Pl4yer_Meter_KnockdownColor').colorselector();
        }

        function SetDefault() {
            $("#FPS_thread_1_min").val(70);
            $("#FPS_thread_1_max").val(40);
            $("#FPS_thread_2_min").val(70);
            $("#FPS_thread_2_max").val(40);
            $("#FPS_thread_3_min").val(70);
            $("#FPS_thread_3_max").val(40);
            $("#FPS_thread_4_min").val(70);
            $("#FPS_thread_4_max").val(40);
            $("#FPS_thread_5_min").val(70);
            $("#FPS_thread_5_max").val(40);
            $("#FPS_thread_6_min").val(70);
            $("#FPS_thread_6_max").val(40);

            $("#F1S_show").val(true).prop('checked', true);
            $("#P1ng_show").val(false).prop('checked', false);
            $("#Del4y_show").val(false).prop('checked', false);
            $("#A4ct0rCount_show").val(false).prop('checked', false);

            $("#Cr0ssH4ir_show").val(false).prop('checked', false);
            $("#Cr0ssH4ir_size").val(3);
            $("#Cr0ssH4ir_color").colorselector("setValue", "Colors::Green");

            $("#Resolution_automode").val(true).prop('checked', true);
            $("#Resolution_width").val(1920);
            $("#Resolution_height").val(1080);

            $("#enableSh0w").val(true).prop('checked', true);
            $("#Sh0w_P14yer").val(true).prop('checked', true);
            $("#Sh0w_Pl4yer_Meter").val(true).prop('checked', true);
            $("#Sh0w_Pl4yer_Meter_VeryNear").val(150);
            $("#Sh0w_Pl4yer_Meter_VeryNearColor").val("Colors::DarkRed");
            $("#Sh0w_Pl4yer_Meter_Near").val(300);
            $("#Sh0w_Pl4yer_Meter_NearColor").colorselector("setValue", "Colors::DarkOrange");
            $("#Sh0w_Pl4yer_Meter_SafeColor").colorselector("setValue", "Colors::DarkGreen");
            $("#Sh0w_Pl4yer_Meter_KnockdownColor").colorselector("setValue", "Colors::DarkGray");

            $("#Sh0w_Te4mL1ne").val(false).prop('checked', false);
            $("#Sh0w_Pl4yer_M4p").val(true).prop('checked', true);
            $("#Sh0w_Pl4yer_R4d4r").val(true).prop('checked', true);
            $("#Sh0w_Pl4yer_M4p_RecSize").val(4);
            $("#Sh0w_Pl4yer_R4d4r_RecSize").val(6);

            $("#Sh0w_Pl4yer_M4p_Me").colorselector("setValue", "Colors::White");
            $("#Sh0w_Pl4yer_M4p_Te4mm4te").colorselector("setValue", "ImColor(0, 82, 204, 255)");
            $("#Sh0w_Pl4yer_M4p_3n3my").colorselector("setValue", "ImColor(255, 51, 0, 255)");
            $("#Sh0w_Pl4yer_M4p_Kn0ckd0wn").colorselector("setValue", "ImColor(38, 38, 38, 255)");
            $("#Sh0w_Pl4yer_M4p_C4reP4ck4ge").colorselector("setValue", "ImColor(51, 204, 51, 255)");
            $("#Sh0w_Pl4yer_M4p_Fl4r3C4reP4ck4ge").colorselector("setValue", "ImColor(255, 255, 0, 255)");
            $("#Sh0w_Pl4yer_M4p_De4thDr0p").colorselector("setValue", "ImColor(50, 50, 50, 255)");

            $("#Sh0w_Pl4yer_He4dB0x").val(false).prop('checked', false);
            $("#Sh0w_Pl4yer_He4dB0x_Sk3l3ton").val(true).prop('checked', true);
            $("#Sh0w_Pl4yer_He4dB0x_Dist4nce").val(150);
            $("#Sh0w_Pl4yer_He4dB0x_Sk3l3ton_Dist4nce").val(50);
            $("#Sh0w_Pl4yer_He4dB0x_Dist4nce_TextColor").colorselector("setValue", "ImColor(255, 0, 0, 255)");
            $("#Sh0w_Pl4yer_He4dB0x_L1ne").colorselector("setValue", "ImColor(255, 0, 0, 255)");
            $("#Sh0w_Pl4yer_He4dB0x_He4thB4r").colorselector("setValue", "ImColor(0, 204, 0, 50)");
            $("#Sh0w_Pl4yer_He4dB0x_Sk3l3ton_Color").colorselector("setValue", "ImColor(51, 204, 51, 255)");

            $("#Sh0w_V3h1cl3").val(true).prop('checked', true);
            $("#Sh0w_V3h1cl3_TextColor").colorselector("setValue", "ImColor(0, 0, 77, 255)");
            $("#Sh0w_V3h1cl3_He4thFu3lColor").colorselector("setValue", "Colors::DarkGreen");
            $("#Sh0w_V3h1cl3_W4rn1ngColor").colorselector("setValue", "Colors::DarkRed");
            $("#Sh0w_V3h1cl3_M4p").colorselector("setValue", "ImColor(0, 0, 153, 255)");

            $("#Sh0w_Proj").val(true).prop('checked', true);
            $("#Sh0w_Proj_TextColor").colorselector("setValue", "ImColor(255, 0, 0, 255)");
            $("#Sh0w_Proj_M4p").colorselector("setValue", "ImColor(255, 0, 0, 255)");

            $("#Sh0w_It3m").val(true).prop('checked', true);
            $("#Sh0w_It3m_Sp3ci4l").val(true).prop('checked', true);


            $("#Sh0w_It3m_Gvn").val(true).prop('checked', true);
            $("#Sh0w_It3m_Gvn_TextColor").colorselector("setValue", "ImColor(128, 32, 0, 255)");
            $("#Sh0w_It3m_4tt4chm3nt").val(true).prop('checked', true);
            $("#Sh0w_It3m_4tt4chm3nt_TextColor").colorselector("setValue", "ImColor(51, 0, 51, 255)");
            $("#Sh0w_It3m_H34l").val(true).prop('checked', true);
            $("#Sh0w_It3m_H34l_TextColor").colorselector("setValue", "ImColor(0, 38, 77, 255)");
            $("#Sh0w_It3m_4mm0_5").val(true).prop('checked', true);
            $("#Sh0w_It3m_4mm0_5_TextColor").colorselector("setValue", "ImColor(0, 153, 0, 255)");
            $("#Sh0w_It3m_4mm0_7").val(true).prop('checked', true);
            $("#Sh0w_It3m_4mm0_7_TextColor").colorselector("setValue", "ImColor(204, 153, 0, 255)");
            $("#Sh0w_It3m_4mm0_9").val(false).prop('checked', false);
            $("#Sh0w_It3m_4mm0_9_TextColor").colorselector("setValue", "ImColor(255, 65, 0, 255)");
            $("#Sh0w_Item_Ammo_300Magnum").val(true).prop('checked', true);
            $("#Sh0w_Item_Ammo_300Magnum_TextColor").colorselector("setValue", "ImColor(5, 55, 20, 255)");
            $("#Sh0w_Item_Ammo_Flare").val(true).prop('checked', true);
            $("#Sh0w_Item_Ammo_Flare_TextColor").colorselector("setValue", "Colors::DarkOrange");

            $("#Sh0w_Bull3t").val(false).prop('checked', false);
            $("#Sh0w_Bull3t_Color").colorselector("setValue", "ImColor(204, 0, 153, 255)");
            $("#Sh0w_Bull3t_Size").val(3);
            $("#Sh0w_Bull3t_vs_hitpoint").val(false).prop('checked', false);

            $("#keym0d3").val(0);
            $("#enable4imb0t").val(true).prop('checked', true);
            $("#NearMode_RangeTo4im").val(50);
            $("#NearMode_4imF0U").val(150);
            $("#NormalMode_4imFOU").val(100);
            $("#aimRange").val('1000.f');
            $("#aimClickFreg").val(500);
            $("#aimInitspeed").val('750.f');

            $("#Sm00thStep").val(3);
            $("#DelayMode").val(false).prop('checked', false);
            $("#maxInstantStep").val('0.2f');
            $("#minInstantStep").val('0.015f');
            $("#M1ssPercent").val(0);
            $("#F0reHe4dPercent").val(0);
            $("#He4dPercent").val(40);
            $("#show4imP0int").val(true).prop('checked', true);
            $("#A1mP0int_VisibleColor").colorselector("setValue", "Colors::Green");
            $("#A1mP0int_InvisibleColor").colorselector("setValue", "Colors::Red");
            $("#showH1tP0int").val(false).prop('checked', false);
            $("#H1tP0intColor").colorselector("setValue", "Colors::Red");

            $("#ChangeZer0LevelDelay").val(250);
            $("#test_addToAimPointZ_all").val(0);
            $("#test_addToAimPointZ_below_angle").val(15);
            $("#test_addToAimPointZ_below").val(-3);
            $("#test_addToAimPointZ_running").val(-5);

            $("#meter_UseMeter").val(false).prop('checked', false);
            $("#meter_HeghtFromHitPoint").val(0);

            $("#aimpoint_smart_mode").val(true).prop('checked', true);
            $("#manual_aimpoint").val(0);

            $("#noSwayOrigin").val(0);
            $("#noRecoilOrigin").val(0);
            $("#isNoSway").val(false).prop('checked', false);
            $("#isNoRecoil").val(false).prop('checked', false);
        }

        function Checked(e) {
            $(e).val(!!e.checked);
        }

        function loadKeyConfig() {
            $.get("{{ route('get-key-config') }}" + "/" + "{{ app('request')->input('key') }}", function (response) {
                if (response === "") {
                    SetDefault();
                } else {
                    response = $.parseJSON(response);
                    $.each(response, function (index, value) {
                        let e = $("#" + index);
                        if (e.is('input') && e.attr('type') === 'checkbox') {
                            if (value === "true") {
                                e.val(true).prop('checked', true);
                            } else {
                                e.val(false).prop('checked', false);
                            }
                        } else if (e.is('input') && e.attr('type') !== 'checkbox') {
                            e.val(value);
                        } else if (e.is('select')) {
                            e.colorselector("setValue", value);
                        }
                    })
                }
            })
        }

        addColor();
        loadColor();
        loadKeyConfig();
    </script>
@stop
