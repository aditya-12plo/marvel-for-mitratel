<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenDRM extends Model
{

    protected $table = 'document_drm';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','site_id_actual','site_name_actual','province','city','address_actual','longitude_actual','latitude_actual','kom_date','drm_date','document_kom','document_drm');
    public $timestamps = true;

                public function projectdokumendrm()
    {
return $this->belongsTo('App\Models\Project');
    }

  
}
