<?php
require '../../vendor/autoload.php';

use Dompdf\Dompdf;

include('../../koneksi.php');

$no_pengajuan = $_GET['nopengajuan'];

// Ambil data sama seperti sebelumnya
$sql = $koneksi->query("SELECT * FROM proposal_pengajuans 
    INNER JOIN lokasi_pamerans ON lokasi_pamerans.no_lokasi = proposal_pengajuans.no_lokasi
    INNER JOIN master_dealer ON master_dealer.no_dlr = proposal_pengajuans.no_dlr
    WHERE no_pengajuan ='$no_pengajuan'");
$data = $sql->fetch_assoc();

// Buat HTML seperti sebelumnya
ob_start();
include('print.php'); // simpan HTML report kamu ke file ini
$html = ob_get_clean();

// Generate PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Download
$dompdf->stream("laporan_pameran_des_2024.pdf", array("Attachment" => true));
exit;
