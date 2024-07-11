@extends('layouts.app')

@section('content')
  <div id="encabezado">
    <h2 class="sr-only">Novedades destacadas</h2>
    @include('partials.home.carrusel')
  </div>

  @include('partials.home.tramites')
  @include('partials.home.novedades')
  @include('partials.home.municipal')
  @include('partials.home.sociales')
@endsection
