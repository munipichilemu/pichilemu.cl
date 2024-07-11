@extends('layouts.app')

@section('content')
  <div id="page-content" @postclass>
    <div class="header">
      @if(has_post_thumbnail())
        <img src="@thumbnail('header-pages', false)" alt="@title" role="presentation">
      @else
        <img src="{{ get_field('default_thumbnail', 'option')['sizes']['header-pages'] }}" alt="@title"
             role="presentation">
      @endif

      <h2 class="entry-title">
        <a href="@permalink">
          @title
        </a>
      </h2>
    </div>

    <div class="entry-content not-prose">
      @hasposts($news)
      @posts($news)
      <article class="news">
        @if(has_post_thumbnail())
          <img src="@thumbnail('avatar', false)" alt="@title" role="presentation">
        @else
          <img src="{{ get_field('default_thumbnail', 'option')['sizes']['avatar'] }}" alt="@title"
               role="presentation">
        @endif
        <div>
          <h3>
            <a href="@permalink">@title</a>
          </h3>
          <div class="meta">
            <x-fas-calendar-lines/>
            <time datetime="@published('c')">@published</time>
          </div>
          @excerpt
        </div>
      </article>
      @endposts

      <div class="pagination">
        {!! $pages->links('components.pagination') !!}
      </div>
      @endhasposts

      @noposts($news)
      <x-fas-do-not-enter class="not-prose !block !mx-auto mt-12 text-8xl opacity-50"/>
      <p class="not-prose text-3xl text-center">
        <br>
        No hay noticias disponibles.
      </p>
      @endhasposts
    </div>
  </div>
@endsection
