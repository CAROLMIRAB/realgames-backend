<?php
Route::group(['prefix' => 'reports', 'middleware' => ['web', 'auth']], function ()
{
    // View report profit
    Route::get('profit', [
        'as' => 'reports.profit',
        'uses' => 'ReportsController@profit'
    ]);

    //Data profit report
    Route::post('profit-data', [
        'as' => 'reports.profit.data',
        'uses' => 'ReportsController@profitData'
    ]);

    //Data profit report
    Route::post('profit-data-admin', [
        'as' => 'reports.profit-data-admin',
        'uses' => 'ReportsController@profitDataAdmin'
    ]);

    //Data profit report by user
    Route::post('profit-data-user', [
        'as' => 'reports.profitdatauser',
        'uses' => 'ReportsController@profitByUser'
    ]);

    // View report profit admin
    Route::get('profit-client', [
        'as' => 'reports.profitbyclient',
        'uses' => 'ReportsController@viewProfitAdmin'
    ]);

    // View report profit by user
    Route::get('profit-user', [
        'as' => 'reports.profitbyuser',
        'uses' => 'ReportsController@viewProfitByUser'
    ]);

    // View report profit by provider
    Route::get('profit-provider', [
        'as' => 'reports.profitbyprovider',
        'uses' => 'ReportsController@viewProfitByProvider'
    ]);

    Route::get('profit-provider-data', [
        'as' => 'reports.profitbyproviderdata',
        'uses' => 'ReportsController@profitByProvider'
    ]);

    Route::get('profit-find-provider', [
        'as' => 'reports.findprovider',
        'uses' => 'ReportsController@findProvider'
    ]);

    Route::get('profit-provider-total', [
        'as' => 'reports.profitbyprovidertotal',
        'uses' => 'ReportsController@totalProfitByProvider'
    ]);

    // View report profit by game
    Route::get('profit-game', [
        'as' => 'reports.profitbygame',
        'uses' => 'ReportsController@viewProfitByGame'
    ]);

    Route::get('profit-data-game', [
        'as' => 'reports.profitdatagame',
        'uses' => 'ReportsController@profitByGame'
    ]);

    // View report profit by game
    Route::get('profit-data-provider', [
        'as' => 'reports.profituserprovider',
        'uses' => 'ReportsController@profitByUsersProvider'
    ]);

    // View report spin by game
    Route::get('spin-game', [
        'as' => 'reports.spinbygame',
        'uses' => 'ReportsController@viewSpinByGame'
    ]);

    //data controller spin report
    Route::get('spin-game-data', [
        'as' => 'reports.spinbygamedata',
        'uses' => 'ReportsController@quantitySpin'
    ]);

    Route::get('spin-game-first', [
        'as' => 'reports.spinbygamefirst',
        'uses' => 'ReportsController@firstThree'
    ]);

    Route::get('reports-users-search', [
        'as' => 'reports.searchUsers',
        'uses' => 'ReportsController@searchUsers'
    ]);

    // Profit clients data
    Route::get('profit-general-clients-data', [
        'as' => 'reports.profitgeneralclientsdata',
        'uses' => 'ReportsController@getProfitGeneralClient'
    ]);

    // View report profit clients
    Route::get('profit-general-clients', [
        'as' => 'reports.profitgeneralclients',
        'uses' => 'ReportsController@viewProfitGeneralClient'
    ]);

    // Totals profit client data
    Route::post('profit-general-clients-totals', [
        'as' => 'reports.profitgeneralclientstotals',
        'uses' => 'ReportsController@getTotalProfitClient'
    ]);


    // Profit users data
    Route::get('profit-general-users-data', [
        'as' => 'reports.profitgeneralusersdata',
        'uses' => 'ReportsController@getProfitGeneralUser'
    ]);

    // View report profit users
    Route::get('profit-general-users', [
        'as' => 'reports.profitgeneralusers',
        'uses' => 'ReportsController@viewProfitGeneralUser'
    ]);

    // Totals profit user data
    Route::post('profit-general-users-totals', [
        'as' => 'reports.profitgeneraluserstotals',
        'uses' => 'ReportsController@getTotalProfitUsers'
    ]);
});
