<?php

namespace App\Core\Repositories;

/**
 * Class StatusRepo
 *
 * @package App\Core\Repositories
 */
class StatusRepo
{
    /**
     * Find all Status
     *
     * @return mixed
     */
    public function all()
    {
        $status = \DB::table('status')
            ->orderBy('description', 'asc')
            ->get();

        return $status;
    }

}