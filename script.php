<!-- build:js assets/vendor/js/core.js -->
<script src="assets/vendor/libs/jquery/jquery.js"></script>
<script src="assets/vendor/libs/popper/popper.js"></script>
<script src="assets/vendor/js/bootstrap.js"></script>
<script src="assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="assets/vendor/js/menu.js"></script>
<!-- endbuild -->
<!-- Vendors JS -->
<script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="assets/vendor/libs/swiper/swiper.js"></script>
<!-- Vedors JS -->
<script src="../../assets/vendor/libs/fullcalendar/fullcalendar.js"></script>
<script src="assets/vendor/libs/moment/moment.js"></script>
<script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="assets/vendor/libs/select2/select2.js"></script>
<script src="assets/vendor/libs/%40form-validation/popular.js"></script>
<script src="assets/vendor/libs/%40form-validation/bootstrap5.js"></script>
<script src="assets/vendor/libs/%40form-validation/auto-focus.js"></script>
<script src="assets/vendor/libs/cleavejs/cleave.js"></script>
<script src="assets/vendor/libs/cleavejs/cleave-phone.js"></script>
<!-- Vendors JS -->
<script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<!-- Main JS -->
<script src="assets/js/main.js"></script>
<!-- Page JS -->
<script src="assets/js/dashboards-crm.js"></script>
<script src="assets/js/extended-ui-sweetalert2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<!-- Page JS -->
<script src="assets/js/dashboards-analytics.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>

<script>
  $(document).ready(function() {
    $('#example').DataTable({
      "paging": true, // Aktifkan pagination
      "searching": true, // Aktifkan pencarian
      "ordering": true, // Aktifkan pengurutan
      "info": true, // Tampilkan informasi jumlah data
      "lengthChange": true, // Aktifkan pengubahan jumlah data per halaman
      "pageLength": 10, // Jumlah data per halaman
      "language": {
        "paginate": {
          "previous": "<",
          "next": ">"
        }
      }
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('#penjualan').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "data_penjualan.php", // Ganti dengan nama file server-side script Anda
        "type": "POST"
      },
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "lengthChange": true,
      "pageLength": 10,
      "language": {
        "paginate": {
          "previous": "<",
          "next": ">"
        }
      },
      "columns": [{
          "data": "No"
        },
        {
          "data": "Tanggal"
        },
        {
          "data": "Kode Spare Part"
        },
        {
          "data": "Nama Spare Part"
        },
        {
          "data": "Jumlah"
        },
        {
          "data": "Aksi",
          "orderable": false,
          "searchable": false,
          "defaultContent": "" // Tambahkan default content kosong
        }
      ]
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('#persediaan').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "data_persediaan.php", // Ganti dengan nama file server-side script Anda
        "type": "POST"
      },
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "lengthChange": true,
      "pageLength": 10,
      "language": {
        "paginate": {
          "previous": "<",
          "next": ">"
        }
      },
      "columns": [{
          "data": "No"
        },
        {
          "data": "Kode Barang"
        },
        {
          "data": "Nama Barang"
        },
        {
          "data": "Tipe"
        },
        {
          "data": "Aksi",
          "orderable": false,
          "searchable": false,
          "defaultContent": "" // Tambahkan default content kosong
        }
      ]

    });
  });
</script>

<script>
  $(document).ready(function() {
    $('#lokasi').DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
        "url": "data_lokasi.php", // Ganti dengan nama file server-side script Anda
        "type": "POST"
      },
      "paging": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "lengthChange": true,
      "pageLength": 10,
      "language": {
        "paginate": {
          "previous": "<",
          "next": ">"
        }
      },
      "columns": [{
          "data": "No"
        },
        {
          "data": "No Lokasi"
        },
        {
          "data": "Nama Lokasi"
        },
        {
          "data": "Kelurahan"
        },
        {
          "data": "Kecamatan"
        },
        {
          "data": "Kota"
        },
        {
          "data": "Alamat Jalan"
        },
        {
          "data": "Aksi",
          "orderable": false,
          "searchable": false,
          "defaultContent": "" // Tambahkan default content kosong
        }
      ]

    });
  });
</script>

<script>
  $(document).ready(function() {
    $('#lokasi_event').select2({
      placeholder: 'Pilih Lokasi Event',
      ajax: {
        url: 'cari_lokasi.php',
        type: 'GET',
        dataType: 'json',
        delay: 250,
        data: function(params) {
          return {
            search: params.term
          };
        },
        processResults: function(data) {
          return {
            results: data.map(function(item) {
              return {
                id: item.no_lokasi,
                text: item.nama_lokasi,
                data: item
              };
            })
          };
        }
      }
    });

    $('#lokasi_event').on('select2:select', function(e) {
      const data = e.params.data.data;

      $('#alamat_jalan').val(data.alamat_jalan);
      $('#kode_pos').val(data.kode_pos);
      $('#kelurahan').val(data.kelurahan);
      $('#kecamatan').val(data.kecamatan);
      $('#kota').val(data.kota);
      $('#propinsi').val(data.propinsi);
      $('#latitude').val(data.latitude);
      $('#longitude').val(data.longitude);
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
    const tglMulai = document.getElementById('tgl_mulai');
    const tglAkhir = document.getElementById('tgl_akhir');
    const durasi = document.getElementById('durasi');

    function hitungDurasi() {
      const mulai = new Date(tglMulai.value);
      const akhir = new Date(tglAkhir.value);

      if (tglMulai.value && tglAkhir.value && akhir >= mulai) {
        const selisih = Math.floor((akhir - mulai) / (1000 * 60 * 60 * 24)) + 1; // +1 agar termasuk hari pertama
        durasi.value = selisih;
      } else {
        durasi.value = "";
      }
    }

    tglMulai.addEventListener('change', hitungDurasi);
    tglAkhir.addEventListener('change', hitungDurasi);
  });

  $(document).ready(function() {
    $('#lokasi_event1').select2({
      placeholder: 'Pilih Lokasi Event',
      ajax: {
        url: 'cari_lokasi.php',
        type: 'GET',
        dataType: 'json',
        delay: 250,
        data: function(params) {
          return {
            search: params.term
          };
        },
        processResults: function(data) {
          return {
            results: data.map(function(item) {
              return {
                id: item.no_lokasi,
                text: item.nama_lokasi,
                data: item
              };
            })
          };
        }
      }
    });

    // SET default value untuk Select2 + isi field terkait
    const oldId = $('#old_no_lokasi').val();
    const oldText = $('#old_nama_lokasi').val();
    const oldData = JSON.parse($('#old_data_lokasi').val());

    if (oldId && oldText) {
      // Tambah opsi ke Select2 dan pilih
      const option = new Option(oldText, oldId, true, true);
      $('#lokasi_event1').append(option).trigger('change');

      // Isi field lainnya
      $('#alamat_jalan1').val(oldData.alamat_jalan);
      $('#kode_pos1').val(oldData.kode_pos);
      $('#kelurahan1').val(oldData.kelurahan);
      $('#kecamatan1').val(oldData.kecamatan);
      $('#kota1').val(oldData.kota);
      $('#propinsi1').val(oldData.propinsi);
      $('#latitude1').val(oldData.latitude);
      $('#longitude1').val(oldData.longitude);
    }

    // Jika user memilih lokasi baru
    $('#lokasi_event1').on('select2:select', function(e) {
      const data = e.params.data.data;

      $('#alamat_jalan1').val(data.alamat_jalan);
      $('#kode_pos1').val(data.kode_pos);
      $('#kelurahan1').val(data.kelurahan);
      $('#kecamatan1').val(data.kecamatan);
      $('#kota1').val(data.kota);
      $('#propinsi1').val(data.propinsi);
      $('#latitude1').val(data.latitude);
      $('#longitude1').val(data.longitude);
    });
  });
</script>
<script>
  let currentDate = new Date();
  let currentPage = 1;
  let totalPages = 1;

  function renderSchedule(monthOffset = 0, page = 1) {
    currentDate.setMonth(currentDate.getMonth() + monthOffset);
    currentPage = page;

    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const bulanNama = currentDate.toLocaleString("default", {
      month: "long"
    });

    document.getElementById("bulanTahun").textContent = `${bulanNama} ${year}`;

    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const tanggalList = [];
    for (let i = 1; i <= daysInMonth; i++) {
      const d = new Date(year, month, i);
      tanggalList.push(d.toISOString().split("T")[0]);
    }

    const awal = document.getElementById("periode_awal_event").value;
    const akhir = document.getElementById("periode_akhir_event").value;
    const dealer = document.getElementById("nm_dlr").value;
    const lokasi = document.getElementById("nama_lokasi").value;

    const params = new URLSearchParams({
      page,
      limit: 10,
      awal,
      akhir,
      dealer,
      lokasi
    });

    if (awal) params.append('awal', awal);
    if (akhir) params.append('akhir', akhir);
    if (dealer) params.append('dealer', dealer);
    if (lokasi) params.append('lokasi', lokasi);

    fetch(`get_events.php?${params.toString()}`)
      .then(response => response.json())
      .then(result => {
        const data = result.data;
        totalPages = result.total_pages;

        const thead = document.getElementById("thead-tanggal");
        const tbody = document.getElementById("tbody-jadwal");
        thead.innerHTML = "";
        tbody.innerHTML = "";

        let headerBulan = `<tr>
              <th rowspan="3">No</th>
              <th rowspan="3">No Pengajuan</th>
              <th rowspan="3">Tema Event</th>
              <th rowspan="3">Nama Dealer</th>
              <th rowspan="3">Lokasi</th>
              <th colspan="${tanggalList.length}" class="text-center">${bulanNama} ${year}</th>
            </tr>`;

        let headerTanggal = `<tr>`;
        tanggalList.forEach(t => {
          const date = new Date(t);
          headerTanggal += `<th>${date.getDate()}</th>`;
        });
        headerTanggal += `</tr>`;

        thead.innerHTML = headerBulan + headerTanggal;

        data.forEach((ev, index) => {
          const row = document.createElement("tr");
          row.innerHTML = `
                    <td>${(index + 1) + (currentPage - 1) * 10}</td>
                    <td>${ev.no_pengajuan ?? '-'}</td>
                    <td>${ev.tema_event ?? '-'}</td>
                    <td>${ev.nm_dlr ?? '-'}</td>
                    <td>${ev.nama_lokasi ?? '-'}</td>
                `;
          tanggalList.forEach(t => {
            const d = new Date(t);
            const start = new Date(ev.start);
            const end = new Date(ev.end);
            const warna = ev.color;

            row.innerHTML += (d >= start && d < end) ?
              `<td style="background-color: ${warna};"></td>` : `<td></td>`;
          });
          tbody.appendChild(row);
        });

        document.getElementById("pageInfo").textContent = `Halaman ${currentPage} dari ${totalPages}`;
        document.getElementById("prevPage").disabled = currentPage === 1;
        document.getElementById("nextPage").disabled = currentPage === totalPages;
      });
  }

  // Tangani filter submit
  document.getElementById("filterForm").addEventListener("submit", function(e) {
    e.preventDefault();
    renderSchedule(0, 1);
  });

  // Reset filter
  document.getElementById("resetFilter").addEventListener("click", function() {
    document.getElementById("filterForm").reset();
    renderSchedule(0, 1);
  });


  document.getElementById("prevMonth").addEventListener("click", () => renderSchedule(-1, 1));
  document.getElementById("nextMonth").addEventListener("click", () => renderSchedule(1, 1));

  document.getElementById("prevPage").addEventListener("click", () => {
    if (currentPage > 1) renderSchedule(0, currentPage - 1);
  });

  document.getElementById("nextPage").addEventListener("click", () => {
    if (currentPage < totalPages) renderSchedule(0, currentPage + 1);
  });

  document.addEventListener("DOMContentLoaded", () => renderSchedule(0, 1));
</script>

<script>
  document.getElementById('search-kendaraan').addEventListener('keyup', function() {
    var keyword = this.value.toLowerCase();
    var items = document.querySelectorAll('.kendaraan-item');

    items.forEach(function(item) {
      var label = item.textContent.toLowerCase();
      if (label.includes(keyword)) {
        item.style.display = '';
      } else {
        item.style.display = 'none';
      }
    });
  });
</script>


<script>
  document.getElementById('wilayah').addEventListener('change', function() {
    const noWil = this.value;
    const bulan = (new Date().getMonth() + 1).toString().padStart(2, '0');

    // Lakukan fetch ke PHP untuk ambil urutan terakhir berdasarkan wilayah dan bulan
    fetch(`get_last_lokasi.php?no_wil=${noWil}&bulan=${bulan}`)
      .then(response => response.json())
      .then(data => {
        const urut = (data.urutan + 1).toString().padStart(4, '0');
        const noLokasi = `Lok${noWil}${bulan}${urut}`;
        document.getElementById('no_lokasi').value = noLokasi;
      });
  });
</script>

<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      dom: '<"card-header flex-column flex-md-row"<"#tableTitle.card-title">><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      
    });
  });
</script>
<script>
  window.addEventListener('load', function() {
    const preloader = document.getElementById('preloader');
    const layoutWrapper = document.querySelector('.layout-wrapper');

    preloader.style.display = 'none';
    layoutWrapper.style.display = 'block';
  });

  document.addEventListener('DOMContentLoaded', function() {
    var logoutButton = document.getElementById('logoutButton');

    if (logoutButton) {
      logoutButton.addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
          title: "Are you sure?",
          text: "Do you really want to log out?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Yes, log out",
          cancelButtonText: "Cancel",
          customClass: {
            confirmButton: "btn btn-primary me-3 waves-effect waves-light",
            cancelButton: "btn btn-label-secondary waves-effect waves-light",
          },
          buttonsStyling: false,
        }).then(function(result) {
          if (result.isConfirmed) {
            // Redirect to the logout page
            window.location.href = 'logout.php'; // Ubah "logout.php" sesuai dengan halaman logout Anda
          }
        });
      });
    }
  });
</script>