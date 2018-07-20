<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenSITAC extends Model
{

    protected $table = 'document_sitac';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','no_ban_bak','date_ban_bak','document_ban_bak','ijin_warga_date','document_ijin_warga','no_pks','pks_date','document_pks','no_imb','imb_date','document_imb');
    public $timestamps = true;

                public function projectdokumensitac()
    {
return $this->belongsTo('App\Models\Project');
    }

  
}
