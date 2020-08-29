<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tweet;

class Comment extends Model
{
    protected $guarded = [];

    public function tweet(){
        return $this->belongsTo(Tweet::class);
    }
}
