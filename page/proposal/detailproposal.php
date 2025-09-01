<style>
    .form-control {
        border: none;
    }

    @media print {
        .no-print {
            display: none !important;
        }
    }

    #print-area {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }
</style>

<?php
$no_pengajuan = $_GET['nopengajuan'];

$sql = $koneksi->query("SELECT proposal_pengajuans.tgl_pengajuan, proposal_pengajuans.tema_event, proposal_pengajuans.periode_awal_event, proposal_pengajuans.periode_akhir_event, proposal_pengajuans.durasi, lokasi_pamerans.nama_lokasi, lokasi_pamerans.alamat_jalan, lokasi_pamerans.kode_pos, lokasi_pamerans.kelurahan, lokasi_pamerans.kecamatan, lokasi_pamerans.kota, lokasi_pamerans.propinsi, lokasi_pamerans.latitude, lokasi_pamerans.longitude, proposal_pengajuans.unit_entry, proposal_pengajuans.target_jumlah_pit, proposal_pengajuans.target_jumlah_mechanic , proposal_pengajuans.biaya_pameran, 
proposal_pengajuans.target_penjualan, proposal_pengajuans.target_peserta_ridingtest, proposal_pengajuans.target_pengunjung, proposal_pengajuans.jml_hot_prospek, proposal_pengajuans.pic_event, proposal_pengajuans.no_hppic, proposal_pengajuans.no_dlr , proposal_pengajuans.nama_sales
 FROM proposal_pengajuans  INNER JOIN lokasi_pamerans ON lokasi_pamerans.no_lokasi = proposal_pengajuans.no_lokasi
     WHERE no_pengajuan ='$no_pengajuan' ");
while ($data = $sql->fetch_assoc()) {
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4" id="print-area">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="modal-title" id="exampleModalLabel1">Detail Pengajuan Proposal</h5>

                    </div>
                    <div class="card-body row">
                        <div class="col-md-6">
                            <div class="row ">
                                <div class="col-md-4 ">
                                    <label for="No. Pengajuan" class="form-label">No. Proposal</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="text" class="form-control" name="no_pengajuan_display" value="<?= $no_pengajuan ?>" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 ">
                                    <label for="Tgl Pengajuan" class="form-label">Tgl Pengajuan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" class="form-control" name="tgl_pengajuan" value="<?= $data['tgl_pengajuan']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="Tema Event" class="form-label">Tema Event</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="text" class="form-control" placeholder="kode barang" name="tema_event" value="<?= $data['tema_event']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-1">
                                    <label for="Tema Event" class="form-label"><b>Periode Event</b></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <label class="form-label">Tgl. Mulai Event</label>
                                </div>
                                <div class="col-md-6 ">
                                    <input type="datetime-local" class="form-control" name="periode_awal_event" id="tgl_mulai" value="<?= $data['periode_awal_event']; ?>" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 ">
                                    <label class="form-label">Tgl. Akhir Event</label>
                                </div>
                                <div class="col-md-6 ">
                                    <input type="datetime-local" class="form-control" name="periode_akhir_event" id="tgl_akhir" value="<?= $data['periode_akhir_event']; ?>" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 ">
                                    <label class="form-label">Durasi</label>
                                </div>
                                <div class="col-md-6 ">
                                    <input type="text" class="form-control" placeholder="Hari" value="<?= $data['durasi']; ?>" name="durasi" readonly>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-4 ">
                                    <label for="lokasi_event" class="form-label">Lokasi Event</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="text" class="form-control" placeholder="Hari" value="<?= $data['nama_lokasi']; ?>" name="durasi" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 ">
                                    <label for="Tgl Pengajuan" class="form-label">Alamat Jalan</label>
                                </div>
                                <div class="col-md-8 ">
                                    <textarea class="form-control" id="" name="alamat_jalan" readonly><?= $data['alamat_jalan']; ?> </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <label for="Tema Event" class="form-label">Kode Pos</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="text" class="form-control" id="" name="kode_pos" value="<?= $data['kode_pos']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <label for="Tema Event" class="form-label">Kelurahan</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="text" id="" name="kelurahan" class="form-control" value="<?= $data['kelurahan']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <label for="Tema Event" class="form-label">Kecamatan</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="text" id="" name="kecamatan" class="form-control" value="<?= $data['kecamatan']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <label for="Tema Event" class="form-label">Kabupaten/Kota</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="text" id="" name="kota" class="form-control" value="<?= $data['kota']; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="Durasi" class="form-label">Provinsi</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="text" id="" name="propinsi" class="form-control" value="<?= $data['propinsi']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <label for="Tgl Pengajuan" class="form-label">Latitude </label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="text" id="" name="latitude" class="form-control" value="<?= $data['latitude']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <label for="Tgl Pengajuan" class="form-label">Longatitude</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="text" id="" name="longitude" class="form-control" value="<?= $data['longitude']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <label for="Tgl Pengajuan" class="form-label">Target Unit Entry </label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="number" class="form-control" placeholder="35" name="unit_entry" value="<?= $data['unit_entry']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="Tgl Pengajuan" class="form-label">Target Jumlah Pit</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="number" class="form-control" placeholder="35" name="target_jumlah_pit" value="<?= $data['target_jumlah_pit']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="Tgl Pengajuan" class="form-label">Target Jumlah Mechanic</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="number" class="form-control" placeholder="35" name="target_jumlah_mechanic" value="<?= $data['target_jumlah_mechanic']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <label for="Durasi" class="form-label">Biaya Pameran</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="number" class="form-control" placeholder="35000000" name="biaya_pameran" value="<?= $data['biaya_pameran']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <label for="Durasi" class="form-label">Target Penjualan Pameran</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="number" class="form-control" placeholder="35" name="target_penjualan" value="<?= $data['target_penjualan']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="Durasi" class="form-label">Target Peserta Riding Test</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="number" class="form-control" placeholder="35" name="target_peserta_ridingtest" value="<?= $data['target_peserta_ridingtest']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="Durasi" class="form-label">Target Pengunjung</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="number" class="form-control" placeholder="35" name="terget_pengunjung" value="<?= $data['target_pengunjung']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <label for="Durasi" class="form-label">Target Hot Prospect</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="number" class="form-control" placeholder="35" name="jumlah_hot_prospek" value="<?= $data['jml_hot_prospek']; ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 ">
                                    <label class="form-label">PIC Event</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="text" class="form-control" placeholder="alex" name="pic_event" value="<?= $data['pic_event']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 ">
                                    <label class="form-label">No Hp PIC</label>
                                </div>
                                <div class="col-md-8 ">
                                    <input type="number" class="form-control" name="no_hppic" placeholder="0828289289" value="<?= $data['no_hppic']; ?>" required>
                                </div>
                            </div>
                        </div>
                        <h4>PENGAJUAN PROPOSAL DETAIL</h4>
                        <table class="table table-nobordered mb-2" style="width:100%">
                            <tr>
                                <th>Kode Dealer</th>
                                <th>Nama Dealer</th>
                                <th>Nama Sales</th>
                            </tr>
                            <tr>
                                <td><?= $data['no_dlr']; ?></td>
                                <td><?php
                                    $sql_dlr = $koneksi->query("SELECT nm_dlr FROM master_dealer WHERE no_dlr = '" . $data['no_dlr'] . "' LIMIT 1");
                                    while ($data_dlr = $sql_dlr->fetch_assoc()) {
                                        echo $data_dlr['nm_dlr'];
                                    }
                                    ?></td>

                                <td><?= $data['nama_sales']; ?></td>
                            </tr>
                        </table>
                        <table class="table table-nobordered" style="width:100%">
                            <tr>
                                <th>Kode Motor</th>
                                <th>Nama Motor</th>
                                <th>Tipe Motor</th>
                            </tr>
                            <?php
                            $sql_motor = $koneksi->query("SELECT motor_display.kode_barang, persediaan.nama_barang, persediaan.tipe  
                                   FROM motor_display
                                   INNER JOIN persediaan ON persediaan.kode_barang = motor_display.kode_barang  
                                   WHERE pengajuan_no = '" . $no_pengajuan . "'");
                            while ($data_motor = $sql_motor->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?= $data_motor['kode_barang']; ?></td>
                                    <td><?= $data_motor['nama_barang']; ?></td>
                                    <td><?= $data_motor['tipe']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary mb-3 no-print" onclick="printOnly()">Print (PDF)</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    function printOnly() {
        const all = document.body.children;
        const toPrint = document.getElementById('print-area');
        const originalDisplay = [];

        // Sembunyikan semua elemen kecuali #print-area
        for (let i = 0; i < all.length; i++) {
            if (all[i] !== toPrint) {
                originalDisplay[i] = all[i].style.display;
                all[i].style.display = 'none';
            }
        }

        html2pdf().set({
            margin: 0.5,
            filename: 'Detail_Proposal.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'a4',
                orientation: 'portrait'
            },

        }).from(toPrint).save().then(() => {
            // Kembalikan tampilan semula
            for (let i = 0; i < all.length; i++) {
                if (all[i] !== toPrint) {
                    all[i].style.display = originalDisplay[i];
                }
            }
        });
    }
</script>