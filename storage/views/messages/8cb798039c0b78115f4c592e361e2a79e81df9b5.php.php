<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Transactions\Collections\TransactionsCollection;
use App\Core\Collections\CoreCollection;
use App\Users\Repositories\UsersRepo;
use App\Clients\Repositories\ClientsRepo;
use App\Transactions\Repositories\TransactionsRepo;
use App\Core\Enums\Roles;


/**
 * Class CoreController
 *
 * @package App\Http\Controllers
 * @autor Carol Mirabal
 * @autor Pedro Virgüez
 */
class CoreController extends Controller
{
    private $userRepo;
    private $transactionsRepo;
    private $transactionsCollection;
    private $coreCollection;
    private $clientsRepo;

    /**
     * CoreController constructor.
     *
     * @param UsersRepo $userRepo
     * @param TransactionsRepo $transactionsRepo
     * @param TransactionsCollection $transactionsCollection
     * @param CoreCollection $coreCollection
     * @param ClientsRepo $clientsRepo
     */

    public function __construct(UsersRepo $userRepo, TransactionsRepo $transactionsRepo, TransactionsCollection $transactionsCollection, CoreCollection $coreCollection, ClientsRepo $clientsRepo)
    {
        $this->userRepo = $userRepo;
        $this->transactionsRepo = $transactionsRepo;
        $this->transactionsCollection = $transactionsCollection;
        $this->coreCollection = $coreCollection;
        $this->clientsRepo = $clientsRepo;
    }

    /**
     * Resume users from dashboard
     *
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function dashboardResume()
    {
        try {
            $yesterday = Carbon::yesterday();
           // $yesterday->setTimezone(\Session::get('timezone'));
            $yesterday = $yesterday->format('Y-m-d');
            \Log::debug('yesterday', ['hey'=> $yesterday]);
            $current_date = Carbon::now();
            $current_date->setTimezone(\Session::get('timezone'));
            $totalUsers = $this->userRepo->totalUsers(\Auth::user()->id);
            $totalTransactions = $this->transactionsRepo->findTransactionsByDay(\Auth::user()->id, \Session::get('timezone'), $current_date);
            $yesterdayTransactions = $this->transactionsRepo->findTransactionsByDay(\Auth::user()->id, \Session::get('timezone'), $yesterday);
            $result = $this->coreCollection->resumeData($totalUsers, $totalTransactions, $yesterdayTransactions);
        } catch (\Exception $ex) {
            \Log::error('CoreController.dashboardResume.catch', ['exception' => $ex]);
            $result = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Transacción fallida')
            ];
        }
        return response()->json($result);
    }

    /**
     * View dashboard
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard()
    {
        if (\Auth::user()->rol == Roles::$client) {
            return view('core.client.dashboard');
        } else {
            return view('core.admin.dashboard');
        }
    }

    /**
     * Lastest 20 transactions
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function latestTransactions()
    {
        try {
            $transactions = $this->transactionsRepo->findLatestTransactions(\Auth::user()->id, \Session::get('timezone'));
            $result = $this->coreCollection->latestTransactions($transactions);
        } catch (\Exception $ex) {
            \Log::error('CoreController.lastestTransactions.catch', ['exception' => $ex]);
            $result = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Transacción fallida'),
           ];
        }
        return response()->json($result);
    }

    /**
     * Grafic transactions in dashboard
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnMenu()
    {
        try {
            $result = \Session::get('timezone');
        } catch (\Exception $ex) {
            \Log::error('CoreController.transactionsGraphic.catch', ['exception' => $ex]);
            $result = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Transacción fallida'),
            ];
        }
        return $result;
    }

    /**
     * Grafic transactions in dashboard
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function transactionsGraphic()
    {
        try {
            $month = \Request::input('month');
            $transactions = $this->transactionsRepo->findTotalTransactionsByWeek(\Auth::user()->id, $month);
            $result = $this->coreCollection->transactionsGraphicData($transactions);
        } catch (\Exception $ex) {
            \Log::error('CoreController.transactionsGraphic.catch', ['exception' => $ex]);
            $result = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Transacción fallida'),
            ];
        }
        return response()->json($result);
    }

    /**
     * Grafic transactions in dashboard admin
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function transactionsGraphicAdmin()
    {
        try {
            $timezone = \Session::get('timezone');
            $current_date = Carbon::now();
            $current_date->setTimezone($timezone);
            $current_date = $current_date->format('Y-m-d');
            $transactions = $this->transactionsRepo->transactionsClientsDay($current_date, $timezone);
            $result = $this->coreCollection->transactionsGraphicDataAdmin($transactions);
        } catch (\Exception $ex) {
            \Log::error('CoreController.transactionsGraphicAdmin.catch', ['exception' => $ex]);
            $result = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Transacción fallida'),
            ];
        }
        return response()->json($result);
    }
}
