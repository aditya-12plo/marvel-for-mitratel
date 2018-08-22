<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RfiBaut extends Model
{

    protected $table = 'rfi_baut';
    protected $primaryKey = 'id';
    protected $fillable = array('rfi_date','rfi_document','baut_date','baut_document','pks_document');
    public $timestamps = true; 
  
}
