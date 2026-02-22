@extends('layout.layout')

@section('main')
    <h1>Welcome to the Index Page</h1>
    <a href="{{ route("product.index") }}">View Products</a>
@endsection