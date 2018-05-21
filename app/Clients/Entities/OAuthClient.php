<?php

namespace App\Clients\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OAuth
 *
 * Entity to manage the data of the oauth_clients table
 *
 * @package App\Clients\Entities
 * @author  Arniel Serrano
 * @author  Eborio Linarez
 * @author  Elio Martins
 * @author  Luis Suarez
 */
class OAuthClient extends Model
{
    /**
     * Table
     *
     * @var string
     */
    protected $table = 'oauth_clients';

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = ['id', 'secret', 'name', 'created_at', 'updated_at'];

    /**
     * @var bool
     */
    public $incrementing = false;

}
