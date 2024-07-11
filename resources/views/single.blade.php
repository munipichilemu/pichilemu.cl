@extends('layouts.app')

@section('content')
  @hasposts
  @include('partials.content-single')
  @endhasposts

  <aside>
    <h3>Otras noticias</h3>

    @if(get_previous_post())
      @php
        $prev = get_previous_post();
      @endphp
      <div class="post-card prev">
        @if(has_post_thumbnail($prev))
          <img src="@thumbnail($prev, 'thumbnail', false)" alt="@title" role="presentation">
        @else
          <img src="{{ get_field('default_thumbnail', 'option')['sizes']['thumbnail'] }}" alt="@title"
               role="presentation">
        @endif
        <div>
          <span>Anterior</span>
          <h4>
            <a href="@permalink($prev)">@title($prev)</a>
          </h4>
        </div>
      </div>
    @endif

    @if(get_next_post())
      @php
        $next = get_next_post();
      @endphp
      <div class="post-card next">
        @if(has_post_thumbnail($next))
          <img src="@thumbnail($next, 'thumbnail', false)" alt="@title" role="presentation">
        @else
          <img src="{{ get_field('default_thumbnail', 'option')['sizes']['thumbnail'] }}" alt="@title"
               role="presentation">
        @endif
        <div>
          <span>Siguiente</span>
          <h4>
            <a href="@permalink($next)">@title($next)</a>
          </h4>
        </div>
      </div>
    @endif
  </aside>
@endsection
