<?php

use Illuminate\Support\Facades\Route;

Route::get('verify_user_logged_in',function(){
    return auth()->user()->id ;

});

Auth::routes();
Route::get('get_auth_user','AppController@get_auth_user');

Route::get('{any}','AppController@index')->where('any','.*');
