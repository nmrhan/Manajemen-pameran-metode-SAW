<?php
include 'koneksi.php'; // Pastikan file ini sesuai dengan koneksi database Anda

$sql_id = $koneksi->query("SELECT id_persediaan, nama_barang, kode_barang FROM persediaan");
$data = array();

while ($row = $sql_id->fetch_assoc()) {
    $data[] = array(
        'id' => $row['id_persediaan'],
        'label' => $row['kode_barang'] . ' | ' . $row['nama_barang'],
        'value' => $row['kode_barang']
    );
}

echo json_encode($data);
?>
