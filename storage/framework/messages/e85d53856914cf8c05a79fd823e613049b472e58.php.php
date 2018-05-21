<?php

namespace App\Transactions\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 *
 * @package App\Transactions\Entities
 * @autor Carol Mirabal
 */
class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'user', 'ticket', 'amount', 'clienttransaction', 'balance', 'transactiontype', 'game', 'created_at', 'updated_at'];


    public function users()
    {
        return $this->belongsTo(User::class, 'user', 'id' );
    }

}