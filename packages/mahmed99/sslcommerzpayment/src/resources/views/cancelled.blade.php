@extends('master')

@section('content')
	<div class="row">
	    <div class="col-md-8 col-md-offset-2">
		    <div class="panel panel-warning">
		      <div class="panel-heading">Payment {{ $payment_status }}</div>
		      
		      <div class="panel body">					
						<h2> {{ $validation_message }} </h2>			
						<div id="payment">				
							<form action="{{ url('/pay/'.$orderId) }}">
								 {{ csrf_field() }}
								 <button type="submit" class="btn btn-info">Try Again</button>								 
								 <a href= "{{ url('/home') }}" type="button" value="Cancel" class="btn btn-warning">Cancel</a>
							</form>
						</div>			
			  	</div>
		    </div>
	  	</div>
	</div>   
@endsection