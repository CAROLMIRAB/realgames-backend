<?php

namespace App\Http\Controllers;

use App\Clients\Repositories\ClientsRepo;
use App\Core\Enums\Status;
use App\Core\Enums\Roles;
use App\Core\Collections\CoreCollection;
use Illuminate\Support\Facades\Config;

/**
 * Class AuthController
 *
 * Controller for the authentication
 *
 * @package App\Http\Controllers
 * @author  Carol Mirabal
 */
class AuthController extends Controller
{
    /**
     * Customers repository
     *
     * @var ClientsRepo
     */
    private $clientsRepo;

    /**
     * Overwrite __construct
     *
     * @param ClientsRepo $clientsRepo
     */
    public function __construct(ClientsRepo $clientsRepo)
    {
        $this->clientsRepo = $clientsRepo;
    }

    /**
     * Customers login
     *
     * @param CoreCollection $coreCollection
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(CoreCollection $coreCollection)
    {
        try {
            $username = \Request::input('username');
            $password = \Request::input('password');

            $clients = $this->clientsRepo->findByUsername($username);
            \Session::put('timezone', $clients['timezone']);

            $detailsCurrency = $this->clientsRepo->findCurrencyByUsername($username);

            $currency = [
                'iso' => $detailsCurrency['iso'],
                'symbol' => $detailsCurrency['symbol'],
                'thousandseparator' => $detailsCurrency['thousandseparator'],
                'decimalseparator' => $detailsCurrency['decimalseparator'],
                'decimals' => $detailsCurrency['decimals'],
            ];

            \Session::put('currency', $currency);


            $credentials = ['username' => $username, 'password' => $password];

            if ($clients['rol'] == Roles::$client && $clients['status'] == Status::$inactive) {
                $response = ['message' => __('Su usuario está innactivo debe comunicarse con su proveedor de servicios')];
                return response()->json($response);
            }

            if ($clients['rol'] == Roles::$client && $clients['status'] == Status::$locked) {
                $response = ['message' => __('Su usuario está bloqueado debe comunicarse con su proveedor de servicios')];
                return response()->json($response);
            }

            if (\Auth::attempt($credentials)) {
                if ($clients['rol'] == Roles::$administrator) {
                    return ['message' => __('Autenticado'), 'status' => '200'];
                }
                if ($clients['rol'] == Roles::$client && $clients['status'] == Status::$active) {
                    return ['message' => __('Autenticado'), 'status' => '200'];
                }
            } else {
                $response = ['message' => __('Sus credenciales son incorrectas')];
                return response()->json($response);
            }


        } catch (\Exception $ex) {
            \Log::error('AuthController.Auth', ['exception' => $ex]);
            return redirect()->route('clients.login')->with('error', __('Error accediendo al sistema ' . $password));
        }

    }

    /**
     * Log the client out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        \Auth::logout();
        \Session::flush();
        return redirect()->route('clients.login');
    }

}

