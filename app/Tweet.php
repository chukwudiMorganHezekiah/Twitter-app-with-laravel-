<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;
use App\Like;
use App\Comment;
class Tweet extends Model
{
    //
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
