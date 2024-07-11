@extends('page')

@section('content')
  @parent

  <div class="container mx-auto pb-16 max-w-[56rem]">
    @query([
      'post_type' => 'page',
      'post_parent' => get_the_ID(),
      'posts_per_page' => -1,
      'orderby' => 'menu_order',
      'order' => 'ASC',
    ])

    @hasposts
    <h2 class="section-heading">Direcciones</h2>

    <div class="direcciones-container">
      <ul class="direcciones-list">
        @posts
        <li class="direcciones-item">
          <a href="@permalink">
            @title
          </a>
        </li>
        @endposts
      </ul>
    </div>
    @endhasposts
    @noposts
    <p>No se encontraron direcciones.</p>
    @endhasposts
  </div>
@endsection
