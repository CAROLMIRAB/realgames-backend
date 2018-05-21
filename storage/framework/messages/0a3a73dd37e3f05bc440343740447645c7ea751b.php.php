<?php

namespace App\Transactions\Repositories;

use App\Entities\RealGamesGame;
use App\Transactions\Entities\Transaction;

/**
 * Class TransactionsRepo
 *
 * Repository to manage the data of the Transactions entity
 *
 * @package App\Transactions\Repositories
 * @author  Carol Mirabal
 */
class TransactionsRepo
{

    /**
     * @param $startDate
     * @param $endDate
     * @param $idtransaction
     * @param $username
     * @param $idgame
     * @param $gamename
     * @param $client
     */
    public function advancedSearch($client, $startDate, $endDate, $idtransaction, $username, $idgame, $gamename, $timezone)
    {
        $query = "select transactions.id, users.username, realgamesgames.title, transactions.game,  transactions.amount, transactions.transactiontype from transactions 
                  LEFT JOIN users on users.id = transactions.user 
                  LEFT JOIN realgamesgames on realgamesgames.gameid = transactions.game";

        $conditions = " where users.client = '$client' AND (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE BETWEEN '$startDate' AND '$endDate'";

        if (!empty($idtransaction)) {
            $conditions .= " and transactions.id = '$idtransaction'";
        }
        if (!empty($username)) {
            $conditions .= " and lower(users.username) like '" . $username . "%'";
        }
        if (!empty($idgame)) {
            $conditions .= " and  transactions.game = '$idgame '";
        }
        if (!empty($gamename)) {
            $conditions .= " and lower(realgamesgames.title) like '" . $gamename . "%'";
        }
        $conditions .= ' ORDER BY transactions.id DESC ';
        $query = $query . $conditions;
        $result = \DB::select($query);
        return $result;
    }

    /**
     *Search sum all transactions by week
     *
     * @param $client
     * @param $month
     * @return
     */
    public function findTotalTransactionsByWeek($client, $month)
    {
        if (empty($month)) {
            $condition = "";
            $limit = " limit 4";
        } else {
            $condition = "and extract(MONTH from transactions.created_at)= " . $month;
            $limit = "";
        }

        $transactions = \DB::select("select extract(week from total.week) as week, sum(total.played) as played , sum(total.won) as won from (
        SELECT
        date_trunc('week', transactions.created_at) as week,
        case when transactiontype=2 then sum(amount) else 0 end as played,
        case when transactiontype=1 then sum(amount) else 0 end as won,
        transactions.id
        from transactions
        LEFT JOIN users on users.id=transactions.user
        WHERE users.client='$client'
        $condition
        GROUP BY week, transactiontype,transactions.id ) total
        group by week
        order by week DESC
        $limit
        ");
        return $transactions;
    }

    /**
     *Search sum all transactions and group by clients
     *
     * @param $timezone
     * @param $today
     * @return
     */
    public function transactionsClientsDay($today, $timezone)
    {

        $transactions = \DB::select("select total.client, sum(total.played) as played , sum(total.won) as won from (
            SELECT
            users.client as client,
            case when transactiontype = 2 then sum(amount) else 0 end as played,
            case when transactiontype = 1 then sum(amount) else 0 end as won,
            transactions.id
            from transactions
            LEFT JOIN users on users.id=transactions.user
            WHERE (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE = '$today'
            GROUP BY client,transactiontype,transactions.id ) total
            group by client
            order by client ASC
            ");
        return $transactions;
    }

    /**
     * Find 20 latest transactions
     *
     * @param $client
     * @param $timezone
     * @return
     */
    public function allProviders()
    {

        $query = \DB::select("select software from realgamesgames GROUP BY software");
        return $query;
    }

    /**
     * Find 20 latest transactions
     *
     * @param $client
     * @param $timezone
     * @return
     */
    public function findLatestTransactions($client, $timezone)
    {
        $transactions = Transaction::select('transactions.id', \DB::raw("transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '" . $timezone . "' as created_at"), 'transactiontype', 'users.username', 'amount', 'name', 'lastname')
            ->leftJoin('users', 'users.id', '=', 'transactions.user')
            ->where('users.client', $client)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        return $transactions;
    }

    /**
     * Search sum all transactions by day
     *
     * @param $client
     * @param $timezone
     * @param $today
     * @return
     */
    public function findTransactionsByDay($client, $timezone, $today)
    {
        $transactions = \DB::select("select sum(total.played) as played ,sum(total.won) as won from (
        SELECT
        case when transactiontype=2 then sum(amount) else 0 end as played,
        case when transactiontype=1 then sum(amount) else 0 end as won
        from transactions
        LEFT JOIN users on users.id=transactions.user
        WHERE users.client='$client'
        AND (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE = '$today'
        GROUP BY transactiontype ) total
        ");

        return $transactions;
    }

    /**
     * Get profit by user
     *
     * @param $client
     * @param $dateFrom
     * @param $dateAt
     * @param $transactionsType
     * @param $timezone
     * @param $user
     * @return mixed
     */
    public function profitByUser($client, $dateFrom, $dateAt, $transactionsType, $timezone, $user)
    {
        $query = Transaction::join('users', 'transactions.user', '=', 'users.id')
            ->where('users.client', '=', $client)
            ->where('users.id', '=', $user)
            ->where('transactions.transactiontype', '=', $transactionsType)
            ->whereBetween(\DB::raw("(transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '" . $timezone . "')::DATE"), [$dateFrom, $dateAt])
            ->sum('amount');

        return $query;
    }

    /**
     * Get profit by game
     *
     * @param $startDate
     * @param $endDate
     * @param $client
     * @param $provider
     * @param $timezone
     * @return mixed
     */
    public function profitByGame($startDate, $endDate, $client, $provider, $timezone)
    {

        $query = \DB::select("  SELECT title, software, sum(played) as played, sum(won) as won from (select * from (select total.title, total.software, sum(total.played) as played ,sum(total.won) as won 
				from (
        SELECT
        case when transactiontype=2 then sum(amount) else 0 end as played,
        case when transactiontype=1 then sum(amount) else 0 end as won,
				realgamesgames.title as title,
        realgamesgames.software as software
        from transactions
        LEFT JOIN users on users.id=transactions.user
        LEFT JOIN realgamesgames on realgamesgames.gameid = transactions.game
        WHERE users.client='$client'
				AND realgamesgames.software = '$provider'
				AND (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE BETWEEN '$startDate' AND '$endDate'
        GROUP BY transactiontype, realgamesgames.title, realgamesgames.software) as total
        GROUP by total.title, total.software) val
        UNION
        SELECT title, software, 0 as played, 0 as won from realgamesgames
				where software = '$provider'
        GROUP BY title, software) as soft
        GROUP BY soft.software, soft.title
				order by played desc
");
        return $query;
    }

    /**
     * Get profit by game
     *
     * @param $startDate
     * @param $endDate
     * @param $client
     * @param $user
     * @param $timezone
     * @return mixed
     */
    public function profitByUsersProvider($startDate, $endDate, $client, $user, $timezone)
    {

        $query = \DB::select("select total.software, total.title, sum(total.played) as played ,sum(total.won) as won from (
        SELECT
        case when transactiontype=2 then sum(amount) else 0 end as played,
        case when transactiontype=1 then sum(amount) else 0 end as won,
        realgamesgames.software as software,
				realgamesgames.title as title
        from transactions
        LEFT JOIN users on users.id=transactions.user
        LEFT JOIN realgamesgames on realgamesgames.gameid = transactions.game
        WHERE users.client='$client'
        and users.id ='$user'
        and (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE BETWEEN '$startDate' AND '$endDate'
        GROUP BY transactiontype, realgamesgames.software, realgamesgames.title) total
        GROUP by total.software, total.title
");
        return $query;
    }

    /**
     * Find 20 latest transactions
     *
     * @param $client
     * @param $dateFrom
     * @param $dateAt
     * @param $timezone
     * @return
     */
    public function profitByProvider($client, $dateFrom, $dateAt, $timezone)
    {
        $transactions = \DB::select("SELECT software, sum(played) as played, sum(won) as won from (select * from (select total.software, sum(total.played) as played ,sum(total.won) as won from (
        SELECT
        case when transactiontype=2 then sum(amount) else 0 end as played,
        case when transactiontype=1 then sum(amount) else 0 end as won,
        realgamesgames.software as software
        from transactions
        LEFT JOIN users on users.id=transactions.user
        LEFT JOIN realgamesgames on realgamesgames.gameid = transactions.game
        WHERE users.client='$client'
        and (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE BETWEEN '$dateFrom' AND '$dateAt'
        GROUP BY transactiontype, realgamesgames.software) as total
        GROUP by total.software) val
        UNION
        SELECT software, 0 as played, 0 as won from realgamesgames
        GROUP BY software) as soft
        GROUP BY soft.software
");
        return $transactions;
    }

    /**
     * Quantity of spin by game
     *
     * @param $client
     * @param $dateFrom
     * @param $dateAt
     * @param $timezone
     * @return mixed
     */
    public function quantitySpin($client, $dateFrom, $dateAt, $timezone)
    {
        $transactions = \DB::select("select sum(soft.spin) as spin, gamename, software, image  from (select * from (SELECT
        count(*) AS spin,
        realgamesgames.title as gamename,
        realgamesgames.software as software,
        realgamesgames.image as image
        from transactions
        LEFT JOIN users on users.id=transactions.user
        LEFT JOIN realgamesgames on realgamesgames.gameid = transactions.game
        WHERE users.client= '$client'
				and transactiontype=2
        AND (transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '$timezone')::DATE BETWEEN '$dateFrom' AND '$dateAt'
        GROUP BY transactiontype, realgamesgames.title, realgamesgames.software, realgamesgames.image)val
        UNION
        SELECT  0 as spin,title,software, image from realgamesgames
        GROUP BY title, software, spin, image) as soft
        GROUP BY gamename,software, image
        ORDER BY spin DESC
");
        return $transactions;

    }

    /**
     * Get total profit
     *
     * @param $client
     * @param $dateFrom
     * @param $dateAt
     * @param $transactionsType
     * @param $timezone
     * @return mixed
     */
    public function sumTransactions($client, $dateFrom, $dateAt, $transactionsType, $timezone)
    {
        $query = Transaction::join('users', 'transactions.user', '=', 'users.id')
            ->where('users.client', '=', $client)
            ->where('transactions.transactiontype', '=', $transactionsType)
            ->whereBetween(\DB::raw("(transactions.created_at::TIMESTAMP WITH TIME ZONE AT TIME ZONE '" . $timezone . "')::DATE"), [$dateFrom, $dateAt])
            ->sum('amount');

        return $query;
    }


}
