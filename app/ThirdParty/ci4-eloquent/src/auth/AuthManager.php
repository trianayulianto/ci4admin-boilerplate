<?php

namespace Fluent\Auth;

use Closure;
use CodeIgniter\Config\Factories;
use CodeIgniter\Config\Services;
use Fluent\Auth\Config\Auth;
use Fluent\Auth\Contracts\AuthenticationInterface;
use Fluent\Auth\Contracts\AuthFactoryInterface;
use InvalidArgumentException;

use function call_user_func;
use function count;
use function is_null;

class AuthManager implements AuthFactoryInterface
{
    /**
     * The config instance.
     *
     * @var Auth
     */
    protected $config;

    /**
     * The registered custom driver creators.
     *
     * @var array
     */
    protected $customCreators = [];

    /**
     * The registered custom provider creators.
     *
     * @var array
     */
    protected $customProviderCreators = [];

    /**
     * The array of created "drivers".
     *
     * @var array
     */
    protected $guards = [];

    /**
     * The user resolver shared by various services.
     *
     * @var Closure
     */
    protected $userResolver;

    /**
     * Create a new Auth manager instance.
     *
     * @param bool getShared
     * @return void
     */
    public function __construct(Factories $factory, bool $getShared = true)
    {
        $this->config = $factory::config('Auth', ['getShared' => $getShared]);

        $this->userResolver = (fn ($guard = null) => $this->guard($guard)->user());
    }

    /**
     * {@inheritdoc}
     */
    public function guard($name = null)
    {
        $name = $name ?: $this->getDefaultDriver();

        return $this->guards[$name] ?? $this->guards[$name] = $this->resolve($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultDriver()
    {
        return $this->config->defaults['guard'];
    }

    /**
     * {@inheritdoc}
     */
    public function shouldUse($name)
    {
        $name = $name ?: $this->getDefaultDriver();

        $this->setDefaultDriver($name);

        $this->userResolver = (fn ($name = null) => $this->guard($name)->user());
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultDriver($name)
    {
        $this->config->defaults['guard'] = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function userResolver()
    {
        return $this->userResolver;
    }

    /**
     * {@inheritdoc}
     */
    public function resolveUsersUsing(Closure $callback)
    {
        $this->userResolver = $callback;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function extend($driver, Closure $callback)
    {
        $this->customCreators[$driver] = $callback;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function createUserProvider($provider = null)
    {
        if (is_null($config = $this->getProviderConfiguration($provider))) {
            return null;
        }

        if (isset($this->customProviderCreators[$driver = $config['driver']])) {
            return call_user_func(
                $this->customProviderCreators[$driver],
                $this,
                $config
            );
        }

        return match ($driver) {
            'model' => new $config['table'],
            'connection' => new UserDatabase($config['table'], $config['connection']),
            default => throw new InvalidArgumentException(
                sprintf('Authentication user provider [%s] is not defined.', $driver)
            ),
        };
    }

    /**
     * {@inheritdoc}
     */
    public function provider($name, Closure $callback)
    {
        $this->customProviderCreators[$name] = $callback;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultUserProvider()
    {
        return $this->config->defaults['provider'];
    }

    /**
     * {@inheritdoc}
     */
    public function hasResolvedGuards()
    {
        return count($this->guards) > 0;
    }

    /**
     * {@inheritdoc}
     */
    public function routes(array $options = [])
    {
        $routes = Services::routes();

        if ($options['register'] ?? true) {
            $routes->get('register', 'Auth\RegisterController::index', ['as' => 'register']);

            $routes->post('register', 'Auth\RegisterController::register', [
                'as' => 'register.post',
                'filter' => 'throttle:6,1',
            ]);
        }

        if ($options['reset'] ?? true) {
            $routes->get('password/request', 'Auth\ForgotPasswordController::index', ['as' => 'password.request']);

            $routes->post('password/email', 'Auth\ForgotPasswordController::send', [
                'as' => 'password.email',
                'filter' => 'throttle:6,1',
            ]);

            $routes->get('password/reset/(:any)', 'Auth\ResetPasswordController::index/$1', ['as' => 'password.reset']);

            $routes->post('password/update', 'Auth\ResetPasswordController::reset', [
                'as' => 'password.update',
                'filter' => 'throttle:6,1',
            ]);
        }

        if ($options['verify'] ?? true) {
            $routes->get('email/verify', 'Auth\VerificationController::index', ['as' => 'verification.notice']);

            $routes->get('email/verify/(:any)', 'Auth\VerificationController::verify/$1', [
                'as' => 'verification.verify',
            ]);

            $routes->post('email/resend', 'Auth\VerificationController::resend', [
                'as' => 'verification.resend',
                'filter' => 'throttle:6,1',
            ]);
        }

        $routes->get('login', 'Auth\AuthenticateController::index', ['as' => 'login']);

        $routes->post('login', 'Auth\AuthenticateController::login', [
            'as' => 'login.post',
            'filter' => 'throttle:6,1',
        ]);

        $routes->post('refresh', 'Auth\AuthenticateController::refresh', [
            'as' => 'refresh',
            'filter' => 'throttle:1,60',
        ]);

        $routes->post('logout', 'Auth\AuthenticateController::logout', ['as' => 'logout']);
    }

    /**
     * Resolve the given guard.
     *
     * @param  string  $name
     * @return AuthenticationInterface
     *
     * @throws InvalidArgumentException
     */
    protected function resolve($name)
    {
        $config = $this->getConfig($name);

        if (isset($this->customCreators[$config['driver']])) {
            return $this->callCustomCreator($name, $config);
        }

        throw new InvalidArgumentException(
            sprintf('Auth driver [%s] for guard [%s] is not defined.', $config['driver'], $name)
        );
    }

    /**
     * Get the guard configuration.
     *
     * @param  string  $name
     * @return array
     */
    protected function getConfig($name)
    {
        if (isset($this->config->guards[$name])) {
            return $this->config->guards[$name];
        }

        throw new InvalidArgumentException(sprintf('Auth guard [%s] is not defined.', $name));
    }

    /**
     * Call a custom driver creator.
     *
     * @param  string  $name
     * @return mixed
     */
    protected function callCustomCreator($name, array $config)
    {
        return $this->customCreators[$config['driver']]($this, $name, $config);
    }

    /**
     * Get the user provider configuration.
     *
     * @param  string|null  $provider
     * @return array|null
     */
    protected function getProviderConfiguration($provider)
    {
        if ($provider = $provider ?: $this->getDefaultUserProvider()) {
            return $this->config->providers[$provider];
        }

        return null;
    }

    /**
     * Dynamically call the default driver instance.
     *
     * @param  string  $method
     * @param  array  $arguments
     * @return AuthenticationInterface
     */
    public function __call($method, $arguments)
    {
        return $this->guard()->{$method}(...$arguments);
    }
}
