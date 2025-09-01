<?php
// Koneksi ke database
include('koneksi.php');
session_start();
$role = $_SESSION["kd_dealer"] ?? '';

// Ambil parameter dari DataTables
$start = $_POST['start'] ?? 0;
$length = $_POST['length'] ?? 10;
$search_value = $_POST['search']['value'] ?? '';

// Query SQL untuk mengambil data penjualan
$sql = "SELECT penjualan.id_penjualan, penjualan.tanggal, penjualan.jumlah, persediaan.kode_barang, persediaan.nama_barang 
        FROM penjualan
        INNER JOIN persediaan ON persediaan.kode_barang = penjualan.kode_barang";

// Filter berdasarkan pencarian
if (!empty($search_value)) {
    $sql .= " WHERE penjualan.tanggal LIKE '%" . mysqli_real_escape_string($koneksi, $search_value) . "%' 
            OR persediaan.kode_barang LIKE '%" . mysqli_real_escape_string($koneksi, $search_value) . "%' 
            OR persediaan.nama_barang LIKE '%" . mysqli_real_escape_string($koneksi, $search_value) . "%'";
}

// Hitung total record tanpa filter
$sql_total = "SELECT COUNT(*) AS total FROM penjualan";
$result_total = mysqli_query($koneksi, $sql_total);
$total_records = mysqli_fetch_assoc($result_total)['total'];

// Limit data yang diambil sesuai dengan paging DataTables
$sql .= " LIMIT " . intval($start) . ", " . intval($length);

// Eksekusi query
$result = mysqli_query($koneksi, $sql);

// Format data sesuai dengan format yang dibutuhkan oleh DataTables
$data = array();
$no = $start + 1; // Nomor urutan untuk ditampilkan

while ($row = mysqli_fetch_assoc($result)) {
    $aksi = '';
    if ($role == 'MKT') {
        $aksi = '
        <button type="button" class="btn btn-icon btn-primary">
            <a href="?page=updatepenjualan&id_penjualan=' . $row['id_penjualan'] . '" style="color:white;">
                <span class="ti ti-edit"></span>
            </a>
        </button>
        <button type="button" class="btn btn-icon btn-danger">
            <a onclick="return confirm(\'Apakah anda yakin akan menghapus data ini?\')" href="?page=penjualan&aksi=deletepenjualan&id_penjualan=' . $row['id_penjualan'] . '" style="color:white;">
                <span class="ti ti-trash"></span>
            </a>
        </button>';
    }

    $data[] = array(
        "No" => $no++,
        "Tanggal" => $row['tanggal'],
        "Kode Spare Part" => $row['kode_barang'],
        "Nama Spare Part" => $row['nama_barang'],
        "Jumlah" => $row['jumlah'],
        "Aksi" => $aksi
    );
}

// Format output sesuai dengan standar DataTables
$output = array(
    "draw" => intval($_POST['draw'] ?? 0),
    "recordsTotal" => intval($total_records),
    "recordsFiltered" => intval($total_records), // Bisa disesuaikan jika menggunakan filtering
    "data" => $data
);

// Kembalikan data dalam format JSON
echo json_encode($output);

// Tutup koneksi database
mysqli_close($koneksi);
?>
