<?php

namespace App\Http\Controllers;

use App\Clients\Repositories\OAuthClientRepo;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Webpatser\Uuid\Uuid;
use App\Clients\Repositories\ClientsRepo;
use App\Clients\Collections\ClientsCollection;
use App\Core\Repositories\StatusRepo;
use App\Core\Repositories\CurrenciesRepo;
use App\Core\Repositories\RolesRepo;
use DateTimeZone;


/**
 * Class ClientsController
 *
 * Class to manage the clients requests
 *
 * @package App\Http\Controllers
 * @author  Carol Mirabal
 */
class ClientsController extends Controller
{

    private $clientRepo;
    private $clientCollection;
    private $currenciesRepo;
    private $rolesRepo;
    private $statusRepo;
    private $oauthClientRepo;


    /**
     * Overwrite __construct
     *
     * @param ClientsRepo $clientRepo
     * @param ClientsCollection $clientCollection
     * @param CurrenciesRepo $currenciesRepo
     * @param RolesRepo $rolesRepo
     * @param StatusRepo $statusRepo
     * @param OAuthClientRepo $oauthClientRepo
     */
    public function __construct(ClientsRepo $clientRepo, ClientsCollection $clientCollection, CurrenciesRepo $currenciesRepo, RolesRepo $rolesRepo, StatusRepo $statusRepo, OAuthClientRepo $oauthClientRepo)
    {
        $this->clientRepo = $clientRepo;
        $this->clientCollection = $clientCollection;
        $this->currenciesRepo = $currenciesRepo;
        $this->rolesRepo = $rolesRepo;
        $this->statusRepo = $statusRepo;
        $this->oauthClientRepo = $oauthClientRepo;
    }

    /**
     *View search advanced user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function advancedSearchClientsView()
    {
        $data['timezones'] = DateTimeZone::listIdentifiers();
        $data['currencies'] = $this->currenciesRepo->all();
        $data['roles'] = $this->rolesRepo->all();
        $data['status'] = $this->statusRepo->all();

        return view('clients.advancedsearch', $data);
    }

    public function advancedSearchClients()
    {
        try {
            $id = \Request::input('id');
            $name = \Request::input('name');
            $username = strtolower(\Request::input('username'));
            $url = strtolower(\Request::input('urlconfirm'));
            $currency = \Request::input('currency');
            $timezone = \Request::input('timezone');
            $rol = \Request::input('rol');
            $status = \Request::input('status');

            $clients = $this->clientRepo->advancedSearchClients($id, $username, $name, $url, $currency, $timezone, $rol, $status);
            $datatable = $this->clientCollection->clientDataTable($clients);
            $result = Datatables::of($datatable)->make();
        } catch (\Exception $ex) {
            \Log::error('ClientsController.advancedSearchClient.catch', ['exception' => $ex]);
            $response = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Transacción fallida')
            ];
            $result = response()->json($response);
        }
        return $result;

    }

    /**
     * Return view details client
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @internal param $username
     */
    public function clientDetailsView()
    {
        return view('clients.details', ['username' => \Auth::user()->username]);
    }

    /**
     * Create client view
     *
     * @return mixed
     */
    public function createClientsView()
    {
        $data['timezones'] = DateTimeZone::listIdentifiers();
        $data['currencies'] = $this->currenciesRepo->all();
        $data['roles'] = $this->rolesRepo->all();
        $data['status'] = $this->statusRepo->all();
        return view('clients.create', $data);
    }

    public function clientsSelects()
    {
        $data['timezones'] = DateTimeZone::listIdentifiers();
        $data['currencies'] = $this->currenciesRepo->all();
        $data['roles'] = $this->rolesRepo->all();
        $data['status'] = $this->statusRepo->all();
        return response()->json($data);
    }

    /**
     * Create client
     *
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function createClients(Request $request)
    {
        $id = strtolower($request->id);
        $ip = $request->ip;
        $url = strtolower($request->urlconfirm);
        $currency = $request->currency;
        $username = strtolower($request->username);
        $password = str_random(10);
        $timezone = $request->timezone;
        $rol = $request->rol;
        $status = $request->status;
        $email = $request->email;
        $name = $request->name;
        $secret = (string)Uuid::generate(4)->string;

        $validator = $this->validate($request, [
            'id' => 'required|max:40',
            'name' => 'required|max:200',
            'username' => 'required|max:20',
            'urlconfirm' => 'required|max:255|min:8',
            'email' => 'required|between:3,64|email',
            'currency' => 'required',
            'timezone' => 'required',
            'rol' => 'required',
            'status' => 'required',
            'ip' => 'required'
        ]);

        $clientData = [
            'id' => $id,
            'ip' => json_encode($ip),
            'urlconfirm' => $url,
            'currency' => $currency,
            'username' => $username,
            'password' => bcrypt($password),
            'timezone' => $timezone,
            'rol' => $rol,
            'status' => $status,
            'email' => $email,
        ];
        $oauthData = [
            'id' => $id,
            'name' => $name,
            'secret' => $secret
        ];

        $data = [
            'name' => $name,
            'username' => $username,
            'password' => $password
        ];

        $oauthCreate = $this->oauthClientRepo->createOAuthClient($oauthData);
        $clientCreate = $this->clientRepo->createClient($clientData);

       /* \Mail::send('clients.email.message', $data, function ($message) use ($email) {
            $message->to($email, '')->subject(__('Datos de Ingreso'));
        });*/


        if ($oauthCreate && $clientCreate) {
            $response = [
                'status' => 'SUCCESS',
                'title' => __('¡Exitoso!'),
                'message' => __('Cliente creado exitosamente.')
            ];
        }

        return response()->json($response);
    }

    /**
     * Edit password from details modal
     *
     * @return array|mixed
     */
    public function editPassword()
    {
        try {
            $password = \Request::input('password');
            $result = $this->clientRepo->editPassword(\Auth::user()->id, bcrypt($password));

        } catch
        (\Exception $ex) {
            \Log::error('ClientsController.editPassword.catch', ['exception' => $ex]);
            $result = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Transacción fallida')
            ];
        }

        return response()->json($result);
    }

    /**
     * Edit url from details client modal
     *
     * @return array|mixed
     */
    public function editUrl()
    {
        $url = \Request::input('url');
        try {
            $result = $this->clientRepo->editUrlId(\Auth::user()->id, $url);
        } catch
        (\Exception $ex) {
            \Log::error('ClientsController.editUrl.catch', ['exception' => $ex]);
            $result = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Transacción fallida')
            ];
        }
        return response()->json($result);
    }

    /**
     * Edit ip from details client modal
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editIp()
    {
        try {
            $ip = \Request::input('ip');
            $result = $this->clientRepo->editIpId(\Auth::user()->id, json_encode($ip));
        } catch
        (\Exception $ex) {
            \Log::error('ClientsController.editIp.catch', ['exception' => $ex]);
            $result = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Transacción fallida')
            ];
        }
        return response()->json($result);
    }

    /**
     * Find clients by username
     *
     * @param $username
     * @return \Illuminate\Http\JsonResponse
     */
    public function findClientByUsername($username)
    {
        try {
            $clients = $this->clientRepo->findClientByUsername(strtolower($username));
            $clientsdata = $this->clientCollection->clientDataTable($clients);
            $result = Datatables::of($clientsdata)->make();
        } catch (\Exception $ex) {
            \Log::error('ClientsController.findClientsByUsername.catch', ['exception' => $ex]);
            $response = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Transacción fallida')
            ];
            $result = response()->json($response);
        }
        return $result;
    }

    /**
     * Find client by username
     *
     * @param string $username User username
     * @return \Illuminate\Http\JsonResponse
     */
    public function findByUsername($username)
    {
        try {
            $result = $this->clientRepo->findByUsername($username);
        } catch (\Exception $ex) {
            \Log::error('ClientsController.findClientByUsername.catch', ['exception' => $ex]);
            $result = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Transacción fallida')
            ];
        }
        return response()->json($result);
    }

    /**
     * Show the login view
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showLogin()
    {
        if (\Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('clients.login');
        }
    }

    /**
     * Show the view of details client
     *
     * @param $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchClientDetails($user)
    {
        return view('users.details', array('user' => $user));
    }

    /**
     * Search clients from sidebar
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchClients()
    {
        $username = \Request::input('username');
        return view('clients.find', ['username' => $username]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendPassword(Request $request)
    {

        $password = str_random(10);
        $username = strtolower($request->username);
        $email = $request->email;
        $name = $request->name;
        $id = $request->id;

        \Log::debug('pass', ['email' => $email, 'name' => $name]);

        $data = [
            'name' => $name,
            'username' => $username,
            'password' => $password
        ];

        $validator = $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
        ]);

        \Mail::send('clients.email.message', $data, function ($message) use ($email) {
            $message->to($email, '')->subject(__('Datos de Ingreso'));
        });

        $encryptPass = bcrypt($password);

        $passwordData = $this->clientRepo->updatePassword($id, $encryptPass);

        if ($passwordData) {
            $response = [
                'status' => 'SUCCESS',
                'title' => __('¡Exitoso!'),
                'message' => __('Ha cambiado el password de manera exitosa')
            ];
        }

        return response()->json($response);
    }

    /**
     * Update client
     *
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function updateClients(Request $request)
    {
        $id = strtolower($request->idM);
        $ip = $request->ipM;
        $url = strtolower($request->urlconfirmM);
        $currency = $request->currencyM;
        $username = strtolower($request->usernameM);
        $timezone = $request->timezoneM;
        $rol = $request->rolM;
        $status = $request->statusM;
        $email = $request->emailM;
        $name = $request->nameM;


        $validator = $this->validate($request, [
            'nameM' => 'required|max:200',
            'usernameM' => 'required|max:20',
            'urlconfirmM' => 'required|max:255|min:8',
            'emailM' => 'required|between:3,64|email',
            'currencyM' => 'required',
            'timezoneM' => 'required',
            'rolM' => 'required',
            'statusM' => 'required',
            'ipM' => 'required'
        ]);

        $clientData = [
            'id' => $id,
            'ip' => $ip,
            'urlconfirm' => $url,
            'currency' => $currency,
            'username' => $username,
            'timezone' => $timezone,
            'rol' => $rol,
            'status' => $status,
            'email' => $email,
        ];

        $oauthData = [
            'id' => $id,
            'name' => $name,
        ];


        $oauthUpdate = $this->oauthClientRepo->updateOAuthClient($id, $oauthData);
        $clientUpdate = $this->clientRepo->updateClient($id, $clientData);

        if ($oauthUpdate && $clientUpdate) {
            $response = [
                'status' => 'SUCCESS',
                'title' => __('¡Exitoso!'),
                'message' => __('Cliente modificado exitosamente')
            ];
        }

        return response()->json($response);
    }

}
