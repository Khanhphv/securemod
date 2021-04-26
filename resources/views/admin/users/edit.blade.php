@extends('adminlte::page')

@section('title', 'Sửa thông tin thành viên')

@section('content_header')
    <h1>Sửa thông tin thành viên {{$user->name}}</h1>
    <br>
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif

@stop

@section('content')
    @if(Auth::user()->type === 'admin')
        <form action="{{route('user.update',$user->id)}}" method="post" role="form">
        @csrf
    @else
        <form>
    @endif
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
            <label for="">Tên người dùng</label>
            <input type="text" class="form-control" name="name" id=""
                   value="{{old('name',isset($user->name)? $user->name: null)}}" required>
        </div>
        <div class="form-group">
            <label for="">Địa chỉ email</label>
            <input type="text" class="form-control" name="email" id=""
                   value="{{old('email',isset($user->email)? $user->email: null)}}" required>
        </div>
        {{--    <div class="form-group">--}}
        {{--        <label for="">Số điện thoại</label>--}}
        {{--        <input type="text" class="form-control" name="phone" id=""--}}
        {{--               value="{{old('phone',isset($user->phone)? $user->phone: null)}}" required>--}}
        {{--    </div>--}}
        <div class="form-group">
            <label for="">Số tiền hiện tại</label>
            <input type="number" class="form-control" name="credit" id=""
                   value="{{old('credit',isset($user->credit)? $user->credit: null)}}" required>
        </div>
        <div class="form-group">
            <label for="">Ghi chú</label>
            <input type="text" class="form-control" name="note" id=""
                   value="{{old('note',isset($user->note)? $user->note: null)}}"
                   placeholder="Ghi lý do giải thích cho khách hiểu tại sao cộng trừ tiền của họ">
        </div>
        <div class="form-group">
            <label for="">Được phép giới thiệu thêm bao nhiêu người?</label>
            <input type="number" class="form-control" name="user_ref_count" id=""
                   value="{{old('user_ref_count',isset($user->user_ref_count)? $user->user_ref_count: null)}}">
        </div>
        <div class="form-group">
            <label for="">Phần trăm hoa hồng khi người giới thiệu nạp tiền</label>
            <input type="number" class="form-control" name="user_ref_commission" id=""
                   value="{{old('user_ref_commission',isset($user->user_ref_commission)? $user->user_ref_commission: null)}}">
        </div>
        <div class="form-group">
            <label for="">Vai trò</label>
            <select class="form-control" name="type">
                <option value="admin" {{$user->type == 'admin' ? "selected" : ''}}>Admin</option>
                <option value="reseller" {{$user->type == 'reseller' ? "selected" : ''}}>Đại lý</option>
                <option value="support" {{$user->type == 'support' ? "selected" : ''}}>Hỗ trợ</option>
                <option value="default" {{$user->type == 'default' ? "selected" : ''}}>Khách thường</option>
            </select>
        </div>
        <div class="form-group">
            <label for="pw">Đổi mật khẩu</label>
            <input type="text" name="password" id="pw" class="form-control">
            <small>Để trống nếu không muốn đổi mật khẩu</small>
        </div>
        <br>

        <a href="{{URL::previous()}}" class="btn btn-warning">BACK</a>
        @if(Auth::user()->type === 'admin')
            <button type="submit" class="btn btn-success pull-right" style="width: 90px">SAVE</button>
        @endif
    </form>
    <br>
    @if(Auth::user()->type === 'admin')
    <div class="row">
        <div class="col-md-12">
            <!-- USERS LIST -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">LATEST TRANSACTIONS</h3>

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
                    @if(count($listTransactions) > 0)
                        {!! $listTransactions->render() !!}
                        <div class="table-responsive">

                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>UserID</th>
                                    <th style="text-align: center">Action</th>
                                    <th style="text-align: center">Amount</th>
									<th>Paypal transaction</th>
                                    <th>IP</th>
                                    <th>Content</th>
                                    <th style="text-align: center">Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listTransactions as $history)
                                    <tr>
                                        <td>{{$history->id}}</td>
                                        <td>{{$history->user_id}}</td>
                                        <td style="text-align: center">{{$history->action}}</td>
                                        <td style="text-align: center">{{number_format($history->amount)}}</td>
										<td>@if($history->action == "CHARGE_VIA_PAYPAL") <a href="https://www.paypal.com/activity/payment/{{$history->nl_token}}" target="_blank">{{$history->nl_token}}</a>@endif</td>
                                        <td>{{$history->ip}}</td>
                                        <td>{{$history->content}}</td>
                                        <td style="text-align: center">{{$history->updated_at->format('H:i:s d/m/Y')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                        <!-- /.table-responsive -->
                        <div>
                            {!! $listTransactions->links() !!}
                        </div>
                </div>

                @endif
            </div>
            <!--/.box -->
        </div>
        <!-- /.col -->
    </div>
        @else
        <script>
            window.onload = function () {
                let list = $('input');
                let select = $('select');
                for (let item of select) {
                    item.disabled = true;
                }
                for (let item of list) {
                    item.disabled = true;
                }
            }

        </script>
    @endif
@stop
