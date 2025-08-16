<?php

namespace Artesaos\Defender;

use Fluent\Auth\Config\Services;
use Fluent\Auth\Facades\Auth;
use Fluent\Auth\Providers\AbstractServiceProvider;
use Fluent\JWTAuth\JWTGuard;

class DefenderGuardServiceProvider extends AbstractServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public static function register()
    {
        Auth::extend(JWTGuard::class, fn ($auth, $name, array $config) => new DefenderGuard(
            Services::getSharedInstance('jwt'),
            Services::getSharedInstance('request'),
            $auth->createUserProvider($config['provider']),
        ));
    }
}
