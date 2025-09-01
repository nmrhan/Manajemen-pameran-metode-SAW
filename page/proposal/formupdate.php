<?php
$no_pengajuan = $_GET['nopengajuan'];



if (isset($_POST['update'])) {

    $tema_event = $_POST['tema_event'];
    $periode_awal_event = $_POST['periode_awal_event'];
    $periode_akhir_event = $_POST['periode_akhir_event'];
    $durasi = $_POST['durasi'];
    $biaya_pameran = $_POST['biaya_pameran'];
    $target_penjualan = $_POST['target_penjualan'];
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
    // Query UPDATE
    $query = "UPDATE proposal_pengajuans SET
    
        tema_event = '$tema_event',
        periode_awal_event = '$periode_awal_event',
        periode_akhir_event = '$periode_akhir_event',
        durasi = '$durasi',
        biaya_pameran = '$biaya_pameran',
        target_penjualan = '$target_penjualan',
        target_peserta_ridingtest = '$target_peserta_ridingtest',
        target_pengunjung = '$target_pengunjung',
        pic_event = '$pic_event',
        no_hppic = '$no_hppic',
          nama_sales = '$nama_sales',
        jml_hot_prospek = '$jml_hot_prospek',
        no_lokasi = '$no_lokasi',
        unit_entry = '$unit_entry',
        target_jumlah_pit = '$target_jumlah_pit',
        target_jumlah_mechanic = '$target_jumlah_mechanic'
    WHERE no_pengajuan = '$no_pengajuan'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='?page=proposal';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data: " . mysqli_error($koneksi) . "');</script>";
    }
}



$sql = $koneksi->query("SELECT * FROM proposal_pengajuans  INNER JOIN lokasi_pamerans ON lokasi_pamerans.no_lokasi = proposal_pengajuans.no_lokasi
     WHERE no_pengajuan ='$no_pengajuan' ");
while ($data = $sql->fetch_assoc()) {
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="modal-title" id="exampleModalLabel1">Update Pengajuan Proposal</h5>

                    </div>

                    <form method="post" action="#">

                        <div class="card-body row">
                            <div class="col-md-6">
                                <div class="row ">
                                    <div class="col mb-3">
                                        <label for="No. Pengajuan" class="form-label">No. Proposal</label>
                                        <input type="text" class="form-control" name="no_pengajuan_display" value="<?= $no_pengajuan ?>" readonly>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Tgl Pengajuan" class="form-label">Tgl Pengajuan</label>
                                        <input type="date" class="form-control" name="tgl_pengajuan" value="<?= $data['tgl_pengajuan']; ?>" readonly required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Tema Event" class="form-label">Tema Event</label>
                                        <input type="text" class="form-control" placeholder="kode barang" name="tema_event" value="<?= $data['tema_event']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-1">
                                        <label for="Tema Event" class="form-label"><b>Periode Event</b></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">Tgl. Mulai Event</label>
                                        <input type="datetime-local" class="form-control" name="periode_awal_event" id="tgl_mulai" value="<?= $data['periode_awal_event']; ?>" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">Tgl. Akhir Event</label>
                                        <input type="datetime-local" class="form-control" name="periode_akhir_event" id="tgl_akhir" value="<?= $data['periode_akhir_event']; ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">Durasi</label>
                                        <input type="text" class="form-control" placeholder="Hari" id="durasi" value="<?= $data['durasi']; ?>" name="durasi" readonly>
                                    </div>
                                </div>


                                <!-- Hidden input untuk membawa data no_lokasi yang lama -->
                                <input type="hidden" id="old_no_lokasi" value="<?= $data['no_lokasi']; ?>">
                                <input type="hidden" id="old_nama_lokasi" value="<?= $data['nama_lokasi']; ?>">
                                <input type="hidden" id="old_data_lokasi" value='<?= json_encode([
                                                                                        "alamat_jalan" => $data["alamat_jalan"],
                                                                                        "kode_pos"     => $data["kode_pos"],
                                                                                        "kelurahan"    => $data["kelurahan"],
                                                                                        "kecamatan"    => $data["kecamatan"],
                                                                                        "kota"         => $data["kota"],
                                                                                        "propinsi"     => $data["propinsi"],
                                                                                        "latitude"     => $data["latitude"],
                                                                                        "longitude"    => $data["longitude"]
                                                                                    ]) ?>'>

                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="lokasi_event" class="form-label">Lokasi Event</label>
                                        <select class="form-control" id="lokasi_event1" name="no_lokasi" required></select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Tgl Pengajuan" class="form-label">Alamat Jalan</label>
                                        <textarea class="form-control" id="alamat_jalan1" name="alamat_jalan" disabled></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Tema Event" class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" id="kode_pos1" name="kode_pos" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Tema Event" class="form-label">Kelurahan</label>
                                        <input type="text" id="kelurahan1" name="kelurahan" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Tema Event" class="form-label">Kecamatan</label>
                                        <input type="text" id="kecamatan1" name="kecamatan" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Tema Event" class="form-label">Kabupaten/Kota</label>
                                        <input type="text" id="kota1" name="kota" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Provinsi</label>
                                        <input type="text" id="propinsi1" name="propinsi" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Tgl Pengajuan" class="form-label">Latitude </label>
                                        <input type="text" id="latitude1" name="latitude" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Tgl Pengajuan" class="form-label">Longatitude</label>
                                        <input type="text" id="longitude1" name="longitude" class="form-control" disabled>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Tgl Pengajuan" class="form-label">Target Unit Entry </label>
                                        <input type="number" class="form-control" placeholder="35" name="unit_entry" value="<?= $data['unit_entry']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Tgl Pengajuan" class="form-label">Target Jumlah Pit</label>
                                        <input type="number" class="form-control" placeholder="35" name="target_jumlah_pit" value="<?= $data['target_jumlah_pit']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Tgl Pengajuan" class="form-label">Target Jumlah Mechanic</label>
                                        <input type="number" class="form-control" placeholder="35" name="target_jumlah_mechanic" value="<?= $data['target_jumlah_mechanic']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Biaya Pameran</label>
                                        <input type="number" class="form-control" placeholder="35000000" name="biaya_pameran" value="<?= $data['biaya_pameran']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Target Penjualan Pameran</label>
                                        <input type="number" class="form-control" placeholder="35" name="target_penjualan" value="<?= $data['target_penjualan']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Target Peserta Riding Test</label>
                                        <input type="number" class="form-control" placeholder="35" name="target_peserta_ridingtest" value="<?= $data['target_peserta_ridingtest']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Target Pengunjung</label>
                                        <input type="number" class="form-control" placeholder="35" name="terget_pengunjung" value="<?= $data['target_pengunjung']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Target Hot Prospect</label>
                                        <input type="number" class="form-control" placeholder="35" name="jumlah_hot_prospek" value="<?= $data['jml_hot_prospek']; ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">PIC Event</label>
                                        <input type="text" class="form-control" placeholder="alex" name="pic_event" value="<?= $data['pic_event']; ?>" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">No Hp PIC</label>
                                        <input type="number" class="form-control" name="no_hppic" placeholder="0828289289" value="<?= $data['no_hppic']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Nama Sales</label>
                                        <input type="text" class="form-control" placeholder="35" name="nama_sales" value="<?= $data['nama_sales']; ?>" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal"  onClick='window.history.back(-1)'>Batal</button>
                            <button type="submit" class="btn btn-primary" name="update">Update</button>

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
<?php } ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var spareParts = <?php echo $sparePartsJson; ?>;
        var input = document.getElementById("spare-part-autocomplete");

        new Awesomplete(input, {
            list: spareParts.map(function(part) {
                return {
                    label: part.kode + ' | ' + part.nama,
                    value: part.kode
                };
            }),
            replace: function(suggestion) {
                this.input.value = suggestion.label;
                document.getElementById("kode_barang").value = suggestion.value;
            }
        });
    });
</script>