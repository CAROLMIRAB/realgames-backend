<?php

namespace App\Users\Repositories;

use App\Users\Entities\User;
use App\Transactions\Entities\Transaction;


/**
 * Class UsersRepo
 *
 * Repository to manage the data of the Users entity
 *
 * @package App\Users\Repositories
 * @author  Carol Mirabal
 */
class UsersRepo
{

    /**
     * Find all users
     *
     * @param $client
     * @return mixed
     */
    public function all($client)
    {
        $users = User::where('client', '=', $client)
            ->orderBy('username', 'asc')
            ->get();

        return $users;
    }

    /**
     * Find all users
     *
     * @param $client
     * @param $username
     * @return mixed
     */
    public function allbyusername($client, $username)
    {
        $users = User::where('username', 'like', $username . '%')
            ->where('client', '=', $client)
            ->orderBy('username', 'asc')
            ->get();

        return $users;
    }

    /**
     *Gets user by username
     *
     * @param $username
     * @param $client
     * @return mixed
     */

    public function findUsersByUsername($username, $client)
    {
        $users = User::where('username', 'like', $username . '%')
            ->where('client', '=', $client)
            ->orderBy('username', 'asc')
            ->get();
        return $users;
    }

    /**
     * Gets user by id
     *
     * @param $id
     * @param $client
     * @return mixed
     */
    public function findUserById($id, $client)
    {
        $users = User::select('users.id', 'users.identify', 'users.username', 'dni', 'email', 'name', 'lastname', 'client')
            ->where('client', $client)
            ->where('id', $id)
            ->first();
        return $users;
    }

    /**
     * total the users
     *
     * @param $client
     * @return mixed
     */
    public function totalUsers($client)
    {
        $users = User::where('client', $client)->count();
        return $users;
    }

    /**
     * Gets all transactions by user id
     *
     * @param $user
     * @param $client
     * @param $timezone
     * @return mixed
     */
    public function findTransactionsByUser($user, $client, $timezone)
    {
        $transactions = Transaction::select('transactions.id', 'amount', 'balance', 'clienttransaction', 'realgamesgames.title', \DB::RAW("transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '" . $timezone . "' as created_at"), 'transactiontype')
            ->join('users', 'users.id', '=', 'transactions.user')
            ->join('realgamesgames', 'realgamesgames.gameid', '=', 'transactions.game')
            ->where('users.client', $client)
            ->where('transactions.user', $user)
            ->orderBy('created_at', 'desc')
            ->get();
        return $transactions;
    }

    /**
     * Edit user from detail user
     *
     * @param $user
     * @param $field
     * @param $value
     * @return mixed
     */
    public function updateUser($user, $field, $value)
    {
        return \DB::table('users')->where('id', $user)->update([$field => $value]);
    }

    /**
     * @param $id
     * @param $username
     * @param $email
     * @param $dni
     * @param $name
     * @param $lastname
     * @param $client
     * @return mixed
     */
    public function advancedSearch($id, $username, $email, $dni, $name, $lastname, $client)
    {
        $query = "select id, username, email,  dni, name, lastname, identify
         from users";

        $conditions = " where client = '" . $client . "'";

        if (!empty($id)) {
            $conditions .= " and identify = '" . $id . "'";
        }
        if (!empty($username)) {
            $conditions .= " and lower(username) like '" . $username . "%'";
        }
        if (!empty($email)) {
            $conditions .= " and lower(email) like '" . $email . "%'";
        }
        if (!empty($dni)) {
            $conditions .= " and lower(dni) like '" . $dni . "%'";
        }
        if (!empty($name)) {
            $conditions .= " and lower(name) like '" . $name . "%'";
        }
        if (!empty($lastname)) {
            $conditions .= " and lower(lastname) like '" . $lastname . "%'";
        }
        $conditions .= ' ORDER BY id DESC ';
        $query = $query . $conditions;
        $result = \DB::select($query);
        return $result;
    }

    public function getTopPlayers($client, $timezone, $dateFrom, $dateAt)
    {
        $players = \DB::select("
         SELECT
        users.username,
        users.name,
        users.lastname,
				users.id,
        sum(amount) as played
        from transactions
        LEFT JOIN users on users.id=transactions.user
        WHERE users.client='juegaenlinea'
        and transactiontype=2
        and (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'America/Caracas')::DATE BETWEEN '2016-12-01' AND '2016-12-15'
        GROUP BY users.id,transactiontype,  users.username, users.name, users.lastname
        ORDER BY played desc
        LIMIT 3");

        return $players;
    }

    public function favoritesGamesByUser($client, $timezone, $dateFrom, $dateAt, $user)
    {
        $games = \DB::select(" SELECT
users.username,
        sum(amount) as played,
realgamesgames.id,
realgamesgames.title,
realgamesgames.software
        from transactions
        LEFT JOIN users on users.id=transactions.user
LEFT JOIN realgamesgames on realgamesgames.id=transactions.game
        WHERE users.client='juegaenlinea'
and transactiontype=2
and users.id='1030'
        and (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE 'America/Caracas')::DATE BETWEEN '2016-12-01' AND '2016-12-15'
        GROUP BY realgamesgames.id, realgamesgames.title, realgamesgames.software, username
ORDER BY played desc
        LIMIT 3");

        return $games;
    }
}
