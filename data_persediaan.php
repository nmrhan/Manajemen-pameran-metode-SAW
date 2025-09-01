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
$totalQuery = "SELECT COUNT(*) as total FROM persediaan";
$totalResult = $koneksi->query($totalQuery);
$totalData = $totalResult->fetch_assoc()['total'];

// Mempersiapkan query dengan filter pencarian
$query = "SELECT * FROM persediaan WHERE 1=1";

if (!empty($searchValue)) {
    $query .= " AND (kode_barang LIKE '%$searchValue%' OR nama_barang LIKE '%$searchValue%' OR tipe LIKE '%$searchValue%')";
}

// Menghitung total data dengan filter pencarian
$filteredQuery = $query;
$filteredResult = $koneksi->query($filteredQuery);
$totalFilteredData = $filteredResult->num_rows;

// Menambahkan limit dan offset
$query .= " ORDER BY id_persediaan ASC LIMIT $limit OFFSET $offset";
$result = $koneksi->query($query);

$data = array();
$no = $offset + 1;



while ($row = $result->fetch_assoc()) {
    $subArray = array();
    $subArray['No'] = $no++;
    $subArray['Kode Barang'] = $row['kode_barang'];
    $subArray['Nama Barang'] = $row['nama_barang'];
    $subArray['Tipe'] = $row['tipe'];
    $subArray['id_persediaan'] = $row['id_persediaan']; // Pastikan kolom ini ada

    if ($role == 'MKT') {
        $subArray['Aksi'] = '
            <button type="button" class="btn btn-icon btn-primary">
            <a href="?page=updatepersediaan&id_persediaan=' . $row['id_persediaan'] . '" style="color:white;">
                <span class="ti ti-edit"></span>
            </a>
        </button>
            <button type="button" class="btn btn-icon btn-danger">
                <a onclick="return confirm(\'Apakah anda yakin akan menghapus data ini?\')" href="?page=persediaan&aksi=deletepersediaan&kodebarang=' . $row['kode_barang'] . '" style="color:white;">
                    <span class="ti ti-trash"></span>
                </a>
            </button>
        ';
    } else {
        $subArray['Aksi'] = '';
    }

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
