<?php

Route::group(['prefix' => 'dashboard', 'middleware' => ['web', 'auth']], function ()
{
    // View dashboard
    Route::get('', [
        'as' => 'dashboard',
        'uses' => 'CoreController@dashboard'
    ]);

    // Data of dashboard resume
    Route::post('dashboard-resume', [
        'as' => 'dashboard.resume',
        'uses' => 'CoreController@dashboardResume'
    ]);

    // Data grafic dashboard
    Route::get('dashboard-graphictransactions', [
        'as' => 'dashboard.graphictransactions',
        'uses' => 'CoreController@transactionsGraphic'
    ]);

    // latest transactions dashboard
    Route::get('dashboard-latesttransactions', [
        'as' => 'dashboard.latesttransactions',
        'uses' => 'CoreController@latestTransactions'
    ]);

    // Data grafic dashboard admin
    Route::get('dashboard-graphictransactionsadmin', [
        'as' => 'dashboard.graphictransactionsadmin',
        'uses' => 'CoreController@transactionsGraphicAdmin'
    ]);

    // language
    Route::get('dashboard-language', [
        'as' => 'dashboard.language',
        'uses' => 'CoreController@language'
    ]);

    Route::get('lang/{locale?}', [
        'as'=>'dashboard.lang',
        'uses'=>'CoreController@changeLang'
    ]);

    Route::get('dashboard-top-players}', [
        'as'=>'dashboard.topplayers',
        'uses'=>'CoreController@topPlayers'
    ]);

    Route::get('dashboard-favorites-games}', [
        'as'=>'dashboard.favoritesgames',
        'uses'=>'CoreController@favoritesGames'
    ]);
});

