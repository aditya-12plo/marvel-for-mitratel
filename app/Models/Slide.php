<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{

    protected $table = 'slide_show';
    protected $primaryKey = 'id';
    protected $fillable = array('sequence','name','image');
    public $timestamps = true;
 

  
}
