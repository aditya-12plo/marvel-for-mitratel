<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteOpening extends Model
{

    protected $table = 'site_opening';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','site_opening_date','document_site_opening');
    public $timestamps = true;


  
}
