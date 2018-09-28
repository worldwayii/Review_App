<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'followers';

    protected $fillable = [ 'follower_id', 'followee_id' ];

    public function user()
    {
    	return $this->belongsTo('App\Models\User', 'followee_id');
    }
}
