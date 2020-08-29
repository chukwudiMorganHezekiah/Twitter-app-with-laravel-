<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{

    protected $guarded = [];
    public function users (){
        return $this->belongsToMany(App::class);
    }
}
