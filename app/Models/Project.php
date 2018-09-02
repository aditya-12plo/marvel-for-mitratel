<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $table = 'project';
    protected $primaryKey = 'id';
    protected $fillable = array('projectid','no_wo','wo_date','batch','years','infratype','area','regional','site_id_spk','site_name_spk','address_spk','longitude_spk','latitude_spk','status_id','boq_status','haki_status','project_status_id','batch_accrue');
    public $timestamps = true;

                public function projectstatus()
    {
return $this->hasOne('App\Models\Statusnya','id','status_id');
    }

  
}
