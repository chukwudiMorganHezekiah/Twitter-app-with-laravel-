<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get_user_profile_image/{user}','UtilitiesController@get_user_profile_image');

Route::get('get_user_tweets/{user}/{limit}','UtilitiesController@get_user_tweets');

Route::post('save_new_tweet','TweetController@save_new_tweet');

Route::get('get_other_users/{user_id}','UtilitiesController@get_other_users');

Route::post('follow_user','FollowController@follow_user');

Route::get('get_users_permission_to_edit_profile','ProfileController@get_users_permission_to_edit_profile');

Route::get('get_users_profile/{user_id}','ProfileController@get_users_profile');

Route::get('get_user_activity_details/{user_id}', 'UtilitiesController@get_user_activity_details');

Route::get('get_users_followings/{user_id}','FollowController@get_users_followings');

Route::get('get_tweet_details/{tweet}','TweetController@get_tweet_details');
