<?php
// Koneksi ke database
include('koneksi.php');
session_start();
$role = $_SESSION["kd_dealer"] ?? '';
// Mengatur header agar output dalam format JSON


// Mendapatkan parameter dari DataTables
$limit = $_POST['length'];
$offset = $_POST['start'];
$searchValue = $_POST['search']['value'];

// Menghitung total data tanpa filter
$totalQuery = "SELECT COUNT(*) as total FROM lokasi_pamerans";
$totalResult = $koneksi->query($totalQuery);
$totalData = $totalResult->fetch_assoc()['total'];

// Mempersiapkan query dengan filter pencarian
$query = "SELECT * FROM lokasi_pamerans WHERE 1=1";

if (!empty($searchValue)) {
    $query .= " AND (no_lokasi LIKE '%$searchValue%' OR nama_lokasi LIKE '%$searchValue%' OR kelurahan LIKE '%$searchValue%' OR kecamatan LIKE '%$searchValue%' OR kota LIKE '%$searchValue%' OR alamat_jalan LIKE '%$searchValue%')";

}

// Menghitung total data dengan filter pencarian
$filteredQuery = $query;
$filteredResult = $koneksi->query($filteredQuery);
$totalFilteredData = $filteredResult->num_rows;

// Menambahkan limit dan offset
$query .= " ORDER BY no_lokasi ASC LIMIT $limit OFFSET $offset";
$result = $koneksi->query($query);

$data = array();
$no = $offset + 1;



while ($row = $result->fetch_assoc()) {
    $subArray = array();
    $subArray['No'] = $no++;
    $subArray['No Lokasi'] = $row['no_lokasi'];
    $subArray['Nama Lokasi'] = $row['nama_lokasi'];
    $subArray['Kelurahan'] = $row['kelurahan'];
    $subArray['Kecamatan'] = $row['kecamatan'];
    $subArray['Kota'] = $row['kota'];
    $subArray['Alamat Jalan'] = $row['alamat_jalan'];
    $subArray['no_lokasi'] = $row['no_lokasi']; // Pastikan kolom ini ada

        
        $subArray['Aksi'] = '
            <button type="button" class="btn btn-icon btn-primary">
                <a href="?page=updatelokasi&nolokasi=' . $row['no_lokasi'] . '" style="color:white;">
                    <span class="ti ti-edit"></span>
                </a>
            </button>
            <button type="button" class="btn btn-icon btn-danger">
                <a onclick="return confirm(\'Apakah anda yakin akan menghapus data ini?\')" href="?page=lokasi&aksi=deletelokasi&nolokasi=' . $row['no_lokasi'] . '" style="color:white;">
                    <span class="ti ti-trash"></span>
                </a>
            </button>
        ';
    
    $data[] = $subArray;
}

// Menyiapkan data untuk response
$response = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFilteredData),
    "data" => $data
);

// Mengirimkan response dalam format JSON
echo json_encode($response);

$koneksi->close();
?>
