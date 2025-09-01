<?php
include('../../koneksi.php');

$no_pengajuan = $_GET['nopengajuan'];
function formatTanggalIndo($tanggal)
{
    $bulanIndo = [
        'Jan' => 'Jan',
        'Feb' => 'Feb',
        'Mar' => 'Mar',
        'Apr' => 'Apr',
        'May' => 'Mei',
        'Jun' => 'Jun',
        'Jul' => 'Jul',
        'Aug' => 'Agu',
        'Sep' => 'Sep',
        'Oct' => 'Okt',
        'Nov' => 'Nov',
        'Dec' => 'Des'
    ];

    $timestamp = strtotime($tanggal);
    $tgl = date('j', $timestamp);
    $bln = $bulanIndo[date('M', $timestamp)];
    $thn = date('Y', $timestamp);

    return "$tgl $bln $thn";
}

function tanggalHariIniIndo()
{
    $bulanIndo = [
        'Jan' => 'Jan',
        'Feb' => 'Feb',
        'Mar' => 'Mar',
        'Apr' => 'Apr',
        'May' => 'Mei',
        'Jun' => 'Jun',
        'Jul' => 'Jul',
        'Aug' => 'Agu',
        'Sep' => 'Sep',
        'Oct' => 'Okt',
        'Nov' => 'Nov',
        'Dec' => 'Des'
    ];

    $tgl = date('j');
    $bln = $bulanIndo[date('M')];
    $thn = date('Y');

    return "$tgl $bln $thn";
}

$sql = $koneksi->query("SELECT * FROM proposal_pengajuans  INNER JOIN lokasi_pamerans ON lokasi_pamerans.no_lokasi = proposal_pengajuans.no_lokasi
  INNER JOIN master_dealer ON master_dealer.no_dlr = proposal_pengajuans.no_dlr
     WHERE no_pengajuan ='$no_pengajuan' ");
$data = $sql->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pameran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
        }

        h2,
        h3 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 10px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 2px;
            text-align: center;
        }

        .img-cell {
            text-align: center;
        }

        .img-cell img {
            width: 100%;
            max-width: 250px;
            height: auto;
        }

        .text-left {
            text-align: left;
        }

        .signature-wrapper {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            font-size: 10px;
        }

        .signature {
            width: 45%;

        }


        .img-cell img {
            width: 250px;
            height: 180px;
            object-fit: contain;
            /* atau 'contain' kalau ingin gambar tidak terpotong */
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>

<body id="laporan">

    <h2>PROPOSAL PENGAJUAN</h2>
    <h3 style="text-transform: uppercase;"><?= $data['no_pengajuan']; ?> - <?= $data['nama_lokasi']; ?></h3>
    <p style="font-size: 10px;">Main Dealer : PT. WAHANA MAKMUR SEJATI</p>
    <table>
        <tr>
            <th colspan="2">Periode </th>
            <th rowspan="2">Durasi</th>
            <th rowspan="2">Kode Dealer</th>
            <th rowspan="2">Nama Dealer</th>
            <th rowspan="2">Lokasi</th>
            <th colspan="2">Pengunjung</th>
            <th colspan="2">Penjualan</th>
            <th colspan="2">Riding Test</th>
            <th colspan="1">Jumlah Hot Prospect</th>
            <th colspan="1">Jumlah Closing (Deal)</th>
            <th colspan="1">% Deal dari Hot Prospect</th>
            <th colspan="2">Unit Entry</th>
            <th colspan="2">Jumlah PIT</th>
            <th colspan="2">Jumlah Mekanik</th>
            <th rowspan="2">Biaya Pameran</th>
        </tr>
        <tr>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Estimasi</th>
            <th>Aktual</th>
            <th>Estimasi</th>
            <th>Aktual</th>
            <th>Estimasi</th>
            <th>Aktual</th>
            <th>Aktual</th>
            <th>Aktual</th>
            <th>Aktual</th>
            <th>Estimasi</th>
            <th>Aktual</th>
            <th>Estimasi</th>
            <th>Aktual</th>
            <th>Estimasi</th>
            <th>Aktual</th>

        </tr>
        <tr>
            <td><?= formatTanggalIndo($data['periode_awal_event']); ?></td>
            <td><?= formatTanggalIndo($data['periode_akhir_event']); ?></td>
            <td><?= $data['durasi']; ?> </td>
            <td><?= $data['no_dlr']; ?> </td>
            <td><?= $data['nm_dlr']; ?> </td>
            <td><?= $data['nama_lokasi']; ?> </td>
            <td><?= $data['target_pengunjung']; ?></td>
            <td><?= $data['aktual_pengunjung']; ?></td>
            <td><?= $data['target_penjualan']; ?></td>
            <td><?= $data['aktual_penjualan']; ?></td>
            <td><?= $data['target_peserta_ridingtest']; ?></td>
            <td><?= $data['aktual_peserta_ridingtest']; ?></td>
            <td><?= $data['jml_hot_prospek']; ?></td>
            <td><?= $data['jml_closing']; ?></td>
            <td><?= $data['persentase_deal'] . '%'; ?></td>
            <td><?= $data['unit_entry']; ?></td>
            <td><?= $data['akt_unit_entry']; ?></td>
            <td><?= $data['target_jumlah_pit']; ?></td>
            <td><?= $data['akt_jumlah_pit']; ?></td>
            <td><?= $data['target_jumlah_mechanic']; ?></td>
            <td><?= $data['akt_jumlah_mechanic']; ?></td>
            <td><?= $data['aktual_biayapameran']; ?></td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td class="img-cell"><img src="../../image/lampiranfoto/<?= $data['foto1_attachment']; ?>" alt="Foto 1">
                <p>Lampiran Foto 1</p>
            </td>
            <td class="img-cell"><img src="../../image/lampiranfoto/<?= $data['foto2_attachment']; ?>" alt="Foto 2">
                <p>Lampiran Foto 2</p>
            </td>
            <td class="img-cell"><img src="../../image/lampirankuitansi/<?= $data['kuitansi_attachment']; ?>" alt="Foto 3">
                <p>Lampiran Kuitansi</p>
            </td>
        </tr>
    </table>
    <p class="text-left" style="margin-top: 10px; font-size: 10px;">
        * Pengunjung adalah orang yang terlihat tertarik terhadap promosi yang ditawarkan.<br>
        ** Penjualan adalah minimal konsumen yang sudah memberikan tanda jadi.<br>
        *** Jumlah penjualan selama pameran tidak bisa lebih tinggi dari jumlah orang pengunjung selama pameran.
    </p>
    <div class="signature-wrapper">
        <div class="signature">
            <p>Mengetahui,</p><br><br><br><br>
            <p><strong>Olivia Widyasuwita</strong><br>Head Of Marketing</p>
        </div>
        <div class="signature">
            <p><?= tanggalHariIniIndo(); ?></p>
            <p>Yang membuat,</p><br><br>
            <p><strong><?= $data['pic_event']; ?></strong><br><?= $data['nm_dlr']; ?></p>
        </div>
    </div>
    <script>
        window.onload = function() {
            const element = document.getElementById("laporan");
            const opt = {
                margin: 0.3,
                filename: 'laporan_pameran_<?= $data['no_pengajuan']; ?> .pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 1.5
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'landscape'
                }
            };
    
            html2pdf().set(opt).from(element).save().then(() => {
                window.close(); // Menutup tab setelah selesai download
            });

        };
    </script>

</body>

</html>