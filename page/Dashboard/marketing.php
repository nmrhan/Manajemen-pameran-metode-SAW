<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
  <!-- Total Profit -->
  <div class="col-xl-3 col-md-4 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="badge p-2 bg-label-info mb-2 rounded"><i class="ti ti-users ti-md"></i></div>
          <h5 class="card-title mb-1 pt-2">Total Users</h5>
          <small class="text-muted">Today</small>
          <?php
          $jumlah_user = mysqli_query($koneksi, "SELECT * FROM users ");
          $total_user = mysqli_num_rows($jumlah_user);
          ?>
          <p class="mb-2 mt-1"><?php echo $total_user; ?></p>
          <div class="pt-1">
            <span class="badge bg-label-secondary">user</span>
          </div>
        </div>
      </div>
    </div>
    <!-- Total Profit -->
    <div class="col-xl-3 col-md-4 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="badge p-2 bg-label-danger mb-2 rounded"><i class="ti ti-package ti-md"></i></div>
          <h5 class="card-title mb-1 pt-2">Total Kendaraan</h5>
          <small class="text-muted">Today</small>
          <?php
          $jumlah_persediaan = mysqli_query($koneksi, "SELECT * FROM persediaan ");
          $total_persediaan = mysqli_num_rows($jumlah_persediaan);
          ?>
          <p class="mb-2 mt-1"><?php echo $total_persediaan; ?></p>
          <div class="pt-1">
            <span class="badge bg-label-secondary">Kendaraan</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Total Sales -->
    <div class="col-xl-3 col-md-4 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="badge p-2 bg-label-info mb-2 rounded"><i class="ti ti-file-invoice ti-md"></i></div>
          <h5 class="card-title mb-1 pt-2">Total Penjualan</h5>
          <small class="text-muted">Today</small>
          <?php
          $jumlah_penjualan = mysqli_query($koneksi, "SELECT * FROM penjualan ");
          $total_penjualan = mysqli_num_rows($jumlah_penjualan);
          ?>
          <p class="mb-2 mt-1"><?php echo $total_penjualan; ?></p>
          <div class="pt-1">
            <span class="badge bg-label-secondary">Transaksi</span>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-4 col-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="badge p-2 bg-label-warning mb-2 rounded"><i class="ti ti-checklist ti-md"></i></div>
          <h5 class="card-title mb-1 pt-2">Pengajuan Pameran </h5>
          <small class="text-muted">Today</small>
          <?php
          $jumlah_laporan = mysqli_query($koneksi, "SELECT * FROM proposal_pengajuans  ");
          $total_laporan = mysqli_num_rows($jumlah_laporan);
          ?>
          <p class="mb-2 mt-1"><?php echo $total_laporan; ?></p>
          <div class="pt-1">
            <span class="badge bg-label-secondary">Pengajuan</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Revenue Growth
    <div class="col-xl-4 col-md-8 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div class="d-flex flex-column">
              <div class="card-title mb-auto">
                <h5 class="mb-1 text-nowrap">Revenue Growth</h5>
                <small>Weekly Report</small>
              </div>
              <div class="chart-statistics">
                <h3 class="card-title mb-1">$4,673</h3>
                <span class="badge bg-label-success">+15.2%</span>
              </div>
            </div>
            <div id="revenueGrowth"></div>
          </div>
        </div>
      </div>
    </div> -->




  </div>

</div>
<!-- / Content -->