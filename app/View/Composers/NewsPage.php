<?php

namespace App\View\Composers;

use Log1x\Pagi\PagiFacade as Pagi;
use Roots\Acorn\View\Composer;
use WP_Query;

class NewsPage extends Composer
{
    protected static $views = [
        'page-noticias',
    ];

    public function with()
    {
        $paged = get_query_var('paged') ?? 1;

        $query = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 10,
            'paged' => $paged,
        ]);

        Pagi::setQuery($query);
        $pagination = Pagi::build();

        return [
            'news' => $query,
            'pages' => $pagination,
        ];
    }
}
