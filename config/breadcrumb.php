<?php
return [
    'divider'       => '<i class="fa fa-angle-right"></i>',
    'cssClass'      => ['page-breadcrumb'],
    'listElement'   => 'ul',
    'itemElement'   => 'li',
    'beforeElement' => '<li><i class="fa fa-home"></i></li>',

    'groups' => [
        'admin' => [
            'divider'       => '<i class="fa fa-angle-right"></i>',
            'cssClass'      => ['page-breadcrumb'],
            'listElement'   => 'ul',
            'itemElement'   => 'li',
            'beforeElement' => '<li><i class="fa fa-home"></i></li>',
        ],
        'frontend' => [
            'divider'       => '<i class="fa fa-angle-right"></i>',
            'cssClass'      => ['breadcrumb'],
            'listElement'   => 'ol',
            'itemElement'   => 'li',
            'beforeElement' => '<li><i class="fa fa-home"></i></li>',
        ],
    ]
];