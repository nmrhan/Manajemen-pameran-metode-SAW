<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="    background-color:rgb(252, 232, 216) !important;
">


  <div class="app-brand demo mb-3 mt-2  border-bottom">
    <a href="index?page=dashboard" class="app-brand-link">
      <span class="rounded-circle app-brand-logo">
        <img src="assets/img/logo/logo.png" style=" width: 10vh;" class=" rounded-circle">
      </span>
      <span class="app-brand-text demo menu-text fw-bold">SIMP</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>


  <ul class="menu-inner py-1">
    <?php if ($role == 'MKT') { ?>

      <li class="menu-item <?php echo ($page == 'marketing') ? 'active' : ''; ?>">
        <a href="?page=marketing" class="menu-link">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n="Dashboard">Dashboard</div>
        </a>
      </li>
      <li class="menu-item <?php echo ($page == 'users') ? 'active' : ''; ?>">
        <a href="?page=users" class="menu-link">
          <i class="menu-icon tf-icons ti ti-users"></i>
          <div data-i18n="Users">Users</div>
        </a>
      </li>
      <li class="menu-item <?php echo ($page == 'lokasi') ? 'active' : ''; ?>">
        <a href="?page=lokasi" class="menu-link">
          <i class="menu-icon tf-icons ti ti-map-pin"></i>
          <div data-i18n="Lokasi">Lokasi</div>
        </a>
      </li>
      <li class="menu-item <?php echo ($page == 'lokasi_strategis') ? 'active' : ''; ?>">
        <a href="?page=lokasi_strategis" class="menu-link">
          <i class="menu-icon tf-icons ti ti-package"></i>
          <div data-i18n="lokasi_strategis">Penilaian Lokasi</div>
        </a>
      </li>
      <li class="menu-item <?php echo ($page == 'proposal' || $page == 'updatestatus' || $page == 'realisasievent' || $page == 'kalenderevent' ) ? 'active open' : ''; ?>">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-files"></i>
          <div data-i18n="Dashboards">Pameran</div>

        </a>
        <ul class="menu-sub">
        <li class="menu-item <?php echo ($page == 'proposal' || $page == 'updatestatus') ? 'active' : ''; ?>">
        <a href="?page=proposal" class="menu-link">
          <i class="menu-icon tf-icons ti ti-files"></i>
          <div data-i18n="Data Master">Pengajuan Proposal</div>
        </a>
      </li>
      <li class="menu-item <?php echo ($page == 'realisasievent') ? 'active' : ''; ?>">
        <a href="?page=realisasievent" class="menu-link">
          <i class="menu-icon tf-icons ti ti-check  "></i>
          <div data-i18n="Data Master">Realisasi Event</div>
        </a>
      </li>
      <li class="menu-item <?php echo ($page == 'kalenderevent') ? 'active' : ''; ?>">
        <a href="?page=kalenderevent" class="menu-link">
          <i class="menu-icon tf-icons ti ti-calendar  "></i>
          <div data-i18n="Data Master">Kalender Event</div>
        </a>
      </li>
        </ul>
      </li>
   
      

      <li class="menu-item <?php echo ($page == 'laporan') ? 'active' : ''; ?>">
        <a href="?page=laporan" class="menu-link">
          <i class="menu-icon tf-icons ti ti-checklist"></i>
          <div data-i18n="Laporan Persetujuan">Monitoring LPJ</div>
        </a>
      </li>
      <!-- <li class="menu-item <?php echo ($page == 'report') ? 'active' : ''; ?>">
      <a href="?page=report" class="menu-link">
        <i class="menu-icon tf-icons ti ti-report"></i>
        <div data-i18n="Report">Report</div>
      </a>
    </li> -->
    <?php } else { ?>

      <li class="menu-item <?php echo ($page == 'dashboard') ? 'active' : ''; ?>">
        <a href="?page=dashboard" class="menu-link">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n="Dashboard">Dashboard</div>
        </a>
      </li>
      <li class="menu-item <?php echo ($page == 'lokasi' || $page== 'updatelokasi') ? 'active' : ''; ?>">
        <a href="?page=lokasi" class="menu-link">
          <i class="menu-icon tf-icons ti ti-map-pin"></i>
          <div data-i18n="Lokasi">Lokasi</div>
        </a>
      <li class="menu-item <?php echo ($page == 'lokasi_strategis') ? 'active' : ''; ?>">
        <a href="?page=lokasi_strategis" class="menu-link">
          <i class="menu-icon tf-icons ti ti-package"></i>
          <div data-i18n="lokasi_strategis">Penilaian Lokasi</div>
        </a>
      </li>
      <li class="menu-item <?php echo ($page == 'proposal' || $page == 'updatestatus' || $page == 'realisasievent' || $page == 'kalenderevent' ) ? 'active open' : ''; ?>">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-files"></i>
          <div data-i18n="Dashboards">Pameran</div>

        </a>
        <ul class="menu-sub">
          <li class="menu-item <?php echo ($page == 'proposal' || $page == 'pengajuanproposal' || $page == 'updateproposal') ? 'active' : ''; ?>">
            <a href="?page=proposal" class="menu-link">
              <i class="menu-icon tf-icons ti ti-files"></i>
              <div data-i18n="Data Master">Pengajuan Proposal</div>
            </a>
          </li>
          <li class="menu-item <?php echo ($page == 'realisasievent' || $page == 'realisasiupdate') ? 'active' : ''; ?>">
            <a href="?page=realisasievent" class="menu-link">
              <i class="menu-icon tf-icons ti ti-check  "></i>
              <div data-i18n="Data Master">Realisasi Event</div>
            </a>
          </li>
          <li class="menu-item <?php echo ($page == 'kalenderevent') ? 'active' : ''; ?>">
            <a href="?page=kalenderevent" class="menu-link">
              <i class="menu-icon tf-icons ti ti-calendar  "></i>
              <div data-i18n="Data Master">Kalender Event</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item <?php echo ($page == 'laporan') ? 'active' : ''; ?>">
        <a href="?page=laporan" class="menu-link">
          <i class="menu-icon tf-icons ti ti-checklist"></i>
          <div data-i18n="Laporan Persetujuan">Monitoring LPJ</div>
        </a>
      </li>

    <?php } ?>
  </ul>




</aside>
<!-- / Menu -->