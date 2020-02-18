<?php
namespace Nguyen930411\Breadcrumbs;

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
