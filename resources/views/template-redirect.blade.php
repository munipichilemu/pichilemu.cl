{{--
Template Name: Redirección
Template Post Type: page, post
--}}
@php
  if (wp_get_environment_type() === 'production') {
    wp_redirect(get_field('link'), get_field('redirect') ? 301 : 302);
    exit;
  }
@endphp

Redirigiendo a: <span style="font-family: monospace;">[<a href="@field('link')">@field('link')</a>]</span> de forma
<strong style="text-transform: uppercase;">{{ get_field('permanent') ? 'permanente' : 'temporal' }}</strong>
