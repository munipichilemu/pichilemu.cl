{{--
Template Name: Miembro del Concejo
--}}
{{--TODO: Visualización de template-concejal--}}

@php
  if (wp_get_environment_type() === 'production') {
    wp_redirect(site_url('/municipalidad/concejo'));
    exit;
  }
@endphp

Redirigiendo a: {{ site_url('/municipalidad/concejo') }} de forma <strong>temporal</strong>.
