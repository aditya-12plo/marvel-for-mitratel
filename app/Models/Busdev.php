<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Busdev extends Model
{

    protected $table = 'busdev';
    protected $primaryKey = 'id';
    protected $fillable = array('name','email');
    public $timestamps = true;
 

  
}
