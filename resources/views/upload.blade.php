@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload Files</div>
                <div class="panel-body">

                    <form enctype="multipart/form-data" method="POST" action=" {{route('upload')}}">
                        {{ csrf_field() }}
                        <input type="file" name="avatar">
                        <button type="submit"> upload</button>                    
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
