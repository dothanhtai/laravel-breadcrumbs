<?php
namespace Dothanhtai\Breadcrumbs;

class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'breadcrumbs';
    }
}
