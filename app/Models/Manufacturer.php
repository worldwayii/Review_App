<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'manufacturers';

    protected $fillable = ['name'];

}
