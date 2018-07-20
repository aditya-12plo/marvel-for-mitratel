<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statusnya extends Model
{

    protected $table = 'status';
    protected $primaryKey = 'id';
    protected $fillable = array('detail');
    public $timestamps = true;

	        public function statusproject()
    {
return $this->belongsTo('App\Models\Project');
    }
  
}
