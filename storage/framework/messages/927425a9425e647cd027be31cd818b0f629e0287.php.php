<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RealGamesGame
 *
 * Class to define realgamesgames table attributes
 *
 * @package App\Entities
 * @author  Eborio Linarez
 */
class RealGamesGame extends Model
{
    /**
     * Table
     *
     * @var string
     */
    protected $table = 'realgamesgames';

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
    protected $fillable = ['id', 'title', 'name', 'image', 'software', 'slug', 'status'];
}
