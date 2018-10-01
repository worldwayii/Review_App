<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'items';

    protected $fillable = [ 'name', 'sku', 'url', 'manufacturer_id', 'about', 'price'];

    //Defining relationship between Item and manufacturer
    public function manufacturer()
    {
    	return $this->belongsTo('App\Models\Manufacturer', 'manufacturer_id');
    }

    //relationship for reviews
    public function reviews()
    {
    	return $this->hasMany('App\Models\Review', 'item_id');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image', 'item_id');
    }

    static function after ($whr, $inthat)
    {
        if (!is_bool(strpos($inthat, $whr)))
        return substr($inthat, strpos($inthat,$whr)+strlen($whr));
    }
}
