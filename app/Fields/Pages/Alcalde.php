<?php

namespace App\Fields\Pages;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Alcalde extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $page_alcalde = get_page_by_path('municipalidad/alcalde');
        $alcalde = Builder::make(
            'alcalde',
            [
                'title' => 'Retrato',
                'position' => 'side',
            ]);

        $alcalde
            ->setLocation('page', '==', $page_alcalde->ID);

        $alcalde
            ->addImage('portrait', [
                'label' => 'Fotografía',
                'return_format' => 'array',
                'mime_types' => 'jpg, jpeg, png, gif, webp, heif, heic',
                'preview_size' => 'thumbnail',
                'required' => 1,
            ]);

        return $alcalde->build();
    }
}
