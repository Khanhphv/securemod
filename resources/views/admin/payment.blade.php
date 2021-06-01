@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Payment Settings</h1>
@stop

@section('content')
    @include('layouts.success')
    {{-- validation--}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- change cliend_id payment -->
    <div class="content">
        <div>
            <div class="col-md">
                {!! Form::open([
                    'route' => ['change_payment'],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal',
                ]) !!}
                <div class="box box-primary">
                    <div class="box-body">
                        <label>Setting Key Of Payment</label>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-2 col-xs-12">
                                        {!! html_entity_decode(
                                            Form::label(
                                                'select_payment_type',
                                                'Select payment type'
                                                ,
                                                [
                                                    'style' => 'margin-top: 5px'
                                                ]
                                            )
                                        ) !!}
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        {!!
                                           Form::select(
                                               'payment',
                                                $arr_payment_type,
                                                null,
                                                [
                                                    'id' => 'payment_select',
                                                    'class' => 'form-control']
                                           )
                                        !!}
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-2 col-xs-12">
                                        {!! html_entity_decode(
                                            Form::label(
                                                'public_key',
                                                'Client ID',
                                                [
                                                    'style' => 'margin-top: 5px'
                                                ]
                                            )
                                        ) !!}
                                    </div>
                                    <div class="col-md-10 col-xs-12">
                                        {!! Form::text(
                                            'public_key',
                                            old('client_id'),
                                            [
                                                'id' => 'public_key',
                                                'class' => 'form-control',
                                                'placeholder' => 'Client ID',
                                                'required' => 'required',
                                                'disabled' => 'disabled'
                                            ]
                                        ) !!}
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-2 col-xs-12">
                                        {!! html_entity_decode(
                                            Form::label(
                                                'secret_key',
                                                'Client Secret',
                                                ['style' => 'margin-top: 5px']
                                            )
                                        ) !!}
                                    </div>
                                    <div class="col-md-10 col-xs-12">
                                        {!! Form::text(
                                            'secret_key',
                                            old('client_secret'),
                                            [
                                                'class' => 'form-control',
                                                'placeholder' => 'Client Secret',
                                                'required' => 'required',
                                            ]
                                        ) !!}
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-9 col-md-offset-5">
                        {!! Form::submit(
                            'Update',
                            [
                                'class' => 'btn btn-success',
                            ]
                        ) !!}
                        {!! Html::linkRoute(
                            'payment_settings',
                            'Cancel',
                            [],
                            [
                                'class' => 'btn btn-warning',
                            ]
                        ) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="mt-3">
                <br/>
            </div>
            <div class="col-md">
                <div class="box box-primary">
                    <div class="box-body">
                        <label>List Seller Paypal</label>
                        <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#create_payment">
                            + Add Seller
                        </button>
                        @if (count($sellers) === 0)
                            <p>There are no seller</p>
                        @else
                        <div class="table-responsive table-striped">
                            <table class="table table-hover datatables" style="background: #FFF">
                                <tr>
                                    <th>ID</th>
                                    <th>Seller</th>
                                    <th>Discord</th>
                                    <th>Payment options</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($sellers as $seller)
                                <tr>
                                    <td><strong>{{$seller->id}}</strong></td>
                                    <td>{{$seller->seller_name}}</td>
                                    <td>{{$seller->discord}}</td>
                                    <td>
                                        {{$seller->payment_options}}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning open-edit-modal" data-toggle="modal" data-target="#edit_seller" data-id="{{$seller}}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <a href="{{route('paypal_seller.destroy',$seller->id)}}" onclick="return confirm('Do you want to delete this seller?')" class="btn btn-danger" ><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="edit_seller" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content edit-form">
                {!! Form::open([
                    'route' => ['paypal_seller.update'],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal'
                ]) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit seller</h5>
                    {!! Form::submit(
                        '&times;',
                        [
                            'class' => 'close',
                            'type' => "button",
                            'data-dismiss' =>"modal",
                            'aria-label' => "Close"
                        ]
                    ) !!}
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                    {!! html_entity_decode(
                                        Form::label(
                                            'seller_id',
                                            'ID',
                                            []
                                        )
                                    ) !!}
                                </div>
                                <div class="col-md col-xs-12">
                                    {!! Form::text(
                                        'seller_id',
                                        '',
                                        [
                                            'id' => 'seller_id',
                                            'class' => 'form-control',
                                            'placeholder' => 'Seller Name',
                                            'required' => 'required'
                                        ]
                                    ) !!}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                    {!! html_entity_decode(
                                        Form::label(
                                            'seller_name',
                                            'Seller',
                                            []
                                        )
                                    ) !!}
                                </div>
                                <div class="col-md col-xs-12">
                                    {!! Form::text(
                                        'seller_name',
                                        'Razen',
                                        [
                                            'id' => 'seller_name',
                                            'class' => 'form-control',
                                            'placeholder' => 'Seller Name',
                                            'required' => 'required',
                                        ]
                                    ) !!}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                    {!! html_entity_decode(
                                        Form::label(
                                            'discord',
                                            'Discord',
                                            [
                                                'style' => 'margin-top: 5px'
                                            ]
                                        )
                                    ) !!}
                                </div>
                                <div class="col-md col-xs-12">
                                    {!! Form::text(
                                        'discord',
                                        'Razen123',
                                        [
                                            'id' => 'discord',
                                            'class' => 'form-control',
                                            'placeholder' => 'Discord',
                                            'required' => 'required',
                                        ]
                                    ) !!}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                    {!! html_entity_decode(
                                        Form::label(
                                            'payment_options',
                                            'Payment Options',
                                            ['style' => 'margin-top: 5px']
                                        )
                                    ) !!}
                                </div>
                                <div class="col-md col-xs-12">
                                    {!! Form::text(
                                        'payment_options',
                                        'Paypal, Payoneer, TransferWise, Western Union, PaysafeCard ,Venmo, CashApp, Zelle, Apple Pay',
                                        [
                                            'id' => 'payment_options',
                                            'class' => 'form-control',
                                            'placeholder' => 'Payment Options',
                                            'required' => 'required',
                                        ]
                                    ) !!}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                    {!! html_entity_decode(
                                        Form::label(
                                            'more_infomation',
                                            'More Infomation',
                                            ['style' => 'margin-top: 5px']
                                        )
                                    ) !!}
                                </div>
                                <div class="col-md col-xs-12">
                                    {!! Form::text(
                                        'more_infomation',
                                        'https://abc.def/nnnnnnnnnnn',
                                        [
                                            'id' => 'more_infomation',
                                            'class' => 'form-control',
                                            'placeholder' => 'More Infomation',
                                            'required' => 'required',
                                        ]
                                    ) !!}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    {!! Form::submit(
                        'Cancel',
                        [
                            'class' => 'btn btn-secondary',
                            'type' => "button",
                            'data-dismiss' => "modal"
                        ]
                    ) !!}
                    {!! Form::submit(
                        'Save changes',
                        [
                            'class' => 'btn btn-primary',
                            'type' => "button"
                        ]
                    ) !!}
                </div>
                {!! Form::close() !!}}
            </div>
        </div>
    </div>

    <!-- Modal create -->
    <div class="modal fade" id="create_payment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">s
            <div class="modal-content">
                {!! Form::open([
                    'route' => ['paypal_seller.create'],
                    'method' => 'POST',
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal',
                ]) !!}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Seller</h5>
                    {!! Form::submit(
                        '&times;',
                        [
                            'class' => 'close',
                            'type' => "button",
                            'data-dismiss' =>"modal",
                            'aria-label' => "Close"
                        ]
                    ) !!}
                </div>
                <div class="modal-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                    {!! html_entity_decode(
                                        Form::label(
                                            'seller_name',
                                            'Seller',
                                            [ 'style' => 'margin-top: 5px' ]
                                        )
                                    ) !!}
                                </div>
                                <div class="col-md col-xs-12">
                                    {!! Form::text(
                                        'seller_name',
                                        old('seller_name'),
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => 'Seller Name',
                                            'required' => 'required',
                                        ]
                                    ) !!}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                    {!! html_entity_decode(
                                        Form::label(
                                            'discord',
                                            'Discord',
                                            [
                                                'style' => 'margin-top: 5px'
                                            ]
                                        )
                                    ) !!}
                                </div>
                                <div class="col-md col-xs-12">
                                    {!! Form::text(
                                        'discord',
                                        old('discord'),
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => 'Discord',
                                            'required' => 'required',
                                        ]
                                    ) !!}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                    {!! html_entity_decode(
                                        Form::label(
                                            'payment_options',
                                            'Payment Options',
                                            ['style' => 'margin-top: 5px']
                                        )
                                    ) !!}
                                </div>
                                <div class="col-md col-xs-12">
                                    {!! Form::text(
                                        'payment_options',
                                        old('payment_options'),
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => 'Payment Options',
                                            'required' => 'required',
                                        ]
                                    ) !!}
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-5 col-xs-12">
                                    {!! html_entity_decode(
                                        Form::label(
                                            'more_infomation',
                                            'More Infomation',
                                            ['style' => 'margin-top: 5px']
                                        )
                                    ) !!}
                                </div>
                                <div class="col-md col-xs-12">
                                    {!! Form::text(
                                        'more_infomation',
                                        old('more_infomation'),
                                        [
                                            'class' => 'form-control',
                                            'placeholder' => 'More Infomation',
                                            'required' => 'required',
                                        ]
                                    ) !!}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    {!! Form::submit(
                        'Cancel',
                        [
                            'class' => 'btn btn-secondary',
                            'type' => "button",
                            'data-dismiss' => "modal"
                        ]
                    ) !!}
                    {!! Form::submit(
                        'Add',
                        [
                            'class' => 'btn btn-primary',
                            'type' => "button"
                        ]
                    ) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

        $('#payment_select').change(function(){
            var data= $(this).val();
            if(data == 1){
                document.getElementById("public_key").disabled = true;
            } else {
                document.getElementById("public_key").disabled = false;
            }
        });

        $(document).on("click", ".open-edit-modal", function () {
            var seller = $(this).attr('data-id');
            var obj_seller = JSON.parse(seller);
            $(".modal-body #seller_id").val( obj_seller['id'] );
            $(".modal-body #seller_name").val( obj_seller['seller_name'] );
            $(".modal-body #discord").val( obj_seller['discord'] );
            $(".modal-body #payment_options").val( obj_seller['payment_options'] );
            $(".modal-body #more_infomation").val( obj_seller['more_infomation'] );
        });
    </script>
@stop


