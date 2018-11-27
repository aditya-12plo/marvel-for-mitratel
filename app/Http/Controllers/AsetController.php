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
use App\Models\BOQSubmit;
use App\Models\SiteOpening;
use App\Models\Excavation;
use App\Models\Rebaring;
use App\Models\Pouring;
use App\Models\Curing;
use App\Models\TowerErection;
use App\Models\MEProcess;
use App\Models\FenceYard;
use App\Models\RfiBaut;
use App\Models\RfiDetail;
use App\Models\Aset;

class AsetController extends Controller
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
        $query = Aset::orderBy('id','DESC');
        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like);
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
            ->orWhere('name', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('email', 'LIKE', $like)
            ->orWhere('name', 'LIKE', $like);
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
            ->orWhere('name', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }
    

    public function store(Request $request)
    {
$valid = $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required|unique:Aset,email'
    ]);
if (!$valid)
    { 
$masuk = array('name' => $request->name, 'email' => $request->email ); 
Aset::create($masuk);
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'Aset' ,'action' => 'insert', 'data' => json_encode($masuk)]);
return response()->json(['success'=>'Add Successfully']);
    }
else
    {
 return response()->json('error', $valid);
    } 
    }


    public function destroy($id)
    {
$cek = Aset::findOrFail($id);
if(!$cek)
{
 return response()->json(['error'=>'Data Not Found']);
}
else
{
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'Aset' ,'action' => 'delete', 'data' => json_encode($cek)]);
Aset::where('id',$id)->delete();
return response()->json(['success'=>'Delete Successfully']);

}
    }


    
    public function deleteAll($id)
    {
$get =  Aset::whereIn('id',explode(",",$id))->get();
Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'Aset' ,'action' => 'delete', 'data' => json_encode($get)]);
Aset::whereIn('id',explode(",",$id))->delete();
return response()->json(['success'=>"Deleted Successfully."]);
    }


    public function update(Request $request, $id)
    {  
$valid = $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required|unique:Aset,email,'.$id
    ]);
 
if (!$valid)
    {
        $edit = array('name' => $request->name, 'email' => $request->email ); 
       Aset::where('id',$id)->update($edit);
        Log::create(['email' => Auth::guard('karyawan')->user()->email, 'table_action'=>'Aset' ,'action' => 'insert', 'data' => json_encode($edit)]);
        return response()->json(['success'=>'Add Successfully']); 
    }
else
{
    return response()->json('error', $valid);

}
}



}