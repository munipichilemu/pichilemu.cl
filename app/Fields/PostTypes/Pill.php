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
        $pillMeta = Builder::make(
            'pill',
            [
                'title' => 'Detalles de la píldora',
                'label_placement' => 'left',
            ]);

        $pillMeta
            ->setLocation('post_type', '==', 'pill');

        $pillMeta
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
                'label' => 'Color',
                'return_format' => 'string',
                'enable_opacity' => 0,
                'default_value' => '#09272F',
            ]);

        return $pillMeta->build();
    }
}
