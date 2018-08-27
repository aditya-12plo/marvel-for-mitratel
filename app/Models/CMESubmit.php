<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMESubmit extends Model
{

    protected $table = 'cmesubmit';
    protected $primaryKey = 'id';
    protected $fillable = array('cme_code','project_id','project_id_accrued');
    public $timestamps = true;

                 

  
}
