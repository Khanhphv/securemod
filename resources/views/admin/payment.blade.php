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
                    'route' => ['setting_system_edit'],
                    'method' => 'PUT',
                    'enctype' => 'multipart/form-data',
                    'class' => 'form-horizontal',
                ]) !!}
                {{--                    change logo--}}
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
                                                [
                                                    1 => 'Lex Holding',
                                                    2 => 'Paypal',
                                                    3 => 'Coin Payment'
                                                ],
                                                1,
                                                ['class' => 'form-control']
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
                                            'public_key-fbjfjdbjfjdfbnjdjfjd',
                                            [
                                                'class' => 'form-control',
                                                'placeholder' => 'Client ID',
                                                'required' => 'required',
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
                                            'secret_key-fbjfjdbjfjdfbnjdjfjd',
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
                        <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#exampleModal">
                            + Add Seller
                        </button>

{{--                        @if (count($posts) === 0)--}}
{{--                            <p>There are no post</p>--}}
{{--                        @else--}}
                            <div class="table-responsive table-striped">
                                <table class="table table-hover datatables" style="background: #FFF">
                                    <tr>
                                        <th>ID</th>
                                        <th>Seller</th>
                                        <th>Discord</th>
                                        <th>Payment options</th>
                                        <th>Action</th>
                                    </tr>
{{--                                    @foreach ($posts as $post)--}}
                                        <tr>
                                            <td><strong>1</strong></td>
                                            <td>Razen</td>
                                            <td>Razen#5816</td>
                                            <td>
                                                Paypal, Payoneer, TransferWise, Western Union, PaysafeCard ,Venmo, CashApp, Zelle, Apple Pay,...
                                            </td>
                                            <td>
{{--                                                {!! html_entity_decode(--}}
{{--                                                    Html::linkRoute(--}}
{{--                                                        'post.edit',--}}
{{--                                                        'Edit',--}}
{{--                                                        [],--}}
{{--                                                        [--}}
{{--                                                            'class' => 'btn btn-warning',--}}
{{--                                                        ]--}}
{{--                                                    )--}}
{{--                                                )--}}
{{--                                                !!}--}}
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <a href="#" onclick="return confirm('Do you want to delete this seller?')" class="btn btn-danger" ><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
{{--                                    @endforeach--}}
                                </table>
                            </div>
{{--                        @endif--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
    </script>
@stop

