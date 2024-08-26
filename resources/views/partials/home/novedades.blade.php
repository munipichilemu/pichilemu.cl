<div id="novedades">
  <h2 class="sr-only">Novedades</h2>

  <section id="noticias">
    <h3>
      <x-fas-newspaper/>
      Noticias
    </h3>

    @query([
      'post_type' => 'post',
      'posts_per_page' => 3
    ])
    @posts
    <article>
      @if(has_post_thumbnail())
        <img src="@thumbnail('avatar', false)" alt="@title" role="img">
      @else
        <img src="{{ get_field('default_thumbnail', 'option')['sizes']['avatar'] }}" alt="@title"
             role="img">
      @endif
      <div>
        <h4>
          <a href="@permalink">@title</a>
        </h4>
        <div class="meta">
          <x-fas-calendar-lines/>
          <time datetime="@published('c')">@published</time>
        </div>
        @excerpt
      </div>
    </article>
    @endposts

    <a class="more" href="{{ site_url('/noticias') }}">Ver noticias anteriores</a>
  </section>

  <section id="publicaciones">
    <h3 class="text-4xl mb-8">
      <x-fas-books/>
      Publicaciones
    </h3>

    @query([
      'post_type' => 'publication',
      'posts_per_page' => 6,
      'meta_key' => 'emitted_at',
      'orderby' => 'meta_value_num',
      'order' => 'DESC'
    ])
    @posts
    <article>
      @php
        $term_icon = (object) apply_filters('get_publication_type_icon', get_the_ID());
      @endphp
      <x-icon name="fas-{{ $term_icon->id }}"/>
      <div>
        <h4>
          <a href="@permalink" target="_blank">@title</a>
        </h4>
        <div class="meta">
          <x-fas-calendar-lines class="-translate-y-px"/>
          <time datetime="{{ apply_filters('publication_date_formatter', get_field('emitted_at')) }}">
            {{ apply_filters('publication_date_formatter', get_field('emitted_at'), 'long') }}
          </time>
          @if(get_the_terms(get_the_ID(), 'publication_type'))
            &middot;
          <x-fas-tag/>
          <span>@term('publication_type')</span>
          @endif
        </div>
      </div>
    </article>
    @endposts

    <a class="more" href="{{ site_url('/publicaciones') }}">Ver publicaciones anteriores</a>
  </section>

  <section id="actividades" class="events-section">
    <h3>
      <x-fas-party-horn/>
      Eventos y actividades
    </h3>

    @include('partials.future-events-list')
  </section>
</div>
