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
        ->select('id','projectid','no_wo','wo_date','batch','years','infratype','area','regional','site_id_spk','site_name_spk','address_spk','longitude_spk','latitude_spk','status_id','project_status_id','statusnya','created_at')
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
        ->select('id','projectid','no_wo','wo_date','batch','years','infratype','area','regional','site_id_spk','site_name_spk','address_spk','longitude_spk','latitude_spk','status_id','project_status_id','statusnya','documentsisid','document_sis','created_at')
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
        ->select('id','projectid','no_wo','wo_date','batch','years','infratype','area','regional','site_id_spk','site_name_spk','address_spk','longitude_spk','latitude_spk','status_id','project_status_id','statusnya','documentid','document_sis','created_at')
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
