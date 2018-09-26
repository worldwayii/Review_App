<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'reviews';

    protected $fillable = [ 'rating', 'comment', 'item_id', 'user_id' ];

    public function item()
    {
    	return $this->belongsTo('App\Models\Item', 'item_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function votes()
    {
        return $this->hasMany('App\Models\Vote', 'review_id');
    }

}
