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
use App\Models\Project;
use App\Models\Pesan;
use App\Models\Log;

class KaryawanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('karyawan.auth');
		$this->data['title']  = 'Selamat Datang';
    $this->data['tahunproject']  = DB::table('vtahun')->get();

    }

  /* home */

    
    public function index()
    {
		 
        return view('Karyawan.templates.home')->with($this->data);
    }


/* home */



/* user profil */


       public function GetProfile()
    {
      $data = 
      [
'name'=>Auth::guard('karyawan')->user()->name,
'email'=>Auth::guard('karyawan')->user()->email,
'level'=>Auth::guard('karyawan')->user()->level,
'posisi'=>Auth::guard('karyawan')->user()->posisi,
'regional'=>Auth::guard('karyawan')->user()->regional,
'area'=>Auth::guard('karyawan')->user()->area,
'area2'=>Auth::guard('karyawan')->user()->area2,
      ];
return response()->json($data);       
    }




       public function changePassword(Request $request)
    {
$valid = $this->validate($request, [
        'password' => 'required|max:255',
        'password_confirmation' => 'required|max:255|same:password'
    ]);
if (!$valid)
    {
$masuk = array('password' => Hash::make(Input::get('password'))); 
User::where("id",Auth::guard('karyawan')->user()->id)->update(['password' => Hash::make($request->password)]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'users' ,'action' => 'insert', 'data' => json_encode($masuk)]);
return response()->json(['success'=>'Password Berhasil Dirubah']);

    }
else
    {
 return response()->json('error', $valid);
    }     
    }



/* user profil */


    /* cek user akses */
           public function CekUserProfileAkses($kode)
    {
       if($kode == 'UserAdd')
         {
            if(Auth::guard('karyawan')->user()->level == 'ADMINISTRATOR')
            {
                return response()->json(true);
            }
            else
            {
                return response()->json('error',422);
            }
         }
       elseif($kode == 'ProjectAdd')
         {
            if(Auth::guard('karyawan')->user()->level == 'ADMINISTRATOR')
            {
                return response()->json(true);
            }
            else
            {
                return response()->json('error',422);
            }
         }
       elseif($kode == 'RegionalUserAdd')
         {
            if(Auth::guard('karyawan')->user()->level == 'REGIONAL' && Auth::guard('karyawan')->user()->posisi == 'MANAGER MARKETING')
            {
                return response()->json(['level'=>Auth::guard('karyawan')->user()->level,'area'=>Auth::guard('karyawan')->user()->area]);
            }
            else
            {
                return response()->json('error',422);
            }
         }
       elseif($kode == 'RegionalAccountManagerUserAdd')
         {
            if(Auth::guard('karyawan')->user()->level == 'REGIONAL' && Auth::guard('karyawan')->user()->posisi == 'ACCOUNT MANAGER')
            {
                return response()->json(['level'=>Auth::guard('karyawan')->user()->level,'area'=>Auth::guard('karyawan')->user()->area,'regional'=>Auth::guard('karyawan')->user()->regional]);
            }
            else
            {
                return response()->json('error',422);
            }
         }
       elseif($kode == 'DocumentSISAdd')
         {
            if(Auth::guard('karyawan')->user()->level == 'REGIONAL' && Auth::guard('karyawan')->user()->posisi == 'ACCOUNT MANAGER' OR Auth::guard('karyawan')->user()->level == 'REGIONAL' && Auth::guard('karyawan')->user()->posisi == 'AM SUPPORT')
            {
                return response()->json(['level'=>Auth::guard('karyawan')->user()->level,'area'=>Auth::guard('karyawan')->user()->area,'regional'=>Auth::guard('karyawan')->user()->regional]);
            }
            else
            {
                return response()->json('error',422);
            }
         }
       elseif($kode == 'DocumentSISApproval')
         {
            if(Auth::guard('karyawan')->user()->level == 'REGIONAL' && Auth::guard('karyawan')->user()->posisi == 'MANAGER MARKETING')
            {
                return response()->json(['level'=>Auth::guard('karyawan')->user()->level,'area'=>Auth::guard('karyawan')->user()->area,'regional'=>Auth::guard('karyawan')->user()->regional]);
            }
            else
            {
                return response()->json('error',422);
            }
         }
       elseif($kode == 'DocumentBOQApprovalAM')
         {
            if(Auth::guard('karyawan')->user()->level == 'HQ' && Auth::guard('karyawan')->user()->posisi == 'ACCOUNT MANAGER')
            {
                return response()->json(['name'=>Auth::guard('karyawan')->user()->name,'level'=>Auth::guard('karyawan')->user()->level,'area'=>Auth::guard('karyawan')->user()->area,'regional'=>Auth::guard('karyawan')->user()->regional]);
            }
            else
            {
                return response()->json('error',422);
            }
         }
       elseif($kode == 'DocumentBOQApproval')
         {
            if(Auth::guard('karyawan')->user()->level == 'HQ' && Auth::guard('karyawan')->user()->posisi == 'ACCOUNT MANAGER' OR Auth::guard('karyawan')->user()->level == 'HQ' && Auth::guard('karyawan')->user()->posisi == 'MANAGER')
            {
                return response()->json(['name'=>Auth::guard('karyawan')->user()->name,'level'=>Auth::guard('karyawan')->user()->level,'area'=>Auth::guard('karyawan')->user()->area,'area2'=>Auth::guard('karyawan')->user()->area2,'regional'=>Auth::guard('karyawan')->user()->regional]);
            }
            else
            {
                return response()->json('error',422);
            }
         }
       elseif($kode == 'DocumentBOQApprovalManager')
         {
            if(Auth::guard('karyawan')->user()->level == 'HQ' && Auth::guard('karyawan')->user()->posisi == 'MANAGER')
            {
                return response()->json(['name'=>Auth::guard('karyawan')->user()->name,'level'=>Auth::guard('karyawan')->user()->level,'area'=>Auth::guard('karyawan')->user()->area,'regional'=>Auth::guard('karyawan')->user()->regional]);
            }
            else
            {
                return response()->json('error',422);
            }
         }
       elseif($kode == 'HQUserAdd')
         {
            if(Auth::guard('karyawan')->user()->level == 'HQ' && Auth::guard('karyawan')->user()->posisi == 'MANAGER')
            {
                return response()->json(['name'=>Auth::guard('karyawan')->user()->name,'level'=>Auth::guard('karyawan')->user()->level,'area'=>Auth::guard('karyawan')->user()->area,'area2'=>Auth::guard('karyawan')->user()->area2,'regional'=>Auth::guard('karyawan')->user()->regional]);
            }
            else
            {
                return response()->json('error',422);
            }
         }
       elseif($kode == 'DocumentRfiDetail')
         {
            if(Auth::guard('karyawan')->user()->level == 'HQ' && Auth::guard('karyawan')->user()->posisi == 'HAKI - ACCOUNT MANAGER')
            {
                return response()->json(['name'=>Auth::guard('karyawan')->user()->name,'level'=>Auth::guard('karyawan')->user()->level,'area'=>Auth::guard('karyawan')->user()->area,'area2'=>Auth::guard('karyawan')->user()->area2]);
            }
            else
            {
                return response()->json('error',422);
            }
         }
       elseif($kode == 'DocumentRfiDetailManager')
         {
            if(Auth::guard('karyawan')->user()->level == 'HQ' && Auth::guard('karyawan')->user()->posisi == 'HAKI - MANAGER')
            {
                return response()->json(['name'=>Auth::guard('karyawan')->user()->name,'level'=>Auth::guard('karyawan')->user()->level,'area'=>Auth::guard('karyawan')->user()->area,'area2'=>Auth::guard('karyawan')->user()->area2]);
            }
            else
            {
                return response()->json('error',422);
            }
         }
       elseif($kode == 'HAKI')
         {
            if(Auth::guard('karyawan')->user()->level == 'HQ')
            {
                return response()->json(['name'=>Auth::guard('karyawan')->user()->name,'level'=>Auth::guard('karyawan')->user()->level,'area'=>Auth::guard('karyawan')->user()->area,'area2'=>Auth::guard('karyawan')->user()->area2]);
            }
            else
            {
                return response()->json('error',422);
            }
         }
       elseif($kode == 'DocumentBisnis')
         {
            if(Auth::guard('karyawan')->user()->posisi == 'BISNIS')
            {
                return response()->json(['name'=>Auth::guard('karyawan')->user()->name,'level'=>Auth::guard('karyawan')->user()->level]);
            }
            else
            {
                return response()->json('error',422);
            }
         }
         else
         {
            return response()->json('error',422);
         }
    }
    
    /* cek user akses */








}
