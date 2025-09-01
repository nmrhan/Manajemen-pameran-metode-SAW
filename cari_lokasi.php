<?php
include 'koneksi.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';

$query = "SELECT * FROM lokasi_pamerans 
          WHERE nama_lokasi LIKE '%$search%' 
          ORDER BY nama_lokasi ASC 
          LIMIT 10";

$result = mysqli_query($koneksi, $query);
$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = [
        'no_lokasi'     => $row['no_lokasi'],
        'nama_lokasi'   => $row['nama_lokasi'],
        'kelurahan'     => $row['kelurahan'],
        'kecamatan'     => $row['kecamatan'],
        'kota'          => $row['kota'],
        'propinsi'      => $row['propinsi'],
        'alamat_jalan'  => $row['alamat_jalan'],
        'kode_pos'      => $row['kode_pos'],
        'latitude'      => $row['latitude'],
        'longitude'     => $row['longitude']
    ];
}

echo json_encode($data);
?>
