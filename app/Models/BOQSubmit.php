<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BOQSubmit extends Model
{

    protected $table = 'boq_submit';
    protected $primaryKey = 'id';
  //  protected $fillable = array('boq_code','title','nama_telkomsel','posisi_telkomsel','nama_manager','posisi_manager','nama_user','posisi_user','project_id','project_id_boq','project_id_verifikasi','project_id_proses_pr','project_id_po_release','status','message','area','area2');
    protected $fillable = array('boq_code','title','nama_telkomsel','posisi_telkomsel','nama_manager','posisi_manager','nama_user','posisi_user','project_id','status','message','area','area2');
    public $timestamps = true;

                 

  
}
