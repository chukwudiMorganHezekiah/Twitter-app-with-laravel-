<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use App\Tweet;
class UtilitiesController extends Controller
{

    public function verify_user_logged_in(Request $request){
            return auth()->user()->id;

    }
    public function get_user_profile_image(User $user){
        $user_profile_image =$user->profile->profile_image;
        $user_username = $user->profile->profile_name;
        $count_getter = "COUNT('id')";
        $user_number_following = DB::select("SELECT COUNT('id') FROM follow_user WHERE `user_id` ='$user->id'")[0]->$count_getter;
        $user_number_followed =DB::select("SELECT COUNT('id') FROM follow_user WHERE follow_id ='$user->id'")[0]->$count_getter;
        return response()->json(
            [
            'profile_image'=>$user_profile_image,'username'=>$user_username,'following'=>$user_number_following,'followed'=>$user_number_followed
            ],
            200);

    }
    public function get_user_tweets(User $user, $limit){
        $users_following = DB::select("SELECT `follow_id` FROM follow_user WHERE `user_id` ='$user->id'");

        $tweets = [];
        $counter=0;
        $passed_twits =[];
        foreach($users_following as $user){
            $id = $user->follow_id;
            $tweet = DB::select("SELECT * FROM tweets WHERE `user_id` ='$id' ");
            if(isset($tweet[0]->user_id)){
                $id = $tweet[0]->user_id;

                $profile = DB::select("SELECT * FROM profiles WHERE user_id = '$id'");
                $tweet[0]->profile = $profile[0];

                array_push($tweets,$tweet);

            }
        }
        $count = count($tweets);
        if($count >= $limit){
            while($counter < $limit){
                array_push($passed_twits, $tweets[$counter]);
                $counter+=1;

            }

        }else{return 0;}

        shuffle($passed_twits);
        return $passed_twits;


    }

    public function get_other_users($user_id){

        $users = \App\User::all()->where('id','!=',$user_id)->take(5);
        $passed_users =[];



        foreach($users as $user){
            $query =DB::select("SELECT * FROM follow_user WHERE user_id =$user_id AND follow_id =$user->id");

            if(empty($query)){
                array_push($passed_users,$user);

            }
        }

        foreach($passed_users as $user){
            $user->profile=$user->profile;

        }
        return $passed_users;


    }
    public function get_user_activity_details($user_id){
        $tweet_count = DB::select("SELECT id FROM tweets WHERE `user_id` = '$user_id'");
        $followers_count = DB::select("SELECT id FROM follow_user WHERE `follow_id` = '$user_id'");
        $followering_count = DB::select("SELECT id FROM follow_user WHERE `user_id` = '$user_id'");


        return response()->json(
            [
                'tweet_count'=>count($tweet_count),
                'followers_count'=>count($followers_count),
                'following_count'=>count($followering_count)
            ],
            200
        );
    }

    public function test(Tweet $tweet){
        return $tweet->likes->count();

    }
}
