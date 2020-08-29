<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class TweetController extends Controller
{
    public function save_new_tweet(Request $request){

        if($request->user_id &&  $request->tweet){
            $tweet =Tweet::create([
                'tweet'=>$request->tweet,
                'when_tweeted' =>date('l jS \of F Y h:i:s A'),
                'user_id' =>$request->user_id

            ]);
            return response()->json($tweet,200);

        }

    }
    public function get_tweet_details(Tweet $tweet){
        $tweet=$tweet;
        $user=$tweet->user;
        $user_profile= $tweet->user->profile;
        $likes = $tweet->likes->count();
        $comments = $tweet->comments->count();
        $date_created = $tweet->when_tweeted;
        return response()->json(['tweet'=>$tweet,'user'=>$user,'comments'=>$comments,'user_profile'=>$user_profile,'likes'=>$likes,'comments'=>$comments,'created_on'=>$date_created] , 200);

    }
}
