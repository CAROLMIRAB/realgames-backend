<?php

namespace App\Reports\Collections;

use Illuminate\Support\Collection;

class ReportsCollection
{
    public function dataProfit($purchase, $won)
    {
        $currency = \Session::get('currency');

        if (is_null($purchase)) {
            $purchase = 0;
        }
        if (is_null($won)) {
            $won = 0;
        }

        $profit = $purchase - $won;

        $response = [
            'status' => 'SUCCESS',
            'title' => __('Operación realizada con éxito'),
            'data' => [
                'purchase' => $currency['symbol'] . " " . number_format($purchase, 2, '.', ','),
                'won' => $currency['symbol'] . " " . number_format($won, 2, '.', ','),
                'profit' => $currency['symbol'] . " " . number_format($profit, 2, '.', ',')
            ]
        ];

        return $response;
    }

    /**
     *
     * @param $profit
     * @return string
     * @internal param $profitData
     */
    public function profitGame($profit)
    {
        $currency = \Session::get('currency');

        $games = new Collection();

        foreach ($profit as $items) {

            $profit = $items->played - $items->won;

            $games->push([
                'title' => $items->title,
                'software' => $items->software,
                'purchase' => $currency['symbol'] . " " . number_format($items->played, intval($currency['decimals']), $currency['decimalseparator'], $currency['thousandseparator']),
                'won' => $currency['symbol'] . " " . number_format($items->won, intval($currency['decimals']), $currency['decimalseparator'], $currency['thousandseparator']),
                'profit' => $currency['symbol'] . " " . number_format($profit, intval($currency['decimals']), $currency['decimalseparator'], $currency['thousandseparator']),
            ]);
        }
        return $games;
    }

    /**
     *
     * @param $profit
     * @return string
     * @internal param $profitData
     */
    public function profitUsersProvider($profit)
    {
        $currency = \Session::get('currency');

        $games = new Collection();

        foreach ($profit as $items) {

            $profit = $items->played - $items->won;

            $games->push([
                'title' => $items->title,
                'software' => $items->software,
                'purchase' => $currency['symbol'] . " " . number_format($items->played, intval($currency['decimals']), $currency['decimalseparator'], $currency['thousandseparator']),
                'won' => $currency['symbol'] . " " . number_format($items->won, intval($currency['decimals']), $currency['decimalseparator'], $currency['thousandseparator']),
                'profit' => $currency['symbol'] . " " . number_format($profit, intval($currency['decimals']), $currency['decimalseparator'], $currency['thousandseparator']),
            ]);
        }
        return $games;
    }

    public function allProviders($providersData)
    {
        $providers = collect();

        foreach ($providersData as $provider) {
            $provider = "<option value='" . ($provider->software) . "'>" . strtoupper($provider->software) . "</option>";

            $providers->push(['provider' => $provider]);
        }
        return $providers;
    }

    /**
     * Reports data html profit provider
     *
     * @param $profitData
     * @return string
     */
    public function profitProvider($profitData)
    {

        $currency = \Session::get('currency');
        $providers = collect();

        foreach ($profitData as $items) {

            $profit = $items->played - $items->won;

            $provider = "<div class='col-md-6 col-xs-12'>
        <div class='box box-widget widget-user'>
            <div class='widget-user-header bg-gray'>
              <h3 class='widget-user-username'><strong>" . strtoupper($items->software) . "</strong></h3>
            </div>
            <div class='widget-user-image'>
              <img class='img' src='https://cdn2.iconfinder.com/data/icons/advertisement-marketing/512/world_class-512.png'>
            </div>
            <div class='box-footer'>
              <div class='row'>
                <div class='col-sm-4 border-right'>
                  <div class='description-block'>
                  <i class='fa fa-cubes img-circle bg-green logo-providers'></i>
                    <h5 class='description-header'>" . number_format($items->played, intval($currency['decimals']), $currency['decimalseparator'], $currency['thousandseparator']) . "</h5>
                    <span class='description-text'>" . __('JUGADO') . "</span>
                  </div>
                </div>
                <div class='col-sm-4 border-right'>
                  <div class='description-block'>
                   <i class='ion ion-ribbon-b img-circle bg-red logo-providers'></i>
                    <h5 class='description-header'>" . number_format($items->won, intval($currency['decimals']), $currency['decimalseparator'], $currency['thousandseparator']) . "</h5>
                    <span class='description-text'>" . __('GANADO') . "</span>
                  </div>
                </div>
                <div class='col-sm-4'>
                  <div class='description-block'>
                   <i class='ion ion-bag img-circle bg-aqua logo-providers'></i>
                    <h5 class='description-header'>" . number_format($profit, intval($currency['decimals']), $currency['decimalseparator'], $currency['thousandseparator']) . "</h5>
                    <span class='description-text'>" . __('PROFIT') . "</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>";

            $providers->push(['profit' => $provider]);
        }

        return $providers;
    }


    /**
     * Reports data html profit provider
     *
     * @param $data
     * @return string
     */
    public function quantitySpin($data)
    {
        $games = collect();

        $max = max($data);
        $index = 0;
        foreach ($data as $items) {
            $img = "https://cdn.dotworkers.com/realgames/140x140/" . $items->image;
            switch ($index) {
                case 0:
                    switch ($items->spin) {
                        case (!0):
                            $progress = "<div class='progress progress-xs'><div class='progress-bar progress-bar-yellow' style='width: 100%'></div></div>";
                            $spin = "<span data-val='" . $items->spin . "'  style='font-size:20px' class='badge bg-yellow'>" . $items->spin . "</span>";
                            break;
                        case 0:
                            $progress = "<div class='progress progress-xs'><div class='progress-bar progress-bar-yellow' style='width: 0%'></div></div>";
                            $spin = "<span data-val='" . $items->spin . "'  style='font-size:20px' class='badge bg-yellow'>" . $items->spin . "</span>";
                            break;
                    }
                    break;
                case (!0):
                    if ($items->spin == 0) {
                        $progress = "<div class='progress progress-xs'><div class='progress-bar progress-bar-aqua' style='width: 0%'></div></div>";
                        $spin = "<span data-val='" . $items->spin . "'  style='font-size:20px' class='badge bg-aqua'>" . $items->spin . "</span>";
                    } else {
                        $percent = $items->spin * 100 / $max->spin;
                        $progress = "<div class='progress progress-xs'><div class='progress-bar progress-bar-aqua' style='width: " . $percent . "%'></div></div>";
                        $spin = "<span data-val='" . $items->spin . "'  style='font-size:20px'  class='badge bg-aqua'>" . $items->spin . "</span>";
                    }
                    break;
            }

            $games->push([
                'img' => "<img class='img-circle' style='width:60px; height:60px' src='" . $img . "' alt='Game'>",
                'game' => $items->gamename,
                'software' => $items->software,
                'progress' => $progress,
                'spin' => $spin
            ]);

            $index++;
        }

        return $games;
    }

    /**
     * first three games by spin
     *
     * @param $games
     */
    public function firstThree($games)
    {
        $collection = collect();
        $index = 1;
        foreach ($games as $game) {
            $img = "https://cdn.dotworkers.com/realgames/270x152/" . $game->image;
            $data = "<div class='box box-widget widget-user'>
                        <div class='widget-user-header bg-black'
                             style='background: url(" . $img . ")'>
                            <h3 class='widget-user-username bg-black label'><strong>" . $game->gamename . "</strong></h3><br>
                            <h5 class='widget-user-desc bg-black label'><strong>" . $game->software . "</strong></h5>
                        </div>
                        <div class='widget-user-image bg-gray'>
                        <strong>
                           " . $game->spin . "
                           </strong>
                        </div>
                        <div class='box-footer'>
                            <div class='row'>
                                <div class='col-sm-4 col-sm-offset-4 border-right'>
                                    <div class='description-block'>
                                        <h5 class='description-header'>" . $index . "</h5>
                                        <span class='description-text'>" . __('LUGAR') . "</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>";

            $collection->push([
                'position' => $index,
                'game' => $data
            ]);

            if (++$index == 4) break;
        }

        return $collection;
    }

    /**
     * Data total profit
     *
     * @param $transactions
     * @return array
     */
    public function dataResumeProfit($transactions)
    {
        $currency = \Session::get('currency');

        foreach ($transactions as $items) {
            $response = [
                'status' => 'SUCCESS',
                'title' => __('Operación realizada con éxito'),
                'data' => [
                    'purchase' => $currency['symbol'] . " " . number_format($items->played, 2, '.', ','),
                    'won' => $currency['symbol'] . " " . number_format($items->won, 2, '.', ','),
                    'profit' => $currency['symbol'] . " " . number_format($items->profit, 2, '.', ',')
                ]
            ];
        }

        return $response;
    }

    /**
     * Profit client datatable
     *
     * @param $transactions
     * @return Collection
     */
    public function profitGeneral($transactions)
    {
        $currency = \Session::get('currency');
        $result = collect();
        foreach ($transactions as $items) {
            $result->push([
                'username' => $items->id,
                'deposit' => $items->deposit,
                'withdrawal' => $items->withdrawal,
                'profit' => $items->profit,
                'decimals' => intval($currency['decimals']),
                'decimalseparator' => $currency['decimalseparator'],
                'thousandseparator' => $currency['thousandseparator']
            ]);
        }

        return $result;
    }

}