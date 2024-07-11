<?php

namespace App\Fields\PostTypes;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Button extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $buttonMeta = Builder::make(
            'button',
            [
                'title' => 'Detalles del botón',
                'label_placement' => 'left',
            ]
        );

        $buttonMeta
            ->setLocation('post_type', '==', 'button');

        $buttonMeta
            ->addLink('link', [
                'label' => 'Vínculo',
                'return_format' => 'url',
            ]);

        return $buttonMeta->build();
    }
}
