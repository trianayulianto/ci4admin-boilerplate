<?php

namespace Fluent\Auth\Config;

use CodeIgniter\Config\BaseService;
use CodeIgniter\Config\Factories;
use Fluent\Auth\AuthManager;
use Fluent\Auth\Contracts\AuthenticationInterface;
use Fluent\Auth\Contracts\AuthFactoryInterface;
use Fluent\Auth\Contracts\HasherInterface;
use Fluent\Auth\Passwords\Hash\AbstractManager;
use Fluent\Auth\Passwords\Hash\HashManager;
use Fluent\Auth\Passwords\PasswordBrokerManager;

class Services extends BaseService
{
    /**
     * The base auth class.
     *
     * @return AuthFactoryInterface|AuthenticationInterface
     */
    public static function auth(bool $getShared = true)
    {
        if ($getShared) {
            return self::getSharedInstance('auth');
        }

        return new AuthManager(new Factories, $getShared);
    }

    /**
     * Passwords broker services.
     *
     * @return PasswordBrokerFactoryInterface|PasswordBrokerInterface
     */
    public static function passwords(bool $getShared = true)
    {
        if ($getShared) {
            return self::getSharedInstance('passwords');
        }

        return new PasswordBrokerManager(new Factories, $getShared);
    }

    /**
     * Create HashManager instance.
     *
     * @return AbstractManager|HashManager|HasherInterface
     */
    public static function hash(bool $getShared = true)
    {
        if ($getShared) {
            return self::getSharedInstance('hash');
        }

        return new HashManager(new Factories, $getShared);
    }
}
