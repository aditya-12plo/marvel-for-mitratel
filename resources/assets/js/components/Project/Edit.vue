<template>
 <div> 

<div class="card-header-banner"> </div> 

<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <h1 align="center">Perubahan Data Project ID {{this.forms.projectid}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
<button type="button" class="btn btn-raised btn-warning" @click="backLink()"> <i class="ft-arrow-left position-left"></i> Kembali</button>
                </div>
                <div class="card-body">


<div class="form-body">
    <div class="row">  


<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Detail Project</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="rubahProject()" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>



<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-info">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen SIS</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="rubahSIS()" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>



<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-warning">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen DRM</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="rubahDRM()" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>


<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-danger">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen SITAC</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="rubahSITAC()" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>


<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-green">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen RFC</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editRFC', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>


<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-blue">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">BOQ</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editBOQ', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>


<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-yellow">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">PO</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editPO', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>


<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-grey">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen S-Opening</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editSiteOpening', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>



   
<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen Excavation</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editExcavation', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>



<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-info">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen Rebaring</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editRebaring', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>



<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-warning">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen Pouring</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editPouring', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>


<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-danger">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen Curing</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editCuring', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>


<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-green">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen T-Erection</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editTowerErection', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>


<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-blue">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen M-E Process</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editMEProcess', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>


<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-yellow">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen Fence & Yard</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editFenceYard', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>


<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-grey">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen RFI & BAUT</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editRFIBAUT', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>



 
<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">RFI Detail</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editRFIDetail', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>



<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-info">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen BAKS-BAUK</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editBAKSBAUK', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>



<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-warning">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen INVOICE</h5>
                        </div>
                    </div>
                    
 <span><button type="button" @click="modal.set('editInvoice', true)" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Edit</button></span>
                </div>
            </div>
        </div>
    </div>

  



                </div>
                </div>



                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Inputs end -->







<!-- @edit project -->
<modal  v-if="modal.get('editProject')" @close="modal.set('editProject', false)">
        <template slot="header" align="center"><h4 align="center">Edit Detail Project</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahProjectsubmitData()">
                <div class="modal-body">

<div class="col-sm-12">        
<div class="form-body">
                            <div class="row">
                                <div class="col-sm-6 mb-1">
                                    <fieldset class="form-group">
                                        <label for="projectid">Project ID</label>
<input type="text" @input="allcap($event, forms, 'projectid')" class="form-control" placeholder="Project ID" v-model="forms.projectid" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['projectid']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

<div class="col-sm-6 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_wo">No WO</label>
<input type="text" @input="allcap($event, forms, 'no_wo')" class="form-control" placeholder="No WO" v-model="forms.no_wo"  required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_wo']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
                                
                                <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="wo_date">WO Date</label>
<date-picker :date="woDate" :option="option" class="form-control" required></date-picker>                              
<div class="help-block"><ul role="alert">
  <li v-for="error of errorNya['wo_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
                                

                                <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="batch">Batch</label>
 <select class="form-control border-input" v-model="forms.batch" required >
<option value="" selected>Pilih Batch</option>
<option v-for="(n,index) in 25" :value="n">{{ n }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['batch']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="years">Tahun Batch</label>
 <select class="form-control border-input" v-model="forms.years" required >
<option value="" selected>Pilih Tahun Batch</option>
<option v-for="n in getYears(2010)" :value="n">{{ n }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['years']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>



<div class="col-xl-2 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
                                        <label for="infratype">Infratype</label>
<select class="form-control border-input" v-model="forms.infratype" required >
<option value="" selected>Pilih Infratype</option>
<option v-for="pilihinfratype in pilihaninratype" :value="pilihinfratype">{{ pilihinfratype }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['infratype']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>



<div class="col-xl-2 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
                                        <label for="area">Area</label>
<select class="form-control border-input" v-model="forms.area" required >
<option value="" selected>Pilih Area User</option>
<option v-for="piliharea in pilihanarea" :value="piliharea">{{ piliharea }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['area']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
                                        <label for="regional">Regional</label>
<input type="text" @input="allcap($event, forms, 'regional')" class="form-control" placeholder="Regional" v-model="forms.regional" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['regional']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
                                        <label for="site_id_spk">Site ID SPK</label>
<input type="text" @input="allcap($event, forms, 'site_id_spk')" class="form-control" placeholder="Site ID SPK" v-model="forms.site_id_spk" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_id_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
                                        <label for="site_name_spk">Site Name SPK</label>
<input type="text" @input="allcap($event, forms, 'site_name_spk')" class="form-control" placeholder="Site Name SPK" v-model="forms.site_name_spk" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_name_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
                                        <label for="address_spk">ALamat Site</label>
<textarea type="text" @input="allcap($event, forms, 'address_spk')" class="form-control" placeholder="ALamat Site" v-model="forms.address_spk" rows="5" required></textarea>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['address_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


<div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="longitude_spk">Longitude SPK</label>
<input type="text" @input="allcap($event, forms, 'longitude_spk')" class="form-control" placeholder="Longitude SPK" v-model="forms.longitude_spk" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['longitude_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

<div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="latitude_spk">Latitude SPK</label>
<input type="text" @input="allcap($event, forms, 'latitude_spk')" class="form-control" placeholder="Latitude SPK" v-model="forms.latitude_spk" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['latitude_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

<div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="latitude_spk">Cek Lokasi</label>
<br>
<a :href="'http://www.google.com/maps/place/'+this.forms.latitude_spk+','+this.forms.longitude_spk" target="_blank"><button type="button" class="btn btn-raised btn-success">
  <i class="ft-navigation"></i> Maps
</button></a>
 </fieldset>
                                </div>
</div>
</div>
</div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editProject', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>






<!-- @edit SIS -->
<modal  v-if="modal.get('editSIS')" @close="modal.set('editSIS', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen SIS</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenSISsubmitData()">
                <div class="modal-body">

<div class="col-sm-12" v-if="this.forms.documentid">        
<div class="form-body">
                            <div class="row">



                                    <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="documentsis"><h4>Edit Dokumen SIS</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" accept="application/pdf" name="file_name" id="file_name" v-on:change="newAvatar" required="required"> 
            <span class="file-custom"></span>
                    </label>        
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_sis']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>

<a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_sis" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>

<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                        </fieldset>
                                    </div>
           
                                
  
 

</div>
</div>
</div>

<div class="col-sm-12" v-else>        
<div class="form-body">
                            <div class="row">



                                    <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="documentsis"><h4>Add Dokumen SIS</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" accept="application/pdf" name="file_name" id="file_name" v-on:change="newAvatar" required="required"> 
            <span class="file-custom"></span>
                    </label>        
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_sis']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br> 
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                        </fieldset>
                                    </div>
           
                                
  
 

</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editSIS', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>






<!-- @edit DRM -->
<modal  v-if="modal.get('editDRM')" @close="modal.set('editDRM', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen DRM</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenDRMsubmitData()">
                <div class="modal-body">



<div class="col-sm-12" v-if="this.forms.documentdrmid">      
    <h4 align="center">Edit Dokumen DRM</h4>
<div class="form-body">
                            <div class="row">



 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_id_actual">AKTUAL SITE ID</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'site_id_actual')" class="form-control" placeholder="AKTUAL SITE ID" v-model="forms.site_id_actual" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_id_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                
<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_name_actual">AKTUAL SITE NAME</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'site_name_actual')" class="form-control" placeholder="AKTUAL SITE NAME" v-model="forms.site_name_actual" required>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_name_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>           
                                

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="province">PROVINSI</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'province')" class="form-control" placeholder="PROVINSI" v-model="forms.province" required>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['province']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>  

 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="city">KOTA</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'city')" class="form-control" placeholder="KOTA" v-model="forms.city" required>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['city']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
                               
 
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_actual">ALAMAT</label>
                                        <br>
  <textarea @input="allcap($event, forms, 'address_actual')" v-model="forms.address_actual" class="form-control" rows="5" id="message" placeholder="ALAMAT" required></textarea>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['address_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="longitude_actual">KOORDINAT</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'longitude_actual')" class="form-control" placeholder="LONGITUDE" v-model="forms.longitude_actual" required>
<br>
<input type="text" @input="allcap($event, forms, 'latitude_actual')" class="form-control" placeholder="LATITUDE" v-model="forms.latitude_actual" required>
<br>
<a :href="'http://www.google.com/maps/place/'+this.forms.longitude_actual+','+this.forms.latitude_actual" target="_blank"><button type="button" class="btn btn-raised btn-success">
  <i class="ft-navigation"></i> Maps
</button></a>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['longitude_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['latitude_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div> 


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="kom_date">TANGGAL KOM</label>
                                        <br>
<date-picker :date="kom_date" :option="option"></date-picker>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['kom_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_kom">DOKUMEN KOM</label>
                                        <br>
                                       <br>
<label id="projectinput8" class="file center-block">
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_kom" id="document_kom" ref="document_kom" v-on:change="newAvatarkom()">       
            <span class="file-custom"></span>
                    </label>        
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_kom']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
<br>
<a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_kom" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>

                                    </fieldset>
                                </div>



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="drm_date">TANGGAL DRM</label>
                                        <br>
<date-picker :date="drm_date" :option="option"></date-picker>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['drm_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_drm">DOKUMEN DRM</label>
                                        <br>
                                       <br>
<label id="projectinput8" class="file center-block">
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_drm" id="document_drm" ref="document_drm" v-on:change="newAvatarDRM()">       
            <span class="file-custom"></span>
                    </label>        
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_drm']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
<br> 
<a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_drm" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>
 
                                    </fieldset>
                                </div>

</div>
</div>
</div>



<div class="col-sm-12" v-else>      
    <h4 align="center">Add Dokumen DRM</h4>
<div class="form-body">
                            <div class="row">



 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_id_actual">AKTUAL SITE ID</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'site_id_actual')" class="form-control" placeholder="AKTUAL SITE ID" v-model="forms.site_id_actual" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_id_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                
<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_name_actual">AKTUAL SITE NAME</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'site_name_actual')" class="form-control" placeholder="AKTUAL SITE NAME" v-model="forms.site_name_actual" required>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_name_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>           
                                

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="province">PROVINSI</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'province')" class="form-control" placeholder="PROVINSI" v-model="forms.province" required>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['province']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>  

 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="city">KOTA</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'city')" class="form-control" placeholder="KOTA" v-model="forms.city" required>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['city']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
                               
 
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_actual">ALAMAT</label>
                                        <br>
  <textarea @input="allcap($event, forms, 'address_actual')" v-model="forms.address_actual" class="form-control" rows="5" id="message" placeholder="ALAMAT" required></textarea>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['address_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="longitude_actual">KOORDINAT</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'longitude_actual')" class="form-control" placeholder="LONGITUDE" v-model="forms.longitude_actual" required>
<br>
<input type="text" @input="allcap($event, forms, 'latitude_actual')" class="form-control" placeholder="LATITUDE" v-model="forms.latitude_actual" required>
<br>
<a :href="'http://www.google.com/maps/place/'+this.forms.longitude_actual+','+this.forms.latitude_actual" target="_blank"><button type="button" class="btn btn-raised btn-success">
  <i class="ft-navigation"></i> Maps
</button></a>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['longitude_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['latitude_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div> 


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="kom_date">TANGGAL KOM</label>
                                        <br>
<date-picker :date="kom_date" :option="option"></date-picker>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['kom_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_kom">DOKUMEN KOM</label>
                                        <br>
                                       <br>
<label id="projectinput8" class="file center-block">
<input type="file" accept="application/pdf" name="document_kom" id="document_kom" v-on:change="newAvatarkomAdd" required> 
            <span class="file-custom"></span>
                    </label>        
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_kom']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p> 
                                    </fieldset>
                                </div>



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="drm_date">TANGGAL DRM</label>
                                        <br>
<date-picker :date="drm_date" :option="option"></date-picker>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['drm_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_drm">DOKUMEN DRM</label>
                                        <br>
                                       <br>
<label id="projectinput8" class="file center-block">
<input type="file" accept="application/pdf" name="document_drm" id="document_drm" v-on:change="newAvatarDRMAdd" required> 
            <span class="file-custom"></span>
                    </label>        
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_drm']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p> 
                                    </fieldset>
                                </div>

</div>
</div>
</div>



                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editDRM', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>




<!-- @edit SITAC -->
<modal  v-if="modal.get('editSITAC')" @close="modal.set('editSITAC', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen SITAC</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenSITACsubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.documentsitacid">   
    <h4 align="center">Edit Dokumen SITAC</h4>     
<div class="form-body">
<div class="row">

 
 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_ban_bak">NO BAN / BAK</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_ban_bak')" class="form-control" placeholder="AKTUAL SITE ID" v-model="forms.no_ban_bak" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_ban_bak']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="date_ban_bak">TANGGAL DOKUMEN BAN / BAK</label>
                                        <br>
 <date-picker :date="date_ban_bak" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['date_ban_bak']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_ban_bak">DOKUMEN BAN / BAK</label>                              
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_ban_bak" id="document_ban_bak" ref="document_ban_bak" v-on:change="newAvatarDokBanBak()"> 
   <div v-if="this.forms.document_ban_bak">                                     <br>
<a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_ban_bak" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
</div>         
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_ban_bak']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="ijin_warga_date">TANGGAL DOKUMEN IJIN WARGA</label>
                                        <br>
 <date-picker :date="ijin_warga_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['ijin_warga_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_ijin_warga">DOKUMEN IJIN WARGA</label>
                                        <br> 
<label id="projectinput8" class="file center-block">
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_ijin_warga" id="document_ijin_warga" ref="document_ijin_warga" v-on:change="newAvatarIjinWarga()">  
            <span class="file-custom"></span>
                    </label>        
                                        <br>
 <div v-if="this.forms.document_ijin_warga">                                       
<a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_ijin_warga" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a></div>  <br>  
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_ijin_warga']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_pks">NO PKS</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_pks')" class="form-control" placeholder="AKTUAL SITE ID" v-model="forms.no_pks" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_pks']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="pks_date">TANGGAL DOKUMEN PKS</label>
                                        <br>
 <date-picker :date="pks_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['pks_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_pks">DOKUMEN PKS</label>
                                        
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_pks" id="document_pks" ref="document_pks" v-on:change="newAvatarPKS()">       
<br>
 <div v-if="this.forms.document_pks"> 
<a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_pks" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a></div> <br>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_pks']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

                                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_imb">NO IMB</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_imb')" class="form-control" placeholder="AKTUAL SITE ID" v-model="forms.no_imb" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_imb']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
<label for="imb_date">TANGGAL IMB (Selamanya ? <input type="checkbox" id="checkbox" v-model="datenyaIMB">)</label>
                                        <br>
 <div v-if="this.datenyaIMB === true">                                       
 SELAMANYA
</div>
<div v-else>
<date-picker :date="imb_date" :option="option"></date-picker>
</div>    
   
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['imb_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_imb">DOKUMEN IMB</label>
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_imb" id="document_imb" ref="document_imb" v-on:change="newAvatarIMB()">
 <br>
  <div v-if="this.forms.document_imb"> 
<a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_imb" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> </div><br>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_imb']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add Dokumen SITAC</h4>      
<div class="form-body">
<div class="row">

 
 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_ban_bak">NO BAN / BAK</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_ban_bak')" class="form-control" placeholder="AKTUAL SITE ID" v-model="forms.no_ban_bak" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_ban_bak']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="date_ban_bak">TANGGAL DOKUMEN BAN / BAK</label>
                                        <br>
 <date-picker :date="date_ban_bak" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['date_ban_bak']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_ban_bak">DOKUMEN BAN / BAK</label>                              
                                        <br>
<input type="file" accept="application/pdf" name="document_ban_bak" id="document_ban_bak" v-on:change="newAvatarDokBanBakAdd"> 
       
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_ban_bak']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="ijin_warga_date">TANGGAL DOKUMEN IJIN WARGA</label>
                                        <br>
 <date-picker :date="ijin_warga_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['ijin_warga_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_ijin_warga">DOKUMEN IJIN WARGA</label>
                                        <br> 
<label id="projectinput8" class="file center-block">
<input type="file" accept="application/pdf" name="document_ijin_warga" id="document_ijin_warga" v-on:change="newAvatarIjinWargaAdd">  
            <span class="file-custom"></span>
                    </label>        
                                        <br>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_ijin_warga']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_pks">NO PKS</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_pks')" class="form-control" placeholder="AKTUAL SITE ID" v-model="forms.no_pks" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_pks']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="pks_date">TANGGAL DOKUMEN PKS</label>
                                        <br>
 <date-picker :date="pks_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['pks_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_pks">DOKUMEN PKS</label>
                                        
                                        <br>
<input type="file" accept="application/pdf" name="document_pks" id="document_pks" v-on:change="newAvatarPKSAdd">       
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_pks']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

                                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_imb">NO IMB</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_imb')" class="form-control" placeholder="AKTUAL SITE ID" v-model="forms.no_imb" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_imb']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
<label for="imb_date">TANGGAL IMB (Selamanya ? <input type="checkbox" id="checkbox" v-model="datenyaIMB">)</label>
                                        <br>
 <div v-if="this.datenyaIMB === true">                                       
 SELAMANYA
</div>
<div v-else>
<date-picker :date="imb_date" :option="option"></date-picker>
</div>    
   
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['imb_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_imb">DOKUMEN IMB</label>
                                        <br>
<input type="file" accept="application/pdf" name="document_imb" id="document_imb" v-on:change="newAvatarIMBAdd">
 <br>
 <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_imb']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editSITAC', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>






<!-- @edit RFC -->
<modal  v-if="modal.get('editRFC')" @close="modal.set('editRFC', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen RFC</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenRFCsubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.documentrfcid">   
    <h4 align="center">Edit Dokumen RFC</h4>     
<div class="form-body">
<div class="row">

 
 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                       <label for="no_rfc">NO DOKUMEN RFC</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_rfc')" class="form-control" placeholder="RFC NUMBER" v-model="forms.no_rfc" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_rfc']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rfc_date">TANGGAL DOKUMEN RFC</label>
                                        <br>
 <date-picker :date="rfc_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfc_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
         </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                         <label for="document_rfc">DOKUMEN RFC</label>                        
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_rfc" id="document_rfc" ref="document_rfc" v-on:change="newAvatarDokRFC()"> 
                                     <br>
<a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_rfc" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> 
       
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_rfc']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                         <label for="target_rfi">TARGET RFI</label>
                                        <br>
 <div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">PO Release + </span>
</div>
 
<money v-model="forms.target_rfi" v-bind="target_rfi"></money> 
<div class="input-group-append">
<span class="input-group-text">Days</span>
 </div>
                            </div>   <div class="help-block"><ul role="alert"><li v-for="error of errorNya['target_rfi']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                          <label for="power_capacity">POWER CAPACITY</label>
                                        <br> 
  <div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">PLN </span>
</div>
<money v-model="forms.power_capacity" v-bind="power_capacity"></money> 
 
<div class="input-group-append">
<span class="input-group-text">KVA</span>
 </div> 
                            </div>       
                                        <br>
 <div class="help-block"><ul role="alert"><li v-for="error of errorNya['power_capacity']"><span style="color:red;">{{ error }}</span></li></ul></div>
 
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="id_pln">ID PLN</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'id_pln')" class="form-control" placeholder="RFC NUMBER" v-model="forms.id_pln" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['id_pln']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add Dokumen RFC</h4>      
<div class="form-body">
<div class="row">

 
 
 
 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                       <label for="no_rfc">NO DOKUMEN RFC</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_rfc')" class="form-control" placeholder="RFC NUMBER" v-model="forms.no_rfc" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_rfc']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rfc_date">TANGGAL DOKUMEN RFC</label>
                                        <br>
 <date-picker :date="rfc_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfc_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
         </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                         <label for="document_rfc">DOKUMEN RFC</label>                        
                                        <br>
<input type="file" accept="application/pdf" name="document_rfc" id="document_rfc" v-on:change="newAvatarDokRFCAdd" required> 
      
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_rfc']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                         <label for="target_rfi">TARGET RFI</label>
                                        <br>
 <div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">PO Release + </span>
</div>
 
<money v-model="forms.target_rfi" v-bind="target_rfi"></money> 
<div class="input-group-append">
<span class="input-group-text">Days</span>
 </div>
                            </div>   
                            <div class="help-block"><ul role="alert"><li v-for="error of errorNya['target_rfi']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                          <label for="power_capacity">POWER CAPACITY</label>
                                        <br> 
  <div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">PLN </span>
</div>
<money v-model="forms.power_capacity" v-bind="power_capacity"></money> 
 
<div class="input-group-append">
<span class="input-group-text">KVA</span>
 </div> 
                            </div>       
                                        <br>
 <div class="help-block"><ul role="alert"><li v-for="error of errorNya['power_capacity']"><span style="color:red;">{{ error }}</span></li></ul></div>
 
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="id_pln">ID PLN</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'id_pln')" class="form-control" placeholder="RFC NUMBER" v-model="forms.id_pln" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['id_pln']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editRFC', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>






<!-- @edit BOQ -->
<modal  v-if="modal.get('editBOQ')" @close="modal.set('editBOQ', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen BOQ</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenBOQsubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.documentboqid">   
    <h4 align="center">Edit BOQ</h4>     
<div class="form-body">
<div class="row">

 
       <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_type">TIPE SITE</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'site_type')" class="form-control" placeholder="TIPE SITE" v-model="forms.site_type" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_type']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tower_type">TIPE TOWER</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'tower_type')" class="form-control" placeholder="TIPE SITE" v-model="forms.tower_type" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['tower_type']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="roof_top_high">ROOF TOP HIGHT</label>
                                        <br>
<money v-model="forms.roof_top_high" class="form-control border-input" placeholder="Tinggi Tower" v-bind="tower"></money>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['roof_top_high']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tower_high">TINGGI TOWER</label>
                                        <br>
<money v-model="forms.tower_high" class="form-control border-input" placeholder="Tinggi Tower" v-bind="tower"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['tower_high']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
 
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rf_in_meters">RF IN METERS</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'rf_in_meters')" class="form-control" placeholder="RF IN METERS" v-model="forms.rf_in_meters" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['rf_in_meters']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="mw_in_meters">MW IN METERS</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'mw_in_meters')" class="form-control" placeholder="MW IN METERS" v-model="forms.mw_in_meters" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['mw_in_meters']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
 
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="harga_bulan">Harga Sewa / Bulan</label>
                                        <br>
<money v-model="forms.harga_bulan" class="form-control border-input" placeholder="Harga Sewa / Bulan" v-bind="duit"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['harga_bulan']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="harga_tahun">Harga Sewa / Tahun</label>
                                        <br>
{{this.perkalianTahun(this.forms.harga_bulan)}}
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['harga_tahun']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add Dokumen BOQ</h4>      
<div class="form-body">
<div class="row">

 
 
   <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_type">TIPE SITE</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'site_type')" class="form-control" placeholder="TIPE SITE" v-model="forms.site_type" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_type']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tower_type">TIPE TOWER</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'tower_type')" class="form-control" placeholder="TIPE SITE" v-model="forms.tower_type" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['tower_type']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="roof_top_high">ROOF TOP HIGHT</label>
                                        <br>
<money v-model="forms.roof_top_high" class="form-control border-input" placeholder="Tinggi Tower" v-bind="tower"></money>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['roof_top_high']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tower_high">TINGGI TOWER</label>
                                        <br>
<money v-model="forms.tower_high" class="form-control border-input" placeholder="Tinggi Tower" v-bind="tower"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['tower_high']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
 
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rf_in_meters">RF IN METERS</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'rf_in_meters')" class="form-control" placeholder="RF IN METERS" v-model="forms.rf_in_meters" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['rf_in_meters']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="mw_in_meters">MW IN METERS</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'mw_in_meters')" class="form-control" placeholder="MW IN METERS" v-model="forms.mw_in_meters" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['mw_in_meters']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
 
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="harga_bulan">Harga Sewa / Bulan</label>
                                        <br>
<money v-model="forms.harga_bulan" class="form-control border-input" placeholder="Harga Sewa / Bulan" v-bind="duit"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['harga_bulan']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="harga_tahun">Harga Sewa / Tahun</label>
                                        <br>
{{this.perkalianTahun(this.forms.harga_bulan)}}
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['harga_tahun']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editBOQ', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>







<!-- @edit PO -->
<modal  v-if="modal.get('editPO')" @close="modal.set('editPO', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen PO</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenPOsubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.poid">   
    <h4 align="center">Edit PO</h4>     
<div class="form-body">
<div class="row">

 
       <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="po_date"><h4>TANGGAL PO</h4></label>
                                        <br>
 <date-picker :date="po_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['po_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="no_po"><h4>NO PO</h4></label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_po')" class="form-control" placeholder="PO NUMBER" v-model="forms.no_po" required>
 <div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_po']"><span style="color:red;">{{ error }}</span></li></ul></div> 
                                        </fieldset>
                                </div>
   

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add PO</h4>      
<div class="form-body">
<div class="row">

  
       <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="po_date"><h4>TANGGAL PO</h4></label>
                                        <br>
 <date-picker :date="po_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['po_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="no_po"><h4>NO PO</h4></label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_po')" class="form-control" placeholder="PO NUMBER" v-model="forms.forms" required>
 <div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_po']"><span style="color:red;">{{ error }}</span></li></ul></div> 
                                        </fieldset>
                                </div>

</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editPO', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>





<!-- @edit site opening -->
<modal  v-if="modal.get('editSiteOpening')" @close="modal.set('editSiteOpening', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen Site Opening</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenSiteOpeningsubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.siteopeningid">   
    <h4 align="center">Edit Site Opening</h4>     
<div class="form-body">
<div class="row">

 
       <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="site_opening_date"><h4>TANGGAL SITE OPENING</h4></label>
                                        <br>
 <date-picker :date="site_opening_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_opening_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="no_po"><h4>DOKUMEN SITE OPENING</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" class="dropzone dropzone-area" ref="document_site_opening" name="document_site_opening" id="document_site_opening" v-on:change="newAvatarSiteOpening()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_site_opening" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_site_opening']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>
   

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add Site Openning</h4>      
<div class="form-body">
<div class="row">

  
           <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="site_opening_date"><h4>TANGGAL SITE OPENING</h4></label>
                                        <br>
 <date-picker :date="site_opening_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_opening_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="no_po"><h4>DOKUMEN SITE OPENING</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" name="document_site_opening" id="document_site_opening" v-on:change="newAvatarSiteOpeningAdd" required> 
            <span class="file-custom"></span>
                    </label>
                <br>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_site_opening']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>

</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editSiteOpening', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>





<!-- @edit Excavation -->
<modal  v-if="modal.get('editExcavation')" @close="modal.set('editExcavation', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen Excavation</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenExcavationsubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.excavationid">   
    <h4 align="center">Edit Excavation</h4>     
<div class="form-body">
<div class="row">

 
       <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="excavation_date"><h4>TANGGAL Excavation</h4></label>
                                        <br>
 <date-picker :date="excavation_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['excavation_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="excavation_document"><h4>DOKUMEN Excavation</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" class="dropzone dropzone-area" ref="excavation_document" name="excavation_document" id="excavation_document" v-on:change="newAvatarExcavation()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.excavation_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['excavation_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>
   

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add Excavation</h4>      
<div class="form-body">
<div class="row">

  
           <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="excavation_date"><h4>TANGGAL Excavation</h4></label>
                                        <br>
 <date-picker :date="excavation_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['excavation_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="no_po"><h4>DOKUMEN Excavation</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" name="document_site_opening" id="document_site_opening" v-on:change="newAvatarExcavationAdd" required> 
            <span class="file-custom"></span>
                    </label>
                <br>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_site_opening']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>

</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editExcavation', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>




<!-- @edit Rebaring -->
<modal  v-if="modal.get('editRebaring')" @close="modal.set('editRebaring', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen Rebaring</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenRebaringsubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.rebaringid">   
    <h4 align="center">Edit Rebaring</h4>     
<div class="form-body">
<div class="row">

 
       <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="rebaring_date"><h4>TANGGAL Rebaring</h4></label>
                                        <br>
 <date-picker :date="rebaring_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['rebaring_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="rebaring_document"><h4>DOKUMEN Rebaring</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" class="dropzone dropzone-area" ref="rebaring_document" name="rebaring_document" id="rebaring_document" v-on:change="newAvatarRebaring()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.rebaring_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['rebaring_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>
   

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add Rebaring</h4>      
<div class="form-body">
<div class="row">

  
           <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="rebaring_date"><h4>TANGGAL Rebaring</h4></label>
                                        <br>
 <date-picker :date="rebaring_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['rebaring_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="rebaring_document"><h4>DOKUMEN Rebaring</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" name="rebaring_document" id="rebaring_document" v-on:change="newAvatarRebaringAdd" required> 
            <span class="file-custom"></span>
                    </label>
                <br>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['rebaring_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>

</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editRebaring', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>


<!-- @edit Pouring -->
<modal  v-if="modal.get('editPouring')" @close="modal.set('editPouring', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen Pouring</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenPouringsubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.pouringid">   
    <h4 align="center">Edit Pouring</h4>     
<div class="form-body">
<div class="row">

 
       <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="pouring_date"><h4>TANGGAL Pouring</h4></label>
                                        <br>
 <date-picker :date="pouring_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['pouring_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="pouring_document"><h4>DOKUMEN Pouring</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" class="dropzone dropzone-area" ref="pouring_document" name="pouring_document" id="pouring_document" v-on:change="newAvatarPouring()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.pouring_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['pouring_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>
   

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add Pouring</h4>      
<div class="form-body">
<div class="row">

  
           <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="pouring_date"><h4>TANGGAL Pouring</h4></label>
                                        <br>
 <date-picker :date="pouring_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['pouring_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="pouring_document"><h4>DOKUMEN Pouring</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" name="pouring_document" id="pouring_document" v-on:change="newAvatarPouringAdd" required> 
            <span class="file-custom"></span>
                    </label>
                <br>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['pouring_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>

</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editPouring', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>



<!-- @edit Curing -->
<modal  v-if="modal.get('editCuring')" @close="modal.set('editCuring', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen Curing</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenCuringsubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.curingid">   
    <h4 align="center">Edit Curing</h4>     
<div class="form-body">
<div class="row">

 
       <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="curing_date"><h4>TANGGAL Curing</h4></label>
                                        <br>
 <date-picker :date="curing_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['curing_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="curing_document"><h4>DOKUMEN Curing</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" class="dropzone dropzone-area" ref="curing_document" name="curing_document" id="curing_document" v-on:change="newAvatarCuring()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.curing_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['curing_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>
   

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add Curing</h4>      
<div class="form-body">
<div class="row">

  
           <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="curing_date"><h4>TANGGAL Curing</h4></label>
                                        <br>
 <date-picker :date="curing_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['curing_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="curing_document"><h4>DOKUMEN Curing</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" name="curing_document" id="curing_document" v-on:change="newAvatarCuringAdd" required> 
            <span class="file-custom"></span>
                    </label>
                <br>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['curing_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>

</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editCuring', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>



<!-- @edit Tower Erection -->
<modal  v-if="modal.get('editTowerErection')" @close="modal.set('editTowerErection', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen Tower Erection</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenTowerErectionsubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.towererectionid">   
    <h4 align="center">Edit Tower Erection</h4>     
<div class="form-body">
<div class="row">

 
       <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="tower_erection_date"><h4>TANGGAL Tower Erection</h4></label>
                                        <br>
 <date-picker :date="tower_erection_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tower_erection_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="tower_erection_document"><h4>DOKUMEN Tower Erection</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" class="dropzone dropzone-area" ref="tower_erection_document" name="tower_erection_document" id="tower_erection_document" v-on:change="newAvatarTowerErection()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.tower_erection_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['tower_erection_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>
   

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add Tower Erection</h4>      
<div class="form-body">
<div class="row">

  
           <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="tower_erection_date"><h4>TANGGAL Tower Erection</h4></label>
                                        <br>
 <date-picker :date="tower_erection_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tower_erection_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="tower_erection_document"><h4>DOKUMEN Tower Erection</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" name="tower_erection_document" id="tower_erection_document" v-on:change="newAvatarTowerErectionAdd" required> 
            <span class="file-custom"></span>
                    </label>
                <br>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['tower_erection_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>

</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editTowerErection', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>




<!-- @edit M-E Process -->
<modal  v-if="modal.get('editMEProcess')" @close="modal.set('editTMEProcess', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen M-E Process</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenMEProcesssubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.meprocessid">   
    <h4 align="center">Edit M-E Process</h4>     
<div class="form-body">
<div class="row">

 
       <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="m_e_process_date"><h4>TANGGAL M-E Process</h4></label>
                                        <br>
 <date-picker :date="m_e_process_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['m_e_process_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="m_e_process_document"><h4>DOKUMEN M-E Process</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" class="dropzone dropzone-area" ref="m_e_process_document" name="m_e_process_document" id="m_e_process_document" v-on:change="newAvatarMEProcess()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.m_e_process_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['m_e_process_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>
   

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add M-E Process</h4>      
<div class="form-body">
<div class="row">

  
           <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="m_e_process_date"><h4>TANGGAL M-E Process</h4></label>
                                        <br>
 <date-picker :date="m_e_process_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['m_e_process_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="m_e_process_document"><h4>DOKUMEN M-E Process</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" name="m_e_process_document" id="m_e_process_document" v-on:change="newAvatarMEProcessAdd" required> 
            <span class="file-custom"></span>
                    </label>
                <br>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['m_e_process_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>

</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editMEProcess', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>



<!-- @edit Fence & Yard -->
<modal  v-if="modal.get('editFenceYard')" @close="modal.set('editFenceYard', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen Fence & Yard</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenFenceYardsubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.fenceyardid">   
    <h4 align="center">Edit Fence & Yard</h4>     
<div class="form-body">
<div class="row">

 
       <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="fence_yard_date"><h4>TANGGAL Fence & Yard</h4></label>
                                        <br>
 <date-picker :date="fence_yard_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['fence_yard_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="fence_yard_document"><h4>DOKUMEN Fence & Yard</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" class="dropzone dropzone-area" ref="fence_yard_document" name="fence_yard_document" id="fence_yard_document" v-on:change="newAvatarFenceYard()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.fence_yard_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['fence_yard_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>
   

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add Fence & Yard</h4>      
<div class="form-body">
<div class="row">

  
           <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="fence_yard_date"><h4>TANGGAL Fence & Yard</h4></label>
                                        <br>
 <date-picker :date="fence_yard_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['fence_yard_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="fence_yard_document"><h4>DOKUMEN Fence & Yard</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" name="fence_yard_document" id="fence_yard_document" v-on:change="newAvatarFenceYardAdd" required> 
            <span class="file-custom"></span>
                    </label>
                <br>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['fence_yard_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>

</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editFenceYard', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>




<!-- @edit RFI & BAUT -->
<modal  v-if="modal.get('editRFIBAUT')" @close="modal.set('editRFIBAUT', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen RFI & BAUT</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenRFIBAUTsubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.rfibautid">   
    <h4 align="center">Edit RFI & BAUT</h4>     
<div class="form-body">
<div class="row">

 
       <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="rfi_date"><h4>TANGGAL RFI</h4></label>
                                        <br>
 <date-picker :date="rfi_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="rfi_document"><h4>DOKUMEN RFI</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" class="dropzone dropzone-area" ref="rfi_document" name="rfi_document" id="rfi_document" v-on:change="newAvatarRFI()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.rfi_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>
   
       <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="baut_date"><h4>TANGGAL BAUT</h4></label>
                                        <br>
 <date-picker :date="baut_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['baut_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="baut_document"><h4>DOKUMEN BAUT</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" class="dropzone dropzone-area" ref="baut_document" name="baut_document" id="baut_document" v-on:change="newAvatarBAUT()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.baut_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['baut_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add RFI & BAUT</h4>      
<div class="form-body">
<div class="row">

  
           <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="rfi_date"><h4>TANGGAL RFI</h4></label>
                                        <br>
 <date-picker :date="rfi_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="rfi_document"><h4>DOKUMEN RFI</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" name="rfi_document" id="rfi_document" v-on:change="newAvatarRFIAdd" required> 
            <span class="file-custom"></span>
                    </label>
                <br>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>
           <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="baut_date"><h4>TANGGAL BAUT</h4></label>
                                        <br>
 <date-picker :date="baut_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['baut_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                            <label for="baut_document"><h4>DOKUMEN BAUT</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" name="baut_document" id="baut_document" v-on:change="newAvatarBAUTAdd" required> 
            <span class="file-custom"></span>
                    </label>
                <br>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['baut_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
 </fieldset>
                                </div>


</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editRFIBAUT', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>


<!-- @edit RFI Detail -->
<modal  v-if="modal.get('editRFIDetail')" @close="modal.set('editRFIDetail', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen RFI Detail</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenRFIDetailsubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.rfidetailid">   
    <h4 align="center">Edit RFI Detail</h4>     
<div class="form-body">
<div class="row">

 
       <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="rfi_detail_start_date"><h4>TANGGAL MULAI RFI </h4></label>
                                        <br>
 <date-picker :date="rfi_detail_start_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_detail_start_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
   
   
       <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="rfi_detail_end_date"><h4>TANGGAL BERAKHIR RFI</h4></label>
                                        <br>
 <date-picker :date="rfi_detail_end_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_detail_end_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
   

                                <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rfi_detail_price_month">Harga Sewa / Bulan</label>
                                        <br>
<money v-model="forms.rfi_detail_price_month" class="form-control border-input" placeholder="Harga Sewa / Bulan" v-bind="duit"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_detail_price_month']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rfi_detail_price_year">Harga Sewa / Tahun</label>
                                        <br>
{{this.perkalianTahunRFIDetail(this.forms.rfi_detail_price_month)}}
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_detail_price_year']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
  
                              

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add RFI Detail</h4>      
<div class="form-body">
<div class="row">

  
          
       <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="rfi_detail_start_date"><h4>TANGGAL MULAI RFI </h4></label>
                                        <br>
 <date-picker :date="rfi_detail_start_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_detail_start_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
   
   
       <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                     <fieldset class="form-group">
                                        <label for="rfi_detail_end_date"><h4>TANGGAL BERAKHIR RFI</h4></label>
                                        <br>
 <date-picker :date="rfi_detail_end_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_detail_end_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
   

                                <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rfi_detail_price_month">Harga Sewa / Bulan</label>
                                        <br>
<money v-model="forms.rfi_detail_price_month" class="form-control border-input" placeholder="Harga Sewa / Bulan" v-bind="duit"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_detail_price_month']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rfi_detail_price_year">Harga Sewa / Tahun</label>
                                        <br>
{{this.perkalianTahunRFIDetail(this.forms.rfi_detail_price_month)}}
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_detail_price_year']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editRFIDetail', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>







<!-- @edit RFI Detail -->
<modal  v-if="modal.get('editBAKSBAUK')" @close="modal.set('editBAKSBAUK', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen BAKS-BAUK</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenBAKSBAUKsubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.baksbaukid">   
    <h4 align="center">Edit Dokumen BAKS-BAUK</h4>     
<div class="form-body">
<div class="row">

 
         <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                         <label for="no_baks">NO DOKUMEN BAKS</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_baks')" class="form-control" placeholder="NO DOKUMEN BAKS" v-model="forms.no_baks" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_baks']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="date_baks">TANGGAL DOKUMEN BAKS</label>
                                        <br>
 <date-picker :date="date_baks" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['date_baks']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_baks">DOKUMEN BAKS</label>                              
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_baks" id="document_baks" ref="document_baks" v-on:change="newAvatarBAKS()"> 
                                        <br>
<a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_baks" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>          
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_baks']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div> 

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_wctr">DOKUMEN WCTR</label>
                                        <br> 
<label id="projectinput8" class="file center-block">
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_wctr" id="document_wctr" ref="document_wctr" v-on:change="newAvatarWctr()">  
            <span class="file-custom"></span>
                    </label>        
                                        <br>
<a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_wctr" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  <br>  
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_wctr']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>
    

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_boq_project">DOKUMEN BOQ PROJECT</label>
                                        
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_boq_project" id="document_boq_project" ref="document_boq_project" v-on:change="newAvatarBOQ()">       
<br>
<a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_boq_project" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> <br>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_boq_project']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

  

    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_rfi_certificate">DOKUMEN RFI CERTIFICATE</label>
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_rfi_certificate" id="document_rfi_certificate" ref="document_rfi_certificate" v-on:change="newAvatarRFICer()">
 <br>
<a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_rfi_certificate" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> <br>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_rfi_certificate']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>
  
  
                              

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add Dokumen BAKS-BAUK</h4>      
<div class="form-body">
<div class="row">

  
          
       <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_baks">NO DOKUMEN BAKS</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_baks')" class="form-control" placeholder="NO DOKUMEN BAKS " v-model="forms.no_baks" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_baks']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="date_baks">TANGGAL DOKUMEN BAKS</label>
                                        <br>
 <date-picker :date="date_baks" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['date_baks']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_baks">DOKUMEN BAKS</label>
                                        <br>
<input type="file" accept="application/pdf" name="file_name" id="file_name" v-on:change="newAvatarBAKSAdd" required="required"> 
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_baks']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

                             

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_wctr">DOKUMEN WCTR</label>
                                        <br>
<input type="file" accept="application/pdf" name="document_wctr" id="document_wctr" v-on:change="newAvatarWctrAdd" required="required"> 
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_wctr']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

                             

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_boq_project">DOKUMEN BOQ PROJECT</label>
                                        <br>
<input type="file" accept="application/pdf" name="document_boq_project" id="document_boq_project" v-on:change="newAvatarBOQAdd" required="required"> 
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_boq_project']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

                             



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_rfi_certificate">DOKUMEN RFI CERTIFICATE</label>
                                        <br>
<input type="file" accept="application/pdf" name="document_rfi_certificate" id="document_rfi_certificate" v-on:change="newAvatarRFICerAdd" required="required"> 
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_rfi_certificate']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>


</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editBAKSBAUK', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>







<!-- @edit Invoice -->
<modal  v-if="modal.get('editInvoice')" @close="modal.set('editInvoice', false)">
        <template slot="header" align="center"><h4 align="center">Dokumen Invoice</h4></template>
        <template slot="body" >
          <form method="POST" action="" @submit.prevent="rubahDokumenInvoicesubmitData()">
                <div class="modal-body">




<div class="col-sm-12" v-if="this.forms.invoiceid">   
    <h4 align="center">Edit Dokumen Invoice</h4>     
<div class="form-body">
<div class="row">

 
  <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tgl_mulai_sewa">TANGGAL MULAI SEWA</label>
                                        <br>
 <date-picker :date="tgl_mulai_sewa" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tgl_mulai_sewa']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tgl_target_rfi">TANGGAL RFI</label>
                                        <br>
 <date-picker :date="tgl_target_rfi" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tgl_target_rfi']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_boq_baps">DOKUMEN BOQ BAPS</label>
                                        <br>
<input type="file" accept="application/pdf" name="document_boq_baps" id="document_boq_baps" class="dropzone dropzone-area" ref="document_boq_baps" v-on:change="newAvatarBOQBAPSInvoice()"> 
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_boq_baps']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
  <div class="col-sm-12" v-if="this.forms.document_boq_baps"> 
  <a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_boq_baps" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>   
  <br>
  </div>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tgL_akhir_sewa">TANGGAL AKHIR SEWA</label>
                                        <br>
 <date-picker :date="tgL_akhir_sewa" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tgL_akhir_sewa']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div> 
    

                              <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_baps">DOKUMEN BAPS</label>
                                        <br>
<input type="file" accept="application/pdf" name="document_baps" id="document_baps" class="dropzone dropzone-area" ref="document_baps" v-on:change="newAvatarBaps()"> 
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_baps']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
  <div class="col-sm-12" v-if="this.forms.document_baps">
  <a v-bind:href="'/files/'+this.forms.projectid+'/'+this.forms.document_baps" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>   
  <br>
  </div>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

  

 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_receive">NO RECEIVE</label>
                                        <br>
<money v-model="forms.no_receive" class="form-control border-input" placeholder="NO RECEIVE" v-bind="nomorinvoice"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_receive']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_kontrak">NO KONTRAK</label>
                                        <br>
<money v-model="forms.no_kontrak" class="form-control border-input" placeholder="NO KONTRAK" v-bind="nomorinvoice"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_kontrak']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  

                                 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_invoice">NO INVOICE</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_invoice')" class="form-control" placeholder="NO INVOICE" v-model="forms.no_invoice" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_invoice']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tgl_invoice">TANGGAL INVOICE</label>
                                        <br>
 <date-picker :date="tgl_invoice" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tgl_invoice']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div> 
  
  
                              

</div>
</div>
</div>


<div class="col-sm-12" v-else>  
    <h4 align="center">Add Dokumen Invoice</h4>      
<div class="form-body">
<div class="row">

  
         <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tgl_mulai_sewa">TANGGAL MULAI SEWA</label>
                                        <br>
 <date-picker :date="tgl_mulai_sewa" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tgl_mulai_sewa']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div> 
 
   <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tgl_target_rfi">TANGGAL TARGET RFI</label>
                                        <br>
 <date-picker :date="tgl_target_rfi" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tgl_target_rfi']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div> 

   <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_boq_baps">DOKUMEN BOQ BAPS</label>
                                        <br>
<input type="file" accept="application/pdf" name="document_boq_baps" id="document_boq_baps" v-on:change="newAvatarBOQBAPSInvoiceAdd" required="required"> 
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_boq_baps']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tgL_akhir_sewa">TANGGAL AKHIR SEWA</label>
                                        <br>
 <date-picker :date="tgL_akhir_sewa" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tgL_akhir_sewa']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div> 

                                                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_baps">DOKUMEN BAPS</label>
                                        <br>
<input type="file" accept="application/pdf" name="document_baps" id="document_baps" v-on:change="newAvatarBapsAdd" required="required"> 
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_baps']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

								
                                 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_receive">NO RECEIVE</label>
                                        <br>
<money v-model="forms.no_receive" class="form-control border-input" placeholder="NO RECEIVE" v-bind="nomorinvoice"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_receive']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                        </fieldset>
                                </div>

            <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_kontrak">NO KONTRAK</label>
                                        <br>
<money v-model="forms.no_kontrak" class="form-control border-input" placeholder="NO KONTRAK" v-bind="nomorinvoice"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_kontrak']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                 </fieldset>
                                </div>

                                  <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_invoice">NO INVOICE</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_invoice')" class="form-control" placeholder="NO INVOICE" v-model="forms.no_invoice" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_invoice']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tgl_invoice">TANGGAL INVOICE</label>
                                        <br>
 <date-picker :date="tgl_invoice" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tgl_invoice']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div> 




</div>
</div>
</div>




                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('editInvoice', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
                </form>
        </template>
        </modal>






 </div> 
</template>



<script>
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

        class CrudForm {
            constructor(data) {
                this.originalData = data;
                for(let field in data){
                    this[field] = data[field];
                }
            }
            reset(){
                for(let field in this.originalData){
                    this[field] = '';
                }
            }
            /*  Set a value to the temp , verify if has this item and update  */
            setFillItem(item , index){
                for(let field in this.originalData){
                    if(field in item){
                        this[field] = item[field];
                    }else{
                        // if is index
                        if(field == 'index'){ this[field] = index; }
                    }
                }
            }
            data(){
                let data = Object.assign({} , this);
                delete data.originalData;
                delete data.errors;
                return data;
            }
        }

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
import {Money} from 'v-money'
import loading from '../Loading'
import VueEvents from 'vue-events'
Vue.use(VueEvents)
Vue.component('custom-actions', require('../Button/BooksCustomActions.vue'))
window.axios = require('axios')
window.eventBus = new Vue()

export default {
        props: {
      rowDatanya: {
        type: Object,
        required: true
      },
      typenya: {
        type: String,
        required: true
      }
    },
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
    'vue-toast': VueToast,
    'date-picker': myDatepicker,
	loading,
  Money,
  },
 data () {
    return {
    	nomorinvoice: {
        decimal: '',
        thousands: '',
        prefix: '',
        suffix: '',
        precision: 0,
        masked: false
        },
        power_capacity: {
          decimal: ',',
          thousands: '.',
          prefix: '',
          suffix: '',
          precision: 1,
          masked: false
        },
        target_rfi: {
          decimal: '',
          thousands: '.',
          prefix: '',
          suffix: '',
          precision: 0,
          masked: false
        },
        tower: {
        decimal: ',',
        thousands: '.',
        prefix: '',
        suffix: ' M',
        precision: 0,
        masked: false
        },
    duit: {
        decimal: ',',
        thousands: '.',
        prefix: 'Rp. ',
        suffix: '',
        precision: 0,
        masked: false
        },
	isLoading: false,
    formErrors:{},
	GetLevel:'', 
     file_name:'',
     document_kom:'',
     document_drm:'',
     document_ban_bak:'',
     document_ijin_warga:'',
     document_pks:'',
     document_imb:'',
     document_rfc:'',
     document_site_opening:'',
     excavation_document:'',
     rebaring_document:'',
     pouring_document:'',
     curing_document:'',
     tower_erection_document:'',
     m_e_process_document:'',
     fence_yard_document:'',
     rfi_document:'',
     rfi_detail_price_month:0,
     baut_document:'',
     document_baks:'',
     document_wctr:'',
     document_boq_project:'',
     document_rfi_certificate:'',
     document_boq_baps:'',
     document_baps:'',
     no_receive:11,
  tgl_invoice: {
        time: ''
      },
  tgL_akhir_sewa: {
        time: ''
      },
  tgl_target_rfi: {
        time: ''
      },
  tgl_mulai_sewa: {
        time: ''
      },
  date_baks: {
        time: ''
      },
  fence_yard_date: {
        time: ''
      },
  rfi_date: {
        time: ''
      },
  baut_date: {
        time: ''
      },
  woDate: {
        time: ''
      },
  kom_date: {
        time: ''
      },
  drm_date: {
        time: ''
      },
  date_ban_bak: {
        time: ''
      },
  ijin_warga_date: {
        time: ''
      },
  pks_date: {
        time: ''
      },
	imb_date: {
        time: ''
      },
	rfc_date: {
        time: ''
      },
	po_date: {
        time: ''
      },
	site_opening_date: {
        time: ''
      },
	excavation_date: {
        time: ''
      },
	rebaring_date: {
        time: ''
      },
	pouring_date: {
        time: ''
      },
	curing_date: {
        time: ''
      },
	tower_erection_date: {
        time: ''
      },
	m_e_process_date: {
        time: ''
      },
	rfi_detail_start_date: {
        time: ''
      },
	rfi_detail_end_date: {
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
  modal:new CrudModal({editProject: false , editSIS: false ,  editDRM: false ,   editSITAC: false , editRFC:false ,editBOQ:false,
  editPO: false,editSiteOpening:false,editExcavation:false,editRebaring:false,editPouring:false,editCuring:false,editTowerErection:false,
  editMEProcess:false,editFenceYard:false,editRFIBAUT:false,editRFIDetail:false,editRFIBAKSBAUK:false,editBAKSBAUK:false,
  editInvoice:false,
  }),


  forms: new CrudForm({
      id:'' , projectid:'' , no_wo:'' , wo_date:'',  batch:'',  years:'',  infratype:'',  area:'' , 
      regional:'' , site_id_spk:'' , site_name_spk:'' , address_spk:'', longitude_spk:'' , latitude_spk:'' , 
      status_id:'' , boq_status:'' , haki_status:'' , project_status_id:'' , batch_accrue:'' , 

      documentid:'', document_sis:'', 

      documentdrmid:'', site_id_actual:'', site_name_actual:'', province:'', city:'', address_actual:'',
       longitude_actual:'',latitude_actual:'',kom_date:'',drm_date:'',document_kom:'',document_drm:'',

       documentsitacid:'', no_ban_bak:'', date_ban_bak:'', document_ban_bak:'', ijin_warga_date:'', document_ijin_warga:'',
        no_pks:'', pks_date:'', no_imb:'', document_imb:'', document_pks:'', 
        
        documentrfcid:'', no_rfc:'', rfc_date:'', document_rfc:'', id_pln:'', target_rfi:'', target_rfi:'',targepower_capacityt_rfi:'', 
        
        documentboqid:'', site_type:'', tower_type:'', roof_top_high:'', tower_high:'', rf_in_meters:'', mw_in_meters:'',
         harga_bulan:'', harga_tahun:'', 
         
         poid:'',no_po:'',po_date:'',
         
         siteopeningid:'', site_opening_date:'', document_site_opening:'', 
         
         excavationid:'', excavation_date:'', excavation_document:'',

          rebaringid:'', rebaring_date:'', rebaring_document:'',

           pouringid:'', pouring_date:'', pouring_document:'', 
           
           curingid:'', curing_date:'', curing_document:'', 
           
           towererectionid:'', tower_erection_date:'', tower_erection_document:'',

           meprocessid:'',m_e_process_date:'',m_e_process_document:'',
           
           fenceyardid:'', fence_yard_date:'', fence_yard_document:'', 
           
           rfibautid:'', rfi_date:'', rfi_document:'', baut_date:'', baut_document:'', 
           
           rfidetailid:'', rfi_detail_start_date:'', rfi_detail_end_date:'', rfi_detail_price_month:'', rfi_detail_price_year:'',
        
           baksbaukid:'', no_baks:'', date_baks:'', document_baks:'', document_wctr:'', document_boq_project:'',document_rfi_certificate:'',
           
           invoiceid:'',  no_receive:'', tgL_akhir_sewa:'',  document_baps:'',     no_kontrak:'',   no_invoice:'',   tgl_invoice:'' ,tgl_mulai_sewa:'', tgl_target_rfi:'', document_boq_baps:'', 

      }), 
 
	pilihaninratype: ['B2S','UNTAPPED'],
	pilihanarea: ['1','2','3','4'],
     datenyaIMB: false,
    errors: new Errors() ,
    errorNya: [],
    dataStatus: '',
    dataNya: {name : '', level:''},
    perPage: 10,
    loading: false,
      moreParams: {}
    }
  },
 watch: {
        },
        methods: {

//edit Invoice
 rubahDokumenInvoicesubmitData() {
      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData(); 
       if(this.forms.invoiceid)
 {
   masuk.set('id', this.forms.invoiceid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)  
   masuk.set('tgl_mulai_sewa', this.tgl_mulai_sewa.time)
   masuk.set('tgl_target_rfi', this.tgl_target_rfi.time)
   masuk.set('tgL_akhir_sewa', this.tgL_akhir_sewa.time)
   masuk.set('tgl_invoice', this.tgl_invoice.time)
   masuk.set('no_receive', this.forms.no_receive)
   masuk.set('no_kontrak', this.forms.no_kontrak)
   masuk.set('no_invoice', this.forms.no_invoice); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('tgl_mulai_sewa', this.tgl_mulai_sewa.time)
   masuk.set('tgl_target_rfi', this.tgl_target_rfi.time)
   masuk.set('tgL_akhir_sewa', this.tgL_akhir_sewa.time)
   masuk.set('tgl_invoice', this.tgl_invoice.time)
   masuk.set('no_receive', this.forms.no_receive)
   masuk.set('no_kontrak', this.forms.no_kontrak)
   masuk.set('no_invoice', this.forms.no_invoice)
   masuk.set('document_boq_baps', this.document_boq_baps)
   masuk.set('document_baps', this.document_baps); 
} 
                axios.post('/karyawan/RevisiDocumentInvoiceByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success); 
                 this.isLoading = false;  
                 this.tgl_mulai_sewa.time = response.data.project.tgl_mulai_sewa; 
                 this.tgl_target_rfi.time = response.data.project.tgl_target_rfi; 
                 this.tgL_akhir_sewa.time = response.data.project.tgL_akhir_sewa; 
                   this.forms = response.data.project;
                      } 
                      else
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },

 newAvatarBapsAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_baps = files[0];
                
           },

     newAvatarBaps(event) {
this.isLoading = true;            
this.document_baps = this.$refs.document_baps.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.invoiceid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('namafile', this.forms.document_baps) 
   masuk.set('document_baps', this.document_baps) 
axios.post('/karyawan/uploaddokumenBAPSInvoiceByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.document_baps = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.document_baps = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_baps)
{
    this.document_baps = '';
  this.errorNya = {document_baps:[response.data.document_baps]}; 
}
if(response.data.error)
                      {
    this.document_baps = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.document_baps = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_baps = '';                
           },


 newAvatarBOQBAPSInvoiceAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_boq_baps = files[0];
                
           },

     newAvatarBOQBAPSInvoice(event) {
this.isLoading = true;            
this.document_boq_baps = this.$refs.document_boq_baps.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.invoiceid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('namafile', this.forms.document_boq_baps) 
   masuk.set('document_boq_baps', this.document_boq_baps) 
axios.post('/karyawan/uploaddokumenBOQBAPSInvoiceByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.document_boq_baps = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.document_boq_baps = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_boq_baps)
{
    this.document_boq_baps = '';
  this.errorNya = {document_boq_baps:[response.data.document_boq_baps]}; 
}
if(response.data.error)
                      {
    this.document_boq_baps = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.document_boq_baps = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_boq_baps = '';                
           },


//edit Dokumen BAKS-BAUK
 rubahDokumenBAKSBAUKsubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData(); 
       if(this.forms.baksbaukid)
 {
   masuk.set('id', this.forms.baksbaukid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('no_baks', this.forms.no_baks)
   masuk.set('date_baks', this.date_baks.time); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('no_baks', this.forms.no_baks)
   masuk.set('date_baks', this.date_baks.time)
   masuk.set('document_baks', this.document_baks)
   masuk.set('document_wctr', this.document_wctr)
   masuk.set('document_boq_project', this.document_boq_project)
   masuk.set('document_rfi_certificate', this.document_rfi_certificate); 
} 
                axios.post('/karyawan/RevisiDocumentBAKSBAUKByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success); 
                 this.isLoading = false;  
                 this.date_baks.time = response.data.project.date_baks; 
                   this.forms = response.data.project;
                      } 
                      else
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },
 newAvatarRFICerAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_rfi_certificate = files[0];
                
           },

     newAvatarRFICer(event) {
this.isLoading = true;            
this.document_rfi_certificate = this.$refs.document_rfi_certificate.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.baksbaukid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('namafile', this.forms.document_rfi_certificate) 
   masuk.set('document_rfi_certificate', this.document_rfi_certificate) 
axios.post('/karyawan/uploaddokumenRFICaerByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.document_rfi_certificate = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.document_rfi_certificate = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_rfi_certificate)
{
    this.document_rfi_certificate = '';
  this.errorNya = {document_rfi_certificate:[response.data.document_rfi_certificate]}; 
}
if(response.data.error)
                      {
    this.document_rfi_certificate = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.document_rfi_certificate = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_rfi_certificate = '';                
           },

 newAvatarBOQAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_boq_project = files[0];
                
           },

     newAvatarBOQ(event) {
this.isLoading = true;            
this.document_boq_project = this.$refs.document_boq_project.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.baksbaukid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('namafile', this.forms.document_boq_project) 
   masuk.set('document_boq_project', this.document_boq_project) 
axios.post('/karyawan/uploaddokumenBOQProjectByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.document_boq_project = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.document_boq_project = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_boq_project)
{
    this.document_boq_project = '';
  this.errorNya = {document_boq_project:[response.data.document_boq_project]}; 
}
if(response.data.error)
                      {
    this.document_boq_project = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.document_boq_project = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_boq_project = '';                
           },

 newAvatarWctrAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_wctr = files[0];
                
           },

     newAvatarWctr(event) {

this.isLoading = true;            
this.document_wctr = this.$refs.document_wctr.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.baksbaukid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('namafile', this.forms.document_wctr) 
   masuk.set('document_wctr', this.document_wctr) 
axios.post('/karyawan/uploaddokumenWCTRByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.document_wctr = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.document_wctr = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_wctr)
{
    this.document_wctr = '';
  this.errorNya = {document_wctr:[response.data.document_wctr]}; 
}
if(response.data.error)
                      {
    this.document_wctr = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.document_wctr = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_wctr = '';                
           },

 newAvatarBAKSAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_baks = files[0];
                
           },

     newAvatarBAKS(event) {

this.isLoading = true;            
this.document_baks = this.$refs.document_baks.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.baksbaukid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('namafile', this.forms.document_baks) 
   masuk.set('document_baks', this.document_baks) 
axios.post('/karyawan/uploaddokumenBAKSByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.document_baks = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.document_baks = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_baks)
{
    this.document_baks = '';
  this.errorNya = {document_baks:[response.data.document_baks]}; 
}
if(response.data.error)
                      {
    this.document_baks = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.document_baks = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_baks = '';                
           },




//edit RFI Detail
   perkalianTahunRFIDetail (value) {
       this.forms.rfi_detail_price_year = value*12;
      var tahunan = value*12;
      return accounting.formatMoney(tahunan,  "Rp. ", 0, ".", ","); 
    }, 

  rubahDokumenRFIDetailsubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData(); 
       if(this.forms.rfidetailid)
 {
   masuk.set('id', this.forms.rfidetailid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('rfi_detail_start_date', this.rfi_detail_start_date.time)
   masuk.set('rfi_detail_end_date', this.rfi_detail_end_date.time)
   masuk.set('rfi_detail_price_month', this.forms.rfi_detail_price_month)
   masuk.set('rfi_detail_price_year', this.forms.rfi_detail_price_year); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('rfi_detail_start_date', this.rfi_detail_start_date.time)
   masuk.set('rfi_detail_end_date', this.rfi_detail_end_date.time)
   masuk.set('rfi_detail_price_month', this.forms.rfi_detail_price_month)
   masuk.set('rfi_detail_price_year', this.forms.rfi_detail_price_year); 
} 
                axios.post('/karyawan/RevisiDocumentRFIDetailByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success); 
                 this.isLoading = false;  
                 this.rfi_detail_start_date.time = response.data.project.rfi_detail_start_date;
                 this.rfi_detail_end_date.time = response.data.project.rfi_detail_end_date;
                   this.forms = response.data.project;
                      } 
                      else
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },



//edit RFI & BAUT
       rubahDokumenRFIBAUTsubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData();
       if(this.forms.rfibautid)
 {
   masuk.set('id', this.forms.rfibautid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('rfi_date', this.rfi_date.time)
   masuk.set('baut_date', this.baut_date.time); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('rfi_document', this.rfi_document) 
   masuk.set('rfi_date', this.rfi_date.time)
   masuk.set('baut_document', this.baut_document) 
   masuk.set('baut_date', this.baut_date.time); 
}

                axios.post('/karyawan/RevisiDocumentRFIBAUTByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success); 
                 this.isLoading = false;  
                 this.rfi_date.time = response.data.project.rfi_date;
                 this.baut_date.time = response.data.project.baut_date;
                   this.forms = response.data.project;
                      } 
                      else
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },

     newAvatarRFIAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.rfi_document = files[0];
                
           },
     newAvatarBAUTAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.baut_document = files[0];
                
           },

     newAvatarBAUT(event) {

this.isLoading = true;            
this.baut_document = this.$refs.baut_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.rfibautid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('baut_document_old', this.forms.baut_document) 
   masuk.set('baut_document', this.baut_document) 
axios.post('/karyawan/uploaddokumenBAUTByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.baut_document = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.baut_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.baut_document)
{
    this.baut_document = '';
  this.errorNya = {baut_document:[response.data.baut_document]}; 
}
if(response.data.error)
                      {
    this.baut_document = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.baut_document = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.baut_document = '';                
           },



     newAvatarRFI(event) {

this.isLoading = true;            
this.rfi_document = this.$refs.rfi_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.rfibautid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('rfi_document_old', this.forms.rfi_document) 
   masuk.set('rfi_document', this.rfi_document) 
axios.post('/karyawan/uploaddokumenRFIByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.rfi_document = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.rfi_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.rfi_document)
{
    this.rfi_document = '';
  this.errorNya = {rfi_document:[response.data.rfi_document]}; 
}
if(response.data.error)
                      {
    this.rfi_document = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.rfi_document = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.rfi_document = '';                
           },



//edit Fence & Yard
       rubahDokumenFenceYardsubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData();
       if(this.forms.fenceyardid)
 {
   masuk.set('id', this.forms.fenceyardid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('fence_yard_date', this.fence_yard_date.time); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('fence_yard_document', this.fence_yard_document) 
   masuk.set('fence_yard_date', this.fence_yard_date.time); 
}

                axios.post('/karyawan/RevisiDocumentFenceYardByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success); 
                 this.isLoading = false;  
                 this.fence_yard_date.time = response.data.project.fence_yard_date;
                   this.forms = response.data.project;
                      } 
                      else
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },

     newAvatarFenceYardAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.fence_yard_document = files[0];
                
           },

     newAvatarFenceYard(event) {

this.isLoading = true;            
this.fence_yard_document = this.$refs.fence_yard_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.meprocessid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('fence_yard_document_old', this.forms.fence_yard_document) 
   masuk.set('fence_yard_document', this.fence_yard_document) 
axios.post('/karyawan/uploaddokumenFenceYardByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.fence_yard_document = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.fence_yard_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.fence_yard_document)
{
    this.fence_yard_document = '';
  this.errorNya = {fence_yard_document:[response.data.fence_yard_document]}; 
}
if(response.data.error)
                      {
    this.fence_yard_document = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.fence_yard_document = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.fence_yard_document = '';                
           },




//edit M-E Process
       rubahDokumenMEProcesssubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData();
       if(this.forms.meprocessid)
 {
   masuk.set('id', this.forms.meprocessid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('m_e_process_date', this.m_e_process_date.time); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('m_e_process_document', this.m_e_process_document) 
   masuk.set('m_e_process_date', this.m_e_process_date.time); 
}

                axios.post('/karyawan/RevisiDocumentMEProcessByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success); 
                 this.isLoading = false;  
                 this.m_e_process_date.time = response.data.project.m_e_process_date;
                   this.forms = response.data.project;
                      } 
                      else
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },

     newAvatarMEProcessAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.m_e_process_document = files[0];
                
           },

     newAvatarMEProcess(event) {

this.isLoading = true;            
this.m_e_process_document = this.$refs.m_e_process_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.meprocessid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('m_e_process_document_old', this.forms.m_e_process_document) 
   masuk.set('m_e_process_document', this.m_e_process_document) 
axios.post('/karyawan/uploaddokumenMEProcessByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.m_e_process_document = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.m_e_process_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.m_e_process_document)
{
    this.m_e_process_document = '';
  this.errorNya = {m_e_process_document:[response.data.m_e_process_document]}; 
}
if(response.data.error)
                      {
    this.m_e_process_document = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.m_e_process_document = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.m_e_process_document = '';                
           },




//edit Tower Erection
       rubahDokumenTowerErectionsubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData();
       if(this.forms.towererectionid)
 {
   masuk.set('id', this.forms.towererectionid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('tower_erection_date', this.tower_erection_date.time); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('tower_erection_document', this.tower_erection_document) 
   masuk.set('tower_erection_date', this.tower_erection_date.time); 
}

                axios.post('/karyawan/RevisiDocumentTowerErectionByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success); 
                 this.isLoading = false;  
                 this.tower_erection_date.time = response.data.project.tower_erection_date;
                   this.forms = response.data.project;
                      } 
                      else
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },

     newAvatarTowerErectionAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.tower_erection_document = files[0];
                
           },

     newAvatarTowerErection(event) {

this.isLoading = true;            
this.tower_erection_document = this.$refs.tower_erection_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.towererectionid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('tower_erection_document_old', this.forms.tower_erection_document) 
   masuk.set('tower_erection_document', this.tower_erection_document) 
axios.post('/karyawan/uploaddokumenTowerErectionByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.tower_erection_document = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.tower_erection_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.tower_erection_document)
{
    this.tower_erection_document = '';
  this.errorNya = {tower_erection_document:[response.data.tower_erection_document]}; 
}
if(response.data.error)
                      {
    this.tower_erection_document = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.tower_erection_document = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.tower_erection_document = '';                
           },



//edit Curing
       rubahDokumenCuringsubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData();
       if(this.forms.curingid)
 {
   masuk.set('id', this.forms.curingid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('curing_date', this.curing_date.time); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('curing_document', this.curing_document) 
   masuk.set('curing_date', this.curing_date.time); 
}

                axios.post('/karyawan/RevisiDocumentCuringByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success); 
                 this.isLoading = false;  
                 this.curing_date.time = response.data.project.curing_date;
                   this.forms = response.data.project;
                      } 
                      else
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },

     newAvatarCuringAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.curing_document = files[0];
                
           },

     newAvatarCuring(event) {

this.isLoading = true;            
this.curing_document = this.$refs.curing_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.pouringid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('curing_document_old', this.forms.curing_document) 
   masuk.set('curing_document', this.curing_document) 
axios.post('/karyawan/uploaddokumenCuringByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.curing_document = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.curing_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.curing_document)
{
    this.curing_document = '';
  this.errorNya = {curing_document:[response.data.curing_document]}; 
}
if(response.data.error)
                      {
    this.curing_document = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.curing_document = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.curing_document = '';                
           },



//edit Pouring
       rubahDokumenPouringsubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData();
       if(this.forms.pouringid)
 {
   masuk.set('id', this.forms.pouringid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('pouring_date', this.pouring_date.time); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('pouring_document', this.pouring_document) 
   masuk.set('pouring_date', this.pouring_date.time); 
}

                axios.post('/karyawan/RevisiDocumentPouringByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success); 
                 this.isLoading = false;  
                 this.pouring_date.time = response.data.project.pouring_date;
                   this.forms = response.data.project;
                      } 
                      else
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },

     newAvatarPouringAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.pouring_document = files[0];
                
           },

     newAvatarPouring(event) {

this.isLoading = true;            
this.pouring_document = this.$refs.pouring_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.pouringid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('pouring_document_old', this.forms.pouring_document) 
   masuk.set('pouring_document', this.pouring_document) 
axios.post('/karyawan/uploaddokumenPouringByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.pouring_document = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.pouring_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.pouring_document)
{
    this.pouring_document = '';
  this.errorNya = {pouring_document:[response.data.pouring_document]}; 
}
if(response.data.error)
                      {
    this.pouring_document = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.pouring_document = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.pouring_document = '';                
           },



//edit Rebaring
       rubahDokumenRebaringsubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData();
       if(this.forms.rebaringid)
 {
   masuk.set('id', this.forms.rebaringid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('rebaring_date', this.rebaring_date.time); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('rebaring_document', this.rebaring_document) 
   masuk.set('rebaring_date', this.rebaring_date.time); 
}

                axios.post('/karyawan/RevisiDocumentRebaringByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success); 
                 this.isLoading = false;  
                 this.rebaring_date.time = response.data.project.rebaring_date;
                   this.forms = response.data.project;
                      } 
                      else
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },

     newAvatarRebaringAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.rebaring_document = files[0];
                
           },

     newAvatarRebaring(event) {

this.isLoading = true;            
this.rebaring_document = this.$refs.rebaring_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.rebaringid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('rebaring_document_old', this.forms.rebaring_document) 
   masuk.set('rebaring_document', this.rebaring_document) 
axios.post('/karyawan/uploaddokumenRebaringByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.rebaring_document = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.rebaring_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.rebaring_document)
{
    this.rebaring_document = '';
  this.errorNya = {rebaring_document:[response.data.rebaring_document]}; 
}
if(response.data.error)
                      {
    this.rebaring_document = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.rebaring_document = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.rebaring_document = '';                
           },




//edit site opening
       rubahDokumenExcavationsubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData();
       if(this.forms.excavationid)
 {
   masuk.set('id', this.forms.excavationid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('excavation_date', this.excavation_date.time); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('excavation_document', this.excavation_document) 
   masuk.set('excavation_date', this.excavation_date.time); 
}

                axios.post('/karyawan/RevisiDocumentExcavationByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success); 
                 this.isLoading = false;  
                 this.excavation_date.time = response.data.project.excavation_date;
                   this.forms = response.data.project;
                      } 
                      else
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },

     newAvatarExcavationAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.excavation_document = files[0];
                
           },

     newAvatarExcavation(event) {

this.isLoading = true;            
this.excavation_document = this.$refs.excavation_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.excavationid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('excavation_document_old', this.forms.excavation_document) 
   masuk.set('excavation_document', this.excavation_document) 
axios.post('/karyawan/uploaddokumenExcavationByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.excavation_document = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.excavation_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.excavation_document)
{
    this.excavation_document = '';
  this.errorNya = {excavation_document:[response.data.excavation_document]}; 
}
if(response.data.error)
                      {
    this.excavation_document = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.file_name = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.excavation_document = '';                
           },




//edit site opening
       rubahDokumenSiteOpeningsubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData();
       if(this.forms.siteopeningid)
 {
   masuk.set('id', this.forms.siteopeningid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('site_opening_date', this.site_opening_date.time); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('document_site_opening', this.document_site_opening) 
   masuk.set('site_opening_date', this.site_opening_date.time); 
}

                axios.post('/karyawan/RevisiDocumentSiteOpeningByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success); 
                 this.isLoading = false;  
                 this.site_opening_date.time = response.data.project.site_opening_date;
                   this.forms = response.data.project;
                      } 
                      else
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },

     newAvatarSiteOpeningAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_site_opening = files[0];
                
           },

     newAvatarSiteOpening(event) {

this.isLoading = true;            
this.document_site_opening = this.$refs.document_site_opening.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.siteopeningid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('document_site_opening_old', this.forms.document_site_opening) 
   masuk.set('document_site_opening', this.document_site_opening) 
axios.post('/karyawan/uploaddokumenSiteOpeningByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.document_site_opening = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.document_site_opening = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_site_opening)
{
    this.document_site_opening = '';
  this.errorNya = {document_site_opening:[response.data.document_site_opening]}; 
}
if(response.data.error)
                      {
    this.document_site_opening = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.file_name = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_site_opening = '';                
           },

//edit PO
       rubahDokumenPOsubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData();
       if(this.forms.poid)
 {
   masuk.set('id', this.forms.poid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('no_po', this.forms.no_po) 
   masuk.set('po_date', this.po_date.time); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('no_po', this.forms.no_po) 
   masuk.set('po_date', this.po_date.time); 
}

                axios.post('/karyawan/RevisiDocumentPOByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success); 
                 this.isLoading = false;  
                 this.po_date.time = response.data.project.po_date;
                   this.forms = response.data.project;
                      } 
                      else
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },



//edit BOQ
       rubahDokumenBOQsubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData();
       if(this.forms.documentboqid)
 {
   masuk.set('id', this.forms.documentboqid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('site_type', this.forms.site_type) 
   masuk.set('tower_type', this.forms.tower_type) 
   masuk.set('roof_top_high', this.forms.roof_top_high)   
   masuk.set('tower_high', this.forms.tower_high) 
   masuk.set('rf_in_meters', this.forms.rf_in_meters)
   masuk.set('harga_tahun', this.forms.harga_tahun)
   masuk.set('harga_bulan', this.forms.harga_bulan)
   masuk.set('mw_in_meters', this.forms.mw_in_meters); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('site_type', this.forms.site_type) 
   masuk.set('tower_type', this.forms.tower_type) 
   masuk.set('roof_top_high', this.forms.roof_top_high)   
   masuk.set('tower_high', this.forms.tower_high) 
   masuk.set('rf_in_meters', this.forms.rf_in_meters)
   masuk.set('harga_tahun', this.forms.harga_tahun)
   masuk.set('harga_bulan', this.forms.harga_bulan)
   masuk.set('mw_in_meters', this.forms.mw_in_meters); 
}

                axios.post('/karyawan/RevisiDocumentBOQByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success); 
                 this.isLoading = false;  
                   this.forms = response.data.project;
                      } 
                      else
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },

 
//edit RFC
       rubahDokumenRFCsubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
 
   let masuk = new FormData();
       if(this.forms.documentrfcid)
 {
   masuk.set('id', this.forms.documentrfcid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('no_rfc', this.forms.no_rfc) 
   masuk.set('rfc_date', this.rfc_date.time)   
   masuk.set('id_pln', this.forms.id_pln) 
   masuk.set('target_rfi', this.forms.target_rfi)
   masuk.set('power_capacity', this.forms.power_capacity); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('no_rfc', this.forms.no_rfc) 
   masuk.set('rfc_date', this.rfc_date.time)   
   masuk.set('id_pln', this.forms.id_pln) 
   masuk.set('target_rfi', this.forms.target_rfi)
   masuk.set('power_capacity', this.forms.power_capacity)
   masuk.set('document_rfc', this.document_rfc); 
}

                axios.post('/karyawan/RevisiDocumentRFCByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success);
                 this.isLoading = false; 
                    this.rfc_date.time = response.data.project.rfc_date; 
                   this.forms = response.data.project;
                      } 
                      else if(response.data.error)
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                      else
                      { 
                        this.isLoading = false; 
                        this.errorNya = {document_ban_bak:[response.data.error]};
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },

 

          //edit sitac
      rubahSITAC(){
                this.errorNya = ''; 
                this.modal.set('editSITAC', true); 
               
            }  ,  
       rubahDokumenSITACsubmitData() {

      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
        if(this.datenyaIMB === false)
    {
var datenya = this.imb_date.time;
    }
    else
    {
var datenya = 'SELAMANYA';
    }
   let masuk = new FormData();
       if(this.forms.documentsitacid)
 {
   masuk.set('id', this.forms.documentsitacid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('no_ban_bak', this.forms.no_ban_bak) 
   masuk.set('date_ban_bak', this.date_ban_bak.time)  
   masuk.set('ijin_warga_date', this.ijin_warga_date.time) 
   masuk.set('no_pks', this.forms.no_pks)
   masuk.set('pks_date', this.pks_date.time) 
   masuk.set('no_imb', this.forms.no_imb)
   masuk.set('imb_date', datenya); 
}
else
{
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('no_ban_bak', this.forms.no_ban_bak) 
   masuk.set('date_ban_bak', this.date_ban_bak.time)  
   masuk.set('ijin_warga_date', this.ijin_warga_date.time) 
   masuk.set('no_pks', this.forms.no_pks)
   masuk.set('pks_date', this.pks_date.time) 
   masuk.set('no_imb', this.forms.no_imb)
   masuk.set('document_ban_bak', this.document_ban_bak)
   masuk.set('document_ijin_warga', this.document_ijin_warga)
   masuk.set('document_pks', this.document_pks)
   masuk.set('document_imb', this.document_imb)
   masuk.set('imb_date', datenya); 
}

                axios.post('/karyawan/RevisiDocumentSITACByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success);
                 this.isLoading = false;
                    this.date_ban_bak.time = response.data.project.date_ban_bak;
                    this.ijin_warga_date.time = response.data.project.ijin_warga_date;
                    this.pks_date.time = response.data.project.pks_date; 
         if(response.data.project.imb_date === 'SELAMANYA')
           {
           this.datenyaIMB = true;
           }
           else
           {
          this.imb_date.time = response.data.project.imb_date;  
           }
                   this.forms = response.data.project;
                      } 
                      else if(response.data.error)
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                      else
                      { 
                        this.isLoading = false; 
                        this.errorNya = {document_ban_bak:[response.data.error]};
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })

  }
})
       },

          //edit drm
      rubahDRM(){
                this.errorNya = ''; 
                this.modal.set('editDRM', true); 
               
            }  ,  
      
 rubahDokumenDRMsubmitData() {
      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
 if (result.value) {
    this.isLoading = true;
 
      let masukDRM = new FormData();
       if(this.forms.documentdrmid)
 {
   masukDRM.set('id', this.forms.documentdrmid)
   masukDRM.set('project_id', this.forms.id) 
   masukDRM.set('projectid', this.forms.projectid)
   masukDRM.set('site_id_actual', this.forms.site_id_actual)
   masukDRM.set('site_name_actual', this.forms.site_name_actual)
   masukDRM.set('city', this.forms.city)
   masukDRM.set('address_actual', this.forms.address_actual)
   masukDRM.set('longitude_actual', this.forms.longitude_actual)
   masukDRM.set('latitude_actual', this.forms.latitude_actual)
   masukDRM.set('kom_date', this.kom_date.time)
   masukDRM.set('drm_date', this.drm_date.time)
   masukDRM.set('province', this.forms.province) ;
 }
 else
 { 
   masukDRM.set('id', 0)
   masukDRM.set('project_id', this.forms.id) 
   masukDRM.set('projectid', this.forms.projectid)
   masukDRM.set('site_id_actual', this.forms.site_id_actual)
   masukDRM.set('site_name_actual', this.forms.site_name_actual)
   masukDRM.set('city', this.forms.city)
   masukDRM.set('address_actual', this.forms.address_actual)
   masukDRM.set('longitude_actual', this.forms.longitude_actual)
   masukDRM.set('latitude_actual', this.forms.latitude_actual)
   masukDRM.set('kom_date', this.kom_date.time)
   masukDRM.set('drm_date', this.drm_date.time)
   masukDRM.set('province', this.forms.province) 
   masukDRM.set('document_kom', this.document_kom)
   masukDRM.set('document_drm', this.document_drm);
 }   


                axios.post('/karyawan/updateDRMByAdmin', masukDRM)
                    .then(response => { 
                      if(response.data.success)
                      {                  
                this.modal.set('editDRM', false);         
                 this.success(response.data.success);
                 this.isLoading = false;  
                 this.kom_date.time =  response.data.project.kom_date;
                 this.drm_date.time =  response.data.project.drm_date;  
             //    this.forms.set(response.data.project);
                 this.forms = response.data.project;
                      } 
                      else if(response.data.error)
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                      else
                      {
                        this.isLoading = false; 
                        this.error(response.data.error);
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                        this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
    this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
    this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
    this.isLoading = false; 
                    })

                    
  }
})
            },

          //edit sis
      rubahSIS(){
                this.errorNya = ''; 
                this.modal.set('editSIS', true); 
               
            }  ,  
    
 rubahDokumenSISsubmitData() {
      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
 if (result.value) {
    this.isLoading = true;
  let masuk = new FormData();
 if(this.forms.documentid)
 {
   masuk.set('id', this.forms.documentid)
   masuk.set('project_id', this.forms.id) 
   masuk.set('projectid', this.forms.projectid)
   masuk.set('document_sis_old', this.forms.document_sis) 
   masuk.set('document_sis', this.file_name);
 }
 else
 { 
   masuk.set('id', 0)
   masuk.set('project_id', this.forms.id) 
   masuk.set('projectid', this.forms.projectid)
   masuk.set('document_sis_old', this.forms.document_sis)
   masuk.set('document_sis', this.file_name);
 }


                axios.post('/karyawan/updateSISByAdmin', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                this.success(response.data.success);
                 this.isLoading = false;
                  this.modal.set('editSIS', false);
                 this.forms=response.data.project;

                      } 
                      else if(response.data.error)
                      {
                 this.error(response.data.error);
                 this.isLoading = false; 
                      }
                      else
                      {
                         this.modal.set('approve', false);
                          this.isLoading = false; 
                        this.errorNya = {document_sis:[response.data.error]};
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                        this.isLoading = false;
                        this.errorNya = {document_sis:[response.data.error]};
                    }
                   else if (error.response.status = 500) {
    this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
    this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
    this.isLoading = false; 
                    })
  }



})
            },


  //edit project           
      rubahProject(){
                this.errorNya = ''; 
                this.modal.set('editProject', true); 
               
            }  ,      
 rubahProjectsubmitData() {
      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
 if (result.value) {
    this.isLoading = true;

var masuk ={
 id:this.forms.id,
 projectid:this.forms.projectid,
 no_wo:this.forms.no_wo,
 wo_date:this.woDate.time,
 batch:this.forms.batch,
 years:this.forms.years,
 infratype:this.forms.infratype,
area:this.forms.area,
 regional:this.forms.regional,
 site_id_spk:this.forms.site_id_spk,
 site_name_spk:this.forms.site_name_spk,
 address_spk:this.forms.address_spk,
 longitude_spk:this.forms.longitude_spk,
 latitude_spk:this.forms.latitude_spk};

                axios.post('/karyawan/updateprojectByAdmin', masuk)
                    .then(response => { 
                 this.isLoading = false;
                 this.success(response.data.success);
                 this.backLink();
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                        this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
    this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
    this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                        
    this.isLoading = false;
                 this.backLink();
                    })
  }



})
            },
   perkalianTahun (value) {
       this.forms.harga_tahun = value*12;
      var tahunan = value*12;
      return accounting.formatMoney(tahunan,  "Rp. ", 0, ".", ",")
    }, 
        	getYears:function(start){
        		var stop = new Date().getFullYear()+1;
            return new Array(stop-start).fill(start).map((n,i)=>n+i);
        },
               dataAction () {
      if(this.typenya === "edit-project")
      {
                 if(this.rowDatanya.project.invoiceid)
                {
                 this.tgl_mulai_sewa.time = this.rowDatanya.project.tgl_mulai_sewa; 
                 this.tgl_target_rfi.time = this.rowDatanya.project.tgl_target_rfi; 
                 this.tgL_akhir_sewa.time = this.rowDatanya.project.tgL_akhir_sewa; 
                 this.tgl_invoice.time = this.rowDatanya.project.tgl_invoice; 

                }
                 if(this.rowDatanya.project.baksbaukid)
                {
                 this.date_baks.time = this.rowDatanya.project.date_baks; 

                }
                 if(this.rowDatanya.project.rfidetailid)
                {
                 this.rfi_detail_start_date.time = this.rowDatanya.project.rfi_detail_start_date;
                 this.rfi_detail_end_date.time = this.rowDatanya.project.rfi_detail_end_date;

                }
                 if(this.rowDatanya.project.documentdrmid)
                {
                    this.kom_date.time = this.rowDatanya.project.kom_date;
                    this.drm_date.time = this.rowDatanya.project.drm_date;
                }
                 if(this.rowDatanya.project.rfibautid)
                {
                    this.rfi_date.time = this.rowDatanya.project.rfi_date; 
                    this.baut_date.time = this.rowDatanya.project.baut_date; 
                }
                 if(this.rowDatanya.project.fenceyardid)
                {
                    this.fence_yard_date.time = this.rowDatanya.project.fence_yard_date; 
                }
                 if(this.rowDatanya.project.meprocessid)
                {
                    this.m_e_process_date.time = this.rowDatanya.project.m_e_process_date; 
                }
                 if(this.rowDatanya.project.curingid)
                {
                    this.curing_date.time = this.rowDatanya.project.curing_date; 
                }
                 if(this.rowDatanya.project.towererectionid)
                {
                    this.tower_erection_date.time = this.rowDatanya.project.tower_erection_date; 
                }
                 if(this.rowDatanya.project.documentrfcid)
                {
                    this.rfc_date.time = this.rowDatanya.project.rfc_date; 
                }
                 if(this.rowDatanya.project.poid)
                {
                    this.po_date.time = this.rowDatanya.project.po_date; 
                }
                 if(this.rowDatanya.project.siteopeningid)
                {
                    this.site_opening_date.time = this.rowDatanya.project.site_opening_date; 
                }
                 if(this.rowDatanya.project.excavationid)
                {
                    this.excavation_date.time = this.rowDatanya.project.excavation_date; 
                }
                 if(this.rowDatanya.project.rebaringid)
                {
                    this.rebaring_date.time = this.rowDatanya.project.rebaring_date; 
                }
                 if(this.rowDatanya.project.documentsitacid)
                {
                    this.date_ban_bak.time = this.rowDatanya.project.date_ban_bak;
                    this.ijin_warga_date.time = this.rowDatanya.project.ijin_warga_date;
                    this.pks_date.time = this.rowDatanya.project.pks_date;         
                    if(this.rowDatanya.project.imb_date === 'SELAMANYA')
           {
           this.datenyaIMB = true;
           }
           else
           {
          this.imb_date.time = this.rowDatanya.project.imb_date;  
           }
                }
          this.forms = this.rowDatanya.project; 
      }
      else
      {
      this.$router.push('/page-not-found');
      }
        
      },

     newAvatarDokRFCAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_rfc = files[0];
                
           },
     newAvatarDokRFC(event) {

this.isLoading = true;            
this.document_rfc = this.$refs.document_rfc.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.documentrfcid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('document_rfc_old', this.forms.document_rfc) 
   masuk.set('document_rfc', this.document_rfc) 
axios.post('/karyawan/uploaddokumenRFCByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.document_rfc = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.document_rfc = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_rfc)
{
    this.document_rfc = '';
  this.errorNya = {document_rfc:[response.data.document_rfc]}; 
}
if(response.data.errorfile)
                      {
    this.document_rfc = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_rfc = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.file_name = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_rfc = '';                
           },
     newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name = files[0];
                
           },
     newAvatarkom(event) { 
 this.isLoading = true;            
this.document_kom = this.$refs.document_kom.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.documentdrmid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('namafile', this.forms.document_kom)
   masuk.set('document_kom', this.document_kom) 
axios.post('/karyawan/uploaddokumenKOMByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.errorNya = '';
    this.success(response.data.success);
    this.forms.document_kom = response.data.namafilenya;
    this.document_kom = '';
}
if(response.data.document_kom)
{
    this.document_kom = '';
  this.errorNya = {document_kom:[response.data.document_kom]}; 
}
if(response.data.errorfile)
                      {
    this.document_kom = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_kom = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.document_pks = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_kom = '';              
           },
     newAvatarDRM(event) {
this.isLoading = true;            
this.document_drm = this.$refs.document_drm.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.documentdrmid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid)
   masuk.set('namafile', this.forms.document_drm)
   masuk.set('document_drm', this.document_drm) 
axios.post('/karyawan/uploaddokumenDRMByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.errorNya = '';
    this.success(response.data.success);
    this.forms.document_drm = response.data.namafilenya;
    this.document_drm = '';
}
if(response.data.document_drm)
{
    this.document_drm = '';
  this.errorNya = {document_drm:[response.data.document_drm]}; 
}
if(response.data.errorfile)
                      {
    this.document_drm = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_drm = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.document_pks = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_drm = '';    
           },
     newAvatarDRMAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_drm = files[0];
                
           },
     newAvatarkomAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_kom = files[0];
                
           },
     newAvatarDokBanBakAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_ban_bak = files[0];
                
           },
     newAvatarDokBanBak(event) {

this.isLoading = true;            
this.document_ban_bak = this.$refs.document_ban_bak.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.documentsitacid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('document_ban_bak_old', this.forms.document_ban_bak) 
   masuk.set('document_ban_bak', this.document_ban_bak) 
axios.post('/karyawan/uploaddokumenSITACByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.document_ban_bak = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.document_ban_bak = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_ban_bak)
{
    this.document_ban_bak = '';
  this.errorNya = {document_ban_bak:[response.data.document_ban_bak]}; 
}
if(response.data.errorfile)
                      {
    this.document_ban_bak = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_ban_bak = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.file_name = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_ban_bak = '';                
           },
     newAvatarIjinWargaAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_ijin_warga = files[0];
                
           },
           newAvatarIjinWarga() { 
 this.isLoading = true;            
this.document_ijin_warga = this.$refs.document_ijin_warga.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.documentsitacid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('document_ijin_warga_old', this.forms.document_ijin_warga) 
   masuk.set('document_ijin_warga', this.document_ijin_warga) 
axios.post('/karyawan/uploaddokumenSITACijinWargaByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.document_ijin_warga = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.document_ijin_warga = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_ijin_warga)
{
    this.document_ijin_warga = '';
  this.errorNya = {document_ijin_warga:[response.data.document_ijin_warga]}; 
}
if(response.data.errorfile)
                      {
    this.document_ijin_warga = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_ijin_warga = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.document_ijin_warga = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_ijin_warga = '';               
                
           },
     newAvatarPKSAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_pks = files[0];
                
           },
     newAvatarPKS() { 
 this.isLoading = true;            
this.document_pks = this.$refs.document_pks.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.documentsitacid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('document_pks_old', this.forms.document_pks) 
   masuk.set('document_pks', this.document_pks) 
axios.post('/karyawan/uploaddokumenSITACPKSByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.document_pks = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.document_pks = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_pks)
{
    this.document_pks = '';
  this.errorNya = {document_pks:[response.data.document_pks]}; 
}
if(response.data.errorfile)
                      {
    this.document_pks = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_pks = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.document_pks = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_pks = '';                
           },
     newAvatarIMBAdd(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.document_imb = files[0];
                
           },
            newAvatarIMB() { 
 this.isLoading = true;            
this.document_imb = this.$refs.document_imb.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.forms.documentsitacid)
   masuk.set('project_id', this.forms.id)
   masuk.set('projectid', this.forms.projectid) 
   masuk.set('document_imb_old', this.forms.document_imb) 
   masuk.set('document_imb', this.document_imb) 
axios.post('/karyawan/uploaddokumenSITACIMBByAdmin' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.forms.document_imb = response.data.namafilenya;
    this.forms.id = response.data.id;
    this.document_imb = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_imb)
{
    this.document_imb = '';
  this.errorNya = {document_imb:[response.data.document_imb]}; 
}
if(response.data.errorfile)
                      {
    this.document_imb = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_imb = '';
                 this.error(response.data.error);
                 this.isLoading = false; 
}
                    })
                    .catch(error => {
                    this.document_imb = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_imb = '';               
                
           },
  fetchIt(){
   this.isLoading = true;
                axios.get('/karyawan/CekUserProfileAkses/ProjectAdd').then((response) => {
                   if(response.data === true)
                   {
                   	this.isLoading = false;
                   }
                   else
                   {
                   	this.$router.push('/page-not-found');
                   }
                }).catch(error => {
				if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                       this.$router.push('/server-error');
                    }
                   else if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
					else
					{
                         this.$router.push('/page-not-found');
					}
					}
                    });
            },
            success(kata) {
      this.$swal({
  position: 'top-end',
  type: 'success',
  title: kata,
  showConfirmButton: false,
  timer: 1500
})
    },
            backLink() {
			    this.$router.push('/list-project');
            } ,
    allcap (e, o, prop) {
  const start = e.target.selectionStart;
    e.target.value = e.target.value.toUpperCase();
    this.$set(o, prop, e.target.value);
    e.target.setSelectionRange(start, start);
    },
    formatDate (value, fmt = 'DD-MM-YYYY HH:mm:ss') {
      return (value == null)
        ? ''
        : moment(value, 'DD-MM-YYYY HH:mm:ss').format(fmt)
    },       
      resetforms() {
         		this.errorNya='';
         		 this.woDate.time = '';
         		this.forms.reset();
                this.errors.clearAll();
        },
    submitData() {
    	this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {


var masuk ={
 projectid:this.forms.projectid,
 no_wo:this.forms.no_wo,
 wo_date:this.woDate.time,
 batch:this.forms.batch,
 years:this.forms.years,
 infratype:this.forms.infratype,
area:this.forms.area,
 regional:this.forms.regional,
 site_id_spk:this.forms.site_id_spk,
 site_name_spk:this.forms.site_name_spk,
 address_spk:this.forms.address_spk,
 status_id:1,
 project_status_id:0};

 if (result.value) {
                axios.post('/karyawan/listproject', masuk)
                    .then(response => {
                this.resetforms();
                 this.success(response.data.success);
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })
  }



})
            },
		
  },
   events: {

  },
  created: function() {
        },
		          mounted() {
            this.fetchIt();
            this.dataAction();

        }
}


</script>



<style>
.modal {
    display: none;
    height: 100%;
    left: 0;
    position: fixed;
    top: 0;
    width: 100%;
}
.modal.open {
   display: block;
}
.modal-backdrop {
z-index: -1;
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}
.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
.modal-content {
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
  opacity: 1;
  height: auto;
  min-height: 100%;
  border-radius: 0;
}
.modal-dialog {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}
.modal-container {
  width: 90%;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}
.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}
.modal-body {
  margin: 20px 0;
   max-height: calc(100vh - 210px);
    overflow-y: auto;
}
.modal-default-button {
  float: right;
}

.modal-enter {
  opacity: 0;
}
.modal-leave-active {
  opacity: 0;
}
.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>