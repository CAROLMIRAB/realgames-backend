<?php
Route::group(['prefix' => 'transaction', 'middleware' => ['web', 'auth']], function () {


    // View advanced search trasaction
    Route::get('transactions-advancedsearch', [
        'as' => 'transactions.viewtransactionsadvancedsearch',
        'uses' => 'TransactionsController@viewTransactionsAdvancedsearch'
    ]);

    // Advanced search transaction
    Route::get('transactions-data-advancedsearch', [
        'as' => 'transactions.transactionsadvancedsearch',
        'uses' => 'TransactionsController@TransactionsAdvancedsearch'
    ]);

});