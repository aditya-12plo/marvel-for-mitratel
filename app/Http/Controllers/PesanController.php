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
use App\Models\VProjectStatus;

class PesanController extends Controller
{
	 public function __construct()
    {
        $this->middleware('karyawan.auth');
        $this->data['title']  = 'Selamat Datang';
    $this->data['tahunproject']  = DB::table('vtahun')->get();
    }


    public function index(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
if(Auth::guard('karyawan')->user()->level == 'REGIONAL' && Auth::guard('karyawan')->user()->posisi == 'AM SUPPORT' || Auth::guard('karyawan')->user()->level == 'REGIONAL' && Auth::guard('karyawan')->user()->posisi == 'ACCOUNT MANAGER')
{
 $query =  DB::table('vnotifications')
        ->select('id','projectid','notificationid','area','regional','status','created_at')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('notificationid','DESC');

}
if(Auth::guard('karyawan')->user()->level == 'REGIONAL' && Auth::guard('karyawan')->user()->posisi == 'MANAGER MARKETING')
{
  $query =  DB::table('vnotifications')
        ->select('id','projectid','notificationid','area','regional','status','created_at')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('notificationid','DESC');  
}
if(Auth::guard('karyawan')->user()->level == 'HQ' && Auth::guard('karyawan')->user()->posisi == 'ACCOUNT MANAGER' || Auth::guard('karyawan')->user()->level == 'HQ' && Auth::guard('karyawan')->user()->posisi == 'MANAGER')
{
  $query =  DB::table('vnotifications')
        ->select('id','projectid','notificationid','area','regional','status','created_at')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('notificationid','DESC');  
}

       
        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like);
        }
        if(!$search && $min && !$max)
        {
            $query = $query->whereDate('created_at','=',$min);
        }
        if(!$search && !$min && $max)
        {
            $query = $query->whereDate('created_at','=',$max);
        }
        if($search && $min && !$max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$min)
            ->where('projectid', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


          public function detail($id)
    {

$get =  VProjectStatus::with(['komunikasiproject' => function($query)
{
    $query->orderBy('id', 'DESC');
}])->find($id); 
return response()->json($get);
    }


}