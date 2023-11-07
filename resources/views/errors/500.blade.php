@extends('layouts/error')

@section('title') 500 @stop

@section('contents')
    <img class="img-error" src="assets/compiled/svg/error-500.svg" alt="System Error">
    <h1 class="error-title">System Error</h1>
    <p class="fs-5 text-gray-600">
        The website is currently unaivailable. Try again later or contact the developer.
    </p>
    <a href="{{ url('/') }}" class="btn btn-lg btn-outline-primary mt-3">Go Home</a>
@stop