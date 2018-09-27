<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $table = 'invoice';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','no_receive','no_kontrak','no_invoice','tgl_invoice','tgl_mulai_sewa','tgl_target_rfi','document_boq_baps','tgL_akhir_sewa','document_baps');
    public $timestamps = true;
 

  
}
