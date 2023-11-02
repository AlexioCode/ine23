<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">      
    <link rel="stylesheet" href="css/bootstrap.min.css"/>

    <style>
      .fakeimg { height: 100px; background: #aaa; }
    </style>

    <title>Pokecard shop</title>
  </head>


  <body>
  <!-- LAYOUT: HEADER -->

  @include('layouts.header')

    <!-- LAYOUT: CENTER -->
    @yield ('content-center')
    @yield ('content-right')
    <!-- LAYOUT: FOOTER -->

  @include('layouts.footer')

    <!-- Loading Javascripts -->   

  </body>
</html>
