<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Response,View,Input,Auth,Session,Validator,File,Hash,Location,Mail;
use Illuminate\Support\Facades\Crypt;
use PDF;
use Excel;
use DB;


class IndexController extends Controller
{
    public function __construct()
    {
      
    }

	
    
    
	//if page not found
public function pagenotfound()
{
	$this->data['title'] = 'MITRATel-RAVTING';
    return view('layouts.error')->with($this->data);
}

    
}
