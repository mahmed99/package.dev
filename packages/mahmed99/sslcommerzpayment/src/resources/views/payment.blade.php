@extends('master')

@section('content')
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
	        <div class="panel panel-primary">
	          
	          <div class="panel-heading">Amount Info</div>
	          
	          <div class="panel-body">
	              <table class="table table-hover">
					    <thead>
					      <tr>
					        <th>Sl No.</th>
					        <th>Description</th>
					        <th>Amount</th>
					        {{-- <th>&nbsp;</th> --}}
					      </tr>
					    </thead>
					    <tbody>
					      <tr>
					        <td>1</td>
					        <td>Amount</td>
					        <td>{{ $amount }}</td>
					      </tr>
					      <tr>
					        <td>2</td>
					        <td>Online Charge</td>
					        <td>{{ $onlineCharge }}</td>
					      </tr>
					      <tr>
					        <td></td>
					        <td><strong>Total</strong></td>
					        <td><strong>{{ $totalAmount }}</strong></td>
					      </tr>		      
					    </tbody>
				  </table>
	          </div>

	          <div class="panel-footer">	          	
	          	<form id="payment_gw" name="payment_gw" method="POST" action="{{ $gwUrl }}">
					<input type="hidden" name="total_amount" value="{{ $totalAmount}}" />
					<input type="hidden" name="store_id" value="testbox" />
					{{-- <input type="hidden" name="tran_id" value="594e9719c2e59" /> --}}
					<input type="hidden" name="tran_id" value="{{ $bookingId }}" />					
					<input type="hidden" name="success_url" value="{{ route('success') }}" />
					<input type="hidden" name="fail_url" value="{{ route('fail') }}" />
					<input type="hidden" name="cancel_url" value="{{ route('cancel') }}" />
					<input type="hidden" name="version" value="3.00" />	

					<!-- Customer Information !-->
					<input type="hidden" name="cus_name" value="{{ $user->name }}">
					<input type="hidden" name="cus_email" value="{{ $user->email }}">	
					
					<!-- SUBMIT REQUEST  !-->
					<input type="submit" name="submit" value="Checkout" class="btn btn-primary" />
					<a href= "{{ url('/home') }}" type="button" value="Cancel" class="btn btn-warning">Cancel</a>
				</form>	          	
	          </div>
	        </div>
      	</div>
    </div>      
	
@endsection