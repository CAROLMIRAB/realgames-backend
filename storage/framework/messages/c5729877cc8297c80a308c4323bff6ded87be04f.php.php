<?php

namespace App\Core\Repositories;

/**
 * Class RolesRepo
 *
 * @package App\Core\Repositories
 */
class RolesRepo
{
    /**
     * Find all Roles
     *
     * @return mixed
     */
    public function all()
    {
        $roles = \DB::table('roles')
            ->orderBy('description', 'asc')
            ->get();

        return $roles;
    }

}