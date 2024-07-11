<?php

namespace App\Fields\Templates;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Redirect extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $redirect = Builder::make(
            'redirect',
            [
                'title' => 'Redirigir página al vínculo',
                'label_placement' => 'left',
            ]
        );

        $redirect
            ->setLocation('page_template', '==', 'template-redirect.blade.php');

        $redirect
            ->addLink('link', [
                'label' => 'Destino',
                'return_format' => 'url',
            ])
            ->addTrueFalse('permanent', [
                'label' => 'Tipo redirección',
                'default_value' => 0,
                'ui' => 1,
                'message' => '¿Redirigir permanentemente?',
                'ui_on_text' => 'Si',
                'ui_off_text' => 'No',
            ]);

        return $redirect->build();
    }
}
