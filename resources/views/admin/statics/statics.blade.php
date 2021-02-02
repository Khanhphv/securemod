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

        $listColor = array('#1abc9c', '#8e44ad', '#2c3e50', '#341f97', '#f39c12', '#2ecc71', '#95a5a6');
    function cmp($a, $b)
    {
        if ($a == $b) {
            return 0;
        }
        return ($a['package'] < $b['package']) ? -1 : 1;
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
                    <strong>TIỀN VÀO TK CỦA KHÁCH: {{number_format($momoMoney+$cardMoney+$atmMoney+$commissionMoney+$adminMoney)}}</strong><br>
                    THẺ: {{number_format($cardMoney)}} | MOMO: {{number_format($momoMoney)}}
                    | ATM: {{number_format($atmMoney)}} |  ADMIN: {{number_format($adminMoney)}} | HOA HỒNG: {{number_format($commissionMoney)}}
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
                        <small>$</small></span>
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
                        <small>$</small></span>
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
                        <small>$</small></span>
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


        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-calendar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">TIỀN NẠP VÀO TRONG NGÀY</span>
                    <span class="info-box-number">{{number_format($napVaoTrongNgay)}}
                        <small>$</small></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-calendar"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">TIỀN NẠP VÀO TRONG THÁNG</span>
                    <span class="info-box-number">{{number_format($napVaoTrongThang)}}</span> Paypal: {{number_format($napQuaPaypal)}}, CoinPayment: {{number_format($napQuaCoinPayment)}}, Admin cộng: {{number_format($napquaAdmin)}}
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- USERS LIST -->
            <div id="remain-key" class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Số key còn lại</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if(count($listGame) > 0)
                        @foreach($listGame as $game => $listTool)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel box box-success">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                {{ $game }}
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="grid" data-masonry='{ "itemSelector": ".grid-item" }'>
                                            <?php $c = 0; $dem = 0; ?>
                                            @foreach($listTool as $tool)
                                                <?php $c++; $dem == 3? $dem = 0 : $dem++; ?>
                                                <div class="col-md-3 col-sm-6 col-xs-12 grid-item">
                                                    <div class="box box-widget widget-user-2" style="box-shadow: 1px 4px 5px 2px rgba(0,0,0,0.1)">
                                                        <div style="color: #FFF ; max-height: 50px; background: @php
                                                            $color = $listColor[$c%count($listColor)];
                                                            echo $color;
                                                        @endphp">
                                                            <label style="padding: 10px;width: 180px;white-space: nowrap;overflow: hidden !important;text-overflow: ellipsis;">
                                                                {{ $tool['tool'] }}
                                                            </label>
                                                        </div>
                                                        <div class="box-footer no-padding">
                                                            <ul class="nav nav-stacked">
                                                                @foreach($tool['data'] as $item)
                                                                    <li>
                                                                        <a>
                                                                            {{$item['package']}}

                                                                            @if($item['total'] > 0)
                                                                                <span class="pull-right badge bg-blue">
                                                            {{$item['total']}}
                                                        </span>
                                                                            @else
                                                                                <span class="pull-right badge bg-red">
                                                            0
                                                        </span>

                                                                            @endif
                                                                        </a>

                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <!-- /.widget-user -->
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
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
                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>Tool</th>
                                    <th>Gói</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($keySoled as $key)
                                    <tr style="color: #FFF; background: @php
                                        $color = $listColor[$key->id%count($listColor)];
                                        echo $color;
                                    @endphp">
                                        <td>{{$key->name}}
                                        <td>{{$key->package}}
                                        </td>
                                        <td>{{$key->soLuong}}
                                        </td>
                                        <td>{{ number_format($key->sum, 2) }}</td>
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
                                        <td>{{$history->email}}</td>
                                        <td style="text-align: center">{{$history->action}}</td>
                                        <td style="text-align: center">{{number_format($history->amount, 2)}}</td>
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
    <script>
        window.onload = function () {
            $('#remain-key').addClass('box box-info collapsed-box')
        }
    </script>
@stop

