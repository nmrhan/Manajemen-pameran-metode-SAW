<?php
function input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
session_start();
if (isset($_SESSION["username"])) {
  echo '<script type="text/javascript">"Anda sudah login"</script>';
  header('Location: index');
  exit;
} 
//Cek apakah ada kiriman form dari method post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include "koneksi.php";
  $username = input($_POST["username"]);
  $p = input($_POST["password"]); // hash the input password
  $hashed_password = md5($p);
  $sql = "SELECT * FROM users WHERE username='" . $username . "' AND password='" . $hashed_password . "' LIMIT 1";
  $hasil = mysqli_query($koneksi, $sql);
  $jumlah = mysqli_num_rows($hasil);
  if ($jumlah > 0) {
      $row = mysqli_fetch_assoc($hasil);
      $_SESSION["id"] = $row["id"];
      $_SESSION["username"] = $row["username"];
      $_SESSION["password"] = $row["password"];
      $_SESSION["name"] = $row["name"];
      $_SESSION["kd_dealer"] = $row["kd_dealer"];
      // Menentukan redirect URL berdasarkan level pengguna
      if ($_SESSION["kd_dealer"] == "MKT") {
        $redirectUrl = "index?page=marketing";
      }
       else {
        $redirectUrl = "index?page=dashboard";
      }
  
      echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                  title: 'Success!',
                  text: 'Login Berhasil!',
                  icon: 'success',
                  customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light',
                  },
                  buttonsStyling: false,
                }).then(function() {
                  window.location.href = '$redirectUrl';
                });
              });
            </script>";
    } else {
      // Akun tidak ditemukan di tabel "user" 
          echo  "<script>
          document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
              title: 'Gagal!',
              text: ' Username atau password salah!',
              icon: 'error',
              customClass: {
                confirmButton: 'btn btn-primary waves-effect waves-light',
              },
              buttonsStyling: false,
            }).then(function() {
              window.location.href = 'login';
            });
          });
        </script>";
    }
  }


?>
<!DOCTYPE html>


<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

  
<!-- Mirrored from demos.pixinvent.com/vuexy-html-admin-template/html/vertical-menu-template/auth-login-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Apr 2024 09:41:06 GMT -->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login</title>

    
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://1.envato.market/vuexy_admin">
    
    
    <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-5J3LMKC');</script>
    <!-- End Google Tag Manager -->
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/logo/logo_m.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="assets/vendor/fonts/tabler-icons.css"/>
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />
    
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" /> 
    <!-- Vendor -->
<link rel="stylesheet" href="assets/vendor/libs/%40form-validation/form-validation.css" />

    <!-- Page CSS -->
    <!-- Page -->
<link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css">
<link rel="stylesheet" href="assets/vendor/libs/sweetalert2/sweetalert2.css" />

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
    <style>
      .btn-primary1{
        background-color:#2667D0;
      }
    </style>

</head>

<body>

  
  <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  
  <!-- Content -->

<div class="authentication-wrapper authentication-cover authentication-bg">
  <div class="authentication-inner row" style="justify-content: center;">
    <!-- /Left Text -->
    <!-- <div class="d-none d-lg-flex col-lg-7 p-0">
      <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
        <img src="assets/img/illustrations/login_m.png" alt="auth-login-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/login_m.png" data-app-dark-img="illustrations/login_m.png">

     </div>
    </div>
    /Left Text -->

    <!-- Login -->
    <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4" style="box-shadow: 0px 0px 14px 4px #888888;">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-4">
          <a href="index-2.html" class="app-brand-link gap-2">
          <span class="rounded-horizontal">
        <img src="assets/img/logo/logo.png" style=" width: 15vh;" class=" rounded-horizontal">
</span> 
          </a>
        </div>
        <!-- /Logo -->
        <h3 class="mb-1">SISTEM INFORMASI MANAJEMEN PAMERAN</h3>
        <p class="mb-4"></p>

        <form class="mb-3" action="" method="post">
          <div class="mb-3">
            <label for="email" class="form-label">Username</label>
            <input type="text" class="form-control" id="email" name="username" placeholder="Enter your username" required>
          </div>
          <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password">Password</label>
            </div>
            <div class="input-group input-group-merge">
              <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
              <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
            </div>
          </div>
          <div class="mb-3">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="remember-me">
              <label class="form-check-label" for="remember-me">
                Remember Me
              </label>
            </div>
          </div>
          <button type="submit" id="login" name="login" value="login" class="btn btn-danger d-grid w-100">Login</button>
    
        </form>


    <!-- /Login -->
  </div>
</div>

<!-- / Content -->

  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  
  <script src="assets/vendor/libs/jquery/jquery.js"></script>
  <script src="assets/vendor/libs/popper/popper.js"></script>
  <script src="assets/vendor/js/bootstrap.js"></script>
  <script src="assets/vendor/libs/node-waves/node-waves.js"></script>
  <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="assets/vendor/libs/hammer/hammer.js"></script>
  <script src="assets/vendor/libs/i18n/i18n.js"></script>
  <script src="assets/vendor/libs/typeahead-js/typeahead.js"></script>
   <script src="assets/vendor/js/menu.js"></script>
  
  <!-- endbuild -->
  <script src="assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
  <script src="assets/js/extended-ui-sweetalert2.js"></script>
  <!-- Vendors JS -->
  <script src="assets/vendor/libs/%40form-validation/popular.js"></script>
<script src="assets/vendor/libs/%40form-validation/bootstrap5.js"></script>
<script src="assets/vendor/libs/%40form-validation/auto-focus.js"></script>

  <!-- Main JS -->
  <script src="assets/js/main.js"></script>
  

  <!-- Page JS -->
  <script src="assets/js/pages-auth.js"></script>
  
</body>


<!-- Mirrored from demos.pixinvent.com/vuexy-html-admin-template/html/vertical-menu-template/auth-login-cover.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Apr 2024 09:41:07 GMT -->
</html>

<!-- beautify ignore:end -->

