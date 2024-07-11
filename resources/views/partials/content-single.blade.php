<article id="page-content" @postclass('h-entry')>
<div class="header">
  @if(has_post_thumbnail())
    <img src="@thumbnail('header-pages', false)" alt="@title" role="presentation">
  @else
    <img src="{{ get_field('default_thumbnail', 'option')['sizes']['header-pages'] }}" alt="@title" role="presentation">
  @endif
  <h2 class="entry-title p-name">
    <span class="meta">
      <time datetime="@published('c')">
        @published
      </time>
    </span>
    <a href="@permalink">
      @title
    </a>
  </h2>
</div>
<div class="entry-content e-content">
  @content
</div>
</article>
