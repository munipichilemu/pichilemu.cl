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
    <h2 class="section-heading">Concejales</h2>

    <ul class="sections-grid">
      @posts
      <li class="section-item">
        <span class="section-link">
          @if(get_field('portrait'))
            @set($retrato, get_field('portrait')['sizes']['avatar'])
            <img src="{{ $retrato }}" alt="@title" class="section-image" role="img">
          @else
            <img src="{{ get_field('default_thumbnail', 'option')['sizes']['avatar'] }}" alt="@title"
                 class="section-image"
                 role="img">
          @endif

          <div class="info">
            <h3>@title</h3>
            <p class="affiliation">@field('political_party')</p>
            <ul>
              @if(get_field('email'))
                <li>
                  <x-fas-envelope/>
                  <a href="mailto:@field('email')">@field('email')</a>
                </li>
              @endif

              @if(get_field('phone'))
                <li>
                  <x-fas-phone/>
                  <a href="tel:@field('phone')">@field('phone')</a>
                </li>
              @endif
            </ul>
          </div>
        </span>
      </li>
      @endposts
    </ul>
    @endhasposts
    @noposts
    <p class="no-sections-message">No se encontraron subpáginas.</p>
    @endhasposts
  </div>
@endsection
