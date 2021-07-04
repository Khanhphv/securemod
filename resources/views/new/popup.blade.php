@php
    $notice = \App\Option::where('option', 'header_notice')->get()->first();
@endphp
@if(isset($notice->value))
    <style>
        .swal2-popup.swal2-modal.swal2-show {
            min-height: auto;
            padding: 30px 0 15px 0;
            font-size: 14px;
        }
        #swal2-content {
            padding: 0 15px;
            font-weight: 500
        }
    </style>
    <script type="">
        window.onload = function() {
            setTimeout(()=> {
                Swal.fire({
                    title: 'Notification',
                    html: '{!! \App\Option::where('option', 'header_notice')->get()->first()->value !!}',
                })
            }, 7 * 1000)
        }

    </script>
@endif
