@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset($message))
            <div class="col-md-12">
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            </div>
        @endif

        @include('includes.post')
    </div>
@endsection