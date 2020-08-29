<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        return view('dashboard');
    }
    public function get_auth_user(){
        return response()->json(['user_id'=>auth()->user()->id],200);
    }
}
