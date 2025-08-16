<?php

namespace Artesaos\Defender\Middlewares;

use Artesaos\Defender\Contracts\ForbiddenHandler;
use CodeIgniter\Config\Factories;
use Config\Services;

/**
 * Class AbstractDefenderMiddleware.
 */
abstract class AbstractDefenderMiddleware
{
    /**
     * The current logged in user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable|\App\Models\User
     */
    protected $user;

    public function __construct()
    {
        $this->user = auth('api')->user();
    }

    /**
     * The current logged in user has correct role.
     */
    protected function hasRoles($roles)
    {
        if (is_null($this->user)) {
            return $this->forbiddenResponse();
        }

        if (is_null($roles) || in_array('*', $roles)) {
            if (! ($this->user->roles)) {
                return $this->forbiddenResponse();
            }

            return null;
        }

        if ($this->user->isSuperUser()) {
            return null;
        }

        if (is_array($roles) && $roles !== []) {
            $hasResult = true;

            foreach ($roles as $role) {
                $hasRole = $this->user->hasRole($role);

                $hasResult &= $hasRole;
            }

            if ($hasResult === 0) {
                return $this->forbiddenResponse();
            }
        }

        return null;
    }

    /**
     * The current logged in user has permission.
     */
    protected function hasPermissions($permissions)
    {
        if (is_null($this->user)) {
            return $this->forbiddenResponse();
        }

        if (is_null($permissions)) {
            if (! ($this->user->permissions)) {
                return $this->forbiddenResponse();
            }

            return null;
        }

        if ($this->user->isSuperUser()) {
            return null;
        }

        if (is_array($permissions) && $permissions !== []) {
            $canResult = true;

            foreach ($permissions as $permission) {
                $canPermission = $this->user->hasPermission($permission);

                $canResult &= $canPermission;
            }

            if ($canResult === 0) {
                return $this->forbiddenResponse();
            }
        }

        return null;
    }

    /**
     * Handles the forbidden response.
     *
     * @return mixed
     */
    protected function forbiddenResponse()
    {
        $config = self::config('forbidden_callback');

        $handler = new $config;

        return ($handler instanceof ForbiddenHandler)
            ? $handler->handle()
            : Services::response()->setStatusCode(403, 'Forbidden.');
    }

    /**
     * Helper to get the config values.
     *
     * @param  string  $key
     * @return mixed
     */
    protected static function config($key)
    {
        return Factories::config('Defender', ['getShared' => true])->$key;
    }
}
