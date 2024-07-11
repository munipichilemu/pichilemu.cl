<?php

namespace App\Fields\Taxonomies;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class PublicationType extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $publicationTypeMeta = Builder::make('publication_type');

        $publicationTypeMeta
            ->setLocation('taxonomy', '==', 'publication_type');

        $publicationTypeMeta
            ->addField('icon', 'font-awesome', [
                'label' => 'Icono',
                'save_format' => 'object',
                'icon_sets' => [
                    0 => 'solid',
                ],
                'default_label' => '&lt;i class="fa-classic fa-solid fa-file fa-fw"&gt;&lt;/i&gt; File',
                'default_value' => '{ "style" : "solid", "id" : "file", "label" : "File" }',
                'allow_null' => 0,
                'show_preview' => 1,
                'enqueue_fa' => 0,
                'fa_live_preview' => '',
            ]);

        return $publicationTypeMeta->build();
    }
}
