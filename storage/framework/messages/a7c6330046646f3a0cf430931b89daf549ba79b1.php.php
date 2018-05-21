<?php
namespace App\Clients\Managers;

use Illuminate\Support\Facades\Validator;
use App\Clients\Repositories\ClientsRepo;
use App\Clients\Repositories\OAuthClientRepo;
use App\Core\Utils;
use App\Core\Enums\Status;
use App\Core\Enums\Codes;
use Dotworkers\FantasyWrapper\Fantasy;

/**
 * Class ClientsManager
 *
 * @package App\Clients\Managers
 * @author  Arniel Serrano
 * @author  Eborio Linarez
 * @author  Elio Martins
 * @author  Luis Suarez
 */
class ClientsManager
{
    /**
     * @var ClientsRepo
     */
    private $clientRepo;

    /**
     * @var OAuthClientRepo
     */
    private $oauthClientRepo;

    /**
     * @param ClientsRepo $clientsRepo
     * @param OAuthClientRepo $oauthClientRepo
     */
    function __construct(ClientsRepo $clientsRepo, OAuthClientRepo $oauthClientRepo)
    {
        $this->clientRepo = $clientsRepo;
        $this->oauthClientRepo = $oauthClientRepo;
    }

    /**
     * @param $client
     * @return bool
     */
    public function registerClient($client)
    {
        $validator = Validator::make($client, [
            'id' => 'required|max:40|unique:oauth_clients,id',
            'secret' => 'required|unique:oauth_clients,secret',
            'name' => 'required',
            'oauthclient' => 'required|max:40|unique:clients,oauthclient',
            'ip' => 'required|ip',
            'country' => 'required',
            'rut' => 'between:4,40',
            'informalname' => 'required',
            'email' => 'required|email',
            'username' => 'required|max:30|unique:clients,username'
        ]);

        if ($validator->fails()) {
            $data = [
                'errors' => $validator->errors()->all()
            ];
            $response = Utils::createResponse(Status::$failed, Codes::$validation_errors, $data);
        } else {
            try {
                $createOauthClient = $this->oauthClientRepo->createOAuthClient($client);
                $createUserClient = Fantasy::userRegister(
                    $client['id'],
                    $client['username'],
                    $client['password'],
                    $client['email'],
                    $client['rut'],
                    $client['informalname'],
                    $client['businessname']
                );
                $createClient = $this->clientRepo->createClient($client);
                $data = [
                    'message' => __('Cliente registrado correctamente'),
                    'client' => $createClient
                ];
                $response = Utils::createResponse(Status::$ok, Codes::$success, $data);
            } catch (\Exception $ex) {
                $data = [
                    'errors' => [$ex->getMessage()],
                    'line' => $ex->getLine()
                ];
                \Log::error('ClientsManager.registerClient.catch', ['errors' => $data]);
                $response = Utils::createResponse(Status::$failed, Codes::$validation_errors, $data);
            }
        }

        return $response;
    }

}
