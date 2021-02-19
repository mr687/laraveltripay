<?php

namespace Mr687\Laraveltripay;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mr687\Laraveltripay\Skeleton\SkeletonClass
 */
class LaraveltripayFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'tripay';
    }
}
