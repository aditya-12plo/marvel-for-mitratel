<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{

    protected $table = 'aset';
    protected $primaryKey = 'id';
    protected $fillable = array('name','email');
    public $timestamps = true;
 

  
}
