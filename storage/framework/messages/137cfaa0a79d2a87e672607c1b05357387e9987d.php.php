<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Users\Collections\UsersCollection;
use App\Users\Managers\UsersManager;
use App\Users\Repositories\UsersRepo;
use Yajra\Datatables\Datatables;

/**
 * Class UsersController
 *
 * Class to manage the users requests
 *
 * @package App\Http\Controllers
 * @author  Carol Mirabal
 */
class UsersController extends Controller
{
    private $userManager;
    private $userRepo;
    private $userCollection;

    /**
     * UsersController constructor.
     *
     * @param UsersManager $userManager
     * @param UsersRepo $userRepo
     * @param UsersCollection $userCollection
     */
    public function __construct(UsersManager $userManager, UsersRepo $userRepo, UsersCollection $userCollection)
    {
        $this->userManager = $userManager;
        $this->userRepo = $userRepo;
        $this->userCollection = $userCollection;
    }

    /**
     * Advanced users search
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function advancedSearchUser()
    {
        try {
            $id = trim(\Request::input('id'));
            $dni = strtolower(trim(\Request::input('dni')));
            $name = strtolower(trim(\Request::input('name')));
            $lastname = strtolower(trim(\Request::input('lastname')));
            $username = strtolower(trim(\Request::input('username')));
            $email = strtolower(trim(\Request::input('email')));


            $users = $this->userRepo->advancedSearch($id, $username, $email, $dni, $name, $lastname, \Auth::user()->id);
            $usersdata = $this->userCollection->userDataTable($users);

            $result = Datatables::of($usersdata)->make();

        } catch (\Exception $ex) {
            \Log::error('UsersController.advancedSearchUser.catch', ['exception' => $ex]);
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
     * Edit user from details
     *
     * @return mixed
     */
    public function editUser()
    {
        try {
            $field = \Request::input('name');
            $value = \Request::input('value');
            $userid = \Request::input('pk');
            if ($field == 'email') {
                $result = $this->userRepo->updateUser($userid, $field, strtolower($value));
            } else {
                $result = $this->userRepo->updateUser($userid, $field, $value);
            }

        } catch (\Exception $ex) {
            \Log::error('UsersController.editUser.catch', ['exception' => $ex]);
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
     * Gets all transactions detail by user id for datatable
     *
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function findTransactionsByUser($user)
    {
        try {
            $current_date = Carbon::now();
            $current_date->setTimezone(\Session::get('timezone'));
            $transactions = $this->userRepo->findTransactionsByUser($user, \Auth::user()->id, \Session::get('timezone'));
            $data = $this->userCollection->transactionsByUser($transactions);
        } catch (\Exception $ex) {
            \Log::error('UsersController.findTransactionsByUser.catch', ['exception' => $ex]);
            $data = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Busqueda fallida')
            ];
        }
        return Datatables::of($data)->make();
    }

    /**
     * find users by username
     *
     * @param $username
     * @return \Illuminate\Http\JsonResponse
     */
    public function findUsersByUsername($username)
    {
        try {
            $users = $this->userRepo->findUsersByUsername(strtolower($username), \Auth::user()->id);
            $usersdata = $this->userCollection->userDataTable($users);
            $result = Datatables::of($usersdata)->make();
        } catch (\Exception $ex) {
            \Log::error('UsersController.findUsersByUsername.catch', ['exception' => $ex]);
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
     * Find users by id
     *
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function findUserById($user)
    {
        try {
            $result = $this->userRepo->findUserById($user, \Auth::user()->id);
        } catch (\Exception $ex) {
            \Log::error('UsersController.findUsersById.catch', ['exception' => $ex]);
            $result = [
                'status' => 'FAILED',
                'title' => __('¡Error!'),
                'message' => __('Busqueda fallida')
            ];
        }
        return response()->json($result);
    }

    /**
     * Obtain user from sidebar
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchUsers()
    {
        $username = \Request::input('username');
        return view('users.find', ['username' => $username]);
    }

    /**
     *View search advanced user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function searchAdvancedView()
    {
        return view('users.advancedsearch');
    }

    /**
     * Redirects view details user
     *
     * @param $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchUserDetails($user)
    {
        return view('users.details', array('user' => $user));
    }

}