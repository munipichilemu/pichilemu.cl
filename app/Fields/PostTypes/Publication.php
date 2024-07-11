<?php

namespace App\Fields\PostTypes;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Publication extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $publicationMeta = Builder::make(
            'publication',
            [
                'title' => 'Detalles de la publicación',
                'label_placement' => 'left',
            ]
        );

        $publicationMeta
            ->setLocation('post_type', '==', 'publication');

        $publicationMeta
            ->addDatePicker('emitted_at', [
                'label' => 'Fecha de emisión',
                'instructions' => 'Fecha impresa en el documento',
            ])
            ->addFile('document', [
                'label' => 'Documento',
                'return_format' => 'url',
                'required' => true,
            ]);

        return $publicationMeta->build();
    }
}
