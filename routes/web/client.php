<?php

// Show login view
Route::get('', [
    'middleware' => ['web', 'guest'],
    'as' => 'clients.login',
    'uses' => 'ClientsController@showLogin'
]);

/**
 * Clients unauthenticated routes
 */
Route::group(['prefix' => 'clients', 'middleware' => ['web', 'guest']], function () {
    // Login
    Route::post('', [
        'as' => 'clients.post-login',
        'uses' => 'AuthController@login'
    ]);
});

/**
 * Clients Authenticated routes
 */
Route::group(['prefix' => 'clients', 'middleware' => ['web', 'auth']], function () {

    // Logout
    Route::get('logout', [
        'as' => 'clients.logout',
        'uses' => 'AuthController@logout'
    ]);

    // Edit client
    Route::post('{slug}/edit', [
        'as' => 'clients.edit',
        'uses' => 'ClientsController@editClient'
    ]);

    // Show client details view
    Route::get('details', [
        'as' => 'clients.details',
        'uses' => 'ClientsController@clientDetailsView'
    ]);

    // Find clients by username
    Route::post('details/{username}', [
        'as' => 'clients.detailsdata',
        'uses' => 'ClientsController@findByUsername'
    ]);

    // Edit clients password
    Route::post('edit-password', [
        'as' => 'clients.editpassword',
        'uses' => 'ClientsController@editPassword'
    ]);

    // Edit client URL
    Route::post('edit-url', [
        'as' => 'clients.editurl',
        'uses' => 'ClientsController@editUrl'
    ]);

    // Edit client IP
    Route::post('edit-ip', [
        'as' => 'clients.editip',
        'uses' => 'ClientsController@editIp'
    ]);

    // View search client
    Route::get('search-client', [
        'as' => 'clients.search',
        'uses' => 'ClientsController@searchClients'
    ]);

    //Find clients
    Route::get('find-clients/{username}', [
        'as' => 'clients.find',
        'uses' => 'ClientsController@findClientByUsername'
    ]);

    // View search client
    Route::get('search-client', [
        'as' => 'clients.searchclients',
        'uses' => 'ClientsController@searchClients'
    ]);

    //Find clients
    Route::get('find-clients/{username}', [
        'as' => 'clients.findclients',
        'uses' => 'ClientsController@findClientByUsername'
    ]);

    //View create clients
    Route::get('create-clients', [
        'as' => 'clients.createclients',
        'uses' => 'ClientsController@createClientsView'
    ]);

    //Create Clients
    Route::post('create-client-post', [
        'as' => 'clients.create-post',
        'uses' => 'ClientsController@createClients'
    ]);

    //Create Clients
    Route::get('advanced-search', [
        'as' => 'clients.advance-search-clients',
        'uses' => 'ClientsController@advancedSearchClients'
    ]);

    Route::get('advanced-search-clients', [
        'as' => 'clients.advanced-search-clients-view',
        'uses' => 'ClientsController@advancedSearchClientsView'
    ]);

    Route::get('advanced-search-selects', [
        'as' => 'clients.selects',
        'uses' => 'ClientsController@clientsSelects'
    ]);

    Route::post('update-client', [
        'as' => 'clients.update',
        'uses' => 'ClientsController@updateClients'
    ]);

    Route::post('send-password', [
        'as' => 'clients.sendpassword',
        'uses' => 'ClientsController@sendPassword'
    ]);

});//END GROUP ROUTES
