<?php


Route::group(['prefix' => 'users', 'middleware' => ['web', 'auth']], function () {

    // Find users from sidebar
    Route::get('find-users/{username}', [
        'as' => 'users.find',
        'uses' => 'UsersController@findUsersByUsername'
    ]);

    // View search users
    Route::get('search-users', [
        'as' => 'users.search',
        'uses' => 'UsersController@searchUsers'
    ]);

    // View details de users
    Route::get('details/{user}', [
        'as' => 'users.details',
        'uses' => 'UsersController@searchUserDetails'
    ]);

    // Find details user by id
    Route::post('details-data-user/{user}', [
        'as' => 'users.detailsdata',
        'uses' => 'UsersController@findUserById'
    ]);

    // Data transactions by user id
    Route::get('details-transactions/{user}', [
        'as' => 'users.transactions',
        'uses' => 'UsersController@findTransactionsByUser'
    ]);

    // Update users data
    Route::post('{slug}/edit', [
        'as' => 'users.edit',
        'uses' => 'UsersController@editUser'
    ]);

    // View advanced search users
    Route::get('advanced-search', [
        'as' => 'users.advancedsearch',
        'uses' => 'UsersController@searchAdvancedView'
    ]);

    // Advanced search users
    Route::get('advanced-search-user', [
        'as' => 'users.advancedsearchuser',
        'uses' => 'UsersController@advancedSearchUser'
    ]);

});//END GROUP ROUTES
