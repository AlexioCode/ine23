
<!-- namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;

-->


@extends('templates.master')

@section('content-center')

<!-- LAYOUT: CENTER -->
<div class="col-sm-2 card card-body border-0">
    <img src="/{{ $product->imgUrl }}" alt="{{ $product->name }}" class="img-fluid">
    <h3>{{ $product->name }}</h3>
    <p>Precio: ${{ number_format($product->price, 2) }}</p>
    <p>Nombre de la empresa: {{ $product->Company->name }}</p>
</div>


@endsection