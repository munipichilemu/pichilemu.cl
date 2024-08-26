<article id="page-content" @postclass>
  <div class="header" role="heading">
    @if(has_post_thumbnail())
      <img src="@thumbnail('header-pages', false)" alt="@title" role="img">
    @else
      <img src="{{ get_field('default_thumbnail', 'option')['sizes']['header-pages'] }}" alt="@title"
           role="img">
    @endif
    <h2 class="entry-title">
      <a href="@permalink">
        @title
      </a>
    </h2>
  </div>

  <div class="entry-content">
    @content
  </div>
</article>
