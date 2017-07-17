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

$api = app('Dingo\Api\Routing\Router');


$api->version('v1', ['namespace'=>'App\Http\Controllers'], function ($api) {


    // This group limit visiting rate without authentication
    $api->group([
        'middleware' => 'api.throttle',
        'limit'      => config('api.rate_limit.default.limit'),
        'expires'    => config('api.rate_limit.default.expires'),
    ],function ($api) {


    });


    // This group can be visited only by those who has been authenticated
    $api->group(['middleware' => 'api.auth'], function ($api) {

        // Limit visiting rate
        $api->group([
            'middleware' => 'api.throttle',
            'limit'      => config('api.rate_limit.default.limit'),
            'expires'    => config('api.rate_limit.default.expires'),
        ],function ($api) {

        });

    });

});

