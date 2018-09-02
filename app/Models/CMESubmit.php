<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMESubmit extends Model
{

    protected $table = 'cme_submit';
    protected $primaryKey = 'id';
    protected $fillable = array('cme_code','project_id','project_id_accrual','project_id_accrued','area','area2','status','message');
    public $timestamps = true;

                 

  
}
