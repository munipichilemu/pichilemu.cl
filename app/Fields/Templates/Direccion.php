<?php

namespace App\Fields\Templates;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Direccion extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $templateDireccionMeta = Builder::make(
            'direccion',
            [
                'title' => 'Datos de la dirección municipal',
                'position' => 'side',
            ]
        );

        $templateDireccionMeta
            ->setLocation('page_template', '==', 'template-direccion.blade.php');

        $templateDireccionMeta
            ->addImage('director_photo', [
                'label' => 'Fotografía',
                'return_format' => 'array',
                'mime_types' => 'jpg,jpeg,png,gif,webp,heif,heic',
                'preview_size' => 'avatar-admin',
                'required' => 1,
            ])
            ->addText('director_name', [
                'label' => 'Nombre del director',
                'required' => 1,
            ])
            ->addTextarea('place_name', [
                'label' => 'Ubicación de las oficinas',
                'rows' => 3,
                'new_lines' => 'br',
            ])
            ->addField('phone', 'phone_number', [
                'label' => 'Número de teléfono',
                'default_country' => 'cl',
                'placeholder' => '+56 72 297 6530',
            ])
            ->addEmail('email', [
                'label' => 'Correo electrónico',
            ]);

        return $templateDireccionMeta->build();
    }
}
