<?php 
header('Content-Type: application/json');
require 'koneksi.php';
session_start();
$role = $_SESSION["kd_dealer"] ?? '';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$offset = ($page - 1) * $limit;


$awal = $_GET['awal'] ?? null;
$akhir = $_GET['akhir'] ?? null;
$dealer = $_GET['dealer'] ?? '';
$lokasi = $_GET['lokasi'] ?? '';
$where = "p.realisasi IN (1, 2)";
// Fungsi warna
function getColorByRealisasi($kode) {
    switch($kode) {
        case '1': return '#9e9e9e';
        case '2': return '#4caf50'; // Hijau untuk "Sudah Realisasi"
       
        default: return '#9e9e9e'; // Abu-abu untuk status lain (jika ada)
    }
}


function labelRealisasi($kode) {
    switch($kode) {
        case '1': return 'Tunggu Approval';
        case '3': return 'Disetujui';
        
        default: return 'Unknown';
    }
}

if ($awal && $akhir) {
    $where .= " AND p.periode_awal_event >= '$awal' AND p.periode_akhir_event <= '$akhir'";
}

if (!empty($dealer)) {
    $where .= " AND m.nm_dlr LIKE '%$dealer%'";
}
if (!empty($lokasi)) {
    $where .= " AND l.nama_lokasi LIKE '%$lokasi%'";
}

// Hitung total data
$countSql = "SELECT COUNT(DISTINCT p.no_pengajuan) AS total 
             FROM proposal_pengajuans p 
             JOIN lokasi_pamerans l ON p.no_lokasi = l.no_lokasi 
             JOIN master_dealer m ON p.no_dlr = m.no_dlr 
             WHERE $where";
$countResult = mysqli_query($koneksi, $countSql);
$total = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($total / $limit);
// Ambil data dengan LIMIT
if ($role == 'MKT') {
$sql = "SELECT DISTINCT
            p.no_pengajuan,
            p.tema_event,
            p.periode_awal_event,
            p.periode_akhir_event,
            p.realisasi,
            l.nama_lokasi,
            l.kelurahan,
            m.nm_dlr
        FROM proposal_pengajuans p
        JOIN lokasi_pamerans l ON p.no_lokasi = l.no_lokasi
        JOIN master_dealer m ON p.no_dlr = m.no_dlr
        WHERE $where
        LIMIT $limit OFFSET $offset";
}else{
    $sql = "SELECT DISTINCT
            p.no_pengajuan,
            p.tema_event,
            p.periode_awal_event,
            p.periode_akhir_event,
            p.realisasi,
            l.nama_lokasi,
            l.kelurahan,
            m.nm_dlr
        FROM proposal_pengajuans p
        JOIN lokasi_pamerans l ON p.no_lokasi = l.no_lokasi
        JOIN master_dealer m ON p.no_dlr = m.no_dlr
        WHERE $where 
        LIMIT $limit OFFSET $offset";
}

$result = mysqli_query($koneksi, $sql);

$events = [];
while ($row = mysqli_fetch_assoc($result)) {
    $color = getColorByRealisasi($row['realisasi']);
    $label = labelRealisasi($row['realisasi']);
    $events[] = [
        'no_pengajuan' => $row['no_pengajuan'],
        'tema_event' => $row['tema_event'],
        'nm_dlr' => $row['nm_dlr'],
        'nama_lokasi' => $row['nama_lokasi'],
        'title' => $row['tema_event'] . ' - ' . $row['nama_lokasi'] . ', ' . $row['kelurahan'] . " ($label)",
        'start' => $row['periode_awal_event'],
        'end'   => date('Y-m-d', strtotime($row['periode_akhir_event'] . ' +1 day')),
        'color' => $color
    ];
}


echo json_encode([
    'data' => $events,
    'total_pages' => $totalPages
]);
?>
