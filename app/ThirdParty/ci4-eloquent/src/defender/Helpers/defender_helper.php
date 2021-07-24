<?php

use Config\Services;

if (! function_exists('defender')) {
    /**
     * Provides convenient access to the main defender class.
     *
     * @param string|null $guard
     * @return \Artesaos\Defender\Defender
     * 
     */
    function defender($guard = null)
    {
        if (is_null($guard)) {
            return Services::getSharedInstance('auth')->defender();
        }

        return Services::getSharedInstance('auth')->guard($guard)->defender();
    }
}