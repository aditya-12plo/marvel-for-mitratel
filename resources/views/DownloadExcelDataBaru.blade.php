<html>
    <body>
    
 <table border="1">
            <tr>
                <th colspan="7" align="center"><h1>BILL OF QUANTITY ACTUAL</h1></th>
            </tr>
			
            <tr>
                <td colspan="7"></td>
            </tr>
			
            <tr>
                <td><h3 align="center">NO</h3></td>
                <td><h3 align="center">PROJECTID</h3></td>
                <td><h3 align="center">INFRATYPE</h3></td>
                <td><h3 align="center">Site ID</h3></td>
                <td><h3 align="center">Site NAME</h3></td>
                <td><h3 align="center">AREA</h3></td>
                <td><h3 align="center">REGIONAL</h3></td>
                <td><h3 align="center">CLUSTER</h3></td>
                <td><h3 align="center">Tinggi Tower</h3></td>
                <td><h3 align="center">Mitra</h3></td>
                <td><h3 align="center">SIS</h3></td>
                <td><h3 align="center">SITAC</h3></td>
                <td><h3 align="center">Biaya Retribusi IMB</h3></td>
                <td><h3 align="center">Biaya Jasa Pengurusan IMB</h3></td>
                <td><h3 align="center">Biaya Sewa Lahan / Tahun</h3></td>
                <td><h3 align="center">Lama Sewa Lahan / Tahun</h3></td>
                <td><h3 align="center">Biaya Tower</h3></td>
            </tr>
            @php $no=1; @endphp
            @foreach($data as $a)        
            <tr>
                <td><div align="center">{{$no++}}</div></td>
                <td><div align="center">{{$a->projectid}}</div></td>
                <td><div align="center">{{$a->infratype}}</div></td>
                <td><div align="center">{{$a->siteid}}</div></td>
                <td><div align="center">{{$a->sitename}}</div></td>
                <td><div align="center">{{$a->area}}</div></td>
                <td><div align="center">{{$a->regional}}</div></td>
                <td><div align="center">{{$a->cluster}}</div></td>
                <td><div align="center">{{$a->tower}} M</div></td>
                <td><div align="center">{{$a->mitra}}</div></td>
                <td><div align="center">{{$a->sis}}</div></td>
                <td><div align="center">{{$a->sitac}}</div></td>
                <td><div align="center">{{$a->imb}}</div></td>
                <td><div align="center">{{$a->imb_jasa}}</div></td>
                <td><div align="center">{{$a->lahan}}</div></td>
                <td><div align="center">{{$a->qty_lahan}}</div></td>
                <td><div align="center">{{$a->biayatower}}</div></td>
            </tr>
            @endforeach  
                
        </table>
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    </body>
</html>