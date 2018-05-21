<?php

namespace App\Core\Enums;

/**
 * Class Status
 *
 * @package App\Core\Enums
 * @author  Arniel Serrano
 * @author  Eborio Linarez
 * @author  Elio Martins
 * @author  Luis Suarez
 */
class Status
{
    /**
     * Correct responses
     *
     * @var string
     */
    public static $ok = 'OK';

    /**
     * Failed responses
     *
     * @var string
     */
    public static $failed = 'FAILED';

    /**
     * Error validations responses
     *
     * @var string
     */
    public static $error = 'ERROR';

    /**
     * Status active
     *
     * @var int
     */

    public static $active = 1;

    /**
     * Status inactive
     *
     * @var int
     */
    public static $inactive = 2;

    /**
     * Status locked
     *
     * @var int
     */
    public static $locked = 3;



}
