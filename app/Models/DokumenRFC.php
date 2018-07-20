<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenRFC extends Model
{

    protected $table = 'document_rfc';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','no_rfc','rfc_date','document_rfc','id_pln','target_rfi','power_capacity');
    public $timestamps = true;

                public function projectdokumenrpm()
    {
return $this->belongsTo('App\Models\Project');
    }

  
}
