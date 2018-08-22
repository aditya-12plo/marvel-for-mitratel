<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TowerErection extends Model
{

    protected $table = 'tower_erection';
    protected $primaryKey = 'id';
    protected $fillable = array('tower_erection_date','tower_erection_document');
    public $timestamps = true;


  
}
