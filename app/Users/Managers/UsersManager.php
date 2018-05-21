<?php

namespace App\Users\Managers;

use Illuminate\Support\Facades\Validator;
use App\Users\Repositories\UsersRepo;
use App\Core\Utils;
use App\Core\Enums\Status;
use App\Core\Enums\Codes;
use Dotworkers\FantasyWrapper\Fantasy;

/**
 * Class UsersManager
 *
 * @package App\Clients\Managers
 * @author  Carol Mirabal
 */
class UsersManager
{
   /**
    * @var UsersRepo
    */
   private $userRepo;


   /**
    * @param UsersRepo $userRepo
    */
   function __construct(UsersRepo $userRepo)
   {
      $this->userRepo = $userRepo;

   }



}
