<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WP_Query;

class FutureEvents extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var string[]
     */
    protected static $views = [
        'partials.future-events-list',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'futureEvents' => $this->getFutureEvents(),
        ];
    }

    protected function getFutureEvents()
    {
        $args = [
            'post_type' => 'event',
            'posts_per_page' => 4,
            'meta_key' => 'start_date',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => [
                [
                    'key' => 'start_date',
                    'value' => date('Ymd'),
                    /*'compare' => '>=',*/
                    'type' => 'DATE',
                ],
            ],
        ];

        return new WP_Query($args);
    }
}
