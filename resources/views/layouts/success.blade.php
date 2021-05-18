@if (Session::has('msg'))
    <div class="alert alert-success">
        {!! Form::button(
            '&times;',
            [
                'class' => 'close',
                'data-dismiss' => 'alert',
            ]
        ) !!}
        {!! Session::get('msg') !!}
    </div>
@endif
