<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RfiDetail extends Model
{

    protected $table = 'rfi_detail';
    protected $primaryKey = 'id';
    protected $fillable = array('rfi_detail_start_date','rfi_detail_end_date','rfi_detail_price_month','rfi_detail_price_year');
    public $timestamps = true; 
  
}
