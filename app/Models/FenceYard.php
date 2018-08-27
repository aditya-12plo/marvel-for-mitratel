<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FenceYard extends Model
{

    protected $table = 'fence_yard';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','fence_yard_date','fence_yard_document');
    public $timestamps = true; 
  
}
