<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Response,View,Input,Auth,Session,Validator,File,Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Crypt;

use App\Models\User;

use App\Models\Log;

class LogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('karyawan.auth');
    }

    
    public function index(Request $request)
    {
        $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query = Log::orderBy('id','DESC');
        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query->where('email', 'LIKE', $like)
            ->orWhere('table_action', 'LIKE', $like)
            ->orWhere('action', 'LIKE', $like);
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
            ->orWhere('table_action', 'LIKE', $like)
            ->orWhere('action', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('email', 'LIKE', $like)
            ->orWhere('table_action', 'LIKE', $like)
            ->orWhere('action', 'LIKE', $like);
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
            ->orWhere('table_action', 'LIKE', $like)
            ->orWhere('action', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }

     public function destroy($id)
    {
$cek = Log::findOrFail($id);
if(!$cek)
{
 return response()->json(['error'=>'Code Not Found']);
}
else
{
$delete = Log::where('id',$id)->delete();
if(!$delete)
{
return response()->json(['error'=>'Delete Error']);
}
else
{
return response()->json(['success'=>'Delete Success']);
}
}
    }

         public function deleteAll($id)
    {
        $get =  Log::whereIn('id',explode(",",$id))->get();
          $cek = Log::whereIn('id',explode(",",$id))->delete();
        if(!$cek)
{
return response()->json(['error'=>'Delete Error']);
}
else
{return response()->json(['success'=>"Log Deleted successfully."]);}
    }
	

    
}
