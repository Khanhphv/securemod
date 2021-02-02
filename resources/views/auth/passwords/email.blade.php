@extends('layouts.app_no_header')
@section('title')
    RESET PASSWORD
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <div class="card">
                    <div class="card-header">{{ __('RESET PASSWORD') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-sm-3 col-form-label text-sm-right">{{ __('Email address') }}</label>

                                <div class="col-sm-8">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button type="submit" class="btn btn-primary col-md-12">
                                        {{ __('Send email to get new password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
