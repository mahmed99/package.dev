@extends('sslcommerzpayment::master')

@section('content')
	<div class="row">
	    <div class="col-md-8 col-md-offset-2">
		    <div class="panel panel-success">		      
		      <div class="panel-heading">Payment Status</div>		      			      		      
		      <div class="panel body">

		      	@if ($payment_status == 'success')
					<h1> {{ $payment_status }}  </h1>
					<ul>
						<li> Status: {{ $status }} </li>
						<li> Order Number: {{ $tran_id }} </li>
						<li> Bank Transaction ID: {{ $bank_tran_id }}</li>		
						<li> Date of Transaction: {{ $tran_date }}</li>		
						<li> Amount: {{ $store_amount }}</li>
						<li> Total Amount: {{ $currency $amount }}</li>
					</ul>
					<p>Payment has been made with <strong> {{card_type}}</strong> for an amount of {{ $currency }} {{ $amount}} </p>
				@else
					<p> {{ $validation_message }}  </p>			
				@endif												

			  </div>
		    </div>
	  	</div>
	</div>   
@endsection