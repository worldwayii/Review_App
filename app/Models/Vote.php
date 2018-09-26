<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'votes';

    protected $fillable = [ 'review_id', 'user_id', 'vote' ];

    public function review()
    {
    	return $this->belongsTo('App\Models\Review', 'review_id');
    }

}
