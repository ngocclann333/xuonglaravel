@extends('master')

@section('title')
    Welcome
@endsection

@section('content')
    <h1>Welcome</h1>
    
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection