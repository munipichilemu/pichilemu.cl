<?php

/**
 * Theme filters.
 */

namespace App;

use Carbon\Carbon;
use Exception;

/**
 * Agrega '…' al extracto.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return '&hellip;';
});

/** Limita el extracto a 48 caracteres. */
add_filter('excerpt_length', function () {
    return 48;
});

/**
 * Filtro para embeber iconos FontAwesome como SVG inline.
 *
 * @param  object|null  $icon_field  Objeto con propiedades 'style' e 'id' del icono.
 *                                   Si es null, se intentará obtener con get_field('icon').
 * @param  array  $options  Opciones de personalización:
 *                          - base_dir: Directorio base de los iconos (string)
 *                          - height: Altura del icono (string, ej: '3em')
 *                          - width: Ancho del icono (string, ej: 'auto')
 *                          - class: Clases CSS adicionales para el SVG (string)
 * @return string Código HTML del icono SVG con estilos, o mensaje de error si no se encuentra.
 */
add_filter('fontawesome_embed', function ($icon_field = null, $options = []) {
    // Si no se proporciona un campo de icono, intenta obtenerlo
    if (! $icon_field) {
        $icon_field = get_field('icon');
    }

    // Configuración por defecto
    $defaults = [
        'base_dir' => get_template_directory().'/resources/icons/blade-fontawesome',
        'height' => '3em',
        'width' => 'auto',
        'class' => '',
    ];

    // Combina las opciones proporcionadas con los valores por defecto
    $settings = wp_parse_args($options, $defaults);

    $style = $icon_field->style;
    $id = $icon_field->id;

    $icon_path = "{$settings['base_dir']}/{$style}/{$id}.svg";

    // Verifica si el archivo existe
    if (! file_exists($icon_path)) {
        return 'Icon file not found';
    }

    $icon_data = file_get_contents($icon_path);

    // Añade clases adicionales si se proporcionan
    if (! empty($settings['class'])) {
        $icon_data = str_replace('<svg', '<svg class="'.esc_attr($settings['class']).'"', $icon_data);
    }

    $style = "<style scoped>
        svg {
            height: {$settings['height']};
            width: {$settings['width']};
        }
    </style>";

    return $style.$icon_data;
}, 10, 2);

/**
 * Filtro para embeber una representación visual de un color.
 *
 *
 * @param  string|null  $color_field  Valor hexadecimal del color (ej: '#ff0000').
 *                                    Si es null o inválido, se usa '#333333'.
 * @return string Código HTML que representa visualmente el color.
 */
add_filter('color_embed', function ($color_field = null) {
    // Valor por defecto si no se proporciona un color
    $default_color = '#333333';

    // Usar el color proporcionado o el valor por defecto
    $color = $color_field ?: $default_color;

    // Asegurarse de que el color es un valor hexadecimal válido
    if (! preg_match('/^#[a-f0-9]{6}$/i', $color)) {
        $color = $default_color;
    }

    // Calcular el color del texto basado en el brillo del fondo
    $rgb = sscanf($color, '#%02x%02x%02x');
    $brightness = (0.299 * $rgb[0] + 0.587 * $rgb[1] + 0.114 * $rgb[2]) / 255;
    $text_color = $brightness > 0.5 ? '#000000' : '#ffffff';

    // Escapar el color para su uso seguro en HTML
    $escaped_color = esc_attr($color);

    return sprintf(
        "<span style='
            background-color: %s;
            color: %s;
            display: inline-block;
            padding: 0.2em 0.4em;
            border-radius: 0.2em;
            font-family: monospace;'>
        %s
        </span>",
        $escaped_color,
        $text_color,
        $escaped_color
    );
}, 10, 1);

/**
 * Filtro para formatear fechas de Publicaciones usando Carbon
 *
 * @param  string  $date_string  La fecha en formato d/m/Y como la devuelve ACF
 * @param  string  $format  El formato deseado de salida (por defecto 'c' para ISO 8601)
 * @return string La fecha formateada
 */
add_filter('publication_date_formatter', function ($date_string, $format = 'c') {
    try {
        Carbon::setLocale('es');
        $date = Carbon::createFromFormat('d/m/Y', $date_string);

        if ($format === 'long') {
            return $date->isoFormat('DD [de] MMMM [de] YYYY');
        }

        return $date->format($format);
    } catch (Exception $e) {
        return $date_string;
    }
}, 10, 2);

/**
 * Filtro para obtener el icono del tipo de publicación
 *
 * @param  int  $post_id  ID del post de tipo 'publication'
 * @return array Datos del icono (incluyendo un icono por defecto si no se encuentra)
 */
add_filter('get_publication_type_icon', function ($post_id) {
    $default_icon = [
        'style' => 'solid',
        'id' => 'file',
    ];

    if (get_post_type($post_id) !== 'publication') {
        return $default_icon;
    }

    $terms = get_the_terms($post_id, 'publication_type');

    if (! $terms || is_wp_error($terms)) {
        return $default_icon;
    }

    $term = reset($terms);

    $icon_field = get_field('icon', $term);

    if (! $icon_field || empty($icon_field->style) || empty($icon_field->id)) {
        return $default_icon;
    }

    return [
        'style' => $icon_field->style,
        'id' => $icon_field->id,
    ];
}, 10, 1);
