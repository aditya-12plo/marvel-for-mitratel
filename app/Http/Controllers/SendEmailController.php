<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Response,View,Input,Auth,Session,Validator,File,Hash,DB,Excel,Mail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;
use PDF;
use Carbon\Carbon;


use App\Models\User;
use App\Models\UserExist;
use App\Models\Pemberitahuan;
use App\Models\Pesan;
use App\Models\Log;
use App\Models\Project;
use App\Models\DokumenSIS;
use App\Models\DokumenDRM;
use App\Models\DokumenSITAC;
use App\Models\DokumenRFC;
use App\Models\BOQ;

class SendEmailController extends Controller
{
    
    public function kirim($to,$id,$projectid,$infratype,$status,$jobs,$from,$level,$message,$kata)
    {

     $isipesan = array(
        'projectid' => $projectid,
        'jobs' => $jobs,
        'message' => $message,
        'infratype' => $infratype,
        'kata' => $kata,
        'level' => $level,
        'name' => $from); 
      $content = view('email_content')->with($isipesan);
        Mail::send('email', ['contentMessage' => $content], function($messageNya) use ($to) {
         $messageNya->to($to)->subject('Notification Dr.MarveL (Dokumen Review MARketing Validation ELectronik)');
         $messageNya->from('aplikasi.mitratel@gmail.com','Dr.MarveL (Dokumen Review MARketing Validation ELectronik)');
      });
  
    }


    
}
