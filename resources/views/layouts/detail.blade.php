<!DOCTYPE html>
<html lang="en" class="loading">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="author" content="@adit_xxx_">
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dr.MarveL (Dokumen Review MARketing Validation ELectronik)</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/feather/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/perfect-scrollbar.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/prism.min.css')}}"> 
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/app.css')}}"> 
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/custom.css')}}">   
      
    <link href="{{ asset('app-assets/css/vue2-autocomplete.css') }}" rel="stylesheet">
    
    <!-- <link rel="stylesheet" href="{{asset('css/app.css')}}">--> 
  </head>
  <body data-col="2-columns" class=" 2-columns ">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper nav-collapsed menu-collapsed">
 
 

      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper"> 
 

   
<br>

 <div id="appmarvel">
  <router-view></router-view>
  </div>




          </div>
        </div>

        <footer class="footer footer-static footer-light">
          <p class="clearfix text-muted text-sm-center px-2"><span>Copyright   &copy; 2018-<script>document.write(new Date().getFullYear())</script> <a href="http://www.mitratel.co.id/" target="_blank">PT Dayamitra Telekomunikasi</a></span></p>
        </footer>

      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

 




    <!-- BEGIN VENDOR JS-->

    <script>
    window.Laravel =  <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
</script>
<script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/core/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/core/popper.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/prism.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/jquery.matchHeight-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/screenfull.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/js/pace/pace.min.js')}}" type="text/javascript"></script> 
    
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN APEX JS-->
    <script src="{{asset('app-assets/js/app-sidebar.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/notification-sidebar.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/customizer.js')}}" type="text/javascript"></script>
    <!-- END APEX JS-->
  <script src="{{asset('app-assets/js/components-modal.min.js')}}" type="text/javascript"></script>
   
  </body>
</html>