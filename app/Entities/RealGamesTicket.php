<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RealGamesTicket
 *
 * Class to define realgamestickets table attributes
 *
 * @package App\Entities
 * @author  Eborio Linarez
 */
class RealGamesTicket extends Model
{
    /**
     * Table
     *
     * @var string
     */
    protected $table = 'realgamestickets';

    /**
     * Connection
     *
     * @var string
     */
    protected $connection = 'jel';

    /**
     * Primary key
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = ['id', 'user', 'ip', 'tradeid', 'game', 'transactiontype', 'betamount', 'winlose', 'userbalance', 'betdate'];
}
