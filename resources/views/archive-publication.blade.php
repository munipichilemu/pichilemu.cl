@extends('layouts.app')

@section('content')
  <div id="page-content" @postclass>
    <div class="header">
      <img src="{{ get_field('default_thumbnail', 'option')['sizes']['header-pages'] }}" alt="@title"
           role="img">

      <h2 class="entry-title">
        <a href="{{ site_url('/publicaciones') }}">
          Publicaciones
        </a>
      </h2>
    </div>

    <div class="entry-content not-prose">
      @hasposts($publications)
      @posts($publications)
      <article class="publication">
        @set($term_icon, (object) apply_filters('get_publication_type_icon', get_the_ID()))
        <x-icon name="fas-{{ $term_icon->id }}"/>
        <div>
          <h3>
            <a href="@permalink" target="_blank">@title</a>
          </h3>
          <div class="meta">
            <x-fas-calendar-lines/>
            <time datetime="{{ apply_filters('publication_date_formatter', get_field('emitted_at')) }}">
              {{ apply_filters('publication_date_formatter', get_field('emitted_at'), 'long') }}
            </time>
            @if(get_the_terms(get_the_ID(), 'publication_type'))
              &middot;
            <x-fas-tag/>
            <span>@term('publication_type')</span>
            @endif
          </div>
          @excerpt
        </div>
      </article>
      @endposts

      <div class="pagination">
        {!! $pages->links('components.pagination') !!}
      </div>
      @endhasposts
    </div>
  </div>
@endsection
