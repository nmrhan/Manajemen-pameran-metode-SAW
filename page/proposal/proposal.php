<div class="container">
    <div class="card">
        <div class="card-header border-bottom">
            <h3 class="card-title">PENGAJUAN PROPOSAL</h3>
            <div class="text-end">
                <?php if ($role != 'MKT') { ?>
                    <a href="?page=pengajuanproposal" type="button" class="btn btn-danger">Tambah</a>
                <?php } ?>
            </div>
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
                            <th>Status</th>
                            <th>Ket. Revisi</th>

                            <th style="min-width: 170px;">Aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if ($role == 'MKT') {
                            $statement = mysqli_query($koneksi, "
                        SELECT DISTINCT proposal_pengajuans.no_pengajuan, proposal_pengajuans.*, lokasi_pamerans.nama_lokasi, master_dealer.nm_dlr 
                        FROM proposal_pengajuans
                        INNER JOIN lokasi_pamerans ON lokasi_pamerans.no_lokasi = proposal_pengajuans.no_lokasi 
                        INNER JOIN master_dealer ON master_dealer.no_dlr = proposal_pengajuans.no_dlr
                        WHERE proposal_pengajuans.realisasi  
                        ORDER BY proposal_pengajuans.no_pengajuan DESC
                    ");
                        } else {

                            $statement = mysqli_query($koneksi, "
                            SELECT DISTINCT proposal_pengajuans.no_pengajuan, proposal_pengajuans.*, lokasi_pamerans.nama_lokasi, master_dealer.nm_dlr 
                            FROM proposal_pengajuans
                            INNER JOIN lokasi_pamerans ON lokasi_pamerans.no_lokasi = proposal_pengajuans.no_lokasi 
                            INNER JOIN master_dealer ON master_dealer.no_dlr = proposal_pengajuans.no_dlr
                            WHERE proposal_pengajuans.realisasi 
                            ORDER BY proposal_pengajuans.no_pengajuan DESC
                        ");
                        };
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
                                    <?php
                                    if ($key['realisasi'] == '1') {
                                        echo 'Tunggu Approval';
                                    } elseif ($key['realisasi'] == '2') {
                                        echo 'Disetujui';
                                    } elseif ($key['realisasi'] == '3') {
                                        echo 'Ditolak';
                                    } elseif ($key['realisasi'] == '4') {
                                        echo 'Revisi';
                                    } elseif ($key['realisasi'] == '5') {
                                        echo '<span style="color: red;">Sedang Dilaksanakan</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($key['alasan_revisi'] != '') {
                                        echo $key['alasan_revisi'];
                                    } else {
                                        echo '-';
                                    } ?></td>

                                <td>
                                    <?php if ($role == 'MKT') { ?>

                                        <a type="button" class="btn btn-icon btn-info" title="details" href="?page=detailproposal&nopengajuan=<?php echo $key['no_pengajuan']; ?>">
                                            <span class="ti ti-eye"></span>
                                        </a>
                                        <a type="button" class="btn btn-icon btn-primary" title="edit" href="?page=updatestatus&nopengajuan=<?php echo $key['no_pengajuan']; ?>">
                                            <span class="ti ti-edit"></span>
                                        </a>

                                    <?php } elseif ($role != 'MKT' && $key['no_dlr'] == $role) { ?>
                                        <a type="button" class="btn btn-icon btn-info" title="details" href="?page=detailproposal&nopengajuan=<?php echo $key['no_pengajuan']; ?>">
                                            <span class="ti ti-eye"></span>
                                        </a>
                                        <a type="button" class="btn btn-icon btn-primary" title="edit" href="?page=updateproposal&nopengajuan=<?php echo $key['no_pengajuan']; ?>">
                                            <span class="ti ti-edit"></span>
                                        </a>
                                        <button type="button" class="btn btn-icon btn-danger">
                                            <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=proposal&aksi=deleteproposal&nopengajuan=<?php echo $key['no_pengajuan']; ?>" style="color:white;">
                                                <span class="ti ti-trash"></span>
                                            </a>
                                        </button>
                                    <?php } else { ?>
                                        -
                                    <?php } ?>
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
        background-color: rgb(247, 237, 224);
        text-align: center;
    }
</style>