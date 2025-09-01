<?php

$kd_dealer = $_SESSION["kd_dealer"]; // dari session
$tahun = date("Y");
$bulan = date("m");

// Ambil nomor urut terakhir
$query = "SELECT RIGHT(no_pengajuan, 4) AS nomor 
          FROM proposal_pengajuans 
          WHERE no_pengajuan LIKE 'PMR" . $kd_dealer . $tahun . $bulan . "%' 
          ORDER BY no_pengajuan DESC 
          LIMIT 1";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

$no_urut = 1;
if ($data && isset($data['nomor'])) {
    $no_urut = (int)$data['nomor'] + 1;
}
$no_urut_format = str_pad($no_urut, 4, '0', STR_PAD_LEFT);

// Buat kode pengajuan
$no_pengajuan = "PMR" . $kd_dealer . $tahun . $bulan . $no_urut_format;

if (isset($_POST['tambah'])) {
    $no_pengajuan = $_POST['no_pengajuan'];
    $no_dlr = $kd_dealer; // dari session atau variabel sebelumnya
    $tgl_pengajuan = date('Y-m-d'); // tanggal hari ini
    $realisasi = 1;
    $tema_event = $_POST['tema_event'];
    $periode_awal_event = $_POST['periode_awal_event'];
    $periode_akhir_event = $_POST['periode_akhir_event'];
    $durasi = $_POST['durasi'];
    $biaya_pameran = $_POST['biaya_pameran'];
    $target_penjualan = $_POST['target_pernjualan'];
    $target_peserta_ridingtest = $_POST['target_peserta_ridingtest'];
    $target_pengunjung = $_POST['terget_pengunjung'];
    $pic_event = $_POST['pic_event'];
    $no_hppic = $_POST['no_hppic'];
    $jml_hot_prospek = $_POST['jumlah_hot_prospek'];
    $no_lokasi = $_POST['no_lokasi'];
    $unit_entry = $_POST['unit_entry'];
    $target_jumlah_pit = $_POST['target_jumlah_pit'];
    $target_jumlah_mechanic = $_POST['target_jumlah_mechanic'];
    $nama_sales = $_POST['nama_sales'];

    // Query INSERT
    $query = "INSERT INTO proposal_pengajuans (
        no_pengajuan, no_dlr, tgl_pengajuan, tema_event, periode_awal_event, 
        periode_akhir_event, durasi, biaya_pameran, target_penjualan, 
        target_peserta_ridingtest, target_pengunjung, pic_event, no_hppic, nama_sales, 
        jml_hot_prospek, no_lokasi, unit_entry, target_jumlah_pit, target_jumlah_mechanic, realisasi
    ) VALUES (
        '$no_pengajuan', '$no_dlr', '$tgl_pengajuan', '$tema_event', '$periode_awal_event', 
        '$periode_akhir_event', '$durasi', '$biaya_pameran', '$target_penjualan', 
        '$target_peserta_ridingtest', '$target_pengunjung', '$pic_event', '$no_hppic', '$nama_sales',
        '$jml_hot_prospek', '$no_lokasi', '$unit_entry', '$target_jumlah_pit', '$target_jumlah_mechanic', '$realisasi'
    )";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Tambahkan data motor display (jika ada)
        if (!empty($_POST['pilihan_kendaraan'])) {
            foreach ($_POST['pilihan_kendaraan'] as $kode_motor) {
                $query_motor_display = "INSERT INTO motor_display (pengajuan_no, kode_barang) VALUES ('$no_pengajuan', '$kode_motor')";
                mysqli_query($koneksi, $query_motor_display);
            }
        }
    
        echo "<script>alert('Data berhasil ditambahkan'); window.location.href='?page=proposal';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data: " . mysqli_error($koneksi) . "');</script>";
    }
    
}

$periode_sma = 3;
$bulan_ini = date('n');
$tahun_ini = date('Y');

// Hitung 3 bulan terakhir
$bulan_tahun_terakhir = [];
for ($i = $periode_sma; $i > 0; $i--) {
    $waktu = strtotime("-$i month");
    $bulan_tahun_terakhir[] = [
        'bulan' => (int)date('n', $waktu),
        'tahun' => (int)date('Y', $waktu),
    ];
}

// Ambil data penjualan
$query = "SELECT kode_barang, MONTH(tanggal) AS bulan, YEAR(tanggal) AS tahun, SUM(jumlah) AS total_jumlah 
          FROM penjualan 
          WHERE tanggal >= DATE_SUB(DATE_FORMAT(CURDATE(), '%Y-%m-01'), INTERVAL $periode_sma MONTH)
          GROUP BY kode_barang, YEAR(tanggal), MONTH(tanggal)
          ORDER BY kode_barang, tahun, bulan";
$result = $koneksi->query($query);

// Kumpulkan data penjualan
$data_mentah = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kode = $row['kode_barang'];
        $bulan = (int)$row['bulan'];
        $tahun = (int)$row['tahun'];
        $jumlah = (int)$row['total_jumlah'];
        $data_mentah[$kode]["$tahun-$bulan"] = $jumlah;
    }
}

// Hitung SMA
$hasil_prediksi = [];
foreach ($data_mentah as $kode_barang => $data_bulan) {
    $jumlah_akhir = [];
    foreach ($bulan_tahun_terakhir as $bt) {
        $key = "{$bt['tahun']}-{$bt['bulan']}";
        $jumlah_akhir[] = $data_bulan[$key] ?? 0;
    }
    $sma = round(array_sum($jumlah_akhir) / $periode_sma);
    $hasil_prediksi[$kode_barang] = $sma;
}

// Urutkan hasil prediksi dari tinggi ke rendah
arsort($hasil_prediksi);

// Ambil semua data persediaan
$query_persediaan = "SELECT kode_barang, nama_barang, tipe FROM persediaan";
$result_persediaan = $koneksi->query($query_persediaan);

$data_prediksi = [];
$data_tanpa_prediksi = [];

if ($result_persediaan->num_rows > 0) {
    while ($row = $result_persediaan->fetch_assoc()) {
        $kode = $row['kode_barang'];
        if (isset($hasil_prediksi[$kode])) {
            $row['prediksi'] = $hasil_prediksi[$kode];
            $data_prediksi[] = $row;
        } else {
            $row['prediksi'] = 0;
            $data_tanpa_prediksi[] = $row;
        }
    }
}

// Data final: gabungkan hasil prediksi dan non-prediksi
$data_final = $data_prediksi; // Sudah terurut karena hasil_prediksi sudah di-sort pakai arsort
usort($data_prediksi, function ($a, $b) {
    return $b['prediksi'] <=> $a['prediksi'];
});
$data_final = array_merge($data_prediksi, $data_tanpa_prediksi);

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="modal-title" id="exampleModalLabel1">Pengajuan Proposal</h5>
                </div>
                <form method="post" action="#">
                    <div class="card-body row">
                        <div class="col-md-6">
                            <div class="row ">
                                <div class="col mb-3">
                                    <label for="No. Pengajuan" class="form-label">No. Pengajuan:</label>
                                    <input type="text" class="form-control" name="no_pengajuan_display" value="<?= $no_pengajuan ?>" disabled>
                                    <input type="hidden" name="no_pengajuan" value="<?= $no_pengajuan ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Tgl Pengajuan" class="form-label">Tgl Pengajuan:</label>
                                    <input type="date" class="form-control" name="tgl_pengajuan" value="<?php echo date('Y-m-d') ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Tema Event" class="form-label">Tema Event:</label>
                                    <input type="text" class="form-control" placeholder="tema event" name="tema_event" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-1">
                                    <label for="Tema Event" class="form-label"><b>Periode Event:</b></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label">Tgl. Mulai Event:</label>
                                    <input type="datetime-local" class="form-control" name="periode_awal_event" id="tgl_mulai" required>
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label">Tgl. Akhir Event:</label>
                                    <input type="datetime-local" class="form-control" name="periode_akhir_event" id="tgl_akhir" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label">Durasi:</label>
                                    <input type="text" class="form-control" placeholder="Hari" id="durasi" name="durasi" readonly>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col mb-3">
                                    <label for="lokasi_event" class="form-label">Lokasi Event:</label>
                                    <select class="form-control" id="lokasi_event" name="no_lokasi" required></select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Tgl Pengajuan" class="form-label">Alamat Jalan:</label>
                                    <textarea class="form-control" id="alamat_jalan" name="alamat_jalan" disabled></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Tema Event" class="form-label">Kode Pos:</label>
                                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Tema Event" class="form-label">Kelurahan:</label>
                                    <input type="text" id="kelurahan" name="kelurahan" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Tema Event" class="form-label">Kecamatan:</label>
                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Tema Event" class="form-label">Kabupaten/Kota:</label>
                                    <input type="text" id="kota" name="kota" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Durasi" class="form-label">Provinsi:</label>
                                    <input type="text" id="propinsi" name="propinsi" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Tgl Pengajuan" class="form-label">Latitude:</label>
                                    <input type="text" id="latitude" name="latitude" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Tgl Pengajuan" class="form-label">Longatitude:</label>
                                    <input type="text" id="longitude" name="longitude" class="form-control" disabled>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Tgl Pengajuan" class="form-label">Target Unit Entry:</label>
                                    <input type="number" class="form-control" placeholder="" name="unit_entry" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Tgl Pengajuan" class="form-label">Target Jumlah Pit:</label>
                                    <input type="number" class="form-control" placeholder="" name="target_jumlah_pit" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Tgl Pengajuan" class="form-label">Target Jumlah Mechanic:</label>
                                    <input type="number" class="form-control" placeholder="" name="target_jumlah_mechanic" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Durasi" class="form-label">Biaya Pameran:</label>
                                    <input type="number" class="form-control" placeholder="" name="biaya_pameran" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Durasi" class="form-label">Target Penjualan Pameran:</label>
                                    <input type="number" class="form-control" placeholder="" name="target_pernjualan" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Durasi" class="form-label">Target Peserta Riding Test:</label>
                                    <input type="number" class="form-control" placeholder="" name="target_peserta_ridingtest" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Durasi" class="form-label">Target Pengunjung:</label>
                                    <input type="number" class="form-control" placeholder="" name="terget_pengunjung" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Durasi" class="form-label">Target Hot Prospect:</label>
                                    <input type="number" class="form-control" placeholder="5" name="jumlah_hot_prospek" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label class="form-label">PIC Event:</label>
                                    <input type="text" class="form-control" placeholder="" name="pic_event" required>
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label">No Hp PIC:</label>
                                    <input type="number" class="form-control" name="" placeholder="0828289289" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Durasi" class="form-label">Nama Sales:</label>
                                    <input type="text" class="form-control" placeholder="nama sales" name="nama_sales" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mb-3">
                                    <label for="Durasi" class="form-label">Pilih Kendaraan:<br> <span style="font-size: 10px; font-style: italic; color: red;"></span></label>
                                    <!-- Search box -->
                                    <input type="text" id="search-kendaraan" class="form-control mb-2" placeholder="Cari kendaraan...">

                                    <!-- Checkbox list -->
                                    <div id="checkbox-container" style="max-height: 200px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">
                                    <?php foreach ($data_final as $data): ?>
                                            <div class="form-check kendaraan-item">
                                                <input class="form-check-input" type="checkbox" name="pilihan_kendaraan[]" value="<?= $data['kode_barang'] ?>" id="cb-<?= $data['kode_barang'] ?>">
                                                <label class="form-check-label" for="cb-<?= $data['kode_barang'] ?>">
                                                    <?= $data['kode_barang'] . ' - ' . $data['nama_barang'] . ' (' . $data['tipe'] . ')' ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                       <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"  onClick='window.history.back(-1)'>Batal</button>
                        <button type="submit" class="btn btn-primary" name="tambah">Tambah</button>

                    </div>
                </form>

            </div>

        </div>
    </div>
</div>