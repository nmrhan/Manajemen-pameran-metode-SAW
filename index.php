<?php
include "koneksi.php";
session_start();
$role = $_SESSION["kd_dealer"];
if (!isset($_SESSION["username"])) {
  echo '<script type="text/javascript">"Anda harus login dulu"</script>';
  header('Location: login');
  exit;
}
$bulan_indonesia = array(
  1 => 'Januari',
  2 => 'Februari',
  3 => 'Maret',
  4 => 'April',
  5 => 'Mei',
  6 => 'Juni',
  7 => 'Juli',
  8 => 'Agustus',
  9 => 'September',
  10 => 'Oktober',
  11 => 'November',
  12 => 'Desember'
);
$bulan_saat_ini = date('n'); // Menggunakan format 'n' untuk mendapatkan angka bulan tanpa leading zero
$nama_bulan_saat_ini = $bulan_indonesia[$bulan_saat_ini];
$user = $_SESSION["name"];
$id_login = $_SESSION["id"];
$role = $_SESSION["kd_dealer"];
$page = isset($_GET['page']) ? $_GET['page'] : '';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">


<!-- Mirrored from demos.pixinvent.com/vuexy-html-admin-template/html/vertical-menu-template/dashboards-crm.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Apr 2024 09:39:54 GMT -->

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>
    <?php echo ($page == 'prediksi') ? 'Data Prediksi Bulan ' . $nama_bulan_saat_ini . '' : 'Dashboard - SIMP | WAHANA'; ?>
  </title>
  <?php include('head.php') ?>
</head>

<body>
  <!-- <div id="preloader" class="body1">
    <div class="sec-loading1">
      <div class="one">
      </div>
    </div>
  </div> -->
  <!-- Preloader -->
  <!-- <div id="preloader" class="body1">
    <svg class="pl" viewBox="0 0 200 200" width="200" height="200" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <linearGradient id="pl-grad1" x1="1" y1="0.5" x2="0" y2="0.5">
          <stop offset="0%" stop-color="hsl(313,90%,55%)" />
          <stop offset="100%" stop-color="hsl(223,90%,55%)" />
        </linearGradient>
        <linearGradient id="pl-grad2" x1="0" y1="0" x2="0" y2="1">
          <stop offset="0%" stop-color="hsl(313,90%,55%)" />
          <stop offset="100%" stop-color="hsl(223,90%,55%)" />
        </linearGradient>
      </defs>
      <circle class="pl__ring" cx="100" cy="100" r="82" fill="none" stroke="url(#pl-grad1)" stroke-width="36" stroke-dasharray="0 257 1 257" stroke-dashoffset="0.01" stroke-linecap="round" transform="rotate(-90,100,100)" />
      <line class="pl__ball" stroke="url(#pl-grad2)" x1="100" y1="18" x2="100.01" y2="182" stroke-width="36" stroke-dasharray="1 165" stroke-linecap="round" />
    </svg>
  </div> -->

  <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <!-- End Google Tag Manager (noscript) -->

  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar  ">
    <div class="layout-container">
      <!-- Menu -->
      <?php include('sidebar.php'); ?>

      <div class="layout-page">

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">

          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="ti ti-menu-2 ti-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">



            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item navbar-search-wrapper mb-0">
                <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                  <!-- <i class="ti ti-search ti-md me-2"></i> -->
                  <span class="d-none d-md-inline-block text-warning">Welcome,
                    <?php echo $user; ?> !
                  </span>
                </a>
              </div>
            </div>
            <!-- /Search -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">


              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="assets/img/avatars/user.png" alt class="h-auto rounded-circle">
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="pages-account-settings-account.html">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="assets/img/avatars/user.png" alt class="h-auto rounded-circle">
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-medium d-block">
                            <?php echo $user; ?>
                          </span>
                          <small class="text-muted">
                            <?php echo $role; ?>
                          </small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>

                  <li>
                    <a class="dropdown-item" href="#" id="logoutButton">
                      <i class="ti ti-logout me-2 ti-sm"></i>
                      <span class="align-middle">Log Out</span>
                    </a>

                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>

        </nav>

        <!-- / Navbar -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <?php include('sidebar_content.php'); ?>

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl">
              <div class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column">
                <div>
                  ©
                  <script>
                    document.write(new Date().getFullYear())
                  </script>, PT WAHANA MAKMUR SEJATI <a href="" target="_blank" class="footer-link text-primary fw-medium"></a>
                </div>

              </div>
            </div>
          </footer>
          <!-- / Footer -->


          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

  </div>
  <!-- Core JS -->
  <?php include('script.php'); ?>

<!-- <style>
  .text-warning {
    --bs-text-opacity: 1;
    color: #7367f0 !important;
}
</style> -->

</body>

</html>