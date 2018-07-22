<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VProjectStatus extends Model
{

    protected $table = 'vprojectstatus';
    protected $primaryKey = 'id';
    protected $fillable = array('detail');
    public $timestamps = false;
 
  	        public function komunikasiproject()
    {
return $this->hasMany('App\Models\VJobCommunication','project_id','id');
    }


}
