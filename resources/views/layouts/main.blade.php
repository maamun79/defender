
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Defender</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="/css/app.css">
</head>
<body>
  <div class="wrapper" id="app">
    <!--header-->
    <div id="headerTop">
      <div>
        <img src="/img/logo1.png" alt="" style="float:left; height:150px; width: 165px; margin-left: 25px;">
      </div>
      <div style="padding-top: 35px;">
        <h3 style="color:#fff600">Defender</h3>
        <h2><b>National Sex Offender Registry & Complaining System</b></h2>
      </div>
    </div>
    <!--/ .header-->
    <nav class="navbar navbar-expand-lg navbar-light" id="frontNav">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav" id="frontNavElement">
            <li class="nav-item">
              <router-link to="/" class="nav-link">
                 <strong> Home </strong>
              </router-link>
             </li>
             <li class="nav-item">
                <router-link to="/mostWanted" class="nav-link">
                    <strong>Most Wanted</strong>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/complainBox" class="nav-link">
                    <strong>Complain Box</strong>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/showAllMissingPerson" class="nav-link">
                    <strong>Missing Person</strong>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/safetyAndEdu" class="nav-link">
                    <strong>Safety & Education</strong>
                </router-link>
              </li>
          
        </ul>
      </div>
    </nav>

    <!-- /.navbar -->

  
    
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content" id="mainContent">
          <router-view></router-view>
      </div>
      <!-- /.content -->


    <!-- Main Footer -->
    <footer class="" id="footer-cust">
    <p class="text-center" style="border-bottom: 1px solid white">&copy; 2019 Defender<p>
      <div class="row">
        
        <div class="col-md-4 footer-box">
          <h5>Follow us</h5>
              <a href="#"><img src="/img/icon/facebook.png" alt="" class="icon-img"></a>
              <a href="#"><img src="/img/icon/twitter.png" alt="" class="icon-img"></a>
              <a href="#"><img src="/img/icon/youtube.png" alt="" class="icon-img"></a>
              <a href="#"><img src="/img/icon/instagram.png" alt="" class="icon-img"><a>
              <a href="#"><img src="/img/icon/google-plus.png" alt="" class="icon-img"></a>
          
        </div>
        <div class="col-md-4 footer-box">
          <a href="#">Privacy & policy</a><br>
          <a href="#">Legal Policies & Disclaimers</a><br>
          <a href="#">Conditions of Use</a><br>
          <a href="#">Registry Sites</a>
        </div>
        <div class="col-md-4 footer-box">
          <a href="#">Contact us</a>
        </div>
      </div>
      
    </footer>
  </div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src = "/js/app.js"></script>
</body>
</html>
