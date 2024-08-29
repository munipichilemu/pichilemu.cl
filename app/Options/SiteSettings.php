<?php

namespace App\Options;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Options as Field;

class SiteSettings extends Field
{
    public $slug = 'site_settings';

    public $name = 'Configuración';

    public $title = 'Configuración del sitio';

    public function updateButton(): string
    {
        return 'Guardar';
    }

    public function fields(): array
    {
        $siteSettings = Builder::make(
            'site_settings',
            [
                'title' => 'Opciones',
            ]
        );

        $siteSettings
            /* Página de inicio */
            ->addTab('home', [
                'label' => 'Página de inicio',
            ])
            ->addGroup('flickr', [
                'label' => 'Flickr',
                'layout' => 'row',
            ])
            ->addUrl('gallery', [
                'label' => 'Galería de Flickr',
            ])
            ->addUrl('profile', [
                'label' => 'Perfil de Flickr',
            ])
            ->endGroup()
            /* Predeterminados */
            ->addTab('site_defaults', [
                'label' => 'Predeterminados',
            ])
            ->addGroup('default', [
                'label' => 'Imágenes predeterminadas',
                'layout' => 'row',
            ])
            ->addImage('thumbnail', [
                'label' => 'Miniatura predeterminada',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ])
            ->addImage('avatar', [
                'label' => 'Avatar predeterminado',
                'return_format' => 'array',
                'preview_size' => 'thumbnail',
            ])
            ->endGroup()
            /* Redirecciones */
            ->addTab('redirections', [
                'label' => 'Redirecciones',
            ])
            ->addMessage('redirection_table', 'Tabla de redirecciones', [
                'label' => false,
                'message' => $this->generateRedirectionsTable(),
            ])
            /* Páginas vacías */
            ->addTab('empty_pages', [
                'label' => 'Páginas vacías',
            ])
            ->addMessage('empty_pages', 'Páginas vacías', [
                'label' => false,
                'message' => $this->generateEmptyPagesTable(),
            ])
            /* Páginas sin imagen destacada */
            ->addTab('pages_without_image', [
                'label' => 'Páginas sin imagen destacada',
            ])
            ->addMessage('pages_without_image', 'Páginas sin imagen destacada', [
                'label' => false,
                'message' => $this->generatePagesWithoutFeaturedImageTable(),
            ]);

        return $siteSettings->build();
    }

    private function generateRedirectionsTable(): string
    {
        $args = [
            'post_type' => ['page', 'post'],
            'posts_per_page' => -1,
            'orderby' => 'ID',
            'order' => 'ASC',
            'meta_query' => [
                [
                    'key' => '_wp_page_template',
                    'value' => 'template-redirect.blade.php',
                    'compare' => '=',
                ],
            ],
        ];
        $posts = get_posts($args);

        $table = '<table class="widefat"><thead style="background-color: #f8f9fa;"><tr>';
        $table .= '<th>Título</th>';
        $table .= '<th>Destino</th>';
        $table .= '<th>Redirección</th>';
        $table .= '</tr></thead><tbody>';

        if (empty($posts)) {
            $table .= '<tr><td colspan="3">No hay redirecciones configuradas.</td></tr>';
        } else {
            foreach ($posts as $post) {
                $edit_link = get_edit_post_link($post->ID);
                $post_route = str_replace(home_url(), '', get_permalink($post->ID));
                $link_field = get_field('link', $post->ID);
                $link_url = is_array($link_field) && isset($link_field['url']) ? $link_field['url'] : '#';
                $permanent = get_field('permanent', $post->ID);
                $permanent_text = $permanent ? 'Permanente' : 'Temporal';

                $table .= '<tr>';
                $table .= sprintf(
                    '<td>
                    <a href="%s">%s</a><br>
                    %s
                </td>',
                    esc_url($edit_link),
                    esc_html($post->post_title),
                    esc_url($post_route)
                );
                $table .= sprintf(
                    '<td>
                    <a href="%s">%s <span class="dashicons dashicons-external" aria-hidden="true"></span></a>
                </td>',
                    esc_url($link_url),
                    esc_html($link_url)
                );
                $table .= sprintf(
                    '<td>
                    <strong>%s</strong>
                </td>',
                    $permanent_text
                );
                $table .= '</tr>';
            }
        }

        $table .= '</tbody></table>';

        return $table;
    }

    private function generateEmptyPagesTable(): string
    {
        $args = [
            'post_type' => 'page',
            'posts_per_page' => -1,
            'orderby' => 'ID',
            'order' => 'ASC',
        ];
        $pages = get_posts($args);

        $empty_pages = [];

        foreach ($pages as $page) {
            $content = get_post_field('post_content', $page->ID);
            $stripped_content = strip_tags($content);

            if (empty(trim($stripped_content))) {
                $template = get_page_template_slug($page->ID);
                $template = empty($template) ? 'Default' : basename($template);

                if ($template === 'template-redirect.blade.php') {
                    continue;
                }

                $empty_pages[] = [
                    'id' => $page->ID,
                    'title' => $page->post_title,
                    'edit_link' => get_edit_post_link($page->ID),
                    'url' => get_permalink($page->ID),
                    'template' => $template,
                ];
            }
        }

        // Ordenar las páginas vacías por plantilla
        usort($empty_pages, function ($a, $b) {
            return strcmp($a['template'], $b['template']);
        });

        $table = '<table class="widefat"><thead style="background-color: #f8f9fa;"><tr>';
        $table .= '<th>ID</th>';
        $table .= '<th>Título</th>';
        $table .= '<th>URL</th>';
        $table .= '<th>Plantilla</th>';
        $table .= '</tr></thead><tbody>';

        if (empty($empty_pages)) {
            $table .= '<tr><td colspan="4">No hay páginas con contenido vacío.</td></tr>';
        } else {
            foreach ($empty_pages as $page) {
                $table .= '<tr>';
                $table .= sprintf('<td>%d</td>', $page['id']);
                $table .= sprintf(
                    '<td><a href="%s">%s <span class="dashicons dashicons-edit" aria-hidden="true"></span></a></td>',
                    esc_url($page['edit_link']),
                    esc_html($page['title'])
                );
                $table .= sprintf(
                    '<td><a href="%s" target="_blank">%s</a></td>',
                    esc_url($page['url']),
                    esc_url(str_replace(home_url(), '', $page['url']))
                );
                $table .= sprintf('<td>%s</td>', esc_html($page['template']));
                $table .= '</tr>';
            }
        }

        $table .= '</tbody></table>';

        return $table;
    }

    private function generatePagesWithoutFeaturedImageTable(): string
    {
        $args = [
            'post_type' => 'page',
            'posts_per_page' => -1,
            'orderby' => 'ID',
            'order' => 'ASC',
        ];
        $pages = get_posts($args);

        $pages_without_image = [];

        foreach ($pages as $page) {
            if (! has_post_thumbnail($page->ID)) {
                $template = get_page_template_slug($page->ID);
                $template = empty($template) ? 'Default' : basename($template);

                if ($template !== 'Default') {
                    continue;
                }

                $pages_without_image[] = [
                    'id' => $page->ID,
                    'title' => $page->post_title,
                    'edit_link' => get_edit_post_link($page->ID),
                    'url' => get_permalink($page->ID),
                    'template' => $template,
                ];
            }
        }

        // Ordenar las páginas por plantilla
        usort($pages_without_image, function ($a, $b) {
            return strcmp($a['template'], $b['template']);
        });

        $table = '<table class="widefat"><thead style="background-color: #f8f9fa;"><tr>';
        $table .= '<th>ID</th>';
        $table .= '<th>Título</th>';
        $table .= '<th>URL</th>';
        $table .= '<th>Plantilla</th>';
        $table .= '</tr></thead><tbody>';

        if (empty($pages_without_image)) {
            $table .= '<tr><td colspan="4">Todas las páginas tienen una imagen destacada configurada.</td></tr>';
        } else {
            foreach ($pages_without_image as $page) {
                $table .= '<tr>';
                $table .= sprintf('<td>%d</td>', $page['id']);
                $table .= sprintf(
                    '<td><a href="%s">%s  <span class="dashicons dashicons-edit" aria-hidden="true"></span></a></td>',
                    esc_url($page['edit_link']),
                    esc_html($page['title'])
                );
                $table .= sprintf(
                    '<td><a href="%s" target="_blank">%s</a></td>',
                    esc_url($page['url']),
                    esc_url(str_replace(home_url(), '', $page['url']))
                );
                $table .= sprintf('<td>%s</td>', esc_html($page['template']));
                $table .= '</tr>';
            }
        }

        $table .= '</tbody></table>';

        return $table;
    }
}
