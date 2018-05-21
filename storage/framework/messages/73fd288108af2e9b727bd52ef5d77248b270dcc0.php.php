<?php

namespace App\Core\Collections;

use Illuminate\Support\Collection;
use Carbon\Carbon;
use League\Flysystem\Config;
use Xinax\LaravelGettext\Facades\LaravelGettext;
use App\Users\Repositories\UsersRepo;


/**
 * Class CoreCollection
 * @package App\Core\Collections
 * @author Carol Mirabal
 */
class CoreCollection
{


    /**
     * Prepare data from graphic dashboard
     *
     * @param $transactions
     * @return mixed
     */
    public function latestTransactions($transactions)
    {
        $currency = \Session::get('currency');
        $temp = new Collection();
        $txtwon = __('Ha Ganado!');
        $txtbet = __('Ha Apostado!');
        foreach ($transactions as $items) {
            $items->created = $items->created_at->format('d-m-Y h:i a');
            $temp->push([
                'id' => $items->id,
                'created_at' => $items->created,
                'name' => $items->name,
                'lastname' => $items->lastname,
                'transactiontype' => $items->transactiontype,
                'amount' => $currency['symbol'] . " " . number_format($items->amount, intval($currency['decimals']), $currency['decimalseparator'], $currency['thousandseparator']),
                'username' => $items->username,
                'txtwon' => $txtwon,
                'txtbet' => $txtbet
            ]);
        }
        return $temp;
    }

    /**
     * Prepare data for resume dashboard
     *
     * @param $totalUsers
     * @param $transactions
     * @param $yesterday
     * @return mixed
     */
    public function resumeData($totalUsers, $transactions, $yesterday)
    {

        $currency = \Session::get('currency');
        $result = collect();
        $played = "";
        $won = "";
        $profit = "";
        if (empty($transactions) || is_null($transactions)) {
            $result = [
                'totalusers' => $totalUsers,
                'played' => '0',
                'won' => '0',
                'profit' => '0',
                'symbol' => $currency['symbol'],
                'decimals' => intval($currency['decimals']),
                'decimalseparator' => $currency['decimalseparator'],
                'thousands' => $currency['thousandseparator']
            ];

        } else {
            foreach ($transactions as $items) {
                $profit = $items->played - $items->won;
                $played = $items->played;
                $won = $items->won;
                $result->push([
                    'totalusers' => $totalUsers,
                    'played' => $items->played,
                    'won' => $items->won,
                    'profit' => $profit,
                    'symbol' => $currency['symbol'],
                    'decimals' => intval($currency['decimals']),
                    'decimalseparator' => $currency['decimalseparator'],
                    'thousands' => $currency['thousandseparator']
                ]);
            }

            foreach ($yesterday as $items) {
                $profit_yesterday = $items->played - $items->won;
                $percent_played = ($items->played == 0) ? 0 : ($played - $items->played) / $played * 100;
                $percent_won = ($items->won == 0) ? 0 : ($won - $items->won) / $won * 100;
                $percent_profit = ($profit_yesterday == 0) ? 0 : ($profit - $profit_yesterday) / $profit * 100;
                $result->push([
                    'percent_played' => $percent_played,
                    'percent_won' => $percent_won,
                    'percent_profit' => $percent_profit,
                ]);
            }

        }
        return $result;
    }

    /**
     * View language
     *
     */
    public function language()
    {
        $language_active = "";
        $current = LaravelGettext::getLocale();
        $languages = [
            'en_GB' => __('Inglés'),
            'es_ES' => __('Español'),
        ];

        $html = '<ul class="menu">';
        foreach ($languages as $key => $language) {
            $flag_id = strtolower(substr($key, -2));
            $flag_img = "https://cdn.dotworkers.com/flags/" . $flag_id . ".png";
            $flag = "<img src='" . $flag_img . "' width='25' height='20'>";
            if ($current == $key) {
                $active = 'active';
                $language_active = "<span>" . $flag . " " . $language . "</span>";
            } else {
                $active = '';
            }
            $html .= sprintf(
                '<li class="%s li-language"><a href="%s">%s %s</a></li>',
                $active,
                route('dashboard.lang', $key),
                $flag,
                $language
            );
        }
        $html .= '</ul>';

        $data = [
            'language' => $html,
            'active' => $language_active
        ];


        return $data;
    }

    /**
     * Prepare data from graphic dashboard
     *
     * @param $transactions
     * @return mixed
     */
    public function transactionsGraphicData($transactions)
    {
        $currency = \Session::get('currency');
        $temp = collect();
        foreach ($transactions as $items) {
            $profit = $items->played - $items->won;
            $temp->push([
                'y' => $items->week,
                'a' => $items->played,
                'b' => $items->won,
                'c' => $profit,
                'decimals' => intval($currency['decimals']),
                'decimalSep' => $currency['decimalseparator'],
                'thousandSep' => $currency['thousandseparator'],
                'symbol' => $currency['symbol']
            ]);
        }
        $order = $temp->reverse();
        $result = $order->all();

        $data = [
            "won" => __('Ganado'),
            "played" => __('Jugado'),
            "profit" => __('Profit'),
            "week" => __('Semana'),
            "total" => __('Total'),
            "data" => $result
        ];

        return $data;
    }

    /**
     * Prepare data from graphic dashboard admin
     *
     * @param $transactions
     * @return mixed
     */
    public function transactionsGraphicDataAdmin($transactions)
    {
        $temp = new Collection();
        foreach ($transactions as $items) {
            $currency = \Session::get('currency');
            $profit = $items->played - $items->won;
            $temp->push([
                'y' => $items->client,
                'a' => $items->played,
                'b' => $items->won,
                'c' => $profit,
                'decimals' => intval($currency['decimals']),
                'decimalSep' => $currency['decimalseparator'],
                'thousandSep' => $currency['thousandseparator'],
                'symbol' => $currency['symbol'],

            ]);
        }
        $data = [
            "won" => __('Ganado'),
            "played" => __('Jugado'),
            "profit" => __('Profit'),
            "week" => __('Semana'),
            "total" => __('Total'),
            "data" => $temp
        ];

        return $data;
    }

    public function topPlayersData($players)
    {
        $i = 1;
        $div1 = "<div class='nav-tabs-custom'>
                    <ul class='nav nav-tabs'>
                        <li class='active'><a href='#tab_1' data-toggle='tab'>" . __('Usuarios') . "</a></li>";
        $div2 = "<div class='tab-content'>
                        <div class='tab-pane active' id='tab_1'>
                            <b></b>
                            <ul class='users-list clearfix'>";
        foreach ($players as $item) {
            $tab = "tab_" . $i;
            $div1 .= " <li><a href='#" . $tab . "' data-toggle='tab' class='tabs' data-id='" . $item->id . "'>" . $item->username . "</a></li>";

            $div2 .= " <li> <img src='https://almsaeedstudio.com/themes/AdminLTE/dist/img/user1-128x128.jpg'
                                         alt='User Image'>
                                    <a class='users-list-name' href='#'>" . $item->username . "</a>
                                    <span class='users-list-date'>" . $item->name . " " . $item->lastname . "</span>
                                </li>";

            $div3 = "<div class='tab-pane' id='" . $tab . "' data-id=" . $item->id . ">

                        </div>";
            $i++;
        }
        $div1 .= "</ul>";
        $div2 .= "</ul></div>";
        $div3 .= "  </div></div>";

        $top = $div1 . "" . $div2 . "" . $div3;

        return ['top' => $top];
    }

}