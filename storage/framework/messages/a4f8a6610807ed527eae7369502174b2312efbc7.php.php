<?php

namespace App\Users\Collections;

use App\Users\Repositories\UsersRepo;
use App\Core\Enums\TransactionTypes;
use Illuminate\Support\Collection;


/**
 * Class UsersCollection
 * @package App\Users\Collections
 * @autor Carol Mirabal
 */
class UsersCollection
{
    private $userRepo;

    /**
     * UsersCollection constructor.
     *
     * @param UsersRepo $userRepo
     */
    public function __construct(UsersRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Prepare data from the transaction datatable serverSide
     *
     * @param $transactions
     * @return array
     */
    public function transactionsByUser($transactions)
    {

        $currency = \Session::get('currency');
        $datatable = new Collection();
        foreach ($transactions as $transaction) {

            $transaction->created = $transaction->created_at->format('d-m-Y H:i:s');

          if ($transaction->transactiontype == TransactionTypes::$credit) {
                $transaction->credit = $currency['symbol'] . " " . number_format($transaction->amount, intval($currency['decimals']), $currency['decimalseparator'], $currency['thousandseparator']);
            } else {
                $transaction->credit = "-";
            }

            if ($transaction->transactiontype == TransactionTypes::$debit) {
                $transaction->debit = $currency['symbol'] . " " . number_format($transaction->amount, intval($currency['decimals']), $currency['decimalseparator'], $currency['thousandseparator']);
            } else {
                $transaction->debit = "-";
            }

            $datatable->push([
                'created' => $transaction->created,
                'transaccion' => $transaction->id,
                'clienttransaction' => $transaction->clienttransaction,
                'Juego' => $transaction->title,
                'debit' => $transaction->debit,
                'credit' => $transaction->credir,
                'balance' => $transaction->balance,
            ]);


        }

        return $datatable;
    }

    /**
     * Prepare data from the user datatable serverSide
     *
     * @param $users
     * @return Collection
     */
    public function userDataTable($users)
    {

        $datatableuser = new Collection();

        foreach ($users as $user) {

            $route = route('users.details', $user->id);

            $datatableuser->push([
                'identify' => $user->identify,
                'dni' => $user->dni,
                'username' => $user->username,
                'name' => $user->name,
                'lastname' => $user->lastname,
                'email' => $user->email,
                'details' => "<a href='" . $route . "' class='open-modal label label-default'>".__('Detalles')."</a>",
            ]);
        }

        return $datatableuser;
    }


}