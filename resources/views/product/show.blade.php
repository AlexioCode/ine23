@extends('templates.master')

@section('content-center')

<!-- LAYOUT: CENTER -->
@foreach ($errors->all() as $sError)
    <div class="alert alert-warning">{{ $sError }}</div>
@endforeach

<div class="col-sm-2 card card-body border-0">
    <img src="/{{ $product->imgUrl }}" alt="{{ $product->name }}" class="img-fluid">
    <h3>{{ $product->name }}</h3>
    <p>Precio: ${{ number_format($product->price, 2) }}</p>
    <p>{{ $product->description }}</p>
    <p>Nombre de la empresa: {{ $product->Company->name }}</p>
    @if (Auth::User() && App\Models\User::isEditor(Auth::User()))
        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary">Editar producto</a>
    @endif
    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary">Añadir al carro</a>
</div>

@endsection