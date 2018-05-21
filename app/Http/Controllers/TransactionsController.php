<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 24/11/2016
 * Time: 10:59 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clients\Repositories\ClientsRepo;
use App\Users\Repositories\UsersRepo;
use Yajra\Datatables\Datatables;
use App\Core\Enums\Roles;
use App\Core\Enums\TransactionTypes;
use App\Reports\Collections\ReportsCollection;
use App\Transactions\Repositories\TransactionsRepo;
use App\Transactions\Collections\TransactionsCollection;

/**
 * Class ReportsController
 *
 * Class to manage the users requests
 *
 * @package App\Http\Controllers
 * @author  Pedro Virgüez
 */
class TransactionsController
{
    private $transactionRepo;
    private $clientsRepo;
    private $reportsCollection;
    private $usersRepo;
    private $transactionsCollection;


    /**
     * Function construct TransactionsController
     *
     * ReportsController constructor.
     * @param TransactionsRepo $transactionRepo
     * @param ClientsRepo $clientsRepo
     * @param ReportsCollection $reportsCollection
     * @param UsersRepo $usersRepo
     */
    public function __construct(TransactionsRepo $transactionRepo, TransactionsCollection $transactionsCollection, ClientsRepo $clientsRepo, ReportsCollection $reportsCollection, UsersRepo $usersRepo)
    {
        $this->transactionRepo = $transactionRepo;
        $this->clientsRepo = $clientsRepo;
        $this->reportsCollection = $reportsCollection;
        $this->usersRepo = $usersRepo;
        $this->transactionsCollection = $transactionsCollection;
    }

    /**
     * Advanced transactions search
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function TransactionsAdvancedsearch(Request $request)
    {
        try {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $idtransaction = $request->idtransaction;
            $username = strtolower($request->username);
            $idgame = $request->idgame;
            $gamename = strtolower($request->gamename);
            $client = \Auth::user()->id;

            $transactions = $this->transactionRepo->advancedSearch($client, $startDate, $endDate, $idtransaction, $username, $idgame, $gamename, \Session::get('timezone'));
            $transactionsdata = $this->transactionsCollection->TransactionsDataTable($transactions);

            $result = Datatables::of($transactionsdata)->make();
        } catch (\Exception $ex) {
            \Log::error('UsersController.advancedSearchTransaction.catch', ['exception' => $ex]);
            $response = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Busqueda fallida')
            ];
            $result = response()->json($response);
        }
        return $result;
    }

    /**
     *View advanced serach by transactions
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function viewTransactionsAdvancedsearch()
    {
        return view('transactions.transactionsadvancedsearch');
    }

}