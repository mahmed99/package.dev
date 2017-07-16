@extends('sslcommerzpayment::master')

@section('content')
	<div id="payment" class="row">
	    <div class="col-md-8 col-md-offset-2">
		    <div class="panel panel-success">		      
		      <div class="panel-heading">Payment Status</div>		      			      		      
		      <div class="panel body">

		      	@if ($payment_status == 'success')
					<h1> {{ $payment_status }}  </h1>
					<ul>
						<li> Status: <span>{{ $status }}</span> </li>
						<li> Order Number: <span>{{ $tran_id }}</span> </li>
						<li> Bank Transaction ID: <span>{{ $bank_tran_id }}</span></li>		
						<li> Date of Transaction: <span>{{ $tran_date }}</span></li>		
						<li> Amount: <span>{{ $store_amount }}</span></li>
						<li> Total Amount: <span>{{ $currency }} {{ $amount }}</span></li>
					</ul>
					<p>Payment has been made with <strong> {{ $card_type }}</strong> for an amount of <strong> {{ $currency }} {{ $amount}} </strong> </p>
				@else
					<p> {{ $validation_message }}  </p>			
				@endif												

			  </div>
		    </div>
	  	</div>
	</div>   
@endsection