<?php

namespace App\Clients\Repositories;

use App\Clients\Entities\Client;
use App\Core\Enums\Roles;

/**
 * Class ClientsRepo
 *
 * Repository to manage the data of the Client entity
 *
 * @package App\Clients\Repositories
 * @author  Arniel Serrano
 * @author  Eborio Linarez
 * @author  Carol Mirabal
 * @author  Pedro Virguez
 */
class ClientsRepo
{

    /**
     * Find all clients
     *
     * @return mixed
     */
    public function all()
    {
        $clients = \DB::table('clients')
            ->where('rol', Roles::$client)
            ->orderBy('username', 'asc')
            ->get();

        return $clients;
    }


    /**
     * @param $password
     * @return Client
     */
    public function activateClient($password)
    {
        $client = new Client();
        $client->password = $password;
        $client->save();
        return $client;
    }

    /**
     * Advanced search clients
     *
     * @param $id
     * @param $username
     * @param $name
     * @param $url
     * @param $currency
     * @param $timezone
     * @param $rol
     * @param $status
     * @return mixed
     */
    public function advancedSearchClients($id, $username, $name, $url, $currency, $timezone, $rol, $status)
    {
        $query = "select c.id, c.username, c.urlconfirm, c.currency, c.timezone, c.rol, c.status, o.name, o.secret, c.email, c.ip, o.secret
         from clients c, oauth_clients o ";

        $conditions = "where c.id=o.id ";

        if (!empty($id)) {
            $conditions .= " and c.id like '" . $id . "%'";
        }
        if (!empty($username)) {
            $conditions .= " and lower(c.username) like '" . $username . "%'";
        }
        if (!empty($name)) {
            $conditions .= " and lower(o.name) like '" . $name . "%'";
        }
        if (!empty($url)) {
            $conditions .= " and lower(c..urlconfirm) like '" . $url . "%'";
        }
        if (!empty($currency)) {
            $conditions .= " and c.currency = '" . $currency . "'";
        }
        if (!empty($timezone)) {
            $conditions .= " and c.timezone = '" . $timezone . "'";
        }
        if (!empty($rol)) {
            $conditions .= " and c.rol = '" . $rol . "'";
        }
        if (!empty($status)) {
            $conditions .= " and c.status = '" . $status . "'";
        }
        $conditions .= ' ORDER BY id DESC ';
        $query = $query . $conditions;
        $result = \DB::select($query);
        return $result;

    }

    /**
     * @param $data
     * @return static
     */
    public function createClient($data)
    {
        $client = Client::create($data);
        return $client;
    }

    /**
     * @param $user
     * @param $password
     * @return mixed
     */
    public function editPassword($user, $password)
    {
        return \DB::table('clients')->where('id', $user)->update(['password' => $password]);
    }

    /**
     * @param $user
     * @param $url
     * @return mixed
     */
    public function editUrlId($user, $url)
    {
        return \DB::table('clients')->where('id', $user)->update(['urlconfirm' => $url]);
    }

    /**
     * update ip clients
     *
     * @param $user
     * @param $ip
     * @return mixed
     */
    public function editIpId($user, $ip)
    {
        $result = \DB::table('clients')->where('id', $user)->update(['ip' => $ip]);

        return $result;
    }

    /**
     * Find currency by username
     *
     * @param $username
     * @return mixed
     */
    public function findCurrencyByUsername($username)
    {
        $client = Client::select('currencies.iso', 'currencies.symbol', 'currencies.thousandseparator', 'currencies.decimalseparator', 'currencies.decimals')
            ->join('currencies', 'clients.currency', '=', 'currencies.iso')
            ->where('clients.username', $username)
            ->first();
        return $client;
    }

    /**
     * Find client by username
     *
     * @param $username
     * @return mixed
     */
    public function findClientByUsername($username)
    {
        $clients = Client::select('clients.id', 'ip', 'urlconfirm', 'currency', 'username', 'timezone', 'rol', 'status', 'email', 'oauth_clients.secret', 'name')
            ->join('oauth_clients', 'clients.id', '=', 'oauth_clients.id')
            ->where('clients.username', 'like', $username . '%')
            ->orderBy('username', 'asc')
            ->get();
        return $clients;
    }

    /**
     * Find client by id
     *
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $client = Client::where('id', $id)->first();
        return $client;
    }

    /**
     * @param $token
     * @return mixed
     */
    public function findByToken($token)
    {
        $client = Client::where('clients.remember_token', $token)->first();
        return $client;
    }

    /**
     * @param $username
     * @return mixed
     */
    public function findByUsername($username)
    {
        $client = Client::where('username', $username)->first();
        return $client;
    }

    /**
     * @return static
     */
    public function getClients()
    {
        $clients = Client::get();
        return $clients;
    }

    /**
     * Compare from login client
     *
     * @param $username
     * @param $password
     */
    public function loginClient($username, $password)
    {
        Client::where('username', $username)->and('password', $password)->first();

    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateClient($id, $data)
    {
        $client = \DB::table('clients')->where('id', $id)->update($data);
        return $client;
    }

    /**
     * @param $id
     * @param $password
     * @return mixed
     */
    public function updatePassword($id, $password)
    {
        $client = \DB::table('clients')->where('id', $id)->update(['password' => $password]);
        return $client;
    }

    /**
     * Get profit clients
     *
     * @param $client
     * @param $timezone
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public function getProfitClients($timezone, $startDate, $endDate)
    {
        $query = "SELECT des.client as id,  sum(des.deposit) as deposit, sum(des.withdrawal) as withdrawal, sum(des.deposit-des.withdrawal) as profit  from (SELECT * from(select
        depos.client,
        CASE WHEN depos.deposit IS NULL THEN 0 ELSE depos.deposit END AS deposit,
        CASE WHEN withdra.withdrawal IS NULL THEN 0 ELSE withdra.withdrawal END AS withdrawal from
        (SELECT  transactions.client,
               sum(amount) as deposit
        from transactions
        left join clients on clients.id = transactions.client
        where transactions.transactiontype=2
        and (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE BETWEEN ? AND ?
        GROUP BY transactions.client) as depos
        LEFT JOIN (
        SELECT transactions.client,
        sum(amount) as withdrawal
        from transactions
                left join clients on clients.id = transactions.client
                  where transactions.transactiontype=1
        and (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE BETWEEN ? AND ?
        GROUP BY transactions.client
        ) as withdra on depos.client = withdra.client
        GROUP BY depos.client, depos.deposit, withdra.withdrawal ) as dru
       union select transactions.client, 0 as deposit, 0 as withdrawal from transactions
        left join clients on clients.id = transactions.client
        )as des
       GROUP BY des.client";

        return \DB::select($query, [$startDate, $endDate, $startDate, $endDate]);
    }

    /**
     * @param $timezone
     * @param $startDate
     * @param $endDate
     * @param $client
     * @return mixed
     */
    public function getProfitUsers($timezone, $startDate, $endDate, $client)
    {
        $query = "SELECT des.username as id,  sum(des.deposit) as deposit, sum(des.withdrawal) as withdrawal, sum(des.deposit-des.withdrawal) as profit  from (SELECT * from(select
        depos.username,
        CASE WHEN depos.deposit IS NULL THEN 0 ELSE depos.deposit END AS deposit,
        CASE WHEN withdra.withdrawal IS NULL THEN 0 ELSE withdra.withdrawal END AS withdrawal from
        (SELECT  users.username,
               sum(amount) as deposit
        from transactions
        LEFT JOIN users on users.id = transactions.user
        left join clients on clients.id = transactions.client
        where transactions.transactiontype=2
and transactions.client= ?
        and (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE BETWEEN ? AND ?
        GROUP BY users.username) as depos
        LEFT JOIN (
        SELECT users.username,
        sum(amount) as withdrawal
        from transactions
LEFT JOIN users on users.id = transactions.user
                left join clients on clients.id = transactions.client
                  where transactions.transactiontype=1
and transactions.client= ?
        and (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE BETWEEN ? AND ?
        GROUP BY users.username
        ) as withdra on depos.username = withdra.username
        GROUP BY depos.username, depos.deposit, withdra.withdrawal ) as dru
       union select users.username, 0 as deposit, 0 as withdrawal from transactions
LEFT JOIN users on users.id = transactions.user
        left join clients on clients.id = transactions.client
        )as des
       GROUP BY des.username";

        return \DB::select($query, [$client, $startDate, $endDate, $client, $startDate, $endDate]);
    }

    /**
     * Get profit users
     *
     * @param $client
     * @param $timezone
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public function getProfitTotalClient($timezone, $startDate, $endDate)
    {
        $query = "SELECT  sum(dru.deposit) as played, sum(dru.withdrawal) as won, sum(dru.deposit-dru.withdrawal) as profit from (select
        depos.client,
        CASE WHEN depos.deposit IS NULL THEN 0 ELSE depos.deposit END AS deposit,
        CASE WHEN withdra.withdrawal IS NULL THEN 0 ELSE withdra.withdrawal END AS withdrawal from
        (SELECT  transactions.client,
               sum(amount) as deposit
        from transactions
        left join clients on clients.id = transactions.client
        where transactions.transactiontype=2
        and (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE BETWEEN ? AND ?
        GROUP BY transactions.client) as depos
        LEFT JOIN (
        SELECT transactions.client,
        sum(amount) as withdrawal
        from transactions
                left join clients on clients.id = transactions.client
                  where transactions.transactiontype=1
        and (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE BETWEEN ? AND ?
        GROUP BY transactions.client
        ) as withdra on depos.client = withdra.client
   ) as dru";

        return \DB::select($query, [$startDate, $endDate, $startDate, $endDate]);
    }

    /**
     * Get profit users
     *
     * @param $client
     * @param $timezone
     * @param $startDate
     * @param $endDate
     * @return mixed
     */
    public function getProfitTotalUser($timezone, $startDate, $endDate, $client)
    {
        $query = "SELECT  sum(dru.deposit) as played, sum(dru.withdrawal) as won, sum(dru.deposit-dru.withdrawal) as profit from (select
        depos.client,
        CASE WHEN depos.deposit IS NULL THEN 0 ELSE depos.deposit END AS deposit,
        CASE WHEN withdra.withdrawal IS NULL THEN 0 ELSE withdra.withdrawal END AS withdrawal from
        (SELECT  transactions.client,
               sum(amount) as deposit
        from transactions
        left join clients on clients.id = transactions.client
        where transactions.transactiontype=2
        and transactions.client = ?
        and (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE BETWEEN ? AND ?
        GROUP BY transactions.client) as depos
        LEFT JOIN (
        SELECT transactions.client,
        sum(amount) as withdrawal
        from transactions
                left join clients on clients.id = transactions.client
        where transactions.transactiontype=1
        and transactions.client = ?
        and (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE BETWEEN ? AND ?
        GROUP BY transactions.client
        ) as withdra on depos.client = withdra.client
   ) as dru";

        return \DB::select($query, [$client, $startDate, $endDate, $client, $startDate, $endDate]);
    }

}
