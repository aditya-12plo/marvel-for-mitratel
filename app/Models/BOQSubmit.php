<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BOQSubmit extends Model
{

    protected $table = 'boq_submit';
    protected $primaryKey = 'id';
    protected $fillable = array('boq_code','title','nama_telkomsel','posisi_telkomsel','nama_manager','posisi_manager','nama_user','posisi_user','project_id','status','message','area');
    public $timestamps = true;

                 

  
}
