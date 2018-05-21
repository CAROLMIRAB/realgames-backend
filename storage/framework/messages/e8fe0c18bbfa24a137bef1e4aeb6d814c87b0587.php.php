<?php

namespace App\Clients\Repositories;

use App\Clients\Entities\OAuthClient;

/**
 * Class OAuthClientRepo
 *
 * Repository to manage the data of the OAuthClient entity
 *
 * @package App\Clients\Repositories
 * @author  Arniel Serrano
 * @author  Eborio Linarez
 * @author  Elio Martins
 * @author  Luis Suarez
 */
class OAuthClientRepo
{
    /**
     * @param $data
     * @return static
     */
    public function createOAuthClient($data)
    {
        $oauthClient = OAuthClient::create($data);
        return $oauthClient;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findById($id)
    {
        $oauthClient = OAuthClient::find($id);
        return $oauthClient;
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function updateOAuthClient($id, $data)
    {
        $client = \DB::table('oauth_clients')->where('id', $id)->update($data);
        return $client;
    }
}
