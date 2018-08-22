<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Excavation extends Model
{

    protected $table = 'excavation';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','excavation_date','excavation_document');
    public $timestamps = true;


  
}
