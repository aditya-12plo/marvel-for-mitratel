<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BOQ extends Model
{

    protected $table = 'document_boq';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','site_type','tower_type','roof_top_high','tower_high','	rf_in_meters','mw_in_meters');
    public $timestamps = true;

                public function projectdokumenrpm()
    {
return $this->belongsTo('App\Models\Project');
    }

  
}
