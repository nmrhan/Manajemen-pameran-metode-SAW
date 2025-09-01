<?php
$id = $_GET['id'];

// Ambil kd_dealer dari user yang akan dihapus
$getKdDealer = mysqli_query($koneksi, "SELECT kd_dealer FROM users WHERE id = '$id'");
$data = mysqli_fetch_assoc($getKdDealer);
$kd_dealer = $data['kd_dealer'];

// Hapus user dari tabel users
$deleteUser = mysqli_query($koneksi, "DELETE FROM users WHERE id = '$id'");

// Jika kd_dealer bukan 'MKT', maka hapus juga dari master_dealer
if ($deleteUser && $kd_dealer !== 'MKT') {
    mysqli_query($koneksi, "DELETE FROM master_dealer WHERE no_dlr = '$kd_dealer'");
}

if ($deleteUser) {
    echo '<script>
        alert("Data berhasil dihapus.");
        window.location.href="?page=users";
    </script>';
} else {
    echo '<script>
        alert("Gagal menghapus data.");
        window.location.href="?page=users";
    </script>';
}
?>
