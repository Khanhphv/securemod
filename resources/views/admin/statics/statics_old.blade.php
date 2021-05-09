@extends('adminlte::page')

@section('title', 'Thống kê')

@section('content_header')

    <h1 class="text-white">Thống kê ngày {{\Carbon\Carbon::parse($start)->format('d-m-Y')}}
    </h1>

@stop

@section('content')
    <style type="text/css">
        .content-wrapper {
            min-height: 0
        }
    </style>
    @php
        if(gettype($start) != "string") {
            $start = \Carbon\Carbon::parse($start)->format('Y-m-d');
        }

    @endphp
    <div class="row">
        <div class="col-md-12">
            <form class="form-inline text-white" action="">
                <div class="form-group">
                    <label>Chọn ngày thống kê: </label>
                    <input type="date" class="form-control" value="{{old('start', isset($start) ? $start : "")}}"
                           name="start" style="margin-left: 10px">
                </div>

                <button type="submit" class="btn btn-warning" style="margin-left: 10px">Thống kê</button>
            </form>
            <br>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>

                <div class="info-box-content">
                    CARD: {{number_format($cardMoney)}}<br>MOMO: {{number_format($momoMoney)}}
                    <br>ATM: {{number_format($atmMoney)}}<br>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">KHÁCH TIÊU TRONG NGÀY</span>
                    <span class="info-box-number">{{number_format($totalMoneySpent)}}
                        <small>VND</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-calendar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">LÃI TRONG NGÀY</span>
                    <span class="info-box-number">{{number_format($moneyInterest)}}
                        <small>VND</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-calendar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">TỔNG LÃI TRONG THÁNG</span>
                    <span class="info-box-number">{{number_format($totalMoneyMonth)}}
                        <small>VND</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">  KEY BÁN RA</span>
                    <span class="info-box-number">  {{number_format($numberSoldKey)}}
                        <small>LƯỢT</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Thành viên mới</span>
                    <span class="info-box-number">{{number_format($newUser)}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- USERS LIST -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Số key còn lại</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    @if(count($mangToTool) > 0)
                        <?php $dem = 0; ?>
                        @foreach($mangToTool as $name=>$detail)
                            <?php $dem == 3? $dem = 0 : $dem++; ?>
                            @if($dem == 0)
                                <div class="row">
                                    @endif
                                    <div class="col-md-3">
                                        @foreach($detail as $item)
                                            <p  style="color: @if($item['total'] < 5) red @else green @endif;font-size:16px">            {{substr($name, 0, 6)}} {{$item['package']}} : {{$item['total']}}
                                            </p>
                                        @endforeach
                                    </div>
                                    @if($dem == 0)
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
                <!--/.box -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- USERS LIST -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Tool đã hết key</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                @if(count($toolDaHet) > 0)
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tool</th>
                                    <th>Số lượng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($toolDaHet as $detail)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><strong
                                                    style="color:red;font-size:16px">            {{substr($detail->name, 0, 6)}} {{$detail->package}}</strong>
                                        </td>
                                        <td>0</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- /.table-responsive -->
                    </div>
                @else
                    <div class="box-body">
                        <div class="table-responsive">
                            <h3>Không có tool nào hết key!</h3>
                        </div>
                    </div>
                @endif
            </div>
            <!--/.box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- USERS LIST -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Số key bán ra</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                @if(count($keySoled) > 0)
                    <div class="box-body">
                        <div class="table-responsive">
                            {!!$keySoled->render()!!}
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tool</th>
                                    <th>Gói</th>
                                    <th>Số lượng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($keySoled as $key)
                                    <tr>
                                        <td>{{$key->id}}</td>
                                        <td>{{$key->getToolName->name}}
                                        <td>{{$key->package}}
                                        </td>
                                        <td>{{$key->soLuong}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {!!$keySoled->render()!!}
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                @else
                    <div class="box-body">
                        <div class="table-responsive">
                            <h3>Không có key nào được bán</h3>
                        </div>
                    </div>
                @endif
            </div>
            <!--/.box -->
        </div>
        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- USERS LIST -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">GIAO DỊCH MỚI NHẤT</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->

                @if(count($histories) > 0)
                    <div class="box-body">
                        <div class="table-responsive">
                            {!!$histories->render()!!}
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>UserID</th>
                                    <th>Username</th>
                                    <th style="text-align: center">Hành động</th>
                                    <th style="text-align: center">Số tiền</th>

                                    <th>Nội dung</th>
                                    <th style="text-align: center">Thời gian</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($histories as $history)
                                    <tr>
                                        <td>{{$history->id}}</td>
                                        <td><a href="{{route('user.edit',$history->user_id)}}">{{$history->user_id}}</a>
                                        </td>
                                        <td><a href="{{route('user.edit',$history->user_id)}}">{{$history->name}}</a>
                                        </td>
                                        <td style="text-align: center">{{$history->action}}</td>
                                        <td style="text-align: center">{{number_format($history->amount)}}</td>
                                        <td>{{$history->content}}</td>
                                        <td style="text-align: center">{{isset($history->updated_at) ? $history->updated_at->format('H:i:s d/m/Y') :  $history->updated_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {!!$histories->render()!!}
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                @else
                    <div class="box-body">
                        <div class="table-responsive">
                            <h3>Không có giao dịch nào</h3>
                        </div>
                    </div>
                @endif
            </div>
            <!--/.box -->
        </div>
        <!-- /.col -->
    </div>

@stop