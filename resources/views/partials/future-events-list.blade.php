@hasposts($futureEvents)
<div class="events-grid">
  @posts($futureEvents)
  <article class="event-card">
    <img alt="@title" src="@thumbnail('event-home', false)">
    <div class="info">
      <time datetime="{{ apply_filters('publication_date_formatter', get_field('start_date'), 'Y-m-d') }}">
        {{ apply_filters('publication_date_formatter', get_field('start_date'), 'd M Y') }}
      </time>
      <h4>@title</h4>
      <ul>
        <li>
          <x-fas-calendar-days class="fa-fw"/>
          @field('duration_date')
        </li>
        <li>
          <x-fas-clock class="fa-fw"/>
          @field('duration_time')
        </li>
        <li>
          <x-fas-location-dot class="fa-fw"/>
          @field('place_name')
        </li>
      </ul>
      <div>
        <a href="@permalink">Más información</a>
      </div>
    </div>
  </article>
  @endposts
</div>
@endhasposts
