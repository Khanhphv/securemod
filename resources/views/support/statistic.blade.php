@extends('adminlte::page')

@section('title', 'SUPPORTER SCREEN')

@section('content_header')

<h1 class="text-white">SUPPORTER PANEL</h1>

@stop

@section('content')
{{--<style>.main-sidebar {display: none}</style>--}}
<div class="row">
	@if(Auth::user()->type=='admin')
	<div class="col-md-12">
		<form action="{{ route('add-blacklist') }}">
			<div class="form-group col-6">
				<label for="email">Email</label>
				<input type="text" class="form-control" name="email" id="email"
				value="" required>
			</div>
			<div class="form-group col-6">
				<button type="submit" class="btn btn-danger">ADD TO BLACKLIST
				</button>
			</div>
		</form>
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">BLACK LIST</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i
						class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i
						class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<!-- /.box-header -->


			@if(count($blacklist) > 0)
			<div class="box-body">
				<div class="table-responsive">
					{{--                            {!!$histories->render()!!}--}}
					<table class="table no-margin">
						<thead>
							<tr>
								<th style="text-align: center">Email</th>
								<th style="text-align: center">Banned day</th>
							</tr>
						</thead>
						<tbody>
							@foreach($blacklist as $black)
							<tr>
								<td style="text-align: center">{{$black->email}}</td>
								<td style="text-align: center">{{$black->created_at}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div>
					{{--                            {!!$histories->render()!!}--}}
				</div>
				<!-- /.table-responsive -->
			</div>
			@endif
		</div>
		<!--/.box -->
	</div>
	@endif
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title">WAITING LIST</h3>

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
					{{--                            {!!$histories->render()!!}--}}
					<table class="table no-margin">
						<thead>
							<tr>
								<th style="text-align: center">User ID</th>
								<th style="text-align: center">Transaction ID</th>
								<th style="text-align: center">Money</th>
								<th style="text-align: center">Status</th>
								<th style="text-align: center">REQUIRE EMAIL CONTENT</th>
								<th style="text-align: center">Time</th>
								<th style="text-align: center">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($histories as $history)
							<tr>
								<td style="text-align: center">{{$history->user_id}}</td>
								<td style="text-align: center">{{$history->nl_token}}</td>
								<td style="text-align: center">{{$history->amount}}</td>
								<td style="text-align: center">
									@if($history->paypal_transaction_status == config('const.paypal_status.completed'))
									<span class="bg-success" style="padding: 3px;">{{$history->paypal_transaction_status}}</div></td>
										@else
										<span class="bg-danger" style="padding: 3px;">{{$history->paypal_transaction_status}}</div></td>
											@endif
											<td style="text-align: center"><strong>
												@php $email = explode(". Your payment", explode("Email: ", $history->content)[1])[0]; echo $email; @endphp
											</strong>
											<textarea class="form-control" onclick="this.select();">
We require to send us a confirmation email from your email - that used to paid us. (PayPal Email)

Make a new mail with following content:
xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

Mail Tittle: Confirmation Payment

Mail Content:
------------------------------------------------------------
I authorized the email access @php echo $email; @endphp and Paypal transaction ID {{$history->nl_token}} with ${{$history->amount}}.My Subcriptions have been added
I agree with Seller's Terms Of Service that is digital goods and none refundable.
Thanks To  Sellers for the best your services.
------------------------------------------------------------

xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

Send to email: vuthimlle80@gmail.com
Let me know when it done - In the case you do not agree with our terms we will provide you refund
											</textarea>
										</td>
										<td style="text-align: center">{{isset($history->created_at) ? $history->created_at->format('H:i:s d/m/Y') :  $history->created_at}}</td>
										<td style="text-align: center">

											@if($history->paypal_transaction_status == config('const.paypal_status.completed'))
											<a class="btn btn-default" target="a_blank" href="https://nanvkl.info/SecureCheats/index.php?email=@php echo $email; @endphp&transaction={{$history->nl_token}}">Check email now</a>
											<br><br>
											<a class="btn btn-success" href="{{ route('accept-payment', [$history->id]) }}"> Accept this payment</a>
											@else
											Not reveiced transaction data from Paypal
											<br>
											<a class="btn btn-danger"
											href="{{ route('accept-payment', [$history->id]) }}"> Still accept this payment</a>
											@endif

									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div>
						{{--                            {!!$histories->render()!!}--}}
					</div>
					<!-- /.table-responsive -->
				</div>
				@else
				<div class="box-body">
					<div class="table-responsive">
						<h3>No transactions</h3>
					</div>
				</div>
				@endif
			</div>
			<!--/.box -->
		</div>
		<!-- /.col -->
	</div>
	@stop
