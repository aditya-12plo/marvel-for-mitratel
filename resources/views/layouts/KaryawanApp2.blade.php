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
   <!-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> -->
  </head>
  <body data-col="2-columns" class=" 2-columns ">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper nav-collapsed menu-collapsed">


      <!-- main menu-->
      <!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->
      <div data-active-color="white" data-background-color="black" data-image="{{asset('app-assets/img/sidebar-bg/04.jpg')}}" class="app-sidebar">
        <!-- main menu header-->
        <!-- Sidebar Header starts-->
        <div class="sidebar-header">
          <div class="logo clearfix"><a href="/karyawan" class="logo-text float-left">
              <div class="logo-img">Dr</div> <span class="text align-middle">MARVEL</span></a><a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"><i data-toggle="expanded" class="ft-toggle-left toggle-icon"></i></a><a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-x"></i></a></div>
        </div>
        <!-- Sidebar Header Ends-->
        <!-- / main menu header-->
        <!-- main menu content-->
        <div class="sidebar-content">
          <div class="nav-container">
            <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">




<!-- MENU -->


<li class="nav-item"><a href="/karyawan"><i class="ft-home"></i><span data-i18n="" class="menu-title">Dashboard</span></a></li>


@if(Auth::guard('karyawan')->user()->level == 'REGIONAL' && Auth::guard('karyawan')->user()->posisi == 'AM SUPPORT')
<li class="has-sub nav-item"><a href="#"><i class="ft-paperclip"></i><span data-i18n="" class="menu-title">Dokumen SIS</span></a>
                <ul class="menu-content">
<li><a href="/karyawan#/documents-sis" class="menu-item">Input Dokumen SIS</a>
                  </li>
<li><a href="/karyawan#/repair-documents-sis" class="menu-item">Revisi Dokumen SIS</a>
                  </li>           

                </ul>
              </li>
<li class="nav-item"><a href="/karyawan#/user-access-for-regional-account-manager"><i class="ft-paperclip"></i><span data-i18n="" class="menu-title">Add Dokumen DRM</span></a></li>
<li class="nav-item"><a href="/karyawan#/user-access-for-regional-account-manager"><i class="ft-paperclip"></i><span data-i18n="" class="menu-title">Add Dokumen SITAC</span></a></li>
<li class="nav-item"><a href="/karyawan#/user-access-for-regional-account-manager"><i class="ft-paperclip"></i><span data-i18n="" class="menu-title">Add Dokumen RFC</span></a></li>
@endif


@if(Auth::guard('karyawan')->user()->level == 'REGIONAL' && Auth::guard('karyawan')->user()->posisi == 'ACCOUNT MANAGER')
<li class="has-sub nav-item"><a href="#"><i class="ft-paperclip"></i><span data-i18n="" class="menu-title">Dokumen SIS</span></a>
                <ul class="menu-content">
<li><a href="/karyawan#/documents-sis" class="menu-item">Input Dokumen SIS</a>
                  </li>
<li><a href="/karyawan#/repair-documents-sis" class="menu-item">Revisi Dokumen SIS</a>
                  </li>           

                </ul>
              </li>
<li class="nav-item"><a href="/karyawan#/user-access-for-regional-account-manager"><i class="icon-user-following"></i><span data-i18n="" class="menu-title">User Akses</span></a></li>
@endif

@if(Auth::guard('karyawan')->user()->level == 'REGIONAL' && Auth::guard('karyawan')->user()->posisi == 'MANAGER MARKETING')
<li class="nav-item"><a href="/karyawan#/approval-documents-sis"><i class="ft-paperclip"></i><span data-i18n="" class="menu-title">Approval Dokumen SIS</span></a></li>
<li class="nav-item"><a href="/karyawan#/user-access-for-regional"><i class="icon-user-following"></i><span data-i18n="" class="menu-title">User Akses</span></a></li>
@endif

@if(Auth::guard('karyawan')->user()->level == 'ADMINISTRATOR')
<li class="has-sub nav-item"><a href="#"><i class="ft-users"></i><span data-i18n="" class="menu-title">Root</span></a>
                <ul class="menu-content">
<li><a href="/karyawan#/user-access" class="menu-item">Akses User</a>
                  </li>
<li><a href="/karyawan#/list-project" class="menu-item">Project</a>
                  </li>           

                </ul>
              </li>
@endif



 <li class="nav-item"><a id="navbar-fullscreen" href="javascript:;" class="nav-link apptogglefullscreen"><i class="ft-maximize font-medium-3"></i><span data-i18n="" class="menu-title">Fullscreen</span> </a></li>
<li class="has-sub nav-item"><a href="#"><i class="ft-user"></i><span data-i18n="" class="menu-title">User</span></a>
                <ul class="menu-content">
<li><a href="/karyawan#/KProfile" class="menu-item">Profil</a>
                  </li>
<li><a onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="menu-item">Sign Out</a>
                  </li>
   <form id="logout-form" action="{{ route('karyawan.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>              

                </ul>
              </li>

<!-- MENU -->




            </ul>
          </div>
        </div>
        <!-- main menu content-->
        <div class="sidebar-background"></div>
        <!-- main menu footer-->
        <!-- include includes/menu-footer-->
        <!-- main menu footer-->
      </div>
      <!-- / main menu-->

<!-- Navbar (Header) Starts-->
      <nav class="navbar navbar-expand-lg navbar-light bg-faded">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
           
          </div>
</div>
      </nav>
      <!-- Navbar (Header) Ends-->


      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper"> 
 


 <div id="appmarvel">
@yield('content-karyawan')
  </div>




          </div>
        </div>

        <footer class="footer footer-static footer-light">
          <p class="clearfix text-muted text-sm-center px-2"><span>Copyright   &copy; 2018-<script>document.write(new Date().getFullYear())</script> <a href="http://www.mitratel.co.id/" target="_blank">PT Dayamitra Telekomunikasi</a></span></p>
        </footer>

      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->





    <!-- Theme customizer Starts-->
    <div class="customizer border-left-blue-grey border-left-lighten-4 d-none d-sm-none d-md-block"><a class="customizer-close"><i class="ft-x font-medium-3"></i></a><a id="customizer-toggle-icon" class="customizer-toggle bg-danger"><i class="ft-settings font-medium-4 fa fa-spin white align-middle"></i></a>
      <div data-ps-id="df6a5ce4-a175-9172-4402-dabd98fc9c0a" class="customizer-content p-3 ps-container ps-theme-dark">
        <h4 class="text-uppercase mb-0 text-bold-400">Theme Customizer</h4>
        <p>Customize & Preview in Real Time</p>
        <hr>
        <!-- Sidebar Options Starts-->
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Sidebar Color Options</h6>
        <div class="cz-bg-color">
          <div class="row p-1">
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="pomegranate" class="gradient-pomegranate d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="king-yna" class="gradient-king-yna d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="ibiza-sunset" class="gradient-ibiza-sunset d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="flickr" class="gradient-flickr d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="purple-bliss" class="gradient-purple-bliss d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="man-of-steel" class="gradient-man-of-steel d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="purple-love" class="gradient-purple-love d-block rounded-circle"></span></div>
          </div>
          <div class="row p-1">
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="black" class="bg-black d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="white" class="bg-grey d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="primary" class="bg-primary d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="success" class="bg-success d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="warning" class="bg-warning d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="info" class="bg-info d-block rounded-circle"></span></div>
            <div class="col"><span style="width:20px; height:20px;" data-bg-color="danger" class="bg-danger d-block rounded-circle"></span></div>
          </div>
        </div>
        <!-- Sidebar Options Ends-->
        <hr>
        <!-- Sidebar BG Image Starts-->
        <h6 class="text-center text-bold-500 mb-3 text-uppercase">Sidebar Bg Image</h6>
        <div class="cz-bg-image row">
          <div class="col mb-3"><img src="{{asset('app-assets/img/sidebar-bg/01.jpg')}}" width="90" class="rounded"></div>
          <div class="col mb-3"><img src="{{asset('app-assets/img/sidebar-bg/02.jpg')}}" width="90" class="rounded"></div>
          <div class="col mb-3"><img src="{{asset('app-assets/img/sidebar-bg/03.jpg')}}" width="90" class="rounded"></div>
          <div class="col mb-3"><img src="{{asset('app-assets/img/sidebar-bg/04.jpg')}}" width="90" class="rounded"></div>
          <div class="col mb-3"><img src="{{asset('app-assets/img/sidebar-bg/05.jpg')}}" width="90" class="rounded"></div>
          <div class="col mb-3"><img src="{{asset('app-assets/img/sidebar-bg/06.jpg')}}" width="90" class="rounded"></div>
        </div>
        <!-- Sidebar BG Image Ends-->
        <hr>
        <!-- Sidebar BG Image Toggle Starts-->
        <div class="togglebutton">
          <div class="switch"><span>Sidebar Bg Image</span>
            <div class="float-right">
              <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                <input id="sidebar-bg-img" type="checkbox" checked="" class="custom-control-input cz-bg-image-display">
                <label for="sidebar-bg-img" class="custom-control-label"></label>
              </div>
            </div>
          </div>
        </div>
        <!-- Sidebar BG Image Toggle Ends-->
        <hr>
        <!-- Compact Menu Starts-->
        <div class="togglebutton">
          <div class="switch"><span>Compact Menu</span>
            <div class="float-right">
              <div class="custom-control custom-checkbox mb-2 mr-sm-2 mb-sm-0">
                <input id="cz-compact-menu" type="checkbox" class="custom-control-input cz-compact-menu">
                <label for="cz-compact-menu" class="custom-control-label"></label>
              </div>
            </div>
          </div>
        </div>
        <!-- Compact Menu Ends-->
        <hr>
        <!-- Sidebar Width Starts-->
        <div>
          <label for="cz-sidebar-width">Sidebar Width</label>
          <select id="cz-sidebar-width" class="custom-select cz-sidebar-width float-right">
            <option value="small">Small</option>
            <option value="medium" selected="">Medium</option>
            <option value="large">Large</option>
          </select>
        </div>
        <!-- Sidebar Width Ends-->
      </div>
    </div>
    <!-- Theme customizer Ends-->




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