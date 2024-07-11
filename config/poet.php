<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Post Types
    |--------------------------------------------------------------------------
    |
    | Here you may specify the post types to be registered by Poet using the
    | Extended CPTs library. <https://github.com/johnbillion/extended-cpts>
    |
    */

    'post' => [
        'slide' => [
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => false,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'show_in_nav_menus' => false,
            'show_in_menu' => 'homepage-options',
            'menu_icon' => 'dashicons-slides',
            'labels' => [
                'singular' => 'Diapositiva',
                'plural' => 'Diapositivas',
                'all_items' => 'Diapositivas',
                'add_new' => 'Agregar diapositiva',
            ],
            'admin_cols' => [
                'thumbnail' => [
                    'title' => 'Fondo',
                    'featured_image' => 'slide-admin',
                    'height' => 80,
                ],
                'published_date' => [
                    'title' => 'Fecha',
                    'function' => function () {
                        echo sprintf(
                            '%s<br>%s a las %s',
                            get_post_status_object(get_post_status())->label,
                            get_the_date('d/m/Y'),
                            get_the_time('H:i')
                        );
                    },
                ],
            ],
        ],
        'pill' => [
            'supports' => ['title'],
            'show_in_rest' => false,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'show_in_nav_menus' => false,
            'show_in_menu' => 'homepage-options',
            'menu_icon' => 'dashicons-text',
            'labels' => [
                'singular' => 'Píldora',
                'plural' => 'Píldoras',
                'all_items' => 'Píldoras',
                'add_new' => 'Agregar píldora',
            ],
            'admin_cols' => [
                'icon' => [
                    'title' => 'Icono',
                    'function' => function () {
                        echo apply_filters('fontawesome_embed', null);
                    },
                ],
                'color' => [
                    'title' => 'Color',
                    'function' => function () {
                        echo apply_filters('color_embed', get_field('color'));
                    },
                ],
                'published_date' => [
                    'title' => 'Fecha',
                    'function' => function () {
                        echo sprintf(
                            '%s<br>%s a las %s',
                            get_post_status_object(get_post_status())->label,
                            get_the_date('d/m/Y'),
                            get_the_time('H:i')
                        );
                    },
                ],
            ],
        ],
        'relevant' => [
            'supports' => ['title', 'thumbnail'],
            'show_in_rest' => false,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'show_in_nav_menus' => false,
            'show_in_menu' => 'homepage-options',
            'menu_icon' => 'dashicons-warning',
            'labels' => [
                'singular' => 'Relevante',
                'plural' => 'Relevantes',
                'all_items' => 'Relevantes',
                'add_new' => 'Agregar relevante',
            ],
        ],
        'button' => [
            'supports' => ['title', 'thumbnail'],
            'show_in_rest' => false,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'show_in_nav_menus' => false,
            'show_in_menu' => 'homepage-options',
            'menu_icon' => 'dashicons-button',
            'featured_image' => 'Imagen del botón',
            'labels' => [
                'singular' => 'Botón',
                'plural' => 'Botones',
                'all_items' => 'Botones',
                'add_new' => 'Agregar botón',
            ],
            'admin_cols' => [
                'link' => [
                    'title' => 'Vínculo',
                    'function' => function () {
                        $link = ! empty(get_field('link')) ? get_field('link') : null;

                        echo $link
                            ? "<a href='$link' target='_blank'>Enlace</a>"
                            : "<span style='color: #b32d2e;'>Enlace no configurado</span>";
                    },
                ],
                'thumbnail' => [
                    'title' => 'Fondo',
                    'featured_image' => 'button-admin',
                    'height' => 80,
                ],
                'published_date' => [
                    'title' => 'Fecha',
                    'function' => function () {
                        echo sprintf(
                            '%s<br>%s a las %s',
                            get_post_status_object(get_post_status())->label,
                            get_the_date('d/m/Y'),
                            get_the_time('H:i')
                        );
                    },
                ],
            ],
        ],
        'publication' => [
            'supports' => ['title'],
            'show_in_rest' => true,
            'block_editor' => false,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'show_in_nav_menus' => false,
            'menu_position' => 6,
            'menu_icon' => 'dashicons-media-document',
            'labels' => [
                'singular' => 'Publicación',
                'plural' => 'Publicaciones',
                'all_items' => 'Publicaciones',
                'add_new' => 'Nueva publicación',
            ],
            'admin_cols' => [
                'document' => [
                    'title' => 'Vínculo de descarga',
                    'function' => function () {
                        $download_link = get_field('document');
                        echo "<a href='{$download_link}' target='_blank'>Descargar documento</a>";
                        /* TODO: Link para copiar vínculo al portapapeles. */
                    },
                ],
                'type' => [
                    'title' => 'Tipo',
                    'function' => function () {
                        $post_id = get_the_ID();
                        $icon_data = apply_filters('get_publication_type_icon', $post_id);
                        $term = get_the_terms($post_id, 'publication_type')[0] ?? null;

                        $icon_html = apply_filters('fontawesome_embed', (object) $icon_data, ['height' => '1.25em']);
                        $type_name = $term ? $term->name : 'Tipo no definido';

                        echo $icon_html;
                        echo "<span style='display: inline-block; padding-left: 0.5em; transform: translateY(-0.25em);'>{$type_name}</span>";
                    },
                ],
                'emitted_at' => [
                    'title' => 'Publicado y emitido',
                    'meta_key' => 'emitted_at',
                    'default' => 'DESC',
                    'return_format' => 'c',
                    'function' => function () {
                        echo sprintf(
                            '<strong>Emitido el %s</strong><br>%s el %s a las %s',
                            get_field('emitted_at'),
                            get_post_status_object(get_post_status())->label,
                            get_the_date('d/m/Y'),
                            get_the_time('H:i')
                        );
                    },
                ],
            ],
        ],
        'event' => [
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true,
            'block_editor' => false,
            'has_archive' => true,
            'menu_position' => 6,
            'menu_icon' => 'dashicons-tickets-alt',
            'labels' => [
                'singular' => 'Evento',
                'plural' => 'Eventos',
                'all_items' => 'Eventos',
                'add_new' => 'Nuevo evento',
            ],
            'admin_cols' => [
                'location' => [
                    'title' => 'Ubicación',
                    'meta_key' => 'place_name',
                ],
                'event_date' => [
                    'title' => 'Fecha del evento',
                    'meta_key' => 'start_date',
                    'default' => 'DESC',
                    'return_format' => 'c',
                    'function' => function () {
                        echo sprintf(
                            '<strong>%s</strong> <br> %s',
                            apply_filters('publication_date_formatter', get_field('start_date'), 'long'),
                            get_field('duration_time')
                        );
                    },
                ],
                'published' => [
                    'title' => 'Publicado',
                    'function' => function () {
                        echo sprintf(
                            '<strong>%s</strong><br>%s a las %s',
                            get_post_status_object(get_post_status())->label,
                            get_the_date('d/m/Y'),
                            get_the_time('H:i')
                        );
                    },
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Taxonomies
    |--------------------------------------------------------------------------
    |
    | Here you may specify the taxonomies to be registered by Poet using the
    | Extended CPTs library. <https://github.com/johnbillion/extended-cpts>
    |
    */

    'taxonomy' => [
        'publication_type' => [
            'links' => ['publication'],
            'exclusive' => true,
            'required' => true,
            'hierarchical' => false,
            'labels' => [
                'singular' => 'Tipo',
                'plural' => 'Tipos',
                'slug' => 'publicaciones/tipo',
            ],
            'admin_cols' => [
                'description' => false,
                'icon' => [
                    'title' => 'Icono',
                    'function' => function ($term_id) {
                        echo apply_filters(
                            'fontawesome_embed',
                            json_decode(get_term_meta($term_id, 'icon', true))
                        );
                    },
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Blocks
    |--------------------------------------------------------------------------
    |
    | Here you may specify the block types to be registered by Poet and
    | rendered using Blade.
    |
    | Blocks are registered using the `namespace/label` defined when
    | registering the block with the editor. If no namespace is provided,
    | the current theme text domain will be used instead.
    |
    | Given the block `sage/accordion`, your block view would be located at:
    |   ↪ `views/blocks/accordion.blade.php`
    |
    | Block views have the following variables available:
    |   ↪ $data    – An object containing the block data.
    |   ↪ $content – A string containing the InnerBlocks content.
    |                Returns `null` when empty.
    |
    */

    'block' => [
        // 'sage/accordion',
    ],

    /*
    |--------------------------------------------------------------------------
    | Block Categories
    |--------------------------------------------------------------------------
    |
    | Here you may specify block categories to be registered by Poet for use
    | in the editor.
    |
    */

    'block_category' => [
        // 'cta' => [
        //     'title' => 'Call to Action',
        //     'icon' => 'star-filled',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Block Patterns
    |--------------------------------------------------------------------------
    |
    | Here you may specify block patterns to be registered by Poet for use
    | in the editor.
    |
    | Patterns are registered using the `namespace/label` defined when
    | registering the block with the editor. If no namespace is provided,
    | the current theme text domain will be used instead.
    |
    | Given the pattern `sage/hero`, your pattern content would be located at:
    |   ↪ `views/block-patterns/hero.blade.php`
    |
    | See: https://developer.wordpress.org/reference/functions/register_block_pattern/
    */

    'block_pattern' => [
        // 'sage/hero' => [
        //     'title' => 'Page Hero',
        //     'description' => 'Draw attention to the main focus of the page, and highlight key CTAs',
        //     'categories' => ['all'],
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Block Pattern Categories
    |--------------------------------------------------------------------------
    |
    | Here you may specify block pattern categories to be registered by Poet for
    | use in the editor.
    |
    */

    'block_pattern_category' => [
        'all' => [
            'label' => 'All Patterns',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Editor Palette
    |--------------------------------------------------------------------------
    |
    | Here you may specify the color palette registered in the Gutenberg
    | editor.
    |
    | A color palette can be passed as an array or by passing the filename of
    | a JSON file containing the palette.
    |
    | If a color is passed a value directly, the slug will automatically be
    | converted to Title Case and used as the color name.
    |
    | If the palette is explicitly set to `true` – Poet will attempt to
    | register the palette using the default `palette.json` filename generated
    | by <https://github.com/roots/palette-webpack-plugin>
    |
    */

    'palette' => [
        // 'red' => '#ff0000',
        // 'blue' => '#0000ff',
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Menu
    |--------------------------------------------------------------------------
    |
    | Here you may specify admin menu item page slugs you would like moved to
    | the Tools menu in an attempt to clean up unwanted core/plugin bloat.
    |
    | Alternatively, you may also explicitly pass `false` to any menu item to
    | remove it entirely.
    |
    */

    'admin_menu' => [
        // 'gutenberg',
    ],

];
