<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();

Route::group([
    'namespace' => 'Staff',
    'prefix' => 'staff',
    'as' => 'Staff::',
], function () {
    // Authentication Routes...
    Route::get('login', [
        'as' => 'getLogin',
        'uses' => 'Auth\AuthController@showLoginForm'
    ]);
    Route::post('login', [
        'as' => 'postLogin',
        'uses' => 'Auth\AuthController@login'
    ]);
    Route::get('logout', [
        'as' => 'getLogout',
        'uses' => 'Auth\AuthController@logout'
    ]);

    // Registration Routes...
    Route::get('register', 'Auth\AuthController@showRegistrationForm');
    Route::post('register', 'Auth\AuthController@register');

    // Password Reset Routes...
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');

    Route::group([
        'middleware' => 'auth:staff',
    ], function () {
        Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
        Route::get('/password', ['as' => 'password_change_form', 'uses' => 'PasswordController@index']);
        Route::post('/password', ['as' => 'password_change', 'uses' => 'PasswordController@change']);
        Route::group([
            'prefix' => 'notifications',
            'as' => 'notification@',
        ], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'NotificationController@index']);
            Route::get('/{id}', ['as' => 'read', 'uses' => 'NotificationController@read']);
        });
    });

    Route::group([
        'namespace' => 'Management',
        'prefix' => 'management',
        'as' => 'Management::',
    ], function () {
        Route::group([
            'prefix' => 'user',
            'as' => 'user@',
        ], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'UserController@index']);
            Route::get('/add', ['as' => 'add', 'uses' => 'UserController@add']);
            Route::post('/store', ['as' => 'store', 'uses' => 'UserController@store']);
            Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'UserController@edit']);
            Route::match(['put', 'patch'], '/{id}', ['as' => 'update', 'uses' => 'UserController@update']);
            Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'UserController@delete']);
        });

        Route::group([
            'prefix' => 'role',
            'as' => 'role@',
        ], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'RoleController@index']);
            Route::get('/add', ['as' => 'add', 'uses' => 'RoleController@add']);
            Route::post('/store', ['as' => 'store', 'uses' => 'RoleController@store']);
            Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'RoleController@edit']);
            Route::match(['put', 'patch'], '/{id}', ['as' => 'update', 'uses' => 'RoleController@update']);
            Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'RoleController@delete']);
            Route::post('/search', ['as' => 'search', 'uses' => 'RoleController@search']);

        });

        Route::group([
            'prefix' => 'permission',
            'as' => 'permission@',
        ], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'PermissionController@index']);
            Route::get('/add', ['as' => 'add', 'uses' => 'PermissionController@add']);
            Route::post('/store', ['as' => 'store', 'uses' => 'PermissionController@store']);
            Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'PermissionController@edit']);
            Route::match(['put', 'patch'], '/{id}', ['as' => 'update', 'uses' => 'PermissionController@update']);
            Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'PermissionController@delete']);
            Route::post('/search', ['as' => 'search', 'uses' => 'PermissionController@search']);

        });


        Route::group([
            'prefix' => 'post',
            'as' => 'post@',
        ], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'PostController@index']);
            Route::get('/add', ['as' => 'add', 'uses' => 'PostController@add']);
            Route::post('/store', ['as' => 'store', 'uses' => 'PostController@store']);
            Route::match(['get'], '/{id}/approve', ['as' => 'approve', 'uses' => 'PostController@approve']);
            Route::match(['get'], '/{id}/renew', ['as' => 'renew', 'uses' => 'PostController@renew']);
            Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'PostController@edit']);
            Route::match(['put', 'patch'], '/{id}', ['as' => 'update', 'uses' => 'PostController@update']);
            Route::get('/{id}/delete', ['as' => 'delete', 'uses' => 'PostController@delete']);
            Route::post('/search', ['as' => 'search', 'uses' => 'PostController@search']);

        });


        Route::group([
            'prefix' => 'collaborators',
            'as' => 'collaborator@',
        ], function () {
            Route::get('/', ['as' => 'index', 'uses' => 'CollaboratorController@index']);
            Route::get('/add', ['as' => 'add', 'uses' => 'CollaboratorController@add']);
            Route::post('/', ['as' => 'store', 'uses' => 'CollaboratorController@store']);
            Route::get('/{id}', ['as' => 'show', 'uses' => 'CollaboratorController@show']);
            Route::get('/{id}/edit', ['as' => 'edit', 'uses' => 'CollaboratorController@edit']);
            Route::match(['put', 'patch'], '/{id}', ['as' => 'update', 'uses' => 'CollaboratorController@update']);
            Route::delete('/{id}', ['as' => 'delete', 'uses' => 'CollaboratorController@delete']);
            Route::match(['put', 'patch'], '/{id}/withdrawMoney', ['as' => 'withdrawMoney', 'uses' => 'CollaboratorController@withdrawMoney']);
        });

    });
});



