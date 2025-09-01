<?php
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_lokasi = $_POST['no_lokasi'];
    $nama_lokasi = $_POST['nama_lokasi'];
    $alamat_jalan = $_POST['alamat_jalan'];
    $kelurahan = $_POST['kelurahan'];
    $kecamatan = $_POST['kecamatan'];
    $kota = $_POST['kota'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $kode_pos = $_POST['kode_pos'];
    if (!empty($no_lokasi) && !empty($nama_lokasi)) {
        $query = "UPDATE lokasi_pamerans SET 
            nama_lokasi = ?, alamat_jalan = ?, kelurahan = ?, kecamatan = ?, kota = ?, latitude = ?, longitude = ?, kode_pos = ?
            WHERE no_lokasi = ?";

        if ($stmt = $koneksi->prepare($query)) {
            $stmt->bind_param("sssssssss", $nama_lokasi, $alamat_jalan, $kelurahan, $kecamatan, $kota, $latitude, $longitude, $kode_pos, $no_lokasi);

            if ($stmt->execute()) {
                echo "<script>alert('Data berhasil diupdate'); window.location.href='../../index?page=lokasi';</script>";
            } else {
                echo "Gagal update: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Gagal mempersiapkan statement: " . $koneksi->error;
        }
    } else {
        echo "<script>alert('Lengkapi semua kolom yang diperlukan.'); history.back();</script>";
    }
}
?>
