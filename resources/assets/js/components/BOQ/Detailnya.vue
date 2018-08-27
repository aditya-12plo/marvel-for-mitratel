<template>
 <div> 
 	<loading :show="isLoading"></loading>
 	 <vue-toast ref='toast'></vue-toast>
    <section class="content-header">

      <h1 align="center">
      Project Detail
      </h1>
    </section>
    



      
      <!--Vertical Timeline Starts-->
<section id="timeline" class="timeline-center timeline-wrapper">
  <div class="row">
    <div class="col-sm-12">
      <div class="content-header"><button type="button" class="btn btn-raised btn-warning" @click="backLink()"> <i class="ft-power"></i> Close </button></div>
    </div>
  </div>
  <h3 class="page-title text-center">Detail Project {{this.rowDatanya.projectid}}</h3>
  <ul class="timeline">
    <li class="timeline-line"></li>
    <li class="timeline-group">
      <a @click="modal.set('komunikasiproject', true)" class="btn btn-raised btn-primary">
        <i class="ft-message-circle"></i> Lihat Komunikasi</a>
    </li>
  </ul>
  <ul class="timeline">
    <li class="timeline-line"></li>
  
  
  
  
    <li class="timeline-item">
      <div class="timeline-badge">
        <span class="bg-blue bg-lighten-1" data-toggle="tooltip" data-placement="right" title="Detail Project">
   
        </span>
      </div>
      <div class="timeline-card card border-grey border-lighten-2">
        <div class="card-header">
          <h4 class="card-title mb-0">
            <a>Detail Project</a>
          </h4> 
        </div>

        <div class="card-body"> 
    
          <div class="card-body">
            <div class="card-block">


      
<div class="feather-icons overflow-hidden">
                          <div class="row">
              <div class="col-md-6 col-sm-6 col-12">
                                    <fieldset class="form-group">
                                        <label for="projectid"><b>PROJECT ID</b></label>
                                        <br>
{{this.rowDatanya.projectid}}
                                    </fieldset>
                                </div>

                                <div class="col-md-6 col-sm-6 col-12">
                                    <fieldset class="form-group">
                                        <label for="no_wo"><b>NO WO</b></label>
                                        <br>
{{this.rowDatanya.no_wo}}
                                    </fieldset>
                                </div>

                                <div class="col-md-6 col-sm-6 col-12">
                                    <fieldset class="form-group">
                                        <label for="wo_date"><b>WO DATE</b></label>
                                        <br>
{{this.rowDatanya.wo_date}}
                                    </fieldset>
                                </div>

                                <div class="col-md-6 col-sm-6 col-12">
                                    <fieldset class="form-group">
                                        <label for="batch"><b>BATCH</b></label>
                                        <br>
{{this.rowDatanya.batchnya}} 
                                    </fieldset>
                                </div>


                                <div class="col-md-6 col-sm-6 col-12">
                                    <fieldset class="form-group">
                                        <label for="infratype"><b>INFRATYPE</b></label>
                                        <br>
{{this.rowDatanya.infratype}}
                                    </fieldset>
                                </div>


                                <div class="col-md-6 col-sm-6 col-12">
                                    <fieldset class="form-group">
                                        <label for="area"><b>AREA</b></label>
                                        <br>
{{this.rowDatanya.area}}
                                    </fieldset>
                                </div>

                                <div class="col-md-6 col-sm-6 col-12">
                                    <fieldset class="form-group">
                                        <label for="regional"><b>REGIONAL</b></label>
                                        <br>
{{this.rowDatanya.regional}}
                                    </fieldset>
                                </div>


                                <div class="col-md-6 col-sm-6 col-12">
                                    <fieldset class="form-group">
                                        <label for="site_id_spk"><b>SITE ID SPK</b></label>
                                        <br>
{{this.rowDatanya.site_id_spk}}
                                    </fieldset>
                                </div>


                                <div class="col-md-6 col-sm-6 col-12">
                                    <fieldset class="form-group">
                                        <label for="site_name_spk"><b>SITE NAME SPK</b></label>
                                        <br>
{{this.rowDatanya.site_name_spk}}
                                    </fieldset>
                                </div>


                                <div class="col-md-6 col-sm-6 col-12">
                                    <fieldset class="form-group">
                                        <label for="address_spk"><b>ALAMAT SPK</b></label>
                                        <br>
{{this.rowDatanya.address_spk}}
                                    </fieldset>
                                </div>


                                <div class="col-md-6 col-sm-6 col-12">
                                    <fieldset class="form-group">
                                        <label for="address_spk"><b>KOORDINAT SPK</b></label>
                                        <br>
Longitude : {{this.rowDatanya.longitude_spk}}
<br>
Latitude : {{this.rowDatanya.latitude_spk}}
<br>
<a :href="'http://www.google.com/maps/place/'+this.rowDatanya.latitude_spk+','+this.rowDatanya.longitude_spk" target="_blank"><button type="button" class="btn btn-raised btn-success">
  <i class="ft-navigation"></i> Maps
</button></a>
                                    </fieldset>
                                </div>
            </div>
            </div>
            </div>
          </div>
           
       
        </div>
      </div>
    </li>
  
  
  
  
    <li class="timeline-item mt-5" v-if="this.rowDatanya.documentid">
      <div class="timeline-badge">
        <span class="bg-red bg-lighten-1" data-toggle="tooltip" data-placement="left" title="Dokumen SIS">
      
    </span>
      </div>
      <div class="timeline-card card border-grey border-lighten-2">
        <div class="card-header">
          <h4 class="card-title mb-0">
            <a>Dokumen SIS</a>
          </h4>
           
        </div>
        <div class="card-body"> 
          <div class="card-body">
            <div class="card-block">
             <a v-bind:href="'/files/'+this.rowDatanya.projectid+'/'+this.rowDatanya.document_sis" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>
                                    </fieldset>
                               
            </div>
          </div> 
        </div>
      </div>
    </li>
  
  
  
<li class="timeline-item" v-if="this.rowDatanya.documentdrmid">
      <div class="timeline-badge">
        <span class="bg-yellow bg-lighten-1" data-toggle="tooltip" data-placement="right" title="Dokumen DRM">
   
        </span>
      </div>
      <div class="timeline-card card border-grey border-lighten-2">
        <div class="card-header">
          <h4 class="card-title mb-0">
            <a>Dokumen DRM</a>
          </h4> 
        </div>

        <div class="card-body"> 
    
          <div class="card-body">
            <div class="card-block">
<div class="feather-icons overflow-hidden">
                          <div class="row">
              
<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_id_actual">AKTUAL SITE ID</label>
 <br>
{{this.rowDatanya.site_id_actual}}
                                    </fieldset>
                                </div>

  <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_name_actual">AKTUAL SITE NAME</label>
                                        <br>
{{this.rowDatanya.site_name_actual}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="province">PROVINSI</label>
                                        <br>
{{this.rowDatanya.province}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="city">KOTA</label>
                                        <br>
{{this.rowDatanya.city}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_actual">ALAMAT</label>
                                        <br>
{{this.rowDatanya.address_actual}}
                                    </fieldset>
                                </div>
                               

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_spk">KOORDINAT AKTUAL</label>
                                        <br>
Longitude : {{this.rowDatanya.longitude_actual}}
<br>
Latitude : {{this.rowDatanya.latitude_actual}}
<br>
<a :href="'http://www.google.com/maps/place/'+this.rowDatanya.latitude_actual+','+this.rowDatanya.longitude_actual" target="_blank"><button type="button" class="btn btn-raised btn-success">
  <i class="ft-navigation"></i> Maps
</button></a>
                                    </fieldset>
                                </div>



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="kom_date">TANGGAL KOM</label>
                                        <br>
{{this.rowDatanya.kom_date}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_kom">DOKUMEN KOM</label>
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.projectid+'/'+this.rowDatanya.document_kom" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>
 
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="drm_date">TANGGAL DRM</label>
                                        <br>
{{this.rowDatanya.drm_date}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_drm">DOKUMEN DRM</label>
                                        <br> 
<a v-bind:href="'/files/'+this.rowDatanya.projectid+'/'+this.rowDatanya.document_drm" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>                                        
                                    </fieldset>
                                </div>
        
            </div>
            </div>
            </div>
          </div>
           
       
        </div>
      </div>
    </li>
  
  
  
  
    <li class="timeline-item mt-5" v-if="this.rowDatanya.documentsitacid">
      <div class="timeline-badge">
        <span class="bg-green bg-lighten-1" data-toggle="tooltip" data-placement="left" title="DOKUMEN SITAC">
      
    </span>
      </div>
      <div class="timeline-card card border-grey border-lighten-2">
        <div class="card-header">
          <h4 class="card-title mb-0">
            <a>DOKUMEN SITAC</a>
          </h4>
           
        </div>
        <div class="card-body"> 
          <div class="card-body">
            <div class="card-block">
      <div class="feather-icons overflow-hidden">
                          <div class="row">
        
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_ban_bak">NO BAN / BAK</label>
                                        <br>
{{this.rowDatanya.no_ban_bak}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="date_ban_bak">TANGGAL DOKUMEN BAN / BAK</label>
                                        <br>
{{this.rowDatanya.date_ban_bak}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_ban_bak">DOKUMEN BAN / BAK</label>
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.projectid+'/'+this.rowDatanya.document_ban_bak" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="ijin_warga_date">TANGGAL DOKUMEN IJIN WARGA</label>
                                        <br>
{{this.rowDatanya.ijin_warga_date}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_ijin_warga">DOKUMEN IJIN WARGA</label>
                                        <br> 
<a v-bind:href="'/files/'+this.rowDatanya.projectid+'/'+this.rowDatanya.document_ijin_warga" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                </div>
   
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_pks">NO PKS</label>
                                        <br>
{{this.rowDatanya.no_pks}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="pks_date">TANGGAL DOKUMEN PKS</label>
                                        <br>
{{this.rowDatanya.pks_date}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_pks">DOKUMEN PKS</label>
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.projectid+'/'+this.rowDatanya.document_pks" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                </div>

 
 
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_imb">NO IMB</label>
                                        <br>
{{this.rowDatanya.no_imb}}
                                    </fieldset>
                                </div>
 

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
<label for="imb_date">TANGGAL IMB</label>
                                        <br>
{{this.rowDatanya.imb_date}}
                                    </fieldset>
                                </div>

    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_imb">DOKUMEN IMB</label>
                                        <br> 
<a v-bind:href="'/files/'+this.rowDatanya.projectid+'/'+this.rowDatanya.document_imb" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                </div>
                               
            </div>
          </div>             
      </div>
          </div> 
        </div>
      </div>
    </li>
  
  
<li class="timeline-item" v-if="this.rowDatanya.documentrfcid">
      <div class="timeline-badge">
        <span class="bg-orange bg-lighten-1" data-toggle="tooltip" data-placement="right" title="DOKUMEN RFC">
   
        </span>
      </div>
      <div class="timeline-card card border-grey border-lighten-2">
        <div class="card-header">
          <h4 class="card-title mb-0">
            <a>DOKUMEN RFC</a>
          </h4> 
        </div>

        <div class="card-body"> 
    
          <div class="card-body">
            <div class="card-block">      
<div class="feather-icons overflow-hidden">
                          <div class="row">
               <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_rfc">NO DOKUMEN RFC</label>
                                        <br>
{{this.rowDatanya.no_rfc}}
</fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rfc_date">TANGGAL DOKUMEN RFC</label>
                                        <br>
{{this.rowDatanya.rfc_date}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_rfc">DOKUMEN RFC</label>
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.projectid+'/'+this.rowDatanya.document_rfc" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
           <label for="target_rfi">TARGET RFI</label>
                                        <br>
 PO Release + <b>{{this.rowDatanya.target_rfi}}</b>  Days                           
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
         <label for="power_capacity">POWER CAPACITY</label>
                                        <br> 
 PLN <b>{{this.rowDatanya.power_capacity}}</b> KVA 
                                    </fieldset>
                                </div>
       
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
         <label for="id_pln">ID PLN</label>
                                        <br> 
 {{this.rowDatanya.id_pln}}
                                    </fieldset>
                                </div>
        
            </div>
            </div>
            </div>
          </div>
           
       
        </div>
      </div>
    </li>
  
  
  
  
    <li class="timeline-item mt-5" v-if="this.rowDatanya.documentboqid">
      <div class="timeline-badge">
        <span class="bg-pink bg-lighten-1" data-toggle="tooltip" data-placement="left" title="DOKUMEN BOQ">
      
    </span>
      </div>
      <div class="timeline-card card border-grey border-lighten-2">
        <div class="card-header">
          <h4 class="card-title mb-0">
            <a>BOQ</a> 
          </h4>
           
        </div>
        <div class="card-body"> 
          <div class="card-body">
            <div class="card-block">
      <div class="feather-icons overflow-hidden">
                          <div class="row">
     <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_type">TIPE SITE</label>
                                        <br>
{{this.rowDatanya.site_type}}
                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tower_type">TIPE TOWER</label>
                                        <br>
{{this.rowDatanya.tower_type}}
                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="roof_top_high">ROOF TOP HIGHT</label>
                                        <br>
{{this.rowDatanya.roof_top_high}}
                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tower_high">TINGGI TOWER</label>
                                        <br>
{{this.formatTower(this.rowDatanya.tower_high)}}
                    </fieldset>
                                </div>
  
 
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rf_in_meters">RF IN METERS</label>
                                        <br>
{{this.formatTower(this.rowDatanya.rf_in_meters)}}
                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="mw_in_meters">MW IN METERS</label>
                                        <br>
{{this.formatTower(this.rowDatanya.mw_in_meters)}}
                    </fieldset>
                                </div>
  
 
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="harga_bulan">Harga Sewa / Bulan</label>
                                        <br>
{{this.formatNumberRupiah(this.rowDatanya.harga_bulan)}}
                    </fieldset>
                                </div>
  

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="harga_tahun">Harga Sewa / Tahun</label>
                                        <br>
{{this.formatNumberRupiah(this.rowDatanya.harga_tahun)}}
                    </fieldset>
                                </div>
                   </div>
          </div>               
            </div>
          </div> 
        </div>
      </div>
    </li>
  
    
  
  
  
    <li class="timeline-item mt-5" v-if="this.rowDatanya.siteopeningid">
      <div class="timeline-badge">
        <span class="bg-grey bg-lighten-1" data-toggle="tooltip" data-placement="left" title="Site Opening (CME)">
      
    </span>
      </div>
      <div class="timeline-card card border-grey border-lighten-2">
        <div class="card-header">
          <h4 class="card-title mb-0">
            <a>Site Opening (CME)</a> 
          </h4>
           
        </div>
        <div class="card-body"> 
          <div class="card-body">
            <div class="card-block">
      <div class="feather-icons overflow-hidden">
                          <div class="row">
     <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_opening_date">TANGGAL DOKUMEN </label>
                                        <br>
{{this.rowDatanya.site_opening_date}}
                    </fieldset>
                                </div>
     <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_site_opening">DOKUMEN</label>
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.projectid+'/'+this.rowDatanya.document_site_opening" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                </div>
   
                   </div>
          </div>               
            </div>
          </div> 
        </div>
      </div>
    </li>
  
  
    <li class="timeline-item mt-5" v-if="this.rowDatanya.excavationid">
      <div class="timeline-badge">
        <span class="bg-white bg-lighten-1" data-toggle="tooltip" data-placement="left" title="Dokumen Excavation (CME)">
      
    </span>
      </div>
      <div class="timeline-card card border-grey border-lighten-2">
        <div class="card-header">
          <h4 class="card-title mb-0">
            <a>Dokumen Excavation (CME)</a> 
          </h4>
           
        </div>
        <div class="card-body"> 
          <div class="card-body">
            <div class="card-block">
      <div class="feather-icons overflow-hidden">
                          <div class="row">
     <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="excavation_date">TANGGAL DOKUMEN </label>
                                        <br>
{{this.rowDatanya.excavation_date}}
                    </fieldset>
                                </div>
     <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="excavation_document">DOKUMEN</label>
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.projectid+'/'+this.rowDatanya.excavation_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                </div>
   
                   </div>
          </div>               
            </div>
          </div> 
        </div>
      </div>
    </li>
  
    
  
  
  
    <li class="timeline-item mt-5" v-if="this.rowDatanya.rebaringid">
      <div class="timeline-badge">
        <span class="bg-blue bg-lighten-1" data-toggle="tooltip" data-placement="left" title="Dokumen Rebaring (CME)">
      
    </span>
      </div>
      <div class="timeline-card card border-grey border-lighten-2">
        <div class="card-header">
          <h4 class="card-title mb-0">
            <a>Dokumen Rebaring (CME)</a> 
          </h4>
           
        </div>
        <div class="card-body"> 
          <div class="card-body">
            <div class="card-block">
      <div class="feather-icons overflow-hidden">
                          <div class="row">
     <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rebaring_date">TANGGAL DOKUMEN </label>
                                        <br>
{{this.rowDatanya.rebaring_date}}
                    </fieldset>
                                </div>
     <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rebaring_document">DOKUMEN</label>
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.projectid+'/'+this.rowDatanya.rebaring_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                </div>
   
                   </div>
          </div>               
            </div>
          </div> 
        </div>
      </div>
    </li>
  
    
  
  
  
    <li class="timeline-item mt-5" v-if="this.rowDatanya.pouringid">
      <div class="timeline-badge">
        <span class="bg-red bg-lighten-1" data-toggle="tooltip" data-placement="left" title="Dokumen Pouring (CME)">
      
    </span>
      </div>
      <div class="timeline-card card border-grey border-lighten-2">
        <div class="card-header">
          <h4 class="card-title mb-0">
            <a>Dokumen Pouring (CME)</a> 
          </h4>
           
        </div>
        <div class="card-body"> 
          <div class="card-body">
            <div class="card-block">
      <div class="feather-icons overflow-hidden">
                          <div class="row">
     <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="pouring_date">TANGGAL DOKUMEN </label>
                                        <br>
{{this.rowDatanya.pouring_date}}
                    </fieldset>
                                </div>
     <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="pouring_document">DOKUMEN</label>
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.projectid+'/'+this.rowDatanya.pouring_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                </div>
   
                   </div>
          </div>               
            </div>
          </div> 
        </div>
      </div>
    </li>
  
    
  
  
  
    <li class="timeline-item mt-5" v-if="this.rowDatanya.curingid">
      <div class="timeline-badge">
        <span class="bg-yellow bg-lighten-1" data-toggle="tooltip" data-placement="left" title="Dokumen Curing (CME)">
      
    </span>
      </div>
      <div class="timeline-card card border-grey border-lighten-2">
        <div class="card-header">
          <h4 class="card-title mb-0">
            <a>Dokumen Curing (CME)</a> 
          </h4>
           
        </div>
        <div class="card-body"> 
          <div class="card-body">
            <div class="card-block">
      <div class="feather-icons overflow-hidden">
                          <div class="row">
     <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="curing_date">TANGGAL DOKUMEN </label>
                                        <br>
{{this.rowDatanya.curing_date}}
                    </fieldset>
                                </div>
     <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="curing_document">DOKUMEN</label>
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.projectid+'/'+this.rowDatanya.curing_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
                                    </fieldset>
                                </div>
   
                   </div>
          </div>               
            </div>
          </div> 
        </div>
      </div>
    </li>
  
    
  
  
  
  
  </ul>

  
  
</section>
<!--Vertical Timeline Ends-->




<!-- @komunikasiproject -->
<modal  v-if="modal.get('komunikasiproject')" @close="modal.set('komunikasiproject', false)">
        <template slot="header" align="center"><h4 align="center">Komunikasi Project</h4></template>
        <template slot="body" >
                <div class="modal-body">

<div class="col-sm-12" v-if="this.komunikasi.length > 0">             
<div v-for="(row,index) in this.komunikasi" style="border: 1px solid grey;">              
                    <!-- form Group -->
                    <div class="form-group">
                        <label for="pengirim">Pengirim : {{row.name}}</label><br>
                        <label for="jabatan">Posisi : {{row.posisi}}</label><br>
                        <label for="stts">Status : {{row.status}}</label><br>
                        <label for="pesan">Pesan : {{row.message}}</label><br>
                        <label for="time">Waktu : {{row.created_at}}</label><br>
                    </div>
</div>
</div>
<div class="col-sm-12" v-else>
 <!-- form Group -->
                    <div class="form-group">
                        <label for="pengirim">Belum Ada Komunikasi Project</label><br>
                    </div>
</div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('komunikasiproject', false)" >Close</button>
                    
                </div>
                </form>
        </template>
        </modal>
        
<!-- komunikasiproject -->

 
    </div>
</template>
<script>
     /* ------------------------------------------------------------------------------------- ERRORS
         ---------------------------------------------------------------------------------------------------- */
        class Errors{
            constructor(){
                this.errors = {};
            }
            get(field){
                if(this.errors[field]){
                    return  this.errors[field][0];
                }
            }
            record(errors){
                this.errors = errors.response.data;
            }
            any(){
                return Object.keys(this.errors).length > 0;
            }
            has(field){
                return this.errors.hasOwnProperty(field);
            }
            clear(field){
                if(field) delete this.errors[field];
                this.errors = {};
            }
            clearAll(){
                this.errors = "";
            }
        }
     
       
         /* ------------------------------------------------------------------------------------- CRUD MODAL
         ---------------------------------------------------------------------------------------------------- */
        class CrudModal{
            constructor(data){
                this.modal = data;
            }
            get(value){
                if(this.modal[value]){
                    return this.modal[value];
                }
            }
            set(data , value){
                this.modal[data] = value;
            }
        }


        //   COMPONENT MODAL
        const Modal = {
            template: `   <transition name="modal">
                                <div class="modal">
                                <div class="modal-mask">
                                  <div class="modal-wrapper">
                                    <div :class="modalStyle">
                                    <a class="close-modal" @click="$emit('close')" ></a>
                                      <div class="modal-header">
                                           <p class="modal-card-title"><slot name="header" class="modal-card-title "></slot></p>
                                      </div>
                                        <slot name="body">
                                          default body
                                        </slot>
                                    </div>
                                  </div>
                                </div>
                                </div>
                              </transition>` ,
            props: {
                modalsize: {type: String},
            } ,
            computed: {
                modalStyle() {
                    return this.modalsize == null ? 'modal-container' : this.modalsize + ' modal-container';
                },
                created(){

                }
            }
        }; 



import accounting from 'accounting'
import moment from 'moment'
import '!!vue-style-loader!css-loader!vue-toast/dist/vue-toast.min.css'
import VueToast from 'vue-toast'
import myDatepicker from 'vue-datepicker'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import Vue from 'vue'
import loading from '../Loading'
import VueEvents from 'vue-events'
import Hashids from 'hashids'
Vue.use(VueEvents)
Vue.component('view-custom-actions', require('../Button/ViewActions.vue'))
window.axios = require('axios')
window.eventBus = new Vue()
export default { 
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
    'vue-toast': VueToast,
    'date-picker': myDatepicker,
	loading,
  },
  data () {
    return {
	isLoading: false,
    startTime: {
        time: ''
      },
      endtime: {
        time: ''
      },
	option: {
        type: 'day',
        week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        format: 'YYYY-MM-DD',
        placeholder: 'YYYY-MM-DD',
        inputStyle: {
          'display': 'inline-block',
          'padding': '6px',
          'line-height': '22px',
          'font-size': '16px',
          'border': '2px solid #fff',
          'box-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.2)',
          'border-radius': '2px',
          'color': '#5F5F5F'
        },
        color: {
          header: '#B799DA',
          headerText: '#f00'
        },
        buttons: {
          ok: 'Ok',
          cancel: 'Cancel'
        },
        overlayOpacity: 0.5, // 0.5 as default 
        dismissible: true // as true as default 
      },
    position: 'up right',
    closeBtn: true,
    formErrors:{},
    errors: new Errors() ,
     errorNya: [],
     token: localStorage.getItem('token'),
    submitted: false,
    submitSelectedItems:[] ,
    komunikasi:[] ,
    rowDatanya:[] ,
    modal:new CrudModal({komunikasiproject: false}),
    displayItems:[] ,
     dataNya: {area:'' , level:'' , regional:''},
    perPage: 10,
    loading: false,    
    }
  },
          watch: {  
            'delayOfJumps': 'resetOptions',
        'maxToasts': 'resetOptions',
        'position': 'resetOptions',
        },
  methods: {
 backLink() {
window.close();
            } ,
 success(kata) {
      this.$swal({
  position: 'top-end',
  type: 'success',
  title: kata,
  showConfirmButton: false,
  timer: 1500
})
    },
    
 error(kata) {
      this.$swal({
  position: 'top-end',
  type: 'error',
  title: kata,
  showConfirmButton: false,
  timer: 1500
})
    },
    
 question(kata) {
      this.$swal(
'Ooppss?',
 kata,
  'question'
)
    },
     newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name = files[0];
                
           },
diacak(id)
           {
var hashids = new Hashids('',1000,'abcdefghijklmnopqrstuvwxyz0987654321ABCDEFGHIJKLMNOPQRSTUVWXYZ'); // no padding
return hashids.encode(id); 
           },
dibalik(id)
           {
var hashids = new Hashids('',1000,'abcdefghijklmnopqrstuvwxyz0987654321ABCDEFGHIJKLMNOPQRSTUVWXYZ'); // no padding
return hashids.decode(id); 
           }, 
dataAction () {
 var id = this.dibalik(this.$route.params.id);
axios.get('/karyawan/GetAllDetailProject/'+id).then((response) => {
                    this.rowDatanya = response.data.project;
                    this.komunikasi = response.data.komunikasi;
 });
      },  
  resetOptions() {
          this.$refs.toast.setOptions({
            delayOfJumps: this.delayOfJumps,
            maxToasts: this.maxToasts,
            position: this.position
          })
        },
        showTime(kode,pesan) {
          this.$refs.toast.showToast(pesan, {
            theme: kode,
            timeLife: 3000,
          })
        }, 
    allcap (value) {
      return value.toUpperCase()
    },
    formatNumber (value) {
      return accounting.formatNumber(value, 2)
    },
	
	formatTower (value) {
      return accounting.formatMoney(value,  {
  symbol: " M",precision: 0,format: "%v %s"})
    },
	formatNumberRupiah (value) {
      return accounting.formatMoney(value,  "Rp. ", 0, ".", ",")
    },
    formatDate (value, fmt = 'D M YYYY') {
      return (value == null)
        ? ''
        : moment(value, 'YYYY-MM-DD').format(fmt)
    },
    onPaginationData (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs.vuetable.changePage(page)
    },
    onCellClicked (data, field, event) {
      this.$refs.vuetable.toggleDetailRow(data.id)
    },            

 		
  },
  events: { 
  }, 
		          mounted() {  
               this.dataAction();

        }

}
</script>
<style>
.pagination {
  margin: 0;
  float: right;
}
.pagination a.page {
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 2px;
}
.pagination a.page.active {
  color: white;
  background-color: #337ab7;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 2px;
}
.pagination a.btn-nav {
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 7px;
  margin-right: 2px;
}
.pagination a.btn-nav.disabled {
  color: lightgray;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 7px;
  margin-right: 2px;
  cursor: not-allowed;
}
.pagination-info {
  float: left;
}
</style>