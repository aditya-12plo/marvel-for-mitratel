<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pouring extends Model
{

    protected $table = 'pouring';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','pouring_date','pouring_document');
    public $timestamps = true;


  
}
