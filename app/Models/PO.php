<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PO extends Model
{

    protected $table = 'po';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','no_po','po_date');
    public $timestamps = true;

                 

  
}
