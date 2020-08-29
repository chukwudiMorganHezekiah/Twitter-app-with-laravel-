<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tweet;
use App\User;

class Like extends Model
{
    protected $guarded = [];

    public function tweets(){
        return $this->belongsToMany(Tweet::class);
    }

    public function user(){
        return $this->belongsToOne(User::class);
    }
}
