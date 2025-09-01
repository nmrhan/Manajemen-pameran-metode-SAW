<?php
$no_pengajuan = $_GET['nopengajuan'];



if (isset($_POST['update'])) {
    $no_pengajuan1 = $_POST['no_pengajuan'];
    $realisasi = $_POST['realisasi'];
    $periode_awal_laporan =  $_POST['periode_awal_laporan'];
    $periode_akhir_laporan =  $_POST['periode_akhir_laporan'];
    $jml_hot_prospek = $_POST['jml_hot_prospek'];
    $jml_closing = $_POST['jml_closing'];
    $persentase_deal = $_POST['persentase_deal'];
    $aktual_biayapameran = $_POST['aktual_biayapameran'];
    $aktual_penjualan = $_POST['aktual_penjualan'];
    $aktual_peserta_ridingtest = $_POST['aktual_peserta_ridingtest'];
    $aktual_pengunjung = $_POST['aktual_pengunjung'];
    $akt_unit_entry = $_POST['akt_unit_entry'];
    $akt_jumlah_pit = $_POST['akt_jumlah_pit'];
    $akt_jumlah_mechanic = $_POST['akt_jumlah_mechanic'];
    $aktual_biayapameran = $_POST['aktual_biayapameran'];

    // Path folder
    $folderFoto = "image/lampiranfoto/";
    $folderKuitansi = "image/lampirankuitansi/";

    // Inisialisasi nama file kosong
    $foto1 = $foto2 = $kuitansi = '';

    // Upload Foto 1
    if (!empty($_FILES['foto1_attachment']['name'])) {
        $ext1 = pathinfo($_FILES['foto1_attachment']['name'], PATHINFO_EXTENSION);
        $foto1 = $no_pengajuan . '_foto1.' . $ext1;
        move_uploaded_file($_FILES['foto1_attachment']['tmp_name'], $folderFoto . $foto1);
    }

    // Upload Foto 2
    if (!empty($_FILES['foto2_attachment']['name'])) {
        $ext2 = pathinfo($_FILES['foto2_attachment']['name'], PATHINFO_EXTENSION);
        $foto2 = $no_pengajuan . '_foto2.' . $ext2;
        move_uploaded_file($_FILES['foto2_attachment']['tmp_name'], $folderFoto . $foto2);
    }

    // Upload Kuitansi
    if (!empty($_FILES['kuitansi_attachment']['name'])) {
        $ext3 = pathinfo($_FILES['kuitansi_attachment']['name'], PATHINFO_EXTENSION);
        $kuitansi = $no_pengajuan . '_kuitansi.' . $ext3;
        move_uploaded_file($_FILES['kuitansi_attachment']['tmp_name'], $folderKuitansi . $kuitansi);
    }

    // Query UPDATE
    $query = "UPDATE proposal_pengajuans SET
        realisasi = '$realisasi',
        periode_awal_laporan = '$periode_awal_laporan',
        periode_akhir_laporan = '$periode_akhir_laporan',
        jml_hot_prospek = '$jml_hot_prospek',
        jml_closing = '$jml_closing',
        persentase_deal = '$persentase_deal',
        aktual_biayapameran = '$aktual_biayapameran',
        aktual_penjualan = '$aktual_penjualan',
        aktual_peserta_ridingtest = '$aktual_peserta_ridingtest',
        aktual_pengunjung = '$aktual_pengunjung',
        akt_unit_entry = '$akt_unit_entry',
        akt_jumlah_pit = '$akt_jumlah_pit',
        akt_jumlah_mechanic = '$akt_jumlah_mechanic',
        aktual_biayapameran = '$aktual_biayapameran'
        ";

    // Tambahkan kolom file jika file di-upload
    if ($foto1 != '') {
        $query .= ", foto1_attachment = '$foto1'";
    }
    if ($foto2 != '') {
        $query .= ", foto2_attachment = '$foto2'";
    }
    if ($kuitansi != '') {
        $query .= ", kuitansi_attachment = '$kuitansi'";
    }

    $query .= " WHERE no_pengajuan = '$no_pengajuan1'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='?page=realisasievent';</script>";
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
                        <h5 class="modal-title" id="exampleModalLabel1">Update Realisasi Event</h5>

                    </div>

                    <form method="post" action="#" enctype="multipart/form-data">
                        <input type="hidden" name="no_pengajuan" value="<?= $no_pengajuan ?>">

                        <div class="card-body ">

                            <div class="row ">
                                <div class="col mb-3">
                                    <label for="No. Pengajuan" class="form-label">No. Proposal</label>
                                    <input type="text" class="form-control" name="no_pengajuan" value="<?= $no_pengajuan ?>" readonly>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="realisasi" class="form-label">Status</label>
                                    <select name="realisasi" id="realisasi" class="form-select show-tick" required readonly>
                                        <option value="2" <?= ($data['realisasi'] == '2') ? 'selected' : '' ?>>Disetujui</option>
                                        
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="card-body row" id="realisasi-fields" style="display: none;">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Tema Event" class="form-label">Tema Event</label>
                                        <input type="text" class="form-control" placeholder="kode barang" name="tema_event" value="<?= $data['tema_event']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-1">
                                        <label for="Tema Event" class="form-label"><b>Periode Laporan</b></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label class="form-label">Periode Awal Laporan</label>
                                        <input type="date" class="form-control" name="periode_awal_laporan" value="<?= $data['periode_awal_laporan']; ?>" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label class="form-label">Periode Akhir Laporan</label>
                                        <input type="date" class="form-control" name="periode_akhir_laporan" value="<?= $data['periode_akhir_laporan']; ?>" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Jumlah Hot Prospect</label>
                                        <input type="number" class="form-control" id="hotProspek" placeholder="35" name="jml_hot_prospek" value="<?= $data['jml_hot_prospek']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Jumlah Closing</label>
                                        <input type="number" class="form-control" id="closing" placeholder="35" name="jml_closing" value="<?= $data['jml_closing']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Persentase(%) Deal</label>
                                        <input type="number" class="form-control" id="persentaseDeal" placeholder="35" name="persentase_deal" value="<?= $data['persentase_deal']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Aktiual Biaya Pameran</label>
                                        <input type="number" class="form-control" placeholder="35000000" name="aktual_biayapameran" value="<?= $data['aktual_biayapameran']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Aktual Penjualan Pameran</label>
                                        <input type="number" class="form-control" placeholder="35" name="aktual_penjualan" value="<?= $data['aktual_penjualan']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Aktual Peserta Riding Test</label>
                                        <input type="number" class="form-control" placeholder="35" name="aktual_peserta_ridingtest" value="<?= $data['aktual_peserta_ridingtest']; ?>" required>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Aktual Pengunjung</label>
                                        <input type="number" class="form-control" placeholder="35" name="aktual_pengunjung" value="<?= $data['aktual_pengunjung']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="" class="form-label">Aktual Unit Entry </label>
                                        <input type="number" class="form-control" placeholder="35" name="akt_unit_entry" value="<?= $data['akt_unit_entry']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="" class="form-label">Aktual Jumlah Pit</label>
                                        <input type="number" class="form-control" placeholder="35" name="akt_jumlah_pit" value="<?= $data['akt_jumlah_pit']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="" class="form-label">Aktual Jumlah Mechanic</label>
                                        <input type="number" class="form-control" placeholder="35" name="akt_jumlah_mechanic" value="<?= $data['akt_jumlah_mechanic']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="Durasi" class="form-label">Biaya Pameran</label>
                                        <input type="number" class="form-control" style="noborder;" placeholder="35000000" name="aktual_biayapameran" value="<?= $data['aktual_biayapameran']; ?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-1">
                                        <label for="foto" class="form-label">Foto Lampiran 1</label>
                                        <input type="file" class="form-control" name="foto1_attachment" value="<?= $data['foto1_attachment']; ?>" required>

                                    </div>
                                    <p>File :
                                        <a href="image/lampiranfoto/<?= $data['foto1_attachment']; ?>" target="_blank">
                                            <?= $data['foto1_attachment']; ?>
                                        </a>
                                    </p>
                                </div>
                                <div class="row">
                                    <div class="col mb-1">
                                        <label for="foto" class="form-label">Foto Lampiran 2</label>
                                        <input type="file" class="form-control" name="foto2_attachment" value="<?= $data['foto2_attachment']; ?>" required>
                                    </div>
                                    <p>File :
                                        <a href="image/lampiranfoto/<?= $data['foto2_attachment']; ?>" target="_blank">
                                            <?= $data['foto2_attachment']; ?>
                                        </a>
                                    </p>
                                </div>
                                <div class="row">
                                    <div class="col mb-1">
                                        <label for="foto" class="form-label">Kuitansi Lampiran</label>
                                        <input type="file" class="form-control" name="kuitansi_attachment" value="<?= $data['kuitansi_attachment']; ?>" required>
                                    </div>
                                    <p>File :
                                        <a href="image/lampirankuitansi/<?= $data['kuitansi_attachment']; ?>" target="_blank">
                                            <?= $data['kuitansi_attachment']; ?>
                                        </a>
                                    </p>
                                </div>


                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="update">Update</button>

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
<?php } ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const realisasiSelect = document.getElementById('realisasi');
        const realisasiFields = document.getElementById('realisasi-fields');
        const requiredInputs = realisasiFields.querySelectorAll('input, select, textarea');

        function toggleFields() {
            if (realisasiSelect.value === '2') { // 4 = Sudah Realisasi
                realisasiFields.style.display = 'flex';
                requiredInputs.forEach(input => {
                    input.setAttribute('required', 'required');
                });
            } else {
                realisasiFields.style.display = 'none';
                requiredInputs.forEach(input => {
                    input.removeAttribute('required');
                });
            }
        }

        // Panggil saat halaman pertama kali dimuat
        toggleFields();

        // Tambahkan event listener untuk perubahan nilai dropdown
        realisasiSelect.addEventListener('change', toggleFields);
    });
</script>
<script>
    const hotProspekInput = document.getElementById('hotProspek');
    const closingInput = document.getElementById('closing');
    const persentaseDealInput = document.getElementById('persentaseDeal');

    function updatePersentaseDeal() {
        const hot = parseFloat(hotProspekInput.value);
        const closing = parseFloat(closingInput.value);

        if (!isNaN(hot) && hot !== 0 && !isNaN(closing)) {
            const result = (closing / hot) * 100;
            persentaseDealInput.value = result.toFixed(1);
        } else {
            persentaseDealInput.value = 0;
        }
    }

    hotProspekInput.addEventListener('input', updatePersentaseDeal);
    closingInput.addEventListener('input', updatePersentaseDeal);
</script>