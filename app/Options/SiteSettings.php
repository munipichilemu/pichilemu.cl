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
}
