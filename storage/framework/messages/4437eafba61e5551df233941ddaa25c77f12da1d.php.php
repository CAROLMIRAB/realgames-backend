<?php

namespace App\Transactions\Collections;

use Illuminate\Support\Collection;

/**
 * Class TransactionsCollection
 * @package App\Transactions\Collections
 * @autor Carol Mirabal
 *  @autor Pedro Virgüez
 */
class TransactionsCollection
{

    /**
     *
     * @param $profit
     * @return string
     * @internal param $transactions
     */
    public function TransactionsDataTable($profit)
    {
        $currency = \Session::get('currency');

        $transactions = new Collection();

        foreach ($profit as $items) {
            $TypeTransaction = $items->transactiontype;
            if ($TypeTransaction == 1) {
                $TypeTransaction = "Credit";
            }
            if ($TypeTransaction == 2) {
                $TypeTransaction = "Debit";
            }

            $transactions->push([
                'idtransaction' => $items->id,
                'username' => $items->username,
                'title' => $items->title,
                'transactiontype' => $TypeTransaction,
                'amount' => $currency['symbol'] . " " . number_format($items->amount, intval($currency['decimals']), $currency['decimalseparator'], $currency['thousandseparator']),

            ]);
        }
        return $transactions;
    }

}