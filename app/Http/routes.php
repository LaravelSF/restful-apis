<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function ()
{
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function ()
{
    //
});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api)
{

    $api->resource('accounts', 'App\Api\V1\AccountController', [
        'except' => [
            'edit',
            'create',
        ],
    ]);

    $api->resource('users', 'App\Api\V1\UserController', [
        'except' => [
            'edit',
            'create',
        ],
    ]);

    $api->resource('subscriptions', 'App\Api\V1\SubscriptionController', [
        'except' => [
            'edit',
            'create',
        ],
    ]);

    $api->resource('channels', 'App\Api\V1\ChannelController', [
        'except' => [
            'edit',
            'create',
        ],
    ]);
});