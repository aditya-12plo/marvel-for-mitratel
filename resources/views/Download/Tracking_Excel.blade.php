<html> 
 <body style="padding:0;font-size: 10px;">
 

 <table border="1" style="padding:0;border-collapse: collapse;border: 1px solid black;"> 
<tr>
 
  <tr>
    <td><b>NO</b></td>
    <td><b>PROJECTID</b></td>
    <td><b>NO WO</b></td>
    <td><b>WO DATE</b></td>
    <td><b>BATCH</b></td>
    <td><b>TAHUN</b></td>
    <td><b>INFRATYPE</b></td>
    <td><b>AREA</b></td>
    <td><b>REGIONAL</b></td>
    <td><b>SITE ID SPK</b></td>
    <td><b>SITE NAME SPK</b></td>
    <td><b>ALAMAT SPK</b></td>
    <td><b>LONGITUDE SPK</b></td>
    <td><b>LATITUDE SPK</b></td> 
    <td><b>SITE ID AKTUAL</b></td>
    <td><b>SITE NAME AKTUAL</b></td>
    <td><b>ALAMAT AKTUAL</b></td>
    <td><b>LONGITUDE AKTUAL</b></td>
    <td><b>LATITUDE AKTUAL</b></td>
    <td><b>KOTA</b></td>
    <td><b>PROVINSI</b></td>
    <td><b>KOM DATE</b></td>
    <td><b>DRM DATE</b></td>
    <td><b>NO BAN BAK</b></td>
    <td><b>DATE BAN BAK</b></td>
    <td><b>IJIN WARGA DATE</b></td>
    <td><b>NO PKS</b></td>
    <td><b>PKS DATE</b></td>
    <td><b>NO IMB</b></td>
    <td><b>IMB DATE</b></td>
    <td><b>NO RFC</b></td>
    <td><b>RFC DATE</b></td>
    <td><b>PLN ID</b></td>
    <td><b>KAPASITAS POWER</b></td>
    <td><b>KAPASITAS POWER</b></td>
    <td><b>SITE TYPE</b></td>
    <td><b>TINGGI TOWER</b></td>
    <td><b>TIPE TOWER</b></td>
    <td><b>RF IN MATERS</b></td>
    <td><b>MW IN MATERS</b></td>
    <td><b>HARGA / BULAN</b></td>
    <td><b>HARGA / TAHUN</b></td>
    <td><b>STATUS PROJECT</b></td>
  </tr>

<!-- loop here -->
@php
$no=1;
$jml=0;
@endphp
@foreach ($data as $a) 
  <tr>
<td>{{$no++}}</td>
<td>{{$a->projectid}}</td>
<td>{{$a->no_wo}}</td>
<td>{{$a->wo_date}}</td>
<td>{{$a->batchnya}}</td>
<td>{{$a->years}}</td>
<td>{{$a->infratype}}</td>
<td>AREA {{$a->area}}</td>
<td>{{$a->regional}}</td>
<td>{{$a->site_id_spk}}</td>
<td>{{$a->site_name_spk}}</td>
<td>{{$a->address_spk}}</td> 
<td>{{$a->longitude_spk}}</td>
<td>{{$a->latitude_spk}}</td> 
<td>{{$a->site_id_actual}}</td>
<td>{{$a->site_name_actual}}</td>
<td>{{$a->address_actual}}</td>
<td>{{$a->longitude_actual}}</td>
<td>{{$a->latitude_actual}}</td>
<td>{{$a->city}}</td>
<td>{{$a->province}}</td>
<td>{{$a->kom_date}}</td>   
<td>{{$a->drm_date}}</td>
<td>{{$a->no_ban_bak}}</td>   
<td>{{$a->date_ban_bak}}</td> 
<td>{{$a->ijin_warga_date}}</td> 
    <td>{{$a->no_pks}}</td>
    <td>{{$a->pks_date}}</td>  
    <td>{{$a->no_imb}}</td>  
    <td>{{$a->imb_date}}</td> 
    <td>{{$a->no_rfc}}</td> 
    <td>{{$a->rfc_date}}</td> 
    <td>{{$a->id_pln}}</td> 
    <td>PLN {{$a->power_capacity}} KVA</td> 
    <td>PO Release + {{$a->target_rfi}} days</td>  
   <td>{{$a->site_type}}</td>
    <td>{{$a->tower_high}}</td>
    <td>{{$a->tower_type}}</td>
    <td>{{$a->rf_in_meters}}</td>
    <td>{{$a->mw_in_meters}}</td>
    <td>{{$a->harga_bulan}}</td>
    <td>{{$a->harga_tahun}}</td>
    <td><b>{{$a->statusnya}}</b></td>
  </tr>
 @php 
 $no++; 
 $jml = $a->harga_tahun + $jml; 
 @endphp 
@endforeach 
<!-- loop here -->
 
			 	
        </table>
		
 
		
		
		
		
		
		
		
		
		
		
		
		
		
		
    </body>
</html>