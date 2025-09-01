<div class="container">
    <div class="card">
        <div class="card-header border-bottom">
            <h3 class="card-title">LPJ PAMERAN</h3>
            <form method="GET" action="index">
                <input type="hidden" name="page" value="laporan">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label>Periode :</label>
                        <input type="date" name="tanggal_dari" class="form-control" value="<?= isset($_GET['tanggal_dari']) ? $_GET['tanggal_dari'] : '' ?>">
                    </div>
                    <div class="col-md-3">
                        <label>s/d:</label>
                        <input type="date" name="tanggal_sampai" class="form-control" value="<?= isset($_GET['tanggal_sampai']) ? $_GET['tanggal_sampai'] : '' ?>">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="index?page=laporan" class="btn btn-secondary ms-2">Reset</a>
                    </div>
                </div>
            </form>

        </div>
        <div class="card-body">
            <div class="card-datatable table-responsive">
                <table id="example1" class="table table-nobordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Proposal</th>
                            <th>Dealer</th>
                            <th>Tema Event</th>
                            <th>Tgl. pengajuan</th>
                            <th>Periode Awal</th>
                            <th>Periode Akhir</th>
                            <th>Lokasi</th>
                            <th>PIC</th>
                            <th style="min-width: 100px;">Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $tanggal_dari = isset($_GET['tanggal_dari']) ? $_GET['tanggal_dari'] : '';
                        $tanggal_sampai = isset($_GET['tanggal_sampai']) ? $_GET['tanggal_sampai'] : '';
                        if ($role == 'MKT') {
                            $query = "
                        SELECT DISTINCT proposal_pengajuans.no_pengajuan, proposal_pengajuans.*, lokasi_pamerans.nama_lokasi, master_dealer.nm_dlr 
                        FROM proposal_pengajuans
                        INNER JOIN lokasi_pamerans ON lokasi_pamerans.no_lokasi = proposal_pengajuans.no_lokasi 
                        INNER JOIN master_dealer ON master_dealer.no_dlr = proposal_pengajuans.no_dlr
                        WHERE proposal_pengajuans.realisasi = '3'
                        ";
                        } else {
                            $query = "
                            SELECT DISTINCT proposal_pengajuans.no_pengajuan, proposal_pengajuans.*, lokasi_pamerans.nama_lokasi, master_dealer.nm_dlr 
                            FROM proposal_pengajuans
                            INNER JOIN lokasi_pamerans ON lokasi_pamerans.no_lokasi = proposal_pengajuans.no_lokasi 
                            INNER JOIN master_dealer ON master_dealer.no_dlr = proposal_pengajuans.no_dlr
                            WHERE proposal_pengajuans.realisasi = '3' AND proposal_pengajuans.no_dlr = '$role'
                            ";
                        }

                        if (!empty($tanggal_dari) && !empty($tanggal_sampai)) {
                            $query .= " AND (
                                (proposal_pengajuans.periode_awal_event BETWEEN '$tanggal_dari' AND '$tanggal_sampai') OR
                                (proposal_pengajuans.periode_akhir_event BETWEEN '$tanggal_dari' AND '$tanggal_sampai') OR
                                ('$tanggal_dari' BETWEEN proposal_pengajuans.periode_awal_event AND proposal_pengajuans.periode_akhir_event) OR
                                ('$tanggal_sampai' BETWEEN proposal_pengajuans.periode_awal_event AND proposal_pengajuans.periode_akhir_event)
                            )";
                        }

                        $query .= " ORDER BY proposal_pengajuans.no_pengajuan DESC";

                        $statement = mysqli_query($koneksi, $query);

                        foreach ($statement as $key) {
                        ?>
                            <tr> <!-- DITAMBAHKAN -->
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $key['no_pengajuan']; ?></td>
                                <td><?php echo $key['nm_dlr']; ?></td>
                                <td><?php echo $key['tema_event']; ?></td>
                                <td><?php echo $key['tgl_pengajuan']; ?></td>
                                <td><?php echo $key['periode_awal_event']; ?></td>
                                <td><?php echo $key['periode_akhir_event']; ?></td>
                                <td><?php echo $key['nama_lokasi']; ?></td>
                                <td><?php echo $key['pic_event']; ?></td>
                                <td>
                                    <a type="button" class="btn btn-icon btn-primary" target="_blank" title="edit" href="page/laporan/print.php?nopengajuan=<?php echo $key['no_pengajuan']; ?>">
                                        <span class="ti ti-printer"></span>
                                    </a>

                                </td>

                            </tr> <!-- DITAMBAHKAN -->
                        <?php
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>


<style>
    .table thead th {
        background-color:rgb(247, 237, 224);
        text-align: center;
    }
</style>