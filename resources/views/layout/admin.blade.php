<!-- ====== Admin Panel Master Layout ====== -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{URL::to('assets/img/logo2.png')}}" style="width:80px;height:80px;">

    <!-- change title depending upon opened page -->
    <title>@yield('title')</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- sweetslert dialog cdn -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- font awesome and bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
    
    <!-- Css file Links -->
    <link rel="stylesheet" href="{{URL::to('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/vendors/iconly/bold.css')}}">
   <!--  <link rel="stylesheet" href="{{URL::to('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}"> -->
    <link rel="stylesheet" href="{{URL::to('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}"> 
    <link rel="stylesheet" href="{{URL::to('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{URL::to('assets/css/acc_css.css')}}">

    <!-- jquery cdn link -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
   
</head>

<body >

<!-- Side Bar code -->
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <img src="{{URL::to('assets/img/logo2.jpg')}}"/>
                           <h2>NaviTalk</h2>
                           <h6>let the sightless perceive</h6>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                    
                @yield('menu')

                      
                <li class="sidebar-item login">
                            <button onclick="window.location='{{ URL::route('logout') }}'">
                                <i class="bi bi-box-arrow-in-left"></i>
                                Logout</button>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            
<!-- render dashboard content -->
  @yield('admincontent')

<!-- Footer code -->
  <footer >
                            <div class="footer clearfix mb-0 text-muted">
                                <div class="float-start">
                                    <p>2022 &copy; NaviTalk</p>
                                </div>
                                <div class="float-end">
                                    <p>Jinnah University for Women</p>
                                </div>
                            </div>
                        </footer>
 </div>
</div>

 <!-- js file links -->
<script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-database.js"></script>
<!-- <script src="{{URL::to('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script> -->
<script src="{{URL::to('assets/js-admin/bootstrap.bundle.min.js')}}"></script>
<script src="{{URL::to('assets/js-admin/main2.js')}}"></script>
<script src="{{URL::to('assets/js-admin/editCode/main.js')}}"></script>

<!-- Firebase connectivity -->
  <script id="MainScript">
  const firebaseConfig = {
    apiKey: "{{config('services.firebase.apiKey')}}",
    authDomain: "{{config('services.firebase.authDomain')}}",
    databaseURL: "{{config('services.firebase.databaseURL')}}",
    projectId: "{{config('services.firebase.projectId')}}",
    storageBucket: "{{config('services.firebase.storageBucket')}}",
    messagingSenderId: "{{config('services.firebase.messagingSenderId')}}",
    appId: "{{config('services.firebase.appId')}}",
    measurementId: "{{config('services.firebase.measurementId')}}"
  };

  firebase.initializeApp(firebaseConfig);

  @stack('script')

 </script>

</body>

</html>