@extends('layouts/error')

@section('title') 403 @stop

@section('contents')
    <img class="img-error" src="assets/compiled/svg/error-403.svg" alt="Forbidden">
    <h1 class="error-title">Forbidden</h1>
    <p class="fs-5 text-gray-600">You are unauthorized to see this page.</p>
    <a href="{{ url('/') }}" class="btn btn-lg btn-outline-primary mt-3">Go Home</a>
@stop