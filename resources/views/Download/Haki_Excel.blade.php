<html> 
 <body style="padding:0;font-size: 10px;">
 

 <table border="1" style="padding:0;border-collapse: collapse;border: 1px solid black;"> 
<tr>
 
  <tr>
    <td><b>NO</b></td>
    <td><b>PROJECTID</b></td>
    <td><b>BATCH</b></td>
    <td><b>SITE NAME SPK</b></td>
    <td><b>SITE ID SPK</b></td> 
    <td><b>SITE NAME AKTUAL</b></td>
    <td><b>SITE ID AKTUAL</b></td> 
    <td><b>AREA</b></td> 
    <td><b>REGION</b></td> 
    <td><b>SOW</b></td> 
    <td><b>RFI DATE</b></td> 
    <td><b>START MASA SEWA</b></td> 
    <td><b>AKHIR MASA SEWA</b></td> 
    <td><b>PRICE / MONTH</b></td> 
    <td><b>PRICE / YEARS</b></td> 
    <td><b>NILAI REVENUE</b></td> 
    <td><b>BATCH ACCRUE</b></td> 
  </tr>

<!-- loop here -->
@php
$no=1;
$jml=0;
@endphp
@foreach ($data as $a) 
  <tr>
<td>{{$no++}}</td>
<td>{{$a['projectid']}}</td>
<td>{{$a['batchnya']}}</td> 
<td>{{$a['site_name_spk']}}</td> 
<td>{{$a['site_id_spk']}}</td> 
<td>{{$a['site_id_actual']}}</td> 
<td>{{$a['site_name_actual']}}</td> 
<td>AREA {{$a['area']}}</td> 
<td>{{$a['regional']}}</td> 
<td>{{$a['infratype']}}</td> 
<td>{{$a['rfi_date']}}</td> 
<td>{{$a['rfi_detail_start_date']}}</td> 
<td>{{$a['rfi_detail_end_date']}}</td> 
<td>{{$a['rfi_detail_price_month']}}</td> 
<td>{{$a['rfi_detail_price_year']}}</td> 
<td>{{$a['nilai_revenue']}}</td> 
<td>{{$a['batch_accrue']}}</td> 
  </tr>
 @php 
 $no++; 
 $jml = $a['nilai_revenue'] + $jml; 
 @endphp 
@endforeach 
<!-- loop here -->
   <tr>
    <td> </td>
    <td> </td>
    <td> </td>
    <td> </td>
    <td> </td> 
    <td> </td>
    <td> </td> 
    <td> </td> 
    <td> </td> 
    <td> </td> 
    <td> </td> 
    <td> </td> 
    <td> </td> 
    <td> </td> 
    <td><b>Total Revenue</b></td> 
    <td><b>{{$jml}}</b></td> 
    <td> </td> 
  </tr>
			 	
        </table>
		
 
		
		
		
		
		
		
		
		
		
		
		
		
		
		
    </body>
</html>