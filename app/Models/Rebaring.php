<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rebaring extends Model
{

    protected $table = 'rebaring';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','rebaring_date','rebaring_document');
    public $timestamps = true;


  
}
