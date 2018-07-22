<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VJobCommunication extends Model
{

    protected $table = 'vjobcommunication';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','users_id','status','message','name','email','level','posisi','area','regional','created_at');
    public $timestamps = false;
 
  	 

}
