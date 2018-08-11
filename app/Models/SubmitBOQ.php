<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmitBOQ extends Model
{

    protected $table = 'submit_boq';
    protected $primaryKey = 'id';
    protected $fillable = array('code','project_id');
    public $timestamps = true;
 

  
}
