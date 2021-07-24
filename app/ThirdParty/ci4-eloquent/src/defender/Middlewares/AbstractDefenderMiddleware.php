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
     *
     */
    protected function hasRoles($roles)
    {
        if (is_null($this->user)) {
            return $this->forbiddenResponse();
        }

        if (is_null($roles)) {
            if (!($this->user->roles)) {
                return $this->forbiddenResponse();
            }

            return;
        }

        if ($this->user->isSuperUser()) {
            return;
        }

        if (is_array($roles) and count($roles) > 0) {
            $hasResult = true;

            foreach ($roles as $role) {
                $hasRole = $this->user->hasRole($role);

                $hasResult = $hasResult & $hasRole;
            }

            if (! $hasResult) {
                return $this->forbiddenResponse();
            }
        }
    }

    /**
     * The current logged in user has permission.
     * 
     */
    protected function hasPermissions($permissions)
    {
        if (is_null($this->user)) {
            return $this->forbiddenResponse();
        }

        if (is_null($permissions)) {
            if (!($this->user->permissions)) {
                return $this->forbiddenResponse();
            }

            return;
        }

        if ($this->user->isSuperUser()) {
            return;
        }

        if (is_array($permissions) and count($permissions) > 0) {
            $canResult = true;

            foreach ($permissions as $permission) {
                $canPermission = $this->user->hasPermission($permission);

                $canResult = $canResult & $canPermission;
            }

            if (! $canResult) {
                return $this->forbiddenResponse();
            }
        }
    }

    /**
     * Handles the forbidden response.
     *
     * @return mixed
     */
    protected function forbiddenResponse()
    {
        $config = self::config('forbidden_callback');

        $handler = new $config();

        return ($handler instanceof ForbiddenHandler) 
            ? $handler->handle() 
            : Services::response()->setStatusCode(403, 'Forbidden.');
    }
    
    /**
     * Helper to get the config values.
     *
     * @param string $key
     * @return mixed
     */
    protected static function config($key)
    {
        return Factories::config('Defender', ['getShared' => true])->$key;
    }
}
