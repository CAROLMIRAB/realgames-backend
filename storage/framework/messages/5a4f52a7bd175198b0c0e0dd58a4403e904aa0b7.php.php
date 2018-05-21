<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clients\Repositories\ClientsRepo;
use App\Users\Repositories\UsersRepo;
use Yajra\Datatables\Datatables;
use App\Core\Enums\Roles;
use App\Core\Enums\TransactionTypes;
use App\Reports\Collections\ReportsCollection;
use App\Transactions\Repositories\TransactionsRepo;


/**
 * Class ReportsController
 *
 * Class to manage the users requests
 *
 * @package App\Http\Controllers
 * @author  Arniel Serrano
 */
class ReportsController extends Controller
{


    private $transactionRepo;
    private $clientsRepo;
    private $reportsCollection;
    private $usersRepo;


    /**
     * Function construct ReportsController
     *
     * ReportsController constructor.
     * @param TransactionsRepo $transactionRepo
     * @param ClientsRepo $clientsRepo
     * @param ReportsCollection $reportsCollection
     * @param UsersRepo $usersRepo
     */
    public function __construct(TransactionsRepo $transactionRepo, ClientsRepo $clientsRepo, ReportsCollection $reportsCollection, UsersRepo $usersRepo)
    {
        $this->transactionRepo = $transactionRepo;
        $this->clientsRepo = $clientsRepo;
        $this->reportsCollection = $reportsCollection;
        $this->usersRepo = $usersRepo;
    }


    /**
     * View profit report
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profit()
    {
        return view('reports.profit');
    }

    /**
     * Data profit report
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profitData()
    {
        try {
            if (\Auth::user()->rol == Roles::$administrator) {
                $client = \Request()->input('client');
            } else {
                $client = \Auth::user()->id;
            }
            $dateFrom = \Request()->input('start-date');
            $dateAt = \Request()->input('end-date');
            $purchase = $this->transactionRepo->sumTransactions($client, $dateFrom, $dateAt, TransactionTypes::$debit, \Session::get('timezone'));
            $won = $this->transactionRepo->sumTransactions($client, $dateFrom, $dateAt, TransactionTypes::$credit, \Session::get('timezone'));
            $response = $this->reportsCollection->dataProfit($purchase, $won);
        } catch (\Exception $ex) {
            \Log::error('ReportsController.profitData.catch', ['exception' => $ex]);
            $response = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Error al efectuar la operación.')
            ];
        }
        return response()->json($response);
    }

    /**
     * Report profit by user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profitByUser()
    {
        try {
            $dateFrom = \Request()->input('start-date');
            $dateAt = \Request()->input('end-date');
            $user = \Request()->input('user');
            $client = \Auth::user()->id;

            $purchase = $this->transactionRepo->profitByUser($client, $dateFrom, $dateAt, TransactionTypes::$debit, \Session::get('timezone'), $user);
            $won = $this->transactionRepo->profitByUser($client, $dateFrom, $dateAt, TransactionTypes::$credit, \Session::get('timezone'), $user);
            $response = $this->reportsCollection->dataProfit($purchase, $won);
        } catch (\Exception $ex) {
            \Log::error('ReportsController.profitByUser.catch', ['exception' => $ex]);
            $response = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Error al efectuar la operación.')
            ];
        }
        return response()->json($response);
    }

    /**
     * Report profit by game
     *
     * @return mixed
     */
    public function profitByGame(Request $request)
    {

        try {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $provider = $request->provider;
            $client = \Auth::user()->id;

            $profit = $this->transactionRepo->profitByGame($startDate, $endDate, $client, $provider, \Session::get('timezone'));
            $gamedata = $this->reportsCollection->profitGame($profit);
            $response = Datatables::of($gamedata)->make();
        } catch (\Exception $ex) {
            \Log::error('ReportsController.profitByGame.catch', ['exception' => $ex]);
            $result = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Error al efectuar la operación.')
            ];

            $response = response()->json($result);
        }

        return $response;
    }

    /**
     * Report profit by game
     *
     * @return mixed
     */
    public function profitByUsersProvider(Request $request)
    {

        try {

            $user = $request->user;
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $client = \Auth::user()->id;

            if($user!='null'){
                $profit = $this->transactionRepo->profitByUsersProvider($startDate, $endDate, $client, $user, \Session::get('timezone'));
                $gamedata = $this->reportsCollection->profitUsersProvider($profit);
                $response = Datatables::of($gamedata)->make();

            }else{
                $result = [
                    'status' => 'FAILED',
                    'title' => __('¡Error!'),
                    'message' => __('Usuario no debe estar vacio.')
                ];
                $response = response()->json($result);
            }

        } catch (\Exception $ex) {
            \Log::error('ReportsController.profitByUserProvider.catch', ['exception' => $ex]);
            $result = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Error al efectuar la operación.')
            ];

            $response = response()->json($result);
        }

        return $response;
    }

    /**
     * Report profit by game
     *
     * @return mixed
     */
    public function profitByProvider()
    {
        try {
            $dateFrom = \Request()->input('startDate');
            $dateAt = \Request()->input('endDate');
            $client = \Auth::user()->id;

            $profit = $this->transactionRepo->profitByProvider($client, $dateFrom, $dateAt, \Session::get('timezone'));
            $response = $this->reportsCollection->profitProvider($profit);
        } catch (\Exception $ex) {
            \Log::error('ReportsController.profitByProvider.catch', ['exception' => $ex]);
            $response = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Error al efectuar la operación.')
            ];
        }
        return response()->json($response);
    }

    /**
     *Search Providers
     *
     * @return mixed
     */
    public function findProvider()
    {
        try {
            $provider = $this->transactionRepo->allProviders();
            $response = $this->reportsCollection->allProviders($provider);
        } catch (\Exception $ex) {
            \Log::error('ReportsController.profitByProvider.catch', ['exception' => $ex]);
            $response = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Error al efectuar la operación.')
            ];
        }
        return response()->json($response);
    }

    public function quantitySpin()
    {
        try {
            $dateFrom = \Request()->input('startDate');
            $dateAt = \Request()->input('endDate');
            $client = \Auth::user()->id;
            $data = $this->transactionRepo->quantitySpin($client, $dateFrom, $dateAt, \Session::get('timezone'));
            $dataspin = $this->reportsCollection->quantitySpin($data);
            $response = Datatables::of($dataspin)->make();
        } catch (\Exception $ex) {
            \Log::error('ReportsController.quantitySpin.catch', ['exception' => $ex]);
            $result = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Error al efectuar la operación.')
            ];
            $response = response()->json($result);
        }
        return $response;
    }

    /**
     * Report profit by game
     *
     * @return mixed
     */
    public function totalProfitByProvider()
    {
        try {
            $dateFrom = \Request()->input('startDate');
            $dateAt = \Request()->input('endDate');
            $client = \Auth::user()->id;
            $purchase = $this->transactionRepo->sumTransactions($client, $dateFrom, $dateAt, TransactionTypes::$debit, \Session::get('timezone'));
            $won = $this->transactionRepo->sumTransactions($client, $dateFrom, $dateAt, TransactionTypes::$credit, \Session::get('timezone'));
            $response = $this->reportsCollection->dataProfit($purchase, $won);
        } catch (\Exception $ex) {
            \Log::error('ReportsController.totalProfitByProvider.catch', ['exception' => $ex]);
            $response = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Error al efectuar la operación.')
            ];
        }
        return response()->json($response);
    }

    public function searchUsers(Request $request){
        try {
            $client = \Auth::user()->id;
            $username = $request->username['term'];
            $response = $this->usersRepo->allbyusername($client, $username);
        } catch (\Exception $ex) {
            \Log::error('ReportsController.searchUsers.catch', ['exception' => $ex]);
            $response = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Error al efectuar la operación.')
            ];
        }

        return response()->json($response);
    }

    /**
     * View profit report
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewProfitAdmin()
    {
        $data['clients'] = $this->clientsRepo->all();
        return view('reports.profitbyclient', $data);
    }

    /**
     * View profit Client por usuario
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function viewProfitByUser()
    {
        $data['users'] = $this->usersRepo->all(\Auth::user()->id);
        return view('reports.profitbyuser', $data);
    }

    /**
     *  View profit Client por proveedor
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function viewProfitByProvider()
    {
        return view('reports.profitbyprovider');
    }

    /**
     * View profit Client for game
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function viewProfitByGame()
    {
        return view('reports.profitbygame');
    }

    /**
     * View Spin by game
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function viewSpinByGame()
    {
        return view('reports.quantityspinbygame');
    }

    /**
     * First three games most spin
     *
     * @return mixed
     */
    public function firstThree()
    {
        try {
            $dateFrom = \Request()->input('startDate');
            $dateAt = \Request()->input('endDate');
            $client = \Auth::user()->id;
            $data = $this->transactionRepo->quantitySpin($client, $dateFrom, $dateAt, \Session::get('timezone'));
            $response = $this->reportsCollection->firstThree($data);
        } catch (\Exception $ex) {
            \Log::error('ReportsController.firstThree.catch', ['exception' => $ex]);
            $response = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Error al efectuar la operación.')
            ];
        }

        return response()->json($response);
    }

}