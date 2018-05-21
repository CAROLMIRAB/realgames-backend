<?php

namespace App\Clients\Entities;

use App\Users\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


/**
 * Class Client
 *
 * Entity to manage the data of the client table
 *
 * @property  password
 * @package App\Clients\Entities
 * @author  Carol Mirabal
 */
class Client extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    /**
     * Table
     *
     * @var string
     */
    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'ip', 'urlconfirm', 'currency', 'username', 'password', 'timezone','rol','status','email'];
    public $incrementing = false;
    public $timestamps = false;



    public function users()
    {
        return $this->hasMany(User::class, 'id', 'client');
    }


}
