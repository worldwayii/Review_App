<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name', 'email', 'password', 'date_of_birth', 'role_id'
    ];

    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function images()
    {
        return $this->hasMany('App\Models\Image', 'user_id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review', 'user_id');
    }

    public function followers()
    {
        return $this->hasMany('App\Models\Follower', 'followee_id');
    }
}
