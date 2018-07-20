<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{

    protected $table = 'notification';
    protected $primaryKey = 'id';
    protected $fillable = array('project_id','sender_id','users_id','message','status');
    public $timestamps = true;

  
}
