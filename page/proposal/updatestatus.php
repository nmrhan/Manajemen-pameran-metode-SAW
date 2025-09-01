<?php
$no_pengajuan = $_GET['nopengajuan'];



if (isset($_POST['update'])) {

    $realisasi = $_POST['realisasi'];
    $alasan_revisi = $_POST['alasan_revisi'];


    // Query UPDATE
    $query = "UPDATE proposal_pengajuans SET
    
        realisasi = '$realisasi',
        alasan_revisi = '$alasan_revisi'
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
            <div class="col-md-6">

                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="modal-title" id="exampleModalLabel1">Update Pengajuan Proposal</h5>

                    </div>

                    <form method="post" action="#">

                        <div class="card-body ">

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
                                    <input type="text" class="form-control" placeholder="kode barang" name="tema_event" value="<?= $data['tema_event']; ?>" readonly required>
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
                                    <label for="realisasi" class="form-label">Status</label>
                                    <select name="realisasi" id="realisasi" class="form-select show-tick" required>
                                        <option value="1" <?= ($data['realisasi'] == '1') ? 'selected' : '' ?>>Tunggu Approval</option>
                                        <option value="2" <?= ($data['realisasi'] == '2') ? 'selected' : '' ?>>Disetujui</option>
                                        <option value="4" <?= ($data['realisasi'] == '4') ? 'selected' : '' ?>>Revisi</option>
                                         <option value="3" <?= ($data['realisasi'] == '3') ? 'selected' : '' ?>>Ditolak</option>
                                        
                                    </select>
                                </div>
                            </div>

                            <div class="row" id="revisi-field" style="display: none;">
                                <div class="col mb-3">
                                    <label for="alasan_revisi" class="form-label">Revisi</label>
                                    <textarea type="text" class="form-control" placeholder="Tulis alasan revisi..." name="alasan_revisi"></textarea>
                                </div>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal" onClick='window.history.back(-1)'>Close</button>
                            <button type="submit" class="btn btn-primary" name="update">Update</button>

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
<?php } ?>

<script>
    function toggleRevisiField() {
        const selected = document.getElementById('realisasi').value;
        const revisiField = document.getElementById('revisi-field');
        revisiField.style.display = (selected === '4') ? 'block' : 'none';
    }

    // Jalankan saat pertama kali load
    document.addEventListener('DOMContentLoaded', function () {
        toggleRevisiField();
        document.getElementById('realisasi').addEventListener('change', toggleRevisiField);
    });
</script>