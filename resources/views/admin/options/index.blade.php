@extends('adminlte::page')

@section('title', 'Setting website')

@section('content_header')
    @if(request()->lang =='en')
        <h1>Website setting</h1>
        <br>
        <a href="{{route('setting.index').'?lang=vi'}}" class="btn btn-primary">Vietnamese</a>
    @else
        @php request()->lang ='vi'; @endphp
        <h1>Cài đặt website</h1>
        <br>
        <a href="{{route('setting.index').'?lang=en'}}" class="btn btn-primary">Tiếng Anh</a>
    @endif
    <br>
    <br>
    @if(Session::has('message'))
        <div class="alert alert-{{Session::get('level')}}">
            {{Session::get('message')}}
        </div>
    @endif


@stop

@section('content')
    <form id="form" action="{{route('setting.update')}}" method="post" role="form">
        @csrf
        <input type="hidden" name="locate" value="{{request()->lang}}">
        <button type="submit" class="btn btn-success pull-right" style="width: 90px; position: absolute; right: 20px; z-index: 999">SAVE</button>
        @if(count($errors)>0)
            <ol>
                @foreach($errors->all() as $err)
                    <li class=" text-warning" style="margin-bottom: 5px">
                        {{$err}}
                    </li>
                @endforeach
            </ol>
        @endif
{{--        <div class="form-group">--}}
{{--            <label class="no-margin">Paypal Client_ID</label>--}}
{{--            @foreach($listPayment as $payment)--}}
{{--                <div class="radio">--}}
{{--                    <label>--}}
{{--                        <input type="radio" name="paypal_id" id="" value="{{$payment['id'] }}"--}}
{{--                               {{ (isset($siteSettings['paypal_id']) && ($payment['id'] === (int)$siteSettings['paypal_id'])) ? 'checked': '' }}>--}}
{{--                        {{ $payment['name'] }}--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--                @endforeach--}}
{{--        </div>--}}
        <div class="form-group">
            <label class="no-margin">Auto accept payment</label>
            <div class="radio">
                <label>
                    <input type="radio" name="auto-accept" id="" value="1"
                        {{ (isset($siteSettings['auto-accept']) && ((int)$siteSettings['auto-accept'] === 1)) ? 'checked': '' }}> On
                </label>
                <label>
                    <input type="radio" name="auto-accept" id="" value="0"
                        {{ (isset($siteSettings['auto-accept']) && ((int)$siteSettings['auto-accept'] === 0)) ? 'checked': '' }}> Off
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-4">
                <label for="">Stripe</label>
                <div class="btn-group">
                    <input {{ (isset($siteSettings['stripe_payment'])
                    && ($siteSettings['stripe_payment'] == '1')) ? 'checked': '' }} type="checkbox"
                           name="stripe_payment" value="1">
                </div>
            </div>
            <div class="col-sm-4">
                <label for="">Seller</label>
                <div class="btn-group">
                    <input {{ (isset($siteSettings['seller_payment'])
                    && ($siteSettings['seller_payment'] == '1')) ? 'checked': '' }} type="checkbox"
                           name="seller_payment" value="1">
                </div>
            </div>
            <div class="col-sm-4">
                <label for="">Coin</label>
                <div class="btn-group">
                    <input {{ (isset($siteSettings['coin_payment'])
                    && ($siteSettings['coin_payment'] == '1')) ? 'checked': '' }} type="checkbox"
                           name="coin_payment" value="1">
                </div>
            </div>

            <div class="col-sm-4">
                <label for="">Paypal</label>
                <div class="btn-group">
                    <input {{ (isset($siteSettings['paypal_payment'])
                    && ($siteSettings['paypal_payment'] == '1')) ? 'checked': '' }} type="checkbox"
                           name="paypal_payment" value="1">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="">Discord</label>
            <input type="text" class="form-control" name="discord_channel" id=""
                               value="{{old('discord_channel',isset($siteSettings['discord_channel'])? $siteSettings['discord_channel']: null)}}"
                               required>
        </div>

        <div class="form-group">
            <label for="">Header title</label>
            <input type="text" class="form-control" name="header_title" id=""
                   value="{{old('header_title', isset($siteSettings['header_title'])? $siteSettings['header_title']: null)}}"
                   >
        </div>
        <div class="form-group">
            <label for="">Header sub title</label>
            <input type="text" class="form-control" name="header_sub_title" id=""
                   value="{{old('header_sub_title',isset($siteSettings['header_sub_title'])? $siteSettings['header_sub_title']: null)}}"
                   >
        </div>
        <div class="form-group">
            <label for="">Default bonus when create new account</label>
            <input type="text" class="form-control" name="commission" id=""
                   value="{{old('commission',isset($siteSettings['commission'])? $siteSettings['commission']: null)}}"
                   required>
        </div>
        <div class="form-group">
            <label for="header_notice">Homepage notice</label>
            <textarea id="header_notice" name="header_notice" class="form-control"
                      rows="10">{{old('header_notice', isset($siteSettings['header_notice'])? $siteSettings['header_notice']: null)}}</textarea>
        </div>

        <div class="form-group">
            <label for="popup">Homepage popup</label>
            <textarea id="popup" name="popup" class="form-control"
                      rows="10">{{old('popup', isset($siteSettings['popup'])? $siteSettings['popup']: null)}}</textarea>
        </div>
        <div class="form-group">
            <label for="float_content_left">Right slide menu</label>
            <textarea id="float_content_left" name="float_content_left" class="form-control"
                      rows="3">{{old('float_content_left', isset($siteSettings['float_content_left'])? $siteSettings['float_content_left']: null)}}</textarea>
        </div>
        <div class="form-group">
            <label for="float_content_right">Left slide menu</label>
            <textarea id="float_content_right" name="float_content_right" class="form-control"
                      rows="3">{{old('float_content_right', isset($siteSettings['float_content_right'])? $siteSettings['float_content_right']: null)}}</textarea>
        </div>

        <div class="form-group">
            <label for="header_code">Header code</label>
            <textarea id="header_code" name="header_code" class="form-control"
                      rows="5">{{old('header_code', isset($siteSettings['header_code'])? $siteSettings['header_code']: null)}}</textarea>
        </div>
        <a href="{{URL::previous()}}" class="btn btn-warning">BACK</a>
        <button type="submit" class="btn btn-success pull-right" style="width: 90px">SAVE</button>
    </form>
@stop

@section('js')
    <script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>

    <script>

        var editor_config = {
            path_absolute: "/",
            selector: ".my-editor",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | forecolor backcolor | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
        };

        tinymce.init(editor_config);

        $(document).ready(function() {
            // on form submit
            $("#form").on('submit', function() {
                // to each unchecked checkbox
                $(this).find('input[type=checkbox]:not(:checked)').prop('checked', true).val(0);
            })
        })
    </script>

@stop
