@query([
'post_type' => 'slide',
'orderby' => 'menu_order',
'order' => 'ASC',
'posts_per_page' => -1,
])

<div id="carrusel" class="tiny-slider" role="presentation">
  @posts
  <div class="slide">
    <div class="slide-wrapper">
      <span class="backdrop"></span>
      <img src="@thumbnail('slide-home', false)" alt="@title">
      <div class="content">
        <h3>@title</h3>
        <p>@content</p>
        @hasfield('link')
        <a href="@field('link')">@field('text')</a>
        @endfield
      </div>
    </div>
  </div>
  @endposts
</div>
