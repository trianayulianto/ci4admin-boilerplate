<?php

namespace Fluent\Auth\Providers;

abstract class AbstractServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    abstract static function register();
}