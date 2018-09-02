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
use PHPExcel; 
use PHPExcel_IOFactory;

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

class DownloadController extends Controller
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


            public function DownloadExcelTracking(Request $request)
    {
$fileName = $request->filename;        
$projectid =  $request->projectid;     
$project =  DB::table('vallproject') 
        ->whereIn('id',explode(",",$projectid))
        ->orderBy('id','DESC')->get();
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Add column headers
$objPHPExcel->getActiveSheet()
            ->setCellValue('A1', 'AREA')
            ->setCellValue('B1', 'PROJECTID')
            ->setCellValue('C1', 'BATCH')
            ->setCellValue('D1', 'NO WO')
            ->setCellValue('E1', 'WO DATE')
            ->setCellValue('F1', 'TAHUN')
            ->setCellValue('G1', 'INFRATYPE')
            ->setCellValue('H1', 'SITE ID SPK')
            ->setCellValue('I1', 'SITE NAME SPK')
            ->setCellValue('J1', 'ALAMAT SPK')
            ->setCellValue('K1', 'LONGITUDE SPK')
            ->setCellValue('L1', 'LATITUDE SPK')
            ->setCellValue('M1', 'SITE ID AKTUAL')
            ->setCellValue('N1', 'SITE NAME AKTUAL')
            ->setCellValue('O1', 'ALAMAT AKTUAL')
            ->setCellValue('P1', 'LONGITUDE AKTUAL')
            ->setCellValue('Q1', 'LATITUDE AKTUAL') 
            ->setCellValue('R1', 'KOTA') 
            ->setCellValue('S1', 'PROVINSI') 
            ->setCellValue('T1', 'KOM DATE') 
            ->setCellValue('U1', 'DRM DATE') 
            ->setCellValue('V1', 'NO BAN BAK') 
            ->setCellValue('W1', 'DATE BAN BAK') 
            ->setCellValue('X1', 'IJIN WARGA DATE') 
            ->setCellValue('Y1', 'NO PKS') 
            ->setCellValue('Z1', 'PKS DATE') 
            ->setCellValue('AA1', 'NO IMB') 
            ->setCellValue('AB1', 'IMB DATE') 
            ->setCellValue('AC1', 'NO RFC') 
            ->setCellValue('AD1', 'RFC DATE') 
            ->setCellValue('AE1', 'PLN ID') 
            ->setCellValue('AF1', 'KAPASITAS POWER') 
            ->setCellValue('AG1', 'SITE TYPE') 
            ->setCellValue('AH1', 'TINGGI TOWER') 
            ->setCellValue('AI1', 'TIPE TOWER') 
            ->setCellValue('AJ1', 'RF IN MATERS') 
            ->setCellValue('AK1', 'MW IN MATERS') 
            ->setCellValue('AL1', 'SITE OPENING DATE') 
            ->setCellValue('AM1', 'EXCAVATIOAN DATE') 
            ->setCellValue('AN1', 'REBARING DATE') 
            ->setCellValue('AO1', 'POURING DATE') 
            ->setCellValue('AP1', 'COURING DATE') 
            ->setCellValue('AQ1', 'TOWER ERACTION DATE') 
            ->setCellValue('AR1', 'M-E PROCESS DATE') 
            ->setCellValue('AS1', 'FENCE & YARD DATE') 
            ->setCellValue('AT1', 'RFI DATE') 
            ->setCellValue('AU1', 'BAUT DATE') 
            ->setCellValue('AV1', 'TANGGAL MULAI SEWA') 
            ->setCellValue('AW1', 'TANGGAL BERAKHIR SEWA') 
            ->setCellValue('AX1', 'PRICE / MONTH') 
            ->setCellValue('AY1', 'PRICE / YEARS') 
            ->setCellValue('AZ1', 'NILAI REVENUE') 
            ->setCellValue('BA1', 'BATCH ACCRUE') 
            ->setCellValue('BB1', 'PO NO') 
            ->setCellValue('BC1', 'PO DATE') 
            ;

$objPHPExcel->getActiveSheet()->getStyle('A1:BC1')->getFont()->setBold(true);  
$no=1;
$row=2; 
//Put each record in a new cell
foreach ($project as $a){ 
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'AREA '.$a->area);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $a->projectid);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $a->batchnya);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $a->no_wo);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $a->wo_date);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $a->years);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $a->infratype);
    $objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $a->site_id_spk);
    $objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $a->site_name_spk);
    $objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $a->address_spk);
    $objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $a->longitude_spk);
    $objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $a->latitude_spk);
    $objPHPExcel->getActiveSheet()->setCellValue('M'.$row, $a->site_id_actual);
    $objPHPExcel->getActiveSheet()->setCellValue('N'.$row, $a->site_name_actual);
    $objPHPExcel->getActiveSheet()->setCellValue('O'.$row, $a->address_actual);
    $objPHPExcel->getActiveSheet()->setCellValue('P'.$row, $a->longitude_actual);
    $objPHPExcel->getActiveSheet()->setCellValue('Q'.$row, $a->latitude_actual);
    $objPHPExcel->getActiveSheet()->setCellValue('R'.$row, $a->city);
    $objPHPExcel->getActiveSheet()->setCellValue('S'.$row, $a->province);
    $objPHPExcel->getActiveSheet()->setCellValue('T'.$row, $a->kom_date);
    $objPHPExcel->getActiveSheet()->setCellValue('U'.$row, $a->drm_date);
    $objPHPExcel->getActiveSheet()->setCellValue('V'.$row, $a->no_ban_bak);
    $objPHPExcel->getActiveSheet()->setCellValue('W'.$row, $a->date_ban_bak);
    $objPHPExcel->getActiveSheet()->setCellValue('X'.$row, $a->ijin_warga_date);
    $objPHPExcel->getActiveSheet()->setCellValue('Y'.$row, $a->no_pks);
    $objPHPExcel->getActiveSheet()->setCellValue('Z'.$row, $a->pks_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AA'.$row, $a->no_imb);
    $objPHPExcel->getActiveSheet()->setCellValue('AB'.$row, $a->imb_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AC'.$row, $a->no_rfc);
    $objPHPExcel->getActiveSheet()->setCellValue('AD'.$row, $a->rfc_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AE'.$row, $a->id_pln);
    $objPHPExcel->getActiveSheet()->setCellValue('AF'.$row, $a->power_capacity);
    $objPHPExcel->getActiveSheet()->setCellValue('AG'.$row, $a->site_type);
    $objPHPExcel->getActiveSheet()->setCellValue('AH'.$row, $a->tower_high);
    $objPHPExcel->getActiveSheet()->setCellValue('AI'.$row, $a->tower_type);
    $objPHPExcel->getActiveSheet()->setCellValue('AJ'.$row, $a->rf_in_meters);
    $objPHPExcel->getActiveSheet()->setCellValue('AK'.$row, $a->mw_in_meters);
    $objPHPExcel->getActiveSheet()->setCellValue('AL'.$row, $a->site_opening_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AM'.$row, $a->excavation_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AN'.$row, $a->rebaring_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AO'.$row, $a->pouring_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AP'.$row, $a->curing_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AQ'.$row, $a->tower_erection_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AR'.$row, $a->m_e_process_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AS'.$row, $a->fence_yard_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AT'.$row, $a->rfi_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AU'.$row, $a->baut_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AV'.$row, $a->rfi_detail_start_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AW'.$row, $a->rfi_detail_end_date);
    $objPHPExcel->getActiveSheet()->setCellValue('AX'.$row, $a->rfi_detail_price_month);
    $objPHPExcel->getActiveSheet()->setCellValue('AY'.$row, $a->rfi_detail_price_year);
    $objPHPExcel->getActiveSheet()->setCellValue('AZ'.$row, $a->nilai_revenue);
    $objPHPExcel->getActiveSheet()->setCellValue('BA'.$row, $a->batch_accrue);
    $objPHPExcel->getActiveSheet()->setCellValue('BB'.$row, $a->no_po);
    $objPHPExcel->getActiveSheet()->setCellValue('BC'.$row, $a->po_date);
$no++; 
$row++;   
}
 
// Set worksheet title
$objPHPExcel->getActiveSheet()->setTitle('Sheet1');

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
/*
return Excel::create('ExportData', function($excel) use ($project){
    $excel->sheet('ExportData', function($sheet) use ($project){
             $sheet->loadView('Download.Tracking_Excel')
             ->with('data',$project);
             $sheet->setOrientation('landscape');
            });
    
})->export('xls'); 
*/

    }


            public function printHaki(Request $request)
    {
$fileName = $request->cme_code;
$datanya =  $request->datanya; 

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Add column headers
$objPHPExcel->getActiveSheet()
            ->setCellValue('A1', 'KODE ACCRUAL : ')
            ->setCellValue('B1', $fileName)
            ->setCellValue('A3', 'NO')
            ->setCellValue('B3', 'PROJECTID')
            ->setCellValue('C3', 'BATCH')
            ->setCellValue('D3', 'PO NO')
            ->setCellValue('E3', 'PO DATE')
            ->setCellValue('F3', 'SITE NAME SPK')
            ->setCellValue('G3', 'SITE ID SPK')
            ->setCellValue('H3', 'SITE NAME AKTUAL')
            ->setCellValue('I3', 'SITE ID AKTUAL')
            ->setCellValue('J3', 'AREA')
            ->setCellValue('K3', 'REGION')
            ->setCellValue('L3', 'SOW')
            ->setCellValue('M3', 'RFI DATE')
            ->setCellValue('N3', 'START MASA SEWA')
            ->setCellValue('O3', 'AKHIR MASA SEWA')
            ->setCellValue('P3', 'PRICE / MONTH')
            ->setCellValue('Q3', 'PRICE / YEARS')
            ->setCellValue('R3', 'NILAI REVENUE')
            ->setCellValue('S3', 'BATCH ACCRUE') 
            ;

$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true); 
$objPHPExcel->getActiveSheet()->getStyle('A3:T3')->getFont()->setBold(true); 

$no=1;
$row=4;
$jml=0;
//Put each record in a new cell
foreach ($datanya as $a){ 
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $no);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,  $a['projectid']);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $a['batchnya']);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $a['no_po']);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $a['po_date']);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $a['site_name_spk']);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $a['site_id_spk']);
    $objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $a['site_name_actual']);
    $objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $a['site_id_actual']);
    $objPHPExcel->getActiveSheet()->setCellValue('J'.$row, 'AREA '.$a['area']);
    $objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $a['regional']);
    $objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $a['infratype']);
    $objPHPExcel->getActiveSheet()->setCellValue('M'.$row, $a['rfi_date']);
    $objPHPExcel->getActiveSheet()->setCellValue('N'.$row, $a['rfi_detail_start_date']);
    $objPHPExcel->getActiveSheet()->setCellValue('O'.$row, $a['rfi_detail_end_date']);
    $objPHPExcel->getActiveSheet()->setCellValue('P'.$row, $a['rfi_detail_price_month']);
    $objPHPExcel->getActiveSheet()->setCellValue('Q'.$row, $a['rfi_detail_price_year']);
    $objPHPExcel->getActiveSheet()->setCellValue('R'.$row, $a['nilai_revenue']);
    $objPHPExcel->getActiveSheet()->setCellValue('S'.$row, $a['batch_accrue']);
$no++; 
$row++;  
$jml = $a['nilai_revenue'] + $jml; 
}

$rowLast=count($datanya)+4;
 $objPHPExcel->getActiveSheet()->setCellValue('Q'.$rowLast, 'TOTAL : ');
 $objPHPExcel->getActiveSheet()->setCellValue('R'.$rowLast, $jml);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$rowLast.':R'.$rowLast)->getFont()->setBold(true);

// Set worksheet title
$objPHPExcel->getActiveSheet()->setTitle('Sheet1');

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');



/*        
$cme_code = $request->cme_code;        
$datanya =  $request->datanya;     
ob_clean();
return Excel::create('ExportData', function($excel) use ($datanya){
    $excel->sheet('ExportData', function($sheet) use ($datanya){
             $sheet->loadView('Download.Haki_Excel')
             ->with('data',$datanya);
             $sheet->setOrientation('landscape');
            });
    
})->export('xlsx'); 
*/

    }


            public function printHakiAccrual(Request $request)
    {
$fileName = $request->cme_code;
$projectid =  $request->projectid; 
$kodenya =  explode(",",$projectid);
$datanya =  DB::table('vallprojectaccrual') 
        ->whereIn('id',$kodenya)
        ->orderBy('id','DESC')->get();
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Add column headers
$objPHPExcel->getActiveSheet()
            ->setCellValue('A1', 'LIST DATA ACCRUAL')
            ->setCellValue('A2', 'KODE ACCRUAL : ')
            ->setCellValue('B2', $fileName)
            ->setCellValue('A3', 'NO')
            ->setCellValue('B3', 'PROJECTID')
            ->setCellValue('C3', 'BATCH')
            ->setCellValue('D3', 'PO NO')
            ->setCellValue('E3', 'PO DATE')
            ->setCellValue('F3', 'SITE NAME SPK')
            ->setCellValue('G3', 'SITE ID SPK')
            ->setCellValue('H3', 'SITE NAME AKTUAL')
            ->setCellValue('I3', 'SITE ID AKTUAL')
            ->setCellValue('J3', 'AREA')
            ->setCellValue('K3', 'REGION')
            ->setCellValue('L3', 'SOW')
            ->setCellValue('M3', 'RFI DATE')
            ->setCellValue('N3', 'START MASA SEWA')
            ->setCellValue('O3', 'AKHIR MASA SEWA')
            ->setCellValue('P3', 'PRICE / MONTH')
            ->setCellValue('Q3', 'PRICE / YEARS')
            ->setCellValue('R3', 'NILAI REVENUE')
            ->setCellValue('S3', 'BATCH ACCRUE') 
            ;

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); 
$objPHPExcel->getActiveSheet()->getStyle('A2:B2')->getFont()->setBold(true); 
$objPHPExcel->getActiveSheet()->getStyle('A3:S3')->getFont()->setBold(true); 

$no=1;
$row=4;
$jml=0;
//Put each record in a new cell
foreach ($datanya as $a){ 
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $no);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,  $a->projectid);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $a->batchnya);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $a->no_po);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $a->po_date);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $a->site_name_spk);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $a->site_id_spk);
    $objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $a->site_id_actual);
    $objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $a->site_name_actual);
    $objPHPExcel->getActiveSheet()->setCellValue('J'.$row, 'AREA '.$a->area);
    $objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $a->regional);
    $objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $a->infratype);
    $objPHPExcel->getActiveSheet()->setCellValue('M'.$row, $a->rfi_date);
    $objPHPExcel->getActiveSheet()->setCellValue('N'.$row, $a->rfi_detail_start_date);
    $objPHPExcel->getActiveSheet()->setCellValue('O'.$row, $a->rfi_detail_end_date);
    $objPHPExcel->getActiveSheet()->setCellValue('P'.$row, $a->rfi_detail_price_month);
    $objPHPExcel->getActiveSheet()->setCellValue('Q'.$row, $a->rfi_detail_price_year);
    $objPHPExcel->getActiveSheet()->setCellValue('R'.$row, $a->nilai_revenue);
    $objPHPExcel->getActiveSheet()->setCellValue('S'.$row, $a->batch_accrue);
$no++; 
$row++;  
$jml = $a->nilai_revenue + $jml; 
}

$rowLast=count($datanya)+4;
 $objPHPExcel->getActiveSheet()->setCellValue('Q'.$rowLast, 'TOTAL : ');
 $objPHPExcel->getActiveSheet()->setCellValue('R'.$rowLast, $jml);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$rowLast.':R'.$rowLast)->getFont()->setBold(true);

// Set worksheet title
$objPHPExcel->getActiveSheet()->setTitle('Sheet1');

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
 

    }





            public function printHakiAccrued(Request $request)
    {
$fileName = $request->cme_code;
$projectid =  $request->projectid; 
$kodenya =  explode(",",$projectid);
$datanya =  DB::table('vallprojectaccrued') 
        ->whereIn('id',$kodenya)
        ->orderBy('id','DESC')->get();
// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Add column headers
$objPHPExcel->getActiveSheet()
            ->setCellValue('A1', 'LIST DATA ACCRUAL')
            ->setCellValue('A2', 'KODE ACCRUAL : ')
            ->setCellValue('B2', $fileName)
            ->setCellValue('A3', 'NO')
            ->setCellValue('B3', 'PROJECTID')
            ->setCellValue('C3', 'BATCH')
            ->setCellValue('D3', 'PO NO')
            ->setCellValue('E3', 'PO DATE')
            ->setCellValue('F3', 'SITE NAME SPK')
            ->setCellValue('G3', 'SITE ID SPK')
            ->setCellValue('H3', 'SITE NAME AKTUAL')
            ->setCellValue('I3', 'SITE ID AKTUAL')
            ->setCellValue('J3', 'AREA')
            ->setCellValue('K3', 'REGION')
            ->setCellValue('L3', 'SOW')
            ->setCellValue('M3', 'RFI DATE')
            ->setCellValue('N3', 'START MASA SEWA')
            ->setCellValue('O3', 'AKHIR MASA SEWA')
            ->setCellValue('P3', 'PRICE / MONTH')
            ->setCellValue('Q3', 'PRICE / YEARS')
            ->setCellValue('R3', 'NILAI REVENUE')
            ->setCellValue('S3', 'BATCH ACCRUE') 
            ;

$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); 
$objPHPExcel->getActiveSheet()->getStyle('A2:B2')->getFont()->setBold(true); 
$objPHPExcel->getActiveSheet()->getStyle('A3:S3')->getFont()->setBold(true); 

$no=1;
$row=4;
$jml=0;
//Put each record in a new cell
foreach ($datanya as $a){ 
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $no);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,  $a->projectid);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $a->batchnya);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $a->no_po);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $a->po_date);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $a->site_name_spk);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $a->site_id_spk);
    $objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $a->site_id_actual);
    $objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $a->site_name_actual);
    $objPHPExcel->getActiveSheet()->setCellValue('J'.$row, 'AREA '.$a->area);
    $objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $a->regional);
    $objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $a->infratype);
    $objPHPExcel->getActiveSheet()->setCellValue('M'.$row, $a->rfi_date);
    $objPHPExcel->getActiveSheet()->setCellValue('N'.$row, $a->rfi_detail_start_date);
    $objPHPExcel->getActiveSheet()->setCellValue('O'.$row, $a->rfi_detail_end_date);
    $objPHPExcel->getActiveSheet()->setCellValue('P'.$row, $a->rfi_detail_price_month);
    $objPHPExcel->getActiveSheet()->setCellValue('Q'.$row, $a->rfi_detail_price_year);
    $objPHPExcel->getActiveSheet()->setCellValue('R'.$row, $a->nilai_revenue);
    $objPHPExcel->getActiveSheet()->setCellValue('S'.$row, $a->batch_accrue);
$no++; 
$row++;  
$jml = $a->nilai_revenue + $jml; 
}

$rowLast=count($datanya)+4;
 $objPHPExcel->getActiveSheet()->setCellValue('Q'.$rowLast, 'TOTAL : ');
 $objPHPExcel->getActiveSheet()->setCellValue('R'.$rowLast, $jml);
$objPHPExcel->getActiveSheet()->getStyle('Q'.$rowLast.':R'.$rowLast)->getFont()->setBold(true);

// Set worksheet title
$objPHPExcel->getActiveSheet()->setTitle('Sheet1');

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
 

    }



 }