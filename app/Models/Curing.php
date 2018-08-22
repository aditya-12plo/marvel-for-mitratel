<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curing extends Model
{

    protected $table = 'curing';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','curing_date','curing_document');
    public $timestamps = true;


  
}
