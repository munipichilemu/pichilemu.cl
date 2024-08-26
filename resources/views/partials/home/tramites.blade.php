<div id="servicios">
  <h2 class="sr-only">Trámites y servicios</h2>

  <section id="busqueda">
    <h3>
      <x-fas-magnifying-glass/>
      Quiero saber sobre…
    </h3>

    @query([
    'post_type' => 'pill',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    ])
    <ul>
      @posts
      <li>
        <a href="@field('link')" style="background-color: @field('color'); color: @field('text_color')">
          <x-icon name="fas-{{ get_field('icon')->id }}"/>
          @title
        </a>
      </li>
      @endposts
    </ul>

    <div>
      <a href="/tramites">Ver todos los servicios y trámites</a>
    </div>
  </section>

  <section id="importantes">
    <h3 class="sr-only">Trámites destacados</h3>

    @query([
    'post_type' => 'relevant',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'posts_per_page' => 4,
    ])

    @posts
    <article>
      <a href="@field('link')">
        <img alt="" src="@thumbnail('relevant-home', false)">
        <h4>@title</h4>
      </a>
    </article>
    @endposts
  </section>

  <section id="tramites">
    <h3 class="sr-only">Otros trámites</h3>

    @query([
    'post_type' => 'button',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'posts_per_page' => 8,
    ])
    <ul>
      @posts
      <li>
        <a href="@field('link')"><img alt="@title" src="@thumbnail('button-home', false)"></a>
      </li>
      @endposts
    </ul>
  </section>
</div>
