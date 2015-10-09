<?php
Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/login', 'Auth\AuthController@getIndex');
Route::post('auth/login', 'Auth\AuthController@postIndex');

Route::group(
    ['namespace' => 'Api', 'prefix' => 'api', 'middleware' => 'cors'],
    function () {

        /**
         * Authentication
         */
        Route::post('api-token-auth', 'AuthenticationController@authorize');
        Route::post('api-token-refresh', [
            'middleware' => 'jwt.refresh',
            'uses' => 'AuthenticationController@refreshToken'
        ]);

        /**
         * Authenticated API Resources
         */
        Route::group(['middleware' => ['resource', 'APIJWT.auth']], function () {
            Route::resource('users', 'UsersController');
            Route::resource('user-roles', 'UserRolesController');
            Route::resource('roles', 'RolesController');
            Route::get('ministry/list', 'MinistryController@asList');
            Route::resource('ministry', 'MinistryController');
            Route::resource('denominations', 'DenominationsController');
            Route::resource('services', 'ServicesController');
            Route::resource('members', 'MembersController');
        });
    }
);
