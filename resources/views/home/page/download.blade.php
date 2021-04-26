@extends('layouts.app_no_header')
@section('title')
    DOWNLOAD YOUR CHEAT
@endsection
@section('content')
<div class="container">
    <div class="row">
        <form action="{{route('download.rootloader')}}" method="GET">
            
        
        <div class="col-sm-7 col-sm-offset-2 text-center">
            <div class="card">
                <div class="card-header col-sm-offset-1">{{ __('DOWNLOAD LATEST VERSION') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="key"
                        class="col-sm-3 col-form-label text-sm-right">{{ __('Input your key') }}</label>
                        <div class="col-sm-8">
                        <input id="key" type="text"
                               class="form-control{{ $errors->has('key') ? ' is-invalid' : '' }}"
                               name="key" value="{{ old('key') }}"  required>
                        </div>

                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-sm-12">
                            <div id="charge-form-notice"></div>
                        </div>

                        <div class="col-sm-8 col-sm-offset-3">
                            <button type="submit" class="btn btn-warning buy-now my-btn col-sm-12">DOWNLOAD NOW</a>

                        </div>
                    </div>
                </div> 
            </div>
        </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
      
    </script>
@stop