@extends('layouts.app')

@section('content')
  <article id="page-content" @postclass>
    <div class="header" role="heading">
      @if(has_post_thumbnail())
        <img src="@thumbnail('header-pages', false)" alt="@title" role="presentation">
      @else
        <img src="{{ get_field('default_thumbnail', 'option')['sizes']['header-pages'] }}" alt="@title"
             role="presentation">
      @endif
      <h2 class="entry-title">
        <span class="meta">Evento</span>
        <a href="@permalink">
          @title
        </a>
      </h2>
    </div>

    <div class="grid grid-cols-4 gap-4 px-4">
      <div class="col-span-3 entry-content">
        @content
      </div>

      <div class="event-info">
        <div class="card">
          @hasfield('place_location')
          @field('place_location')
          @endfield
        </div>

        <dl>
          @hasfield('duration_date')
          <dt>Fecha del evento</dt>
          <dd>@field('duration_date')</dd>
          @endfield

          @hasfield('duration_time')
          <dt>Horario del evento</dt>
          <dd>@field('duration_time')</dd>
          @endfield

          @hasfield('place_name')
          <dt>Lugar del evento</dt>
          <dd>@field('place_name')</dd>
          @endfield
        </dl>
      </div>
    </div>
  </article>

  <aside id="eventos-futuros" class="container mx-auto px-4">
    <h3 class="text-3xl font-bold text-center my-8">
      Próximos eventos
    </h3>

    <div class="events-section my-8">
      @include('partials.future-events-list')
    </div>
  </aside>
@endsection
