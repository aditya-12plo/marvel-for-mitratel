<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baps extends Model
{

    protected $table = 'baps';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','tgL_akhir_sewa','document_baps');
    public $timestamps = true;
 

  
}
