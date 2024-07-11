<?php

namespace App\Fields\PostTypes;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Field;

class Event extends Field
{
    /**
     * The field group.
     */
    public function fields(): array
    {
        $event = Builder::make(
            'event',
            [
                'title' => 'Información del evento',
                'label_placement' => 'left',
            ]
        );

        $event
            ->setLocation('post_type', '==', 'event');

        $event
            ->addDatePicker('start_date', [
                'label' => 'Fecha de inicio',
                'instructions' => 'Fecha grande, al lado del título',
                'required' => true,
                'display_format' => 'd F',
            ])
            ->addText('duration_date', [
                'label' => 'Fecha del evento',
                'instructions' => 'Fecha o fechas como texto',
                'required' => true,
                'placeholder' => '17 al 19 de septiembre',
            ])
            ->addText('duration_time', [
                'label' => 'Horario del evento',
                'instructions' => 'Hora o duración como texto',
                'required' => true,
                'placeholder' => '15 a 18 horas',
            ])
            ->addText('place_name', [
                'label' => 'Lugar del evento',
                'instructions' => 'Nombre del lugar del evento',
                'required' => true,
                'placeholder' => 'Plaza Arturo Prat',
            ])
            ->addField('place_location', 'open_street_map', [
                'label' => 'Ubicación del evento',
                'instructions' => 'Dónde se realizará el evento',
                'center_lat' => -34.3871502,
                'center_lng' => -72.0043945,
                'zoom' => 15,
                'allow_map_layers' => 0,
            ]);

        return $event->build();
    }
}
