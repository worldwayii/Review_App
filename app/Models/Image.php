<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'images';

    protected $fillable = [ 'path', 'item_id', 'user_id'];


    public function item()
    {
    	return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
