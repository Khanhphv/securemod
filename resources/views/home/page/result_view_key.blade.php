@extends('layouts.app_short_header')
@section('title')
    Key activity - TOOL PUBG MOBILE - iPUBG.NET
@stop
@section('content-banner')
    <h2 class="section-title text-center">HOẠT ĐỘNG KEY</h2>
    <span class="tool-description"></span>

@stop
@section('content')
    <div class="container">
	 <div class="row">
         <div class="col-md-8 col-md-offset-2" style="margin-top: 20px; margin-bottom: 20px;">
                <!-- <h1 style="text-align: center; margin: 0;">ATM</h1> -->
                <h3 class="text-center text-uppercase" style="color: #fff;"><strong>LOCK THE KEY TO HWID</strong></h3>
                <br>
				
                <div class="form-group">
                    <input type="text"
                           class="my_select form-control" placeholder="ENTER HWID" id="hwid_fixed" name="hwid_fixed" value={{$key->hwid_fixed}}>
                </div>
                <button id="setHwid" class="my-btn"
                       style="width: 100%;background: #FAC93B;padding: 10px;font-size: 15px;border:0"/>Save </button>
                <br>
        </div>
    
        <div class="col-md-12" style="margin-top: 20px; margin-bottom: 20px;">
            @if(count($key) > 0)
                <h2 class="text-center text-uppercase">Key details</h2>
                <br>
                <div class="table-responsive">
                    <table class="table table-hover" style="background: #FFF">
                        <tr>
                            <th>Type tool</th>
                            <th>Key</th>
                            <th style="text-align: center">Package (hour)</th>
                            <th>Device ID</th>
                            <th style="text-align: center">Number of device change</th>
                            <th style="text-align: center">HWID number</th>
                            <th>Activation time</th>
                        </tr>
                        <tr>
                            <td>{{$key->getToolName->name}}</td>
                            <td>{{$key->key}}</td>
                            <td style="text-align: center">{{$key->package}}</td>
                            <td>{{isset($key->hwid) ? $key->hwid : "Not activated"}}</td>
                            <td style="text-align: center">{{isset($key->hwid_count) ? $key->hwid_count : 0}}</td>
                            <td style="text-align: center">{{$soLuongHWID}}</td>
                            <td>@if(isset($key->active_time))  <?php echo \Carbon\Carbon::createFromTimestamp($key->active_time )->toDateTimeString(); ?>@else  Not activated @endif</td>
                        </tr>
                    </table>
                </div>
            @endif
            @if(count($history) > 0)
                <h2 class="text-center text-uppercase">Key history</h2>
                <br>

                <div class="table-responsive">

                    <table class="table table-hover" style="background: #FFF">
                        <tr>
                            <th>ID</th>
                            <th>Action</th>
                            <th>Content</th>
                            <th>Time</th>


                        </tr>
                        <tr>
                            <td>{{$history->user_id}}</td>
                            <td>{{$history->action}}</td>
                            <td>{{$history->content}}</td>
                            <td>{{$history->updated_at}}</td>
                        </tr>


                    </table>
                </div>
            @endif
            @if(count($hwidLogs) > 0)
                <h2 class="text-center text-uppercase">Device history</h2>
                <div class="table-responsive">
                    <table class="table table-hover" style="background: #FFF">
                            <tr>
                                <th>HWID</th>
                                <th>IP Address</th>
                               <th>First time using</th>
                               <th>Last time using</th>
                            </tr>
                              @foreach($hwidLogs as $hwidLog)
                            <tr>
                                <td>{{$hwidLog->hwid}}</td>
                                <td>{{$hwidLog->ip_address}}</td>
                                <td>{{$hwidLog->created_at}}</td>
                                <td>{{$hwidLog->updated_at}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
            @if(isset($historyHwids) && count($historyHwids) > 0)
                <h2 class="text-center text-uppercase">Blocking by cracked </h2>
                <div class="table-responsive">
                    <table class="table table-hover" style="background: #FFF">
                        <tr>
                            <th>ID</th>
                            <th>Name of the software</th>
                            <th>Time</th>
                        </tr>
                        @foreach($historyHwids as $hwid)
                            <tr>
                                <td>{{$hwid->id}}</td>
                                <td>{{$hwid->cheat_name}}</td>
                                <td>{{$hwid->created_at}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
        </div>
		</div>
    </div>
@endsection
@section('js')
<script>
     $('#setHwid').click(function (e) {
            e.preventDefault();
            var url = `{{route('post.setHwid')}}`;
            var hwid_fixed = $('#hwid_fixed').val();
            var key = '{{$key->key}}';
                $.ajax({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    data: {hwid_fixed: hwid_fixed, key: key},
                    success: function (response) {
                        if (response.status == "success") {
                            Swal({
                                title: 'Success',
                                text: "You have successfully setuped" ,
                                type: 'success'
                            }).then(function (){
                                location.reload();
                            });
                        } else {
                            Swal({
                                title: 'Cannot change key',
                                text: response.message,
                                type: 'error'
                            })
                        }
                    }
                })
            
        })
</script>
@stop