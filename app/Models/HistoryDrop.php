<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryDrop extends Model
{

    protected $table = 'history_drop';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','status_id');
    public $timestamps = false;

  
}
