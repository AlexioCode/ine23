
<!-- namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;


-->
@extends('templates.master')

@section('content-center')

@isset($cart)
    @if ($cart ->iTotalItems > 0)
        <h3>Productos: {{$cart->iTotalItems}} Total: {{$cart->dTotalPrice}} </h3>
    @else
        <h3>No hay productos en el carrito.</h3>
    @endif
<div class="col-sm-2 card card-body border-0">
    @foreach ($cart->htItem as $cartItem)
    <img src="/{{ $cartItem['imgUrl'] }}" class="img-fluid" alt="{{ $cartItem['name'] }}">
    <h3>{{ $cartItem['name'] }}</h3>
    <p>Precio: ${{ number_format($cartItem['price'], 2) }}</p>
    <div>
    <a type="button" class="btn btn-light" href="{{ route('cart.operation', [ 'operation' => 'remove', 'product' => $cartItem['id']]) }}">-</a>
    @php echo $cart->htItem[$cartItem['id']]['quantity'] @endphp
    <a type="button" class="btn btn-light" href="{{ route('cart.operation', [ 'operation' => 'add', 'product' => $cartItem['id']]) }}">+</a>
    </p>
    <p><a type="button" class="btn btn-danger" href="{{ route('cart.operation', [ 'operation' => 'removeAll', 'product' => $cartItem['id']]) }}">Eliminar</a></p>
    </div>
    @endforeach
</div>

<div>

@endisset
@endsection