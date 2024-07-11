@query([
'post_type' => 'slide',
'orderby' => 'menu_order',
'order' => 'ASC',
'posts_per_page' => 1,
])

<ul id="carrusel" role="presentation">
  @posts
  <li>
    <span class="backdrop"></span>
    <img alt="" src="@thumbnail('slide-home', false)">
    <div class="content">
      <h3>@title</h3>
      <p>
        @content
      </p>
      @hasfield('link')
      <a href="@field('link')">
        @field('text')
      </a>
      @endfield
    </div>
  </li>
  @endposts
</ul>
