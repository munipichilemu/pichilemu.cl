<?php

namespace App\Fields\Templates;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Concejal extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $concejal = Builder::make(
            'concejal',
            [
                'title' => 'Ficha del Concejal',
                'position' => 'side',
            ]
        );

        $concejal
            ->setLocation('page_template', '==', 'template-concejal.blade.php');

        $concejal
            ->addImage('portrait', [
                'label' => 'Fotografía',
                'return_format' => 'array',
                'mime_types' => 'jpg, jpeg, png, gif, webp, heif, heic',
                'preview_size' => 'thumbnail',
                'required' => 1,
            ])
            ->addField('phone', 'phone_number', [
                'label' => 'Teléfono',
                'default_country' => 'cl',
                'placeholder' => '+56 722 976 530',
            ])
            ->addEmail('email', [
                'label' => 'Correo electrónico',
            ])
            ->addSelect('political_party', [
                'label' => 'Afiliación política',
                'choices' => [
                    'Independiente',
                    'Partido de Trabajadores Revolucionarios',
                    'Partido Comunista de Chile',
                    'Frente Amplio',
                    'Partido Humanista',
                    'Partido Acción Humanista',
                    'Igualdad',
                    'Partido Socialista de Chile',
                    'Partido Por la Democracia',
                    'Partido Radical de Chile',
                    'Federación Regionalista Verde Social',
                    'Partido Demócrata Cristiano',
                    'Partido Liberal de Chile',
                    'Movimiento Amarillos por Chile',
                    'Renovación Nacional',
                    'Evolución Política',
                    'Partido Demócratas Chile',
                    'Unión Demócrata Independiente',
                    'Partido Republicano de Chile',
                    'Partido de la Gente',
                    'Partido Social Cristiano',
                    'Partido Alianza Verde Popular',
                    'Patria Progresista',
                    'Popular',
                ],
            ]);

        return $concejal->build();
    }
}
