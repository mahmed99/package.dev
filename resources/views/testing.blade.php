@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Uploaded Image Files</div>
                <div class="panel-body">                    
                    {{-- <img src="storage/images/birds.jpg"> --}}
                    <img src="{{ asset('storage/images/birds.jpg')}}">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
