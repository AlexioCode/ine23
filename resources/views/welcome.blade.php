@extends('templates.master')

@section('content-center')

<!-- LAYOUT: CENTER -->
    <div class="container-fluid" style="margin-top:30px">
      <div class="row">
    <!-- BLOCK: CENTER -->
        <div class="col-sm-10"> <!-- col-sm-7 means seven out of twelve columns -->
          <!-- SECTION: Entries -->          
          <h2>Ofertas del día</h2>
          <div class="row"> 
            @foreach ($aProduct_offering as $product)
              <div class="col-sm-2 card card-body border-0">
                <img src="{{ $product->imgUrl }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p>Precio: ${{ number_format($product->price, 2) }}</p>
              </div>
            @endforeach
<!--
            <div class="col-sm-2 card card-body border-0">
              <a href="#"> <img src="img/lucario.jpg" class="img-fluid" alt="Lucario"> </a>
              <h5>Lucario (NXD)</h5>
              <p>2.19$</p>
            </div>

            <div class="col-sm-2 card card-body border-0">
              <a href="#"> <img src="img/shiftry.jpg" class="img-fluid" alt="shiftry"> </a>
              <h5>Shiftry</h5>
              <p>0.50$</p>
            </div>

            <div class="col-sm-2 card card-body border-0">
              <a href="#"> <img src="img/amoonguss.jpg" class="img-fluid" alt="Amoonguus"> </a>
              <h5>Amoonguus (NXD)</h5>
              <p>0.38$</p>
            </div>

            <div class="col-sm-2 card card-body border-0">
              <a href="#"> <img src="img/level_ball.jpg" class="img-fluid" alt="Level-Ball"> </a>
              <h5>Level-Ball (NXD)</h5>
              <p>0.25$</p>
            </div>
-->

          </div>

          <br>

          <h2>Nuevos productos</h2>
          <div class="row"> 
            @foreach ($aProduct_new as $product)
                <div class="col-sm-2 card card-body border-0">
                  <img src="{{ $product->imgUrl }}" alt="{{ $product->name }}">
                  <h3>{{ $product->name }}</h3>
                  <p>Precio: ${{ number_format($product->price, 2) }}</p>
                  @if($product->HasDiscount())
                    {{ "¡OJO! ¡Está de oferta!" }}
                  @endif
                </div>
            @endforeach
<!--
            <div class="col-sm-2 card card-body border-0">
              <a href="#"> <img src="img/heavy_ball.jpg" class="img-fluid" alt="Heavy-Ball" width="70%"> </a>
              <h5>Heavy-Ball (NXD)</h5>
              <p>1.50$</p>
            </div>

            <div class="col-sm-2 card card-body border-0">
              <a href="#"> <img src="img/pinsir.jpg" class="img-fluid" alt="Pinsir" width="70%"> </a>
              <h5>Pinsir (NXD)</h5>
              <p>0.75$</p>
            </div>

            <div class="col-sm-2 card card-body border-0">
              <a href="#"> <img src="img/weavile.jpg" class="img-fluid" alt="Weavile" width="70%"> </a>
              <h5>Weavile (NXD)</h5>
              <p>1.20$</p>
            </div>
-->   
          </div>

        </div>
@endsection

@section('content-right')

        <div class="col-sm-2" style="background-color:#CCFFFF">
          <br>
          <h3>Lo más vendido en el mercado</h3>
          <br>  
          <div class="row pb-4">
            <div class="col-sm-1 pb-4">1
            </div>
            <div class="col-sm-8"><a href="#"> <img src="img/kyurem_ex.jpg" class="img-fluid" alt="Kyurem Ex"></a>
            </div>
          </div>
          <div class="row pb-4">
            <div class="col-sm-1">2 
            </div>
            <div class="col-sm-8"><a href="#"> <img src="img/mewtwo_ex.jpg" class="img-fluid" alt="Mewtwo Ex"></a>
            </div>
          </div>
          <div class="row pb-4">
            <div class="col-sm-1">3
            </div>
            <div class="col-sm-8"><a href="#"> <img src="img/reshiram_ex.jpg" class="img-fluid" alt="Reshiram Ex"></a>
            </div>
          </div>
          <div class="row pb-4">
            <div class="col-sm-1">4
            </div>
            <div class="col-sm-8"><a href="#"> <img src="img/shaymin.jpg" class="img-fluid" alt="Shaymin Ex"></a>
            </div>
          </div>
          <br>
          <div class="row pb-4">
            <div class="col-sm-1">5
            </div>
            <div class="col-sm-8"><a href="#"> <img src="img/zekrom_ex.jpg" class="img-fluid" alt="zekrom_ex"></a>
            </div>
          </div>
          <br>
          <div class="mx-auto pb-4" style="width: 200px;">
            <button type="button" class="btn btn-primary">Ver más cartas</button>
          </div>
        
        </div>   
      </div>
@endsection
