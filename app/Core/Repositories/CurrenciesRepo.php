<?php

namespace App\Core\Repositories;

/**
 * Class CurrenciesRepo
 *
 * @package App\Core\Repositories
 */
class CurrenciesRepo
{

    /**
     * Find all currencies
     *
     * @return mixed
     */
    public function all()
    {
        $currencies = \DB::table('currencies')
            ->orderBy('description', 'asc')
            ->get();

        return $currencies;
    }

}
