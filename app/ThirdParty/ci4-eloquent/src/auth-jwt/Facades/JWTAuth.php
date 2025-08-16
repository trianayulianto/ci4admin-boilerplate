<?php

/*
 * This file is part of jwt-auth.
 *
 * (c) Sean Tymon <tymon148@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Fluent\JWTAuth\Facades;

use Fluent\JWTAuth\Config\Services;
use Fluent\JWTAuth\JWTAuth as Auth;

/**
 * @see Fluent\JWTAuth\JWTAuth
 */
class JWTAuth
{
    /**
     * Get the registered name of the component.
     *
     * @return string|Auth
     */
    public static function __callStatic($method, $arguments)
    {
        return Services::getSharedInstance('auth')->{$method}(...$arguments);
    }
}
