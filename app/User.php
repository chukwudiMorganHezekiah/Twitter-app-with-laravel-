<?php

namespace App;
use App\Follow;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Profile;
use App\Tweet;
use App\Like;
use App\Comment;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function tweets(){
        return $this->hasMany(Tweet::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function follows(){
        return $this->belongsToMany(Follow::class);
    }

    protected static function boot(){
        parent::boot();

        static::created(function($user){
            $user->profile()->create([
                'profile_image'=>'noimage.jpg',
                'profile_name'=>$user->name,
            ]);

        });
    }
}
