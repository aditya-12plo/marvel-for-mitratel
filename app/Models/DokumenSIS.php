<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenSIS extends Model
{

    protected $table = 'document_sis';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','document_sis');
    public $timestamps = true;

                public function projectdokumensis()
    {
return $this->belongsTo('App\Models\Project');
    }

  
}
