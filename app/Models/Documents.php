<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{

    protected $table = 'documents';
    protected $primaryKey = 'id';
    protected $fillable = array('name','filename');
    public $timestamps = true;
 

  
}
