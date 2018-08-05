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

class JobsController extends Controller
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
    }

    
    public function GetJobsDocumentSIS(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentsis')
         ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


    public function GetJobsRevisiDocumentSIS(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentsisrevisi')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


    public function GetJobsApprovalDocumentSIS(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsapprovaldocumentsis')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }



// DRM DOCUMENT

    
    public function GetJobsDocumentDRM(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentdrm')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


    
    public function GetJobsApprovalDocumentDRM(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsapprovaldocumentdrm')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }




    public function GetJobsRevisiDocumentDRM(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentdrmrevisi')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }



// SITAC DOCUMENT

    
    public function GetJobsDocumentSITAC(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentsitac')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }




    public function GetJobsApprovalDocumentSITAC(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsapprovaldocumentsitac')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }




    public function GetJobsRevisiDocumentSITAC(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentsitacrevisi')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }




// SITAC RFC

    
    public function GetJobsDocumentRFC(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentrfc')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }




    public function GetJobsApprovalDocumentRFC(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsapprovaldocumentrfc')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }



    public function GetJobsRevisiDocumentRFC(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsdocumentrfcrevisi')
        ->where([['regional',Auth::guard('karyawan')->user()->regional],['area',Auth::guard('karyawan')->user()->area]])
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }



    public function GetJobsBOQ(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobboq')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }

// MAPPING SITE

 public function GetJobsMappingSite(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsmappingsite')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


 public function GetJobsMappingSiteApproved(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsapprovedmappingsite')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


// DROP SITE

 public function GetJobsApprovalDrop(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vjobsapprovaldropsiteregional')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }

// HISTORY DROP SITE

 public function HistoryDropSite(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vhistorydropsite')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


// MAPPING DROP SITE
 public function HistoryMappingSite(Request $request)
    {
       $perPage = $request->per_page;
        $search = $request->filter;
        $min = $request->min;
        $max = $request->max;
        $query =  DB::table('vhistorymappingsite')
        ->where('area',Auth::guard('karyawan')->user()->area)
        ->orderBy('id','DESC');

        if ($search && !$min && !$max) {
            $like = "%{$search}%";
            $query = $query
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
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
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if($search && !$min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        if(!$search && $min && $max)
        {
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max);
        }
        if($search && $min && $max)
        {
            $like = "%{$search}%";
            $query = $query->whereDate('created_at','>=',$min)->whereDate('created_at','<=',$max)
            ->where('projectid', 'LIKE', $like)
            ->orWhere('no_wo', 'LIKE', $like)
            ->orWhere('infratype', 'LIKE', $like);
        }
        return $query->paginate($perPage);
    }


}
