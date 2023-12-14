
@extends('templates.master')

@section('content-center')

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success', null) }}
        </div>
    @endif
    @foreach ($errors->all() as $sError)
        <div class="alert alert-warning">{{ $sError }}</div>
    @endforeach
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Datos de producto
        </div>
        <div class="card-body">
            <form name="edit-product-form" id="edit-product-form" action="{{ route('product.update', ['product' => $product]) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('auth.Name') }}</label>
                    <input type="text" id="name" name="name" value="{{ $product->name }}" />
                    <br>
                    <label for="description">{{ __('auth.Description') }}</label>
                    <input type="text" id="description" name="description" class="form-control" value="{{ $product->description }}" />
                    <br>
                </div>
                <button type="submit" class="btn btn-primary">
                    {{__('auth.Save') }}
                </button>
            </form>
        </div>
    </div>

@endsection