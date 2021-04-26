@extends('layouts.app_short_header')
@section('title')
    {{trans('auth.change_password')}} - TOOL PUBG MOBILE - CHEATSHARP.COM
@stop
@section('content-banner')
    <h2 class="section-title">
        {{trans('auth.change_password')}}
    </h2>
@stop
@section('header-banner')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-intro">
                    <div class="header-intro-text-block">
                        <h1 class="header-title">HACK GAME AN TOÀN GIÁ RẺ</h1>
                    </div>
                    <br>
                    <!--<a href="#" class="big-button">GROUP FACEBOOK</a>-->
                </div>
            </div>
        </div>

    </div>

@stop
@section('content')
    <div id="page-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header text-center">{{trans('page.account')}}: {{$user->name}}</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(count($errors)>0)
                <ol>
                    @foreach($errors->all() as $err)
                        <li class=" text-warning" style="margin-bottom: 5px">
                            {{$err}}
                        </li>
                    @endforeach
                </ol>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal" action="{{route('password.update2')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="passwordOld">{{trans('auth.current_password')}}:</label>
                            <div class="col-sm-10">
                                <input type="password" name="oldPassword" class="form-control" id="passwordOld" placeholder="{{trans('auth.placeholder_old_password')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="passwordNew">{{trans('auth.new_password')}}:</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" class="form-control" id="passwordNew" placeholder="{{trans('auth.placeholder_new_password')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwdCofirm">{{trans('auth.new_password_cf')}}:</label>
                            <div class="col-sm-10">
                                <input type="password" name="password_confirmation" class="form-control" id="pwdCofirm" placeholder="{{trans('auth.placeholder_new_password_cf')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-warning">{{trans('auth.change_password')}}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
@stop
