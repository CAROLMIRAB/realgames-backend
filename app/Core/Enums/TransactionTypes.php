<?php
/**
 * Created by PhpStorm.
 * User: Carol Mirabal
 * Date: 17/8/2016
 * Time: 1:37 PM
 */

namespace App\Core\Enums;


class TransactionTypes
{
    /**
     * Debit transaction
     * @var int
     */
    public static $debit = 2;

    /**
     * Credit transaction.
     * @var int
     */
    public static $credit = 1;
}