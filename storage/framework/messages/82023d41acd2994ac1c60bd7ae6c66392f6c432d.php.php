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
        $query = "select c.id, c.username, c.urlconfirm, c.ip, c.currency, c.timezone, c.rol, c.status, o.name, o.secret, c.email
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

}
