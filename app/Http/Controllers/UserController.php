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

class UserController extends Controller
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

    
    public function index(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query = User::whereNotIn('level',['ADMINISTRATOR'])->orderBy('id','DESC');
        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
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
            ->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


    public function userregional(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query = DB::table('vusersregional')->where('area',Auth::guard('karyawan')->user()->area)
        ->whereNotIn('email',[Auth::guard('karyawan')->user()->email])
        ->select('id','name','email','level','posisi','regional','area','created_at')->orderBy('id','DESC');
        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
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
            ->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


    public function userhq(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query = DB::table('vusershq')
        ->where(function ($querynya) {
    $querynya->where([['area', Auth::guard('karyawan')->user()->area],['level','HQ'],['posisi','ACCOUNT MANAGER']])
          ->orWhere([['area', Auth::guard('karyawan')->user()->area2],['level','HQ'],['posisi','ACCOUNT MANAGER']]);
})
        ->whereNotIn('email',[Auth::guard('karyawan')->user()->email])
        ->select('id','name','email','level','posisi','regional','area','created_at')->orderBy('id','DESC');
        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
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
            ->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


    public function userregionalaccountmanager(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query = DB::table('vusersregional')->where('regional',Auth::guard('karyawan')->user()->regional)
        ->whereNotIn('email',[Auth::guard('karyawan')->user()->email])
        ->select('id','name','email','level','posisi','regional','area','created_at')->orderBy('id','DESC');
        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
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
            ->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like)
            ->orWhere('level', 'LIKE', $like)
            ->orWhere('posisi', 'LIKE', $like)
            ->orWhere('area', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


        public function store(Request $request)
    {
$valid = $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required|max:255|unique:users,email',
        'password' => 'required|max:255',
        'level' => 'in:REGIONAL,HQ',
        'posisi' => 'in:AM SUPPORT,ACCOUNT MANAGER,MANAGER MARKETING,MANAGER',
        'area' => 'in:1,2,3,4',
    ]);
if (!$valid)
    {
if($request->level == 'REGIONAL' && $request->posisi == 'ACCOUNT MANAGER' || $request->level == 'REGIONAL' && $request->posisi == 'AM SUPPORT')
{
$valid2 = $this->validate($request, [
        'regional' => 'required|max:255'
    ]);
        if (!$valid2)
    {

$masuk = array('name' => $request->name, 'email' => $request->email , 'password' => Hash::make($request->password) , 'level' => $request->level ,'posisi' =>$request->posisi, 'area' => $request->area, 'regional' =>  strtoupper($request->regional)); 
$masukdb = User::create($masuk);
//UserExist::create(['id' => $masukdb->id ,'name' => $request->name, 'email' => $request->email , 'password' => Hash::make($request->password) , 'level' => $request->level , 'posisi' =>$request->posisi,'area' => $request->area, 'regional' =>  strtoupper($request->regional)]);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'users' ,'action' => 'insert', 'data' => json_encode($masuk)]);
return response()->json(['success'=>'Add Successfully']);
    
    }
        else
    {
 return response()->json('error', $valid2);
    }
}
elseif($request->level == 'HQ' && $request->posisi == 'MANAGER' || $request->level == 'HQ' && $request->posisi == 'ACCOUNT MANAGER' || $request->level == 'REGIONAL' && $request->posisi == 'MANAGER MARKETING')
{
    $masuk = array('name' => $request->name, 'email' => $request->email , 'password' => Hash::make($request->password) , 'level' => $request->level ,'posisi' =>$request->posisi, 'area' => $request->area, 'regional' =>  ''); 
$masukdb = User::create($masuk);
//UserExist::create(['id' => $masukdb->id ,'name' => $request->name, 'email' => $request->email , 'password' => Hash::make($request->password) , 'level' => $request->level , 'posisi' =>$request->posisi,'area' => $request->area, 'regional' =>  '']);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'users' ,'action' => 'insert', 'data' => json_encode($masuk)]);
return response()->json(['success'=>'Add Successfully']);
 
}
    }
else
    {
 return response()->json('error', $valid);
    } 
    }



    public function update(Request $request, $id)
    {
        $cek = User::findOrFail($id);
if(!$cek)
{
 return response()->json(['error'=>'Code Not Found']);
}
else
{
    if(Input::get('password') == '')
    {
$valid = $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required|max:255|unique:users,email,'.$id,
        'level' => 'in:REGIONAL,HQ',
        'posisi' => 'in:AM SUPPORT,ACCOUNT MANAGER,MANAGER MARKETING,MANAGER',
        'area' => 'in:1,2,3,4',
    ]);
    }
    else
    {
$valid = $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required|max:255|unique:users,email,'.$id,
        'password' => 'required|max:255',
        'level' => 'in:REGIONAL,HQ',
        'posisi' => 'in:AM SUPPORT,ACCOUNT MANAGER,MANAGER MARKETING,MANAGER',
        'area' => 'in:1,2,3,4',
    ]);
    }
if (!$valid)
    {
            if(Input::get('password') == '')
    {
if($request->level == 'REGIONAL' && $request->posisi == 'ACCOUNT MANAGER' || $request->level == 'REGIONAL' && $request->posisi == 'AM SUPPORT')
{
        $edit = array('name' => Input::get('name'), 'email' => Input::get('email'), 'level' => Input::get('level'), 'posisi' => Input::get('posisi'), 'regional' => strtoupper(Input::get('regional')), 'area' => Input::get('area'));
}
elseif($request->level == 'HQ' && $request->posisi == 'MANAGER' || $request->level == 'HQ' && $request->posisi == 'ACCOUNT MANAGER' || $request->level == 'REGIONAL' && $request->posisi == 'MANAGER MARKETING')
{
        $edit = array('name' => Input::get('name'), 'email' => Input::get('email'), 'level' => Input::get('level'), 'posisi' => Input::get('posisi'), 'regional' => '', 'area' => Input::get('area'));
}        
    }
    else
    {
if($request->level == 'REGIONAL' && $request->posisi == 'ACCOUNT MANAGER' || $request->level == 'REGIONAL' && $request->posisi == 'AM SUPPORT')
{        
         $edit = array('name' => Input::get('name'), 'email' => Input::get('email'), 'password' =>  Hash::make(Input::get('password')), 'level' => Input::get('level'), 'posisi' => Input::get('posisi'), 'regional' => strtoupper(Input::get('regional')), 'area' => Input::get('area'));
} 
elseif($request->level == 'HQ' && $request->posisi == 'MANAGER' || $request->level == 'HQ' && $request->posisi == 'ACCOUNT MANAGER' || $request->level == 'REGIONAL' && $request->posisi == 'MANAGER MARKETING')
{
         $edit = array('name' => Input::get('name'), 'email' => Input::get('email'), 'password' =>  Hash::make(Input::get('password')), 'level' => Input::get('level'), 'posisi' => Input::get('posisi'), 'regional' => '', 'area' => Input::get('area'));
}        
    }
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'users' ,'action' => 'update', 'data' => json_encode($cek)]);
$cek->update($edit);
//UserExist::where("id",$id)->update($edit);
return response()->json(['success'=>'Edit Successfully']);
    }
else
    {
 return response()->json('error', $valid);
    }
} 
    }

     public function destroy($id)
    {
$cek = User::findOrFail($id);
if(!$cek)
{
 return response()->json(['error'=>'Data Not Found']);
}
else
{
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'users' ,'action' => 'delete', 'data' => json_encode($cek)]);
User::where('id',$id)->delete();
return response()->json(['success'=>'Delete Successfully']);

}
    }



         public function deleteAll($id)
    {
$get =  User::whereIn('id',explode(",",$id))->get();
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'users' ,'action' => 'delete', 'data' => json_encode($get)]);
User::whereIn('id',explode(",",$id))->delete();
return response()->json(['success'=>"Deleted Successfully."]);
    }


    
}
