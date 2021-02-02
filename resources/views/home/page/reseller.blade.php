@extends('layouts.app_no_header')
@section('title')
	RESELLER AREA
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text-center">
            <div class="card">
                <div class="card-header col-sm-offset-1">{{ __('RESELLER AREA') }}</div>

                <div class="card-body">
                    <div class="form-group row">
                        <label for="tool"
                        class="col-sm-3 col-form-label text-sm-right">{{ __('Tool type') }}</label>

                        <div class="col-sm-8">
                            <select class="form-control {{ $errors->has('tool_id') ? ' is-invalid' : '' }}"
                                id="tool" required name="tool_id">
                                <option>--Please choose type of tool you want to buy--</option>
                                @php
                                $packagesList = array();

                                @endphp
                                @foreach($tools as $tool)
                                @if ($tool->active == 1 || ($tool->id == 9 &&  (Auth::user()->id == 1 ||  Auth::user()->id == 4 ||  Auth::user()->id == 3 ||  Auth::user()->id == 44))) 

                                @php 
                                $packagesList["t".$tool->id] =  json_decode($tool->reseller); @endphp
                                <option value="{{$tool->id}}">{{$tool->name}} </option>
                                @endif
                                @endforeach
                            </select>
                            @if ($errors->has('tool_id'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('tool_id') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="package"
                        class="col-sm-3 col-form-label text-sm-right">{{ __('Package') }}</label>

                        <div class="col-sm-8">
                            <select class="form-control {{ $errors->has('package') ? ' is-invalid' : '' }}"
                                id="package" name="package">

                            </select>
                            @if ($errors->has('package'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('package') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="number"
                        class="col-sm-3 col-form-label text-sm-right">{{ __('Quantity') }}</label>

                        <div class="col-sm-8">
                            <input id="number" type="number"
                            class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}"
                            name="number" value="{{ old('number') }}" value="50" min="1" required>

                            @if ($errors->has('number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('number') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row" id="blockPrefix" style="display: none;">
                        <label for="prefix"
                        class="col-sm-3 col-form-label text-sm-right">{{ __('Prefix') }}</label>

                        <div class="col-sm-8">
                            <input id="prefix" type="prefix"
                            class="form-control{{ $errors->has('prefix') ? ' is-invalid' : '' }}"
                            name="prefix" onkeydown="limit(this);" onkeyup="limit(this);">
                        </div>
                    </div>



                    <div class="form-group row mb-0">
                        <div class="col-sm-12">
                            <div id="charge-form-notice"></div>
                        </div>

                        <div class="col-sm-8 col-sm-offset-3">
                            <a href="javascript:void(0)" class="buy-now btn btn-primary col-sm-12">BUY NOW</a>

                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function limit(element)
    {
        var max_chars = 10;

        if(element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
    }

    $(document).ready(function () {
        let toolType = $('#tool').val();
        addOption(toolType);

    });
    $('#tool').on('change', function () {
        let toolType = $(this).val();
        addOption(toolType);
        //if(toolType == 1 || toolType == 3)
		if(toolType > 0)
        {
            $('#blockPrefix').css('display','block');
        }else
        {
           $('#blockPrefix').css('display','none');
           $('#prefix').val('');
       }
   });
    if($('#tool').val() == 1)
    {
      $('#blockPrefix').css('display','block');
  }

  function addOption(toolType) {
    let packagesList = JSON.parse('@php echo json_encode($packagesList, JSON_FORCE_OBJECT); @endphp');
    $('#package').html('');
    $.each(packagesList["t" + toolType], function (i, e) {
        let selected = "";
        $('#package').append('<option value="' + i + '" ' + selected + '>' + i + ' hours = $'+e+'</option>');
    })
}

        // buy-now

        $('.buy-now').click(function (e) {
            e.preventDefault();

            var idTool = $('#tool').val();
            var  prefix = $('#prefix').val();
            var url = `{{route('reseller.buy')}}`;
            var package = $('#package').val();
            var number = $('#number').val();
            
            if (package === "" || number === "") {
                $('#charge-form-notice').html('Please input all required field');
                return false;
            } else {
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "json",
                    data: {package, number: number,idTool: idTool, prefix: prefix},
                    success: function (response) {
                        if (response.status == "success") {
                           Swal({
                            title: 'Successfully',
                            text: response.message ,
                            type: 'success'
                        }).then(function () {
                            window.location = response.redirect;
                        });
                    } else {
                        if(response.status == 'fail')
                        {
                            Swal({
                                title: 'We have a small issue',
                                text: response.message,
                                type: 'error'
                            })
                        }
                        if(response.errors)
                        {
                            Swal({
                                title: 'Oh no, it is not success now',
                                text: response.errors,
                                type: 'error'
                            })
                        }
                        else{
                            Swal({
                                title: 'Something wrong, please try again later',
                                text: response.message,
                                type: 'error'
                            })
                        }
                    }
                }
            })
            }
        })
    </script>
    @stop