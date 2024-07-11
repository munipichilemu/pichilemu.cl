@extends('page')

@section('content')
  @parent

  <div class="container mx-auto pb-16 max-w-[56rem]">
    @query([
      'post_type' => 'page',
      'post_parent' => get_the_ID(),
      'orderby' => 'menu_order',
      'order' => 'ASC',
    ])

    @hasposts
    <h2 class="sr-only">Secciones</h2>

    <ul class="sections-grid">
      @posts
      <li class="section-item">
        <a href="@permalink" class="section-link">
          @if(has_post_thumbnail())
            <img src="@thumbnail('header-half', false)" alt="@title" class="section-image" role="presentation">
          @else
            <img src="{{ get_field('default_thumbnail', 'option')['sizes']['header-half'] }}" alt="@title"
                 class="section-image"
                 role="presentation">
          @endif

          <h3 class="section-title">@title</h3>
        </a>
      </li>
      @endposts
    </ul>
    @endhasposts
    @noposts
    <p class="no-sections-message">No se encontraron subpáginas.</p>
    @endhasposts
  </div>
@endsection
