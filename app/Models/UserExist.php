<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserExist extends Model
{

    protected $table = 'users_exist';
    protected $fillable = array('id','name', 'email', 'password','level', 'posisi','regional','area');
    public $timestamps = true;


    
}
