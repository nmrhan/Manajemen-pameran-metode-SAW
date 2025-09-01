<?php
include 'koneksi.php'; // koneksi database

$no_wil = $_GET['no_wil'];
$bulan = $_GET['bulan'];

// Ambil urutan terakhir dari no_lokasi yang cocok
$query = "SELECT MAX(RIGHT(no_lokasi, 4)) AS urutan 
          FROM lokasi_pamerans 
          WHERE no_lokasi LIKE 'Lok{$no_wil}{$bulan}%'";

$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);
$urutan = $data['urutan'] ? (int)$data['urutan'] : 0;

echo json_encode(['urutan' => $urutan]);
?>
