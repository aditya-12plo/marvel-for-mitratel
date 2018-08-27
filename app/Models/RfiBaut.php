<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RfiBaut extends Model
{

    protected $table = 'rfi_baut';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','rfi_date','rfi_document','baut_date','baut_document');
    public $timestamps = true; 
  
}
