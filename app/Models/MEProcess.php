<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MEProcess extends Model
{

    protected $table = 'm_e_process';
    protected $primaryKey = 'id';
    protected $fillable = array('m_e_process_date','m_e_process_document');
    public $timestamps = true; 
  
}
