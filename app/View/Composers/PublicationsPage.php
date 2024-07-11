<?php

namespace App\View\Composers;

use Log1x\Pagi\PagiFacade as Pagi;
use Roots\Acorn\View\Composer;
use WP_Query;

class PublicationsPage extends Composer
{
    protected static $views = [
        'archive-publication',
    ];

    public function with()
    {
        $paged = get_query_var('paged') ?? 1;

        $query = new WP_Query([
            'post_type' => 'publication',
            'posts_per_page' => 10,
            'meta_key' => 'emitted_at',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'paged' => $paged,
        ]);

        Pagi::setQuery($query);
        $pagination = Pagi::build();

        return [
            'publications' => $query,
            'pages' => $pagination,
        ];
    }
}
