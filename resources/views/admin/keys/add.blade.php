@extends('adminlte::page')

@section('title', 'Add new key')

@section('content_header')
    <h1>Add new key</h1>
    <br>
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif

@stop

@section('content')
    <form action="{{route('key.store')}}" method="post" role="form">
        @csrf
        @if(count($errors)>0)
            <ol>
                @foreach($errors->all() as $err)
                    <li class=" text-warning" style="margin-bottom: 5px">
                        {{$err}}
                    </li>
                @endforeach
            </ol>
        @endif

        <div class="form-group">

            @if(count($listTool) == 0)
                <label for="" class="">No tool found!</label>
            @else
                <label for="" class="">Chọn tool</label>
                <select class="form-control" id="tool" required name="tool_id">
                    @php
                        $packagesList = array();
                    @endphp
                       <option value="null">-- Select tool --</option>
                    @foreach($tools as $tool)
                        @php
                            $packagesList["t".$tool->id] = (array) $tool->package;
                        @endphp

                        <option value="{{$tool->id}}" @if (old('tool_id') == $tool->id) {{ 'selected' }} @endif>{{str_pad($tool->game_name, 50, '.')}}: {{$tool->name}}</option>
                    @endforeach
                </select>
            @endif

        </div>

        <div class="form-group">
            <label for="package" class="">Select key</label>
            <select class="form-control" id="package" name="package">
            </select>
        </div>
        <div class="form-group">
            <label for="">List of key</label>
            <textarea name="keys" class="form-control" rows="15">{{ old('keys') }}</textarea>
        </div>


        <br>

        <a href="{{URL::previous()}}" class="btn btn-warning">BACK</a>
        <button type="submit" class="btn btn-success pull-right" style="width: 90px">SAVE</button>
    </form>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            let toolType = $('#tool').val();
            addOption(toolType)
        });
        $('#tool').on('change', function () {
            let toolType = $(this).val();
            addOption(toolType);
        });

        function addOption(toolType) {
            let packagesList = JSON.parse('{!! isset($packagesList) ? json_encode($packagesList) : "" !!}');
            $('#package').html('');
            $.each(packagesList["t" + toolType], function (i, e) {
                let selected = "";
                $('#package').append('<option value="' + i + '" ' + selected + '>' + i + '=' + e + '</option>');
            })
        }
    </script>
@stop
