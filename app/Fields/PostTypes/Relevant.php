<?php

namespace App\Fields\PostTypes;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Relevant extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $relevantMeta = Builder::make(
            'relevant',
            [
                'title' => 'Información relevante',
                'label_placement' => 'left',
            ]
        );

        $relevantMeta
            ->setLocation('post_type', '==', 'relevant');

        $relevantMeta
            ->addLink('link', [
                'label' => 'Vínculo',
                'return_format' => 'url',
            ]);

        return $relevantMeta->build();
    }
}
