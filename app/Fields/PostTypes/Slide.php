<?php

namespace App\Fields\PostTypes;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Slide extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $slideMeta = Builder::make(
            'slide',
            [
                'title' => 'Pie de la diapositiva',
                'label_placement' => 'left',
            ]);

        $slideMeta
            ->setLocation('post_type', '==', 'slide');

        $slideMeta
            ->addText('text', ['label' => 'Texto'])
            ->addLink('link', [
                'label' => 'Vínculo',
                'return_format' => 'url',
            ]);

        return $slideMeta->build();
    }
}
