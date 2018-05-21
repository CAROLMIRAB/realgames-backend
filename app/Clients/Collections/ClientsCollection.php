<?php

namespace App\Clients\Collections;

use App\Clients\Repositories\ClientsRepo;
use App\Core\Enums\Roles;
use App\Core\Enums\Status;
use Illuminate\Support\Collection;


/**
 * Class ClientsCollection
 * @package App\Clients\Collections
 * @autor Carol Mirabal
 */
class ClientsCollection
{
    private $clientRepo;

    /**
     * ClientsCollection constructor.
     *
     * @param ClientsRepo $clientRepo
     */
    public function __construct(ClientsRepo $clientRepo)
    {
        $this->clientRepo = $clientRepo;
    }

    /**
     * Prepare data from the client datatable serverSide
     *
     * @param $clients
     * @return Collection
     */
    public function clientDataTable($clients)
    {

        $datatableclient = new Collection();

        foreach ($clients as $client) {

            $status = $client->status;
            $rol = $client->rol;

            $route = route('clients.sendpassword');
            switch ($client->rol) {
                case Roles::$administrator :
                    $client->rol = __("Administrador");
                    break;
                case Roles::$client :
                    $client->rol = __("Cliente");
                    break;
            }

            switch ($client->status) {
                case Status::$active :
                    $client->status = "<span class='label label-success'>" . __('Activo') . "</span>";
                    break;
                case Status::$inactive :
                    $client->status = "<span class='label label-warning'>" . __("Inactivo") . "</span>";
                    break;
                case Status::$locked :
                    $client->status = "<span class='label label-danger'>" . __("Bloqueado") . "</span>";;
                    break;
            }

            $datatableclient->push([
                'id' => "<a class='open-modal label label-default' data-toggle='modal' data-target='#modalEdit' data-id='" . $client->id . "' data-username='" . $client->username . "' data-name='" . $client->name . "' data-ip='" . json_encode($client->ip) . "' data-urlconfirm='" . $client->urlconfirm . "' data-currency='" . $client->currency . "' data-timezone='" . $client->timezone . "' data-rol='" . $rol . "' data-status='" . $status . "' data-email='" . $client->email . "' >" . $client->id . "</a>",
                'secret' => $client->secret,
                'username' => $client->username,
                'name' => $client->name,
                'email' => $client->email,
                /*'domain' => $client->domain,*/
                'ip' => $client->ip,
                'urlconfirm' => $client->urlconfirm,
                'currency' => $client->currency,
                'timezone' => $client->timezone,
                'rol' => $client->rol,
                'status' => $client->status,
                'details' => "<a class='send-mail label label-warning' data-loading-text=" . __("Enviando...") . " data-id='" . $client->id . "' data-name='" . $client->name . "' data-username='" . $client->username . "' data-email='" . $client->email . "' data-route='" . $route . "' data-secret='" . $client->secret . "' data-currency='" . $client->currency . "'>" . __("Enviar Credenciales") . "<i class='fa fa-envelope-o'></i></a>",
            ]);


        }

        return $datatableclient;
    }

}