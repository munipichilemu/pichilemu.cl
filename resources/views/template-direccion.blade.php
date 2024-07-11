{{--
Template Name: Dirección Municipal
--}}
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
        <a href="@permalink">
          @title
        </a>
      </h2>
    </div>

    <div class="grid grid-cols-4 gap-4 px-4">
      <div class="col-span-3 entry-content">
        @content
      </div>
      <aside>
        <div class="card">
          <div class="card-header">
            @set($director_photo, get_field('director_photo')['sizes']['avatar'] ?? get_field('default_avatar', 'option')['sizes']['avatar'])
            <img src="{{ $director_photo }}" alt="Foto del director">
            <h3>
              {{ get_field('director_name') ?: get_the_title() }}
            </h3>
          </div>
          <div class="card-body">
            <dl>
              @hasfield('place_name')
              <dt>Ubicación</dt>
              <dd>@field('place_name')</dd>
              @endfield

              @hasfield('phone')
              @set($phone, get_field('phone'))
              <dt>Teléfono</dt>
              <dd><a href="{{ $phone->uri }}">{{ $phone->international }}</a></dd>
              @endfield

              @hasfield('email')
              @set($email, get_field('email'))
              <dt>Correo</dt>
              <dd><a href="mailto:{{ $email }}">{{ $email }}</a></dd>
              @endfield
            </dl>
          </div>
        </div>
      </aside>
    </div>
  </article>
@endsection
