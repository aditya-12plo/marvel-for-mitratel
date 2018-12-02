<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Response,View,Input,Auth,Session,Validator,File,Hash,Location,Mail;
use Illuminate\Support\Facades\Crypt;
use PDF;
use Excel;
use DB;

use App\Models\BackgroundImage;
use App\Models\Slide;

class IndexController extends Controller
{
    public function __construct()
    {
    $this->data['tahunproject']  = DB::table('vtahun')->get();
    }

	
    
     
public function detailProject()
{
	$this->data['title'] = 'Dr. Marvel (Document Review Marketting Validation Electronic)';
    return view('layouts.detail')->with($this->data);
}

    

         public function GetAllDetailProject($id)
    {
$project = DB::table('vallproject')->where('projectid',$id)->first();
$pesan = DB::table('vjobcommunication') 
            ->where('project_id',$id)
            ->orderBy('id','ASC')
            ->get();

if($project)
{
return response()->json(['project'=>$project,'komunikasi'=>$pesan]);
}
else
{
return response()->json('error',500);
}
         
    }
	
    
    
	//if page not found
public function pagenotfound()
{
	$this->data['title'] = 'Dr. Marvel (Document Review Marketting Validation Electronic)';
    return view('layouts.error')->with($this->data);
}

    
}
