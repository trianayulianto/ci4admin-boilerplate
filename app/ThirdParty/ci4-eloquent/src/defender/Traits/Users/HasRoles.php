<?php

namespace Artesaos\Defender\Traits\Users;

use CodeIgniter\Config\Factories;

/**
 * Trait HasRoles.
 */
trait HasRoles
{
    /**
     * Returns true if the given user has any of the given roles.
     *
     * @param  string|array  $roles  array or many strings of role name
     * @return bool
     */
    public function hasRoles($roles)
    {
        $roles = is_array($roles) ? $roles : func_get_args();

        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns if the given user has an specific role.
     *
     * @param  string  $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->roles
            ->where('name', $role)
            ->first() != null;
    }

    /**
     * Attach the given role.
     *
     * @param  \Artesaos\Defender\Role  $role
     */
    public function attachRole($role)
    {
        if (! $this->hasRole($role->name)) {
            $this->roles()->attach($role);
        }
    }

    /**
     * Many-to-many role-user relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        $roleModel = self::config('role_model');
        $roleUserTable = self::config('role_user_table');
        $roleKey = self::config('role_key');

        return $this->belongsToMany($roleModel, $roleUserTable, 'user_id', $roleKey);
    }

    /**
     * Detach the given role from the model.
     *
     * @param  \Artesaos\Defender\Role  $role
     * @return int
     */
    public function detachRole($role)
    {
        return $this->roles()->detach($role);
    }

    /**
     * Sync the given roles.
     *
     *
     * @return array
     */
    public function syncRoles(array $roles)
    {
        return $this->roles()->sync($roles);
    }

    /**
     * Take user by roles.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  string|array  $roles
     * @return \Illuminate\Database\Query\Builder
     */
    public function scopeWhichRoles($query, $roles)
    {
        return $query->whereHas('roles', function ($query) use ($roles) {
            $roles = (is_array($roles)) ? $roles : [$roles];

            $query->whereIn('name', $roles);
        });
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
