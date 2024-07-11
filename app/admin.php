<?php

namespace App;

/**
 * Desactiva completamente la funcionalidad de comentarios en WordPress.
 *
 * Este código realiza las siguientes acciones:
 * - Elimina el soporte de comentarios y trackbacks de todos los tipos de post.
 * - Redirige al usuario si intenta acceder a la página de comentarios en el admin.
 * - Elimina la sección de comentarios recientes del dashboard.
 * - Remueve la página de comentarios del menú de administración.
 * - Desactiva la posibilidad de comentar en todas las publicaciones.
 * - Vacía el array de comentarios para todas las publicaciones.
 */
add_action('admin_init', function () {
    /* Remueve el soporte de comentarios en los tipos de post que lo soporten. */
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }

    /* Redirige al usuario en caso de querer entrar directamente a la página de comentarios. */
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }

    /* Remueve el resumen de comentarios en el Escritorio de administración. */
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
});

add_action('admin_menu', function () {
    /* Remueve la página de comentarios del menú de administración. */
    remove_menu_page('edit-comments.php');
});

/* Desactiva el ingreso de comentarios y pings en todas las publicaciones, y retorna sin comentarios. */
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
add_filter('comments_array', function ($comments) {
    $comments = [];

    return $comments;
}, 20, 2);

/**
 * Personaliza el menú de administración de WordPress.
 *
 * Esta función realiza las siguientes modificaciones en el menú de administración:
 * 1. Renombra el menú "Posts" a "Noticias".
 * 2. Agrega un nuevo menú "Portada" para gestionar elementos de la página principal.
 * 3. Inserta un separador antes del menú "Medios".
 *
 * @return void
 *
 * @uses add_menu_page() Para agregar la nueva página de menú "Portada".
 *
 * @global array $menu Array global de WordPress que contiene la estructura del menú de administración.
 *
 * @uses add_action() Para conectar la función al hook 'admin_menu'.
 */
add_action('admin_menu', function () {
    /* Renombrar menú de Posts a Noticias. */
    global $menu;
    $menu[5][0] = 'Noticias';

    /* Agregar menú de elementos de Portada */
    add_menu_page('Portada', 'Portada', 'publish_pages', 'homepage-options', '', 'dashicons-welcome-widgets-menus', 4);

    /* Separador antes de Medios */
    $menu[9] = ['', 'read', '', '', 'wp-menu-separator'];
});

/**
 * Personaliza los estilos del grupo de campos ACF 'Site Settings'.
 *
 * Esta función agrega estilos CSS personalizados para modificar la apariencia
 * del grupo de campos ACF con ID 'acf-group_site_settings'. Los cambios incluyen:
 * - Eliminar el borde exterior del grupo
 * - Ocultar la barra de título
 * - Agregar bordes a los campos individuales
 * - Ajustar los estilos de las pestañas
 *
 * @hooked acf/input/admin_head
 */
add_action('acf/input/admin_head', function () {
    echo '<style>
            #acf-group_site_settings.postbox {
                border: 0;
            }

            #acf-group_site_settings > .postbox-header {
                display: none;
            }

            #acf-group_site_settings .acf-tab-wrap {
                background: #f0f0f1;
                overflow-y: hidden;
            }

            #acf-group_site_settings .acf-tab-group {
                padding: 0;
            }

            #acf-group_site_settings > .acf-fields > .acf-field {
                border: 1px solid #c3c4c7;
            }
          </style>';
});
