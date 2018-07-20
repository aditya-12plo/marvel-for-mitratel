<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dr.MarveL (Dokumen Review MARketing Validation ELectronik)</title>

    <meta name="googlebot" content="index,follow,snippet,archive">
<meta property="og:locale" content="ID" />
<meta content="noindex,nofollow" name="robots"/>
<meta property="og:type" content="article" />
<meta name="keywords" content="mitratel,doktor marvel, marvel, mitratel marvel,dokumen review marketing validation electronik">
<meta name="description" content="Dr-MarveL (Dokumen Review MARketing Validation ELectronik)">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500italic,500,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

        <!-- Bootstrap -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <!-- FontAwesome -->
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <!-- MaterialCSS -->
        <link rel="stylesheet" href="/css/material.min.css">
        <!-- RipplesCSS -->
        <link rel="stylesheet" href="/css/ripples.min.css">
        
        <!-- ThemeCSS & Responsive CSS -->
        <link rel="stylesheet" href="/style.css">
        <link rel="stylesheet" href="/css/responsive.css">
        <link rel="stylesheet" href="/css/custom.css">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    </head>
    <body>
        
        <header class="header">
              <div data-velocity="-.4" id="particles" class="header-bg">
      



       <div class="center-div">
  
  <div id="login" class="login">
    <div class="login-icon-field">

    <h3 align="center" style="color:white;">LOGIN</h3>
    <br>
    <h1 align="center" style="color:white;">Dr. Marvel</h1>
<br>
         @if ($errors->has('password'))
         <span class="help-block">
 <strong style="color:white;">{{ $errors->first('password') }}</strong>
</span>
@endif 
<br>
     @if ($errors->has('email'))
<span class="help-block">
    <strong style="color:white;">{{ $errors->first('email') }}</strong>
</span>
@endif 
<br> 
    </div>

 <form role="form" method="POST" action="{{ route('karyawan.login') }}">
     {{ csrf_field() }}
    <div class="login-form">
      <div class="username-row row">
        <label for="username_input">
        <svg version="1.1" class="user-icon" x="0px" y="0px"
        viewBox="-255 347 100 100" xml:space="preserve" height="36px" width="30px">
          <path class="user-path" d="
          M-203.7,350.3c-6.8,0-12.4,6.2-12.4,13.8c0,4.5,2.4,8.6,5.4,11.1c0,0,2.2,1.6,1.9,3.7c-0.2,1.3-1.7,2.8-2.4,2.8c-0.7,0-6.2,0-6.2,0
          c-6.8,0-12.3,5.6-12.3,12.3v2.9v14.6c0,0.8,0.7,1.5,1.5,1.5h10.5h1h13.1h13.1h1h10.6c0.8,0,1.5-0.7,1.5-1.5v-14.6v-2.9
          c0-6.8-5.6-12.3-12.3-12.3c0,0-5.5,0-6.2,0c-0.8,0-2.3-1.6-2.4-2.8c-0.4-2.1,1.9-3.7,1.9-3.7c2.9-2.5,5.4-6.5,5.4-11.1
          C-191.3,356.5-196.9,350.3-203.7,350.3L-203.7,350.3z"/>
        </svg>
        </label>
 <input type="email" name="email" placeholder="E-mail" style="background-color : #d1d1d1;" required autofocus>
 
      </div>
      <div class="password-row row">
        <label for="password_input">
        <svg version="1.1" class="password-icon" x="0px" y="0px"
        viewBox="-255 347 100 100" height="36px" width="30px">
          <path class="key-path" d="M-191.5,347.8c-11.9,0-21.6,9.7-21.6,21.6c0,4,1.1,7.8,3.1,11.1l-26.5,26.2l-0.9,10h10.6l3.8-5.7l6.1-1.1
          l1.6-6.7l7.1-0.3l0.6-7.2l7.2-6.6c2.8,1.3,5.8,2,9.1,2c11.9,0,21.6-9.7,21.6-21.6C-169.9,357.4-179.6,347.8-191.5,347.8z"/>
        </svg>
        </label>
        <input type="password" name="password" style="background-color : #d1d1d1;" placeholder="Password" required>    
      </div>
    </div>
    <div class="call-to-action">
      <button id="login-button" type="submit">Log In</button>
      <p><h4><a href="/karyawan/password/reset" style="color:white;">Lupa Password? </a></h4></p>
    </div>
  </div>
</form>
</div> 




              </div>
        </header>
        
       
        
 

    </body>
</html>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="/js/vendor/jquery-1.11.2.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/material.min.js"></script>
        <script src="/js/ripples.min.js"></script>
        <script src="/js/jquery.scrolly.js"></script>
        <script src="/js/jquery.particleground.min.js"></script>
        <script src="/js/main.js"></script>
         <script src="/js/TweenMax.min.js"></script>
         <script src="/js/velocity.min.js"></script>
         <script src="/js/velocity.ui.min.js"></script>
   <script>
function slideUpIn() {
  $("#login").velocity("transition.slideUpIn", 1250)
};

function slideLeftIn() {
  $(".row").delay(500).velocity("transition.slideLeftIn", {stagger: 500})    
}

function shake() {
  $(".password-row").velocity("callout.shake");
}

slideUpIn();
slideLeftIn();


</script>    

