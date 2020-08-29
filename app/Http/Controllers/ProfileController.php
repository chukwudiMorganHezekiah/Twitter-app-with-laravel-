<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
   public function get_users_profile($user_id){

       return Profile::where('user_id',$user_id)->get();

   }
}
