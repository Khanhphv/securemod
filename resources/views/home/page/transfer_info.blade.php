@extends('layouts.app_short_header')
@section('title')
    MANUAL TRANSFER MONEY
@stop
@section('content-banner')
    <h2 class="section-title">
        MANUAL TRANSFER MONEY
    </h2>
@stop
@section('header-banner')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="header-intro">
                    <div class="header-intro-text-block">
                        <h1 class="header-title">MANUAL TRANSFER MONEY</h1>
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
                    <h2 class="page-header text-center">BANK INFORMATION</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
				<div class="col-md-12">
               Updating...
			   </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
@stop

@section('js')
    <script>
        function copyMe(obj) {
            obj.select();
            document.execCommand("copy");
            swal({
                'title': "Đã copy",
                'text': obj.value
            });
        }
    </script>
@stop