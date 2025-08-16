<?php

namespace Artesaos\Defender\Contracts\Repositories;

/**
 * Interface PermissionRepository.
 */
interface PermissionRepository extends AbstractRepository
{
    /**
     * Create a new permission using the given name.
     *
     * @param  string  $permissionName
     * @param  string  $readableName
     * @return \Artesaos\Defender\Permission;
     *
     * @throws \Artesaos\Defender\Exceptions\PermissionExistsException
     */
    public function create($permissionName, $readableName = null);

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getByRoles(array $rolesIds);
}
