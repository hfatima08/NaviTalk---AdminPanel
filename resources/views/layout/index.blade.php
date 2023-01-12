
<!-- ======= Admin Login Page Master Layout ======= -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>NaviTalk- Admin Login</title>

    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- css file link -->
    <link href="{{URL::to('assets/css/login.css')}}" rel="stylesheet">
</head>

<body>

<!-- logo and prjoect name in header -->
<header>
   <img src="{{URL::to('assets/img/logo.png')}}" width="70px" height="75px" class="image"/>
   <h4>NaviTalk</h4>
  <p class="slogan">let the sightless perceive</p>
</header>

<!-- render content -->
@yield("content");

<!-- an extra div to adjust the footer -->
<div class="extra">
</div>

  <!-- Footer -->
  <footer id="footer">
    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>NaviTalk</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
      <p style="font-family:Segoe UI Semibold">Jinnah University for Women <br> Department of Computer Science & Software Engineering</p>
      </div>
    </div>
  </footer>

  <!-- page loader -->
<div id="preloader"></div>

<!-- js file link -->
<script src="{{URL::to('assets/js-admin/main.js') }}"></script>

</body>
</html>