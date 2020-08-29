<?php

namespace App\Http\Controllers;

use App\Follow;
use App\User;
use Illuminate\Http\Request;
use DB;

class FollowController extends Controller
{
    public function follow_user(Request $request){
        $follower_id = $request->follower_id;
        $following_id = $request->following_id;

        return User::find($follower_id)->follows()->toggle($following_id);
    }

    public function get_users_followings ($user_id){
        $followering_id = DB::select("SELECT id FROM follow_user WHERE `user_id` = '$user_id'");
        $profiles=[];
        
        foreach($followering_id as $id_col){
            $profile = \App\Profile::where('user_id',$id_col->id )->get();
            array_push($profiles, $profile[0]);
        }
        return $profiles;

    }
}
