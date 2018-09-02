<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoqBaps extends Model
{

    protected $table = 'boq_baps';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','tgl_mulai_sewa','tgl_target_rfi','document_boq_baps');
    public $timestamps = true;
 

  
}
