<?php

namespace Fluent\JWTAuth\Providers;

use Fluent\Auth\Config\Services;
use Fluent\Auth\Facades\Auth;
use Fluent\Auth\Providers\AbstractServiceProvider;
use Fluent\JWTAuth\JWTGuard;

class JWTAuthServiceProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public static function register()
    {
        Auth::extend(JWTGuard::class, function ($auth, $name, array $config) {
            return new JWTGuard(
                Services::getSharedInstance('jwt'),
                Services::getSharedInstance('request'),
                $auth->createUserProvider($config['provider']),
            );
        });
    }
}
