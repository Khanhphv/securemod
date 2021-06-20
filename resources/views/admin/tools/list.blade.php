@extends('adminlte::page')

@section('title', 'Tool list')

@section('content_header')
    <h1 style="float: left">Tool list</h1>
    <a href="{{route('tool.create')}}" type="button" class="btn btn-block btn-success pull-right"
       style="max-width: 200px">Add tool</a><br/><br/>
@stop

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif
    @if (count($tools) === 0)
        <p>No tool found</p>
    @else
        <div class="table-responsive">
        <table class="table table-hover" style="background: #FFF">
            <tr>
                <th>Name</th>
                <th>Updated</th>
                <th>Active</th>
                <th>Sort</th>
                <th>Action</th>
            </tr>
            @foreach ($listTool as $tool)
                <tr>
                    <td><strong>{{$tool->game_name}}</strong> - {{$tool->name}}</td>
                    <td>@if ($tool->updated === 1) <i class="fa fa-check-square"></i> Yes @else <i
                                class="fa fa-close"></i> No @endif</td>
                    <td>@if ($tool->active === 1) <i class="fa fa-check-square"></i> Yes @else <i
                                class="fa fa-close"></i> No @endif</td>
                    <td>{{$tool->order}}</td>
                    <td><a href="{{route('tool.edit',$tool->id)}}" class="btn btn-warning">Edit</a>
                        <a href="{{route('tool.delete',$tool->id)}}" onclick="return confirm('DELETE TOOL {{$tool->name}} MEANS DELETE ALL KEY. THIS ACTION IS EXTREMELY DANGEROUS! AFTER PRESSING OK WILL NOT BE RECOVERY ANY MORE ')" class="btn btn-danger" >Delete</a>
                    </td>
                </tr>
            @endforeach
        </table>
        </div>
    @endif

@stop
