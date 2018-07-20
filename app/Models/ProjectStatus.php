<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model
{

    protected $table = 'project_status';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','users_id','document','status','message');
    public $timestamps = true;

	      
  
}
