<?php

namespace App\Users\Entities;

use App\Clients\Entities\Client;
use App\Transactions\Entities\Transaction;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * Entity to manage the data of the users table
 *
 * @package App\Users\Entities
 * @author  Carol Mirabal
 */
class User extends Model
{

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'identify', 'email', 'username', 'client', 'dni', 'name', 'lastname'];


    public function clients()
    {
        return $this->belongsTo(Client::class, 'client');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'id', 'user');
    }

}
