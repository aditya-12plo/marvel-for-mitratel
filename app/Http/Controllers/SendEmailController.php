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
use Illuminate\Support\Collection;

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
use App\Models\Busdev;

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

    
    public function kirimBOQ($to,$title,$nodoc,$from,$level,$detailnya,$kata)
    { 
     $isipesan = array( 
        'title' => $title,
        'nodoc' => $nodoc, 
        'detailnya' => $detailnya,
        'kata' => $kata,
        'level' => $level,
        'name' => $from); 
      $content = view('email_content_boq')->with($isipesan);
        Mail::send('email', ['contentMessage' => $content], function($messageNya) use ($to) {
         $messageNya->to($to)->subject('Notification Dr.MarveL (Dokumen Review MARketing Validation ELectronik)');
         $messageNya->from('aplikasi.mitratel@gmail.com','Dr.MarveL (Dokumen Review MARketing Validation ELectronik)');
      });
  
    }

    
    public function kirimCMEAccured($file,$nodoc,$from)
    { 
$busdev = Busdev::get();
foreach($busdev as $b)
{
  $to = $b->email;
  $isipesan = array( 
    'title' => 'File Dokumen Accrued Aplikasi Marvel',
    'nodoc' => $nodoc,  
    'file' => $file,  
    'namabusdev' => $b->name,  
    'name' => $from); 
  $content = view('email_content_cme_accrued')->with($isipesan);
    Mail::send('email', ['contentMessage' => $content], function($messageNya) use ($to,$file) {
     $messageNya->to($to)->subject('File Dokumen Accrued Aplikasi Marvel');
     $messageNya->attach($file);
     $messageNya->from('aplikasi.mitratel@gmail.com','Dr.MarveL (Dokumen Review MARketing Validation ELectronik)');
  });

}

    }

    public function kirimCME($to,$nodoc,$from,$level,$detailnya,$kata)
    { 
     $isipesan = array(  
        'nodoc' => $nodoc, 
        'detailnya' => $detailnya,
        'kata' => $kata,
        'level' => $level,
        'name' => $from); 
      $content = view('email_content_cme')->with($isipesan);
        Mail::send('email', ['contentMessage' => $content], function($messageNya) use ($to) {
         $messageNya->to($to)->subject('Notification Dr.MarveL (Dokumen Review MARketing Validation ELectronik)');
         $messageNya->from('aplikasi.mitratel@gmail.com','Dr.MarveL (Dokumen Review MARketing Validation ELectronik)');
      });
  
    }


    
}
