<?php

namespace App\Fields\PostTypes;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Pill extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $pill = Builder::make(
            'pill',
            [
                'title' => 'Detalles de la píldora',
                'label_placement' => 'left',
            ]);

        $pill
            ->setLocation('post_type', '==', 'pill');

        $pill
            ->addLink('link', [
                'label' => 'Vínculo',
                'return_format' => 'url',
            ])
            ->addField('icon', 'font-awesome', [
                'label' => 'Icono',
                'save_format' => 'object',
                'icon_sets' => [
                    0 => 'solid',
                ],
                'default_label' => '&lt;i class="fa-classic fa-solid fa-circle fa-fw"&gt;&lt;/i&gt; Circle',
                'default_value' => '{ "style" : "solid", "id" : "circle", "label" : "Circle", "unicode" : "f111" }',
                'allow_null' => 0,
                'show_preview' => 1,
                'enqueue_fa' => 0,
                'fa_live_preview' => '',
            ])
            ->addColorPicker('color', [
                'label' => 'Color de fondo',
                'instructions' => 'El color del texto se ajustará automáticamente para garantizar un contraste adecuado según WCAG 2.0 AA.',
                'return_format' => 'string',
                'enable_opacity' => 0,
                'default_value' => '#09272F',
            ]);

        add_filter('acf/update_value/name=color', [$this, 'adjustTextColor'], 10, 3);

        return $pill->build();
    }

    /**
     * Adjust text color based on background color
     *
     * @param  mixed  $value  The value to be saved
     * @param  int  $post_id  The post ID where the value will be saved
     * @param  array  $field  The field array containing all settings
     * @return mixed
     */
    public function adjustTextColor($value, $post_id, $field)
    {
        $backgroundColor = $value;
        $textColor = $this->getContrastColor($backgroundColor);

        update_post_meta($post_id, 'text_color', $textColor);

        return $value;
    }

    /**
     * Get the contrast color based on the background color
     *
     * @param  string  $hexColor  The background color
     * @return string
     */
    public function getContrastColor($hexColor)
    {
        $hexColor = ltrim($hexColor, '#');
        $r = hexdec(substr($hexColor, 0, 2));
        $g = hexdec(substr($hexColor, 2, 2));
        $b = hexdec(substr($hexColor, 4, 2));

        $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;

        return $luminance > 0.5 ? '#000000' : '#ffffff';
    }
}
