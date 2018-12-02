<!DOCTYPE html>
<html ng-app="main-App">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dr. Marvel (Document Review Marketting Validation Electronic)</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="author" content="@adit_xxx_">
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap core CSS     -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{asset('assets/css/animate.min.css')}}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{asset('assets/css/light-bootstrap-dashboard.css?v=1.4.0')}}" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('assets/css/pe-icon-7-stroke.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>
<body>

<div class="wrapper">
<div class="sidebar" data-color="red" data-image="/assets/img/sidebar-5.jpg">


      <div class="sidebar-wrapper">
            <ul class="nav">
                <li>
                    <a href="/karyawan">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
           <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i> user
                                    <b class="caret hidden-lg hidden-md"></b>
                  <p class="hidden-lg hidden-md">
                    5 Notifications
                    <b class="caret"></b>
                  </p>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                <li>
                     <a href="/karyawan">
                        <i class="pe-7s-note2"></i>
                        <p>Table List</p>
                    </a>
                </li>
                <li>
                     <a href="/karyawan">
                        <i class="pe-7s-news-paper"></i>
                        <p>Typography</p>
                    </a>
                </li>
                <li>
                     <a href="/karyawan">
                        <i class="pe-7s-science"></i>
                        <p>Icons</p>
                    </a>
                </li>
                <li>
                    <a href="/karyawan">
                        <i class="pe-7s-map-marker"></i>
                        <p>Maps</p>
                    </a>
                </li>
                <li>
                     <a href="/karyawan">
                        <i class="pe-7s-bell"></i>
                        <p>Notifications</p>
                    </a>
                </li>
        <li class="active-pro">
                     <a href="/karyawan">
                        <i class="pe-7s-rocket"></i>
                        <p>Dr. Marvel</p>
                    </a>
                </li>
            </ul>
      </div>
    </div>



  <!-- /.content -->
  <div class="main-panel">
     <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/karyawan">Dr. Marvel</a>
                </div>
                <div class="collapse navbar-collapse">
              </div>
              </div>
            </nav>
  <div class="content">
            <div class="container-fluid">
 <div class="row">



 <div id="appmarvel">
@yield('content-karyawan')
  </div>

  </div>
  </div>
  </div>
  </div>
  <!-- /.content -->

<footer class="footer">
            <div class="container-fluid">
               
                <p class="copyright pull-right">
                    &copy; 2018-<script>document.write(new Date().getFullYear())</script> <a href="http://www.mitratel.co.id/" target="_blank">PT Dayamitra Telekomunikasi</a>
                </p>
            </div>
        </footer>



</div>
<!-- ./wrapper -->







</body>

<script>
    window.Laravel =  <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
</script>
<script src="{{asset('js/app.js')}}"></script>

 <!--   Core JS Files   -->
    <script src="{{asset('assets/js/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
 

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
  <script src="{{asset('assets/js/light-bootstrap-dashboard.js?v=1.4.0')}}"></script>

  <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
  <script src="{{asset('assets/js/demo.js')}}"></script>


</html>
