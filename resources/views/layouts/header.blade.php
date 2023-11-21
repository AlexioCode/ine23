<header class="navbar navbar-expand-sm" style="background-color: #99FFFF">
        <h1 class="display-4" href="#">Pokécards Shop</h1>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <ul class="navbar-nav mr-auto">
        <form class="d-flex form-inline my-2 my-lg-0">
          <input type="text" class="form-control" placeholder="Buscar...">
          <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
          </ul>
        </div>
        <a class="nav-link mx-3" href="#">Autenticación</a>
        @php 
          if(session()->get('cart') && session()->get('cart', 0)->iTotalItems > 0)
            echo session()->get('cart')->iTotalItems;
        @endphp
        <a href="{{ route('cart.show') }}">
            <img src="/ico/carrito.png" class="mx-3" alt="Carrito" width="20%">
          </a> 
</header>