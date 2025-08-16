<?php

namespace Artesaos\Defender\Contracts\Repositories;

/**
 * Interface RoleRepository.
 */
interface RoleRepository extends AbstractRepository
{
    /**
     * Create a new role with the given name.
     *
     * @param  string  $roleName
     * @return \Artesaos\Defender\Role
     *
     * @throws \Exception
     */
    public function create($roleName);
}
