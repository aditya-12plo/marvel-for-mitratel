<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaksBauk extends Model
{

    protected $table = 'baks_bauk';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','no_baks','date_baks','document_baks','document_wctr','document_boq_project','document_rfi_certificate');
    public $timestamps = true;
 

  
}
