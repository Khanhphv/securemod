@extends('layouts.app_no_header')
@section('title')
    Key activity - TOOL PUBG MOBILE - CHEATSHARP.COM
@stop

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2" style="margin-top: 20px; margin-bottom: 20px;">
            <form name="" action="{{route('get.viewKey')}}" method="GET" class="main_form">
                <!-- <h1 style="text-align: center; margin: 0;">ATM</h1> -->
                <h2 class="text-center text-uppercase" style="color: #fff;"><strong>Enter key to see</strong></h2>
                <br>
                <div class="form-group">
                    <input type="text"
                           class="my_select form-control" placeholder="ENTER KEY" required name="key" min="3">
                </div>
                <input type="submit" class="btn btn-primary" value="SEE NOW"
                       style="width: 100%;background: #FAC93B;padding: 10px;font-size: 15px;border:0"/>
            </form>
        </div>
    </div>
@endsection
