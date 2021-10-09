<?php
 $dashboard_link_active="";
 $login_link_active="";
 $register_link_active="";

switch (Route::currentRouteName()) {
  case 'dashboard':
    $dashboard_link_active="active";
    break;
  case 'login': 
    $login_link_active="active";
    break;
  case 'register':
    $register_link_active="active";
    break;
  
  
}
 if(Route::currentRouteName() == 'home')
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
  <title>@yield('page-title') - Check Weather</title>
  
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- Bootstrap core CSS -->
  <link href="{{ URL::to('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- sweetalert plugin  -->
  <link href="{{ URL::to('vendor/sweetalert/sweetalert.css') }}" rel="stylesheet"> 
    
  <!-- Font Awsome styles -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  
  <!-- Custom styles -->
  <link href="{{ URL::to('assets/css/main.css') }}" rel="stylesheet">


</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('dashboard') }}">Achievements & Badges - Laravel App</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          @auth
          <li class="nav-item  {{$dashboard_link_active}}">
            <a class="nav-link" href="{{ route('dashboard') }}">
              Dashboard
            </a>
          </li>

          <li class="nav-item dropdown {{$login_link_active}}">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{auth()->user()->name}}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}" >
                  Logout
              </a>
            </div>
          </li>
          @else
          <li class="nav-item {{$login_link_active}}">
            <a class="nav-link" href="{{ route('login') }}">
            Login
          </a>
          </li>
          <li class="nav-item {{$register_link_active}}">
            <a class="nav-link" href="{{ route('register') }}">
            Register
            </a>
          </li>
          @endif
          
        </ul>
      </div>
    </div>
  </nav>

  @yield('page-content')



  <!-- Bootstrap core JavaScript -->
  <script src="{{ URL::to('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ URL::to('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Loading Overlay plugin -->
  <script src="{{ URL::to('vendor/jquery.loadingoverlay/loadingoverlay.min.js') }}"></script>
  <script src="{{ URL::to('vendor/jquery.loadingoverlay/loadingoverlay_progress.min.js') }}"></script>
  <!-- sweetalert plugin -->
  <script src="{{ URL::to('vendor/sweetalert/sweetalert.min.js') }}"></script>
  <!-- Parsely form validation plugin -->
  <script src="{{ URL::to('assets/js/parsley.min.js') }}"></script>
    
  <!-- Page specific Javascript -->
 
  @yield('page-scripts')

</body>

</html>


