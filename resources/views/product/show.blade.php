namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;

@extends('templates.master')

@section('content-center')

<!-- LAYOUT: CENTER -->

<div class="card card-body">
    <img src="{{ $product->imgUrl }}" alt="{{ $product->name }}">
    <h3>{{ $product->name }}</h3>
    <p>Precio: ${{ number_format($product->price, 2) }}</p>
    date_format(discountStart_at,"%Y-%m-%d")
    <p>Nombre de la empresa: {{ $product->Company->name }}</p>
</div>


@endsection