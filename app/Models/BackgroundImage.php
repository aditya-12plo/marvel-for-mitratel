<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackgroundImage extends Model
{

    protected $table = 'background_image';
    protected $primaryKey = 'id';
    protected $fillable = array('sequence','name','image');
    public $timestamps = true;
 

  
}
