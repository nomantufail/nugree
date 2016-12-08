<?php

/* Dashboard app will be launched from here.. */
\Illuminate\Support\Facades\Route::get('/dashboard',[
    'middleware' => [
        'webAuthenticate:getDashboardAppRequest'
    ],
    'uses'=>'AppsController@dashboard',
    'as'=>'dashboard'
]);

/* AddPropertyWithAuth app will be launched from here.. */
\Illuminate\Support\Facades\Route::get('/app/add-property',[
    'middleware' => [
        //'webAuthenticate:getDashboardAppRequest'
    ],
    'uses'=>'AppsController@addPropertyWithAuth',
    'as'=>'addPropertyWithAuth'
]);
