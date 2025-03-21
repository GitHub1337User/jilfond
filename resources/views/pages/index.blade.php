@extends('layouts.app')

@section('title','mainpage')


@section('main')

<h1>Все товары</h1>
@foreach($products as $product)
    
    @include('includes.product-card',$product)

@endforeach

@endsection