@extends('layouts.app_no_header')
@section('title')
     {{ trans('auth.register') }}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <div class="card">
                    <div class="card-header col-sm-offset-1">{{ trans('auth.new_register') }}</div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name"
                                   class="col-sm-3 col-form-label text-sm-right">{{ trans('auth.your_name') }}</label>

                            <div class="col-sm-8">
                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                       name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email"
                                   class="col-sm-3 col-form-label text-sm-right">{{ trans('auth.your_email') }}
                                (*)</label>

                            <div class="col-sm-8">
                                <input id="email" type="email"
                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                       name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						<!--
                        <div class="form-group row">
                            <label for="phone"
                                   class="col-sm-3 col-form-label text-sm-right">{{ trans('auth.your_phone') }}</label>

                            <div class="col-sm-8">
                                <input id="phone" type="text"
                                       class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                       name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						-->
                        <div class="form-group row">
                            <label for="password"
                                   class="col-sm-3 col-form-label text-sm-right">{{ trans('auth.password') }}
                                (*)</label>

                            <div class="col-sm-8">
                                <input id="password" type="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                   class="col-sm-3 col-form-label text-sm-right">{{ trans('auth.password_confirm') }}
                                (*)</label>

                            <div class="col-sm-8">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required>
                            </div>
                        </div>

                        @if(!request()->session()->exists('ref'))
                            <div class="form-group row">
                                <label for="ref_user_id"
                                       class="col-sm-3 col-form-label text-sm-right">{{ trans('auth.referral_id') }}</label>

                                <div class="col-sm-8">
                                    <input id="ref_user_id" type="text"
                                           class="form-control{{ $errors->has('ref_user_id') ? ' is-invalid' : '' }}"
                                           name="ref_user_id" value="{{ old('ref_user_id') }}">

                                    @if ($errors->has('ref_user_id'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ref_user_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <!--@if(request()->session()->get('ref') != '6281')-->
                                <div class="form-group row">
                                    <label for="ref_user_id"
                                           class="col-sm-3 col-form-label text-sm-right">{{ __('Referer ID') }}</label>

                                    <div class="col-sm-8 text-left">
                                        <strong>{{request()->session()->get('ref')}}</strong>
                                    </div>
                                </div>
							<!--@endif-->

                            <input type="hidden" name="ref_user_id" value="{{request()->session()->get('ref')}}">
                        @endif
                        <div class="form-group row mb-0">
                            <div class="col-sm-8 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary col-sm-12">
                                    {{ trans('auth.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
