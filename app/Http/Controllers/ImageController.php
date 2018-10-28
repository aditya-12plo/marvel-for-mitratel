<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Response,View,Input,Auth,Session,Validator,File,Hash,DB,Excel,Mail,Image;
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
use App\Models\ProjectStatus;
use App\Models\HistoryDrop;
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
use App\Models\PO;
use App\Models\BackgroundImage;
use App\Models\Slide;

class ImageController extends Controller
{
        public function __construct()
    {
        $this->middleware('karyawan.auth');
        $this->data['title']  = 'Selamat Datang';
        $this->SendEmailController = app('App\Http\Controllers\SendEmailController');
        $this->data['tahunproject']  = DB::table('vtahun')->get();
    }

 
// list slide show
public function listslideshow(Request $request)
{
    $perPage = $request->per_page;
    $search = $request->filter; 
$query = Slide::orderBy('id','DESC');
 
if (!empty($search))
{
$like = "%{$search}%";
$query = $query->where('name', 'LIKE', $like)
       ->orWhere('sequence', 'LIKE', $like);
}
 


    return $query->paginate($perPage);
}


public function addslideshow(Request $request)
{
    $valid = $this->validate($request, [
        'sequence' => 'required|numeric|not_in:0', 
        'name' => 'required|max:255', 
        'image' => 'required|mimes:jpg,png,jpeg|max:10240'
    ]);
    if (!$valid)
    {
        $name = str_replace(' ', '_', $request->name);
        $file = Input::file('image'); 
        $extension  = Input::file('image')->getClientOriginalExtension();
        $destinationPath = 'img/'; // upload path   
        $fileName   = $name.'_'.time().'.'.$extension;
        if(file_exists($destinationPath.$fileName))
        {
             File::delete($destinationPath .$fileName);
        }
        $upload_success     = $file->move($destinationPath, $fileName);
        if(!$upload_success)
            {
         return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
            }
        else
            { 
                
                Slide::create(['sequence'=>$request->sequence,'name'=>$request->name,'image'=>$fileName]);
                return response()->json(['success'=>'Successfully']);
            }

    }
    else
    {
        return response()->json('error', $valid);
    }


}
 
public function deleteslideshow($id,$filename)
{
$destinationPath = 'img/'; // upload path   
File::delete($destinationPath .$filename); 
Slide::where('id',$id)->delete();
return response()->json(['success'=>'Successfully']);

}



public function updateslideshow(Request $request)
{
    $valid = $this->validate($request, [
        'sequence' => 'required|numeric|not_in:0', 
        'name' => 'required|max:255',
        'image_old' => 'required',
    ]);
    if (!$valid)
    {
        if(Input::file('image'))
        {
            $valid2 = $this->validate($request, [
        'image' => 'required|mimes:jpg,png,jpeg|max:10240'
            ]);
            if (!$valid2)
            {
            $name = str_replace(' ', '_', $request->name);
            $file = Input::file('image'); 
            $extension  = Input::file('image')->getClientOriginalExtension();
            $destinationPath = 'img/'; // upload path   
            $fileName   = $name.'_'.time().'.'.$extension;
            if(file_exists($destinationPath.$fileName))
            {
                 File::delete($destinationPath .$fileName);
            }
            $upload_success     = $file->move($destinationPath, $fileName);
            if(!$upload_success)
                {
             return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
                }
            else
                { 
            File::delete($destinationPath .$request->image_old);        
            Slide::where('id',$request->id)->update(['sequence'=>$request->sequence,'name'=>$request->name,'image'=>$fileName]);
             return response()->json(['success'=>'Successfully']);
                }
            }
            else
            {
                return response()->json('error', $valid2);
            }
        }
        else
        { 
            Slide::where('id',$request->id)->update(['sequence'=>$request->sequence,'name'=>$request->name]);
            return response()->json(['success'=>'Successfully']);
        }

    }
    else
    {
        return response()->json('error', $valid);
    }


}



// list background
public function listbackground(Request $request)
{
    $perPage = $request->per_page;
    $search = $request->filter; 
$query = BackgroundImage::orderBy('id','DESC');
 
if (!empty($search))
{
$like = "%{$search}%";
$query = $query->where('name', 'LIKE', $like)
       ->orWhere('sequence', 'LIKE', $like);
}
 


    return $query->paginate($perPage);
}


public function addbackground(Request $request)
{
    $valid = $this->validate($request, [
        'sequence' => 'required|numeric|not_in:0', 
        'name' => 'required|max:255', 
        'image' => 'required|mimes:jpg,png,jpeg|max:10240'
    ]);
    if (!$valid)
    {
        $name = str_replace(' ', '_', $request->name);
        $file = Input::file('image'); 
        $extension  = Input::file('image')->getClientOriginalExtension();
        $destinationPath = 'img/'; // upload path   
        $fileName   = $name.'_'.time().'.'.$extension;
        if(file_exists($destinationPath.$fileName))
        {
             File::delete($destinationPath .$fileName);
        }
        $upload_success     = $file->move($destinationPath, $fileName);
        if(!$upload_success)
            {
         return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
            }
        else
            { 
                
                BackgroundImage::create(['sequence'=>$request->sequence,'name'=>$request->name,'image'=>$fileName]);
                return response()->json(['success'=>'Successfully']);
            }

    }
    else
    {
        return response()->json('error', $valid);
    }


}
 
public function deletebackground($id,$filename)
{
$destinationPath = 'img/'; // upload path   
File::delete($destinationPath .$filename); 
BackgroundImage::where('id',$id)->delete();
return response()->json(['success'=>'Successfully']);

}



public function updatebackground(Request $request)
{
    $valid = $this->validate($request, [
        'sequence' => 'required|numeric|not_in:0', 
        'name' => 'required|max:255',
        'image_old' => 'required',
    ]);
    if (!$valid)
    {
        if(Input::file('image'))
        {
            $valid2 = $this->validate($request, [
        'image' => 'required|mimes:jpg,png,jpeg|max:10240'
            ]);
            if (!$valid2)
            {
            $name = str_replace(' ', '_', $request->name);
            $file = Input::file('image'); 
            $extension  = Input::file('image')->getClientOriginalExtension();
            $destinationPath = 'img/'; // upload path   
            $fileName   = $name.'_'.time().'.'.$extension;
            if(file_exists($destinationPath.$fileName))
            {
                 File::delete($destinationPath .$fileName);
            }
            $upload_success     = $file->move($destinationPath, $fileName);
            if(!$upload_success)
                {
             return response()->json(['error'=>'File Upload Gagal, Silahkan Ulangi']);
                }
            else
                { 
            File::delete($destinationPath .$request->image_old);        
            BackgroundImage::where('id',$request->id)->update(['sequence'=>$request->sequence,'name'=>$request->name,'image'=>$fileName]);
             return response()->json(['success'=>'Successfully']);
                }
            }
            else
            {
                return response()->json('error', $valid2);
            }
        }
        else
        { 
            BackgroundImage::where('id',$request->id)->update(['sequence'=>$request->sequence,'name'=>$request->name]);
            return response()->json(['success'=>'Successfully']);
        }

    }
    else
    {
        return response()->json('error', $valid);
    }


}



    
}
