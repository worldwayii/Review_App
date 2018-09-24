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

    protected $fillable = [ 'path', 'item_id', 'uploader_id'];


    public function item()
    {
    	return $this->BelongsTo(Item::class);
    }
}
