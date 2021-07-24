<?php

namespace App\Providers;

use Artesaos\Defender\DefenderGuard;
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
        Auth::extend(JWTGuard::class, function ($auth, $name, array $config) {
            return new DefenderGuard(
                Services::getSharedInstance('jwt'),
                Services::getSharedInstance('request'),
                $auth->createUserProvider($config['provider']),
            );
        });
    }
}
