<?php
include 'koneksi.php';

// Ambil data LPJ yang sudah direalisasi (status = 3)
$query = "
    SELECT 
        p.no_lokasi,
        l.nama_lokasi,
        SUM(p.aktual_pengunjung) AS total_pengunjung,
        SUM(p.jml_hot_prospek) AS total_hotprospek,
        SUM(p.aktual_penjualan) AS total_spk,
        SUM(p.aktual_biayapameran) AS total_biaya
    FROM proposal_pengajuans p
    JOIN lokasi_pamerans l ON p.no_lokasi = l.no_lokasi
    WHERE p.realisasi = '3'
    GROUP BY p.no_lokasi
";

$statement = mysqli_query($koneksi, $query);
$data = [];
while ($row = mysqli_fetch_assoc($statement)) {
    $data[] = $row;
}

// Cek jika data kosong
if (empty($data)) {
    echo "<p class='text-danger m-3'>Belum ada data realisasi proposal pameran.</p>";
    return;
}

// Bobot kriteria SAW
$weights = [
    'total_spk' => 0.4,
    'total_pengunjung' => 0.3,
    'total_hotprospek' => 0.2,
    'total_biaya' => 0.1
];

// Hitung nilai maksimal dan minimal untuk normalisasi
$max = [
    'total_spk' => max(array_column($data, 'total_spk')),
    'total_pengunjung' => max(array_column($data, 'total_pengunjung')),
    'total_hotprospek' => max(array_column($data, 'total_hotprospek'))
];
$min = [
    'total_biaya' => min(array_column($data, 'total_biaya'))
];

// Hitung skor dan simpan nilai normalisasi
foreach ($data as &$d) {
    $norm_spk = $d['total_spk'] / $max['total_spk'];
    $norm_pengunjung = $d['total_pengunjung'] / $max['total_pengunjung'];
    $norm_hotprospek = $d['total_hotprospek'] / $max['total_hotprospek'];
    $norm_biaya = $min['total_biaya'] / $d['total_biaya']; // cost

    $score = (
        $norm_spk * $weights['total_spk'] +
        $norm_pengunjung * $weights['total_pengunjung'] +
        $norm_hotprospek * $weights['total_hotprospek'] +
        $norm_biaya * $weights['total_biaya']
    );

    // Simpan nilai normalisasi dan skor
    $d['norm_spk'] = round($norm_spk, 3);
    $d['norm_pengunjung'] = round($norm_pengunjung, 3);
    $d['norm_hotprospek'] = round($norm_hotprospek, 3);
    $d['norm_biaya'] = round($norm_biaya, 3);
    $d['score'] = round($score, 3);
}

// Urutkan berdasarkan skor tertinggi
usort($data, fn($a, $b) => $b['score'] <=> $a['score']);
?>

<div class="container">
    <div class="card">
        <div class="card-header bg-white text-dark">
            <h5 class="card-title mb-0">Penilaian Lokasi Pameran (Metode SAW)</h5>
        </div>
        <div class="card-body table-responsive">
        <!-- <a href="export_saw_excel.php" class="btn btn-warning mb-3">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a> -->
             <table class="table table-bordered text-center align-middle">
                <thead class="table-warning align-middle text-center">
                    <tr>
                        <th rowspan="2" class="align-middle">Nama Lokasi</th>
                        <th colspan="2">Total Penjualan (0.4)</th>
                        <th colspan="2">Total Pengunjung (0.3)</th>
                        <th colspan="2">Total Hot Prospek (0.2)</th>
                        <th colspan="2">Total Biaya Pameran (0.1)</th>
                        <th rowspan="2" class="align-middle">Skor Akhir</th>
                        <th rowspan="2" class="align-middle">Ranking</th>
                    </tr>
                    <tr>
                        <th>Nilai</th>
                        <th>Normalisasi</th>
                        <th>Nilai</th>
                        <th>Normalisasi</th>
                        <th>Nilai</th>
                        <th>Normalisasi</th>
                        <th>Nilai</th>
                        <th>Normalisasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rank = 1;
                    foreach ($data as $row) {
                        echo "<tr>";
                        echo "<td>{$row['nama_lokasi']}</td>";
                        echo "<td>{$row['total_spk']}</td>";
                        echo "<td>{$row['norm_spk']}</td>";
                        echo "<td>{$row['total_pengunjung']}</td>";
                        echo "<td>{$row['norm_pengunjung']}</td>";
                        echo "<td>{$row['total_hotprospek']}</td>";
                        echo "<td>{$row['norm_hotprospek']}</td>";
                        echo "<td>Rp " . number_format($row['total_biaya'], 0, ',', '.') . "</td>";
                        echo "<td>{$row['norm_biaya']}</td>";
                        echo "<td><strong>{$row['score']}</strong></td>";
                        echo "<td><span class='badge rounded-pill bg-warning text-dark'>{$rank}</span></td>";
                        echo "</tr>";
                        $rank++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

