@extends('master')

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
								<li> Transaction Ref: {{ $tran_id }} </li>
								<li>  Validation ID: {{ $val_id }}</li>				
								<li> Amount: {{ $store_amount }}</li>
								<li> Amount Including Charge: {{ $amount }}</li>
							</ul>
						@else
							<p> {{ $validation_message }}  </p>			
						@endif												

			  	</div>
		    </div>
	  	</div>
	</div>   
@endsection