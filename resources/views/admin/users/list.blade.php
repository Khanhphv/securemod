@extends('adminlte::page')

@section('title', 'User list')

@section('content_header')
    <h1>User list</h1>
@stop

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif

    @if (count($users) == 0)
        <div>No user found</div>
    @else
         <form role="form" class="form-horizontal" action="{{route('user.search')}}" method="POST">
            @csrf

        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="ID or Email" name="userID"
                       value="{{ old('userID') }}">
            </div>

			 <div class="col-sm-6">
                <input type="text" class="form-control" placeholder="TransactionID" name="transactionID"
                       value="{{ old('transactionID') }}">
            </div>

        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success form-control" type="submit">Search user</button>
            </div>
        </div>
    </form>
        <div class="table-responsive">

        <table class="table table-hover" style="background: #FFF">
            <tr>
                <th>ID</th>
                <th>Name</th>
{{--                <th>Số điện thoại</th>--}}
                <th>Balance</th>
                <th>Role</th>
                @if(Auth::user()->type == 'admin')
                <th>Action</th>
                @endif
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td><a href="{{route('user.edit',$user->id)}}">{{$user->id}}</a></td>
                    <td>{{$user->name}}</td>
{{--                    <td>{{$user->phone}}</td>--}}
                    <td>{{number_format($user->credit)}}</td>
                    <td>{{$user->type}}</td>
                    @if(Auth::user()->type == 'admin')
                    <td><a href="{{route('user.edit', $user->id)}}" class="btn btn-warning">Edit</a>
                    @endif
                    </td>
                </tr>
            @endforeach
            {!! $users->links() !!}
        </table>
        </div>
        <div>
             {!! $users->links() !!}
        </div>
    @endif

@stop
