<?php
$no_dlr = $_SESSION["kd_dealer"];

if (isset($_POST['tambah'])) {
    $no_lokasi = $_POST['no_lokasi'];
    $nama_lokasi = $_POST['nama_lokasi'];
    $alamat_jalan = $_POST['alamat_jalan'];
    $kelurahan = $_POST['kelurahan'];
    $kecamatan = $_POST['kecamatan'];
    $kota = $_POST['kota'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $propinsi = $_POST['propinsi'];
    $kode_pos = $_POST['kode_pos'];
    // wilayah

    // Validasi sederhana
    if (!empty($no_lokasi) && !empty($nama_lokasi) && !empty($alamat_jalan) && !empty($kelurahan) && !empty($kecamatan) && !empty($kota) && !empty($latitude) && !empty($longitude)) {

        // Tambahkan alamat_jalan ke query dan binding
        $query = "INSERT INTO lokasi_pamerans 
            (no_lokasi, no_dlr, nama_lokasi, alamat_jalan, kelurahan, kecamatan, kota, latitude, longitude, kode_pos, propinsi) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ?)";

        if ($stmt = $koneksi->prepare($query)) {
            $stmt->bind_param("sssssssssss", $no_lokasi, $no_dlr, $nama_lokasi, $alamat_jalan, $kelurahan, $kecamatan, $kota, $latitude, $longitude, $kode_pos, $propinsi);

            if ($stmt->execute()) {
                echo "<script>
                    alert('Tambah data berhasil');
                    window.location.href = '?page=lokasi';
                </script>";
            } else {
                echo "Gagal menambahkan data: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Gagal menyiapkan statement: " . $koneksi->error;
        }
    } else {
        echo "<script>alert('Lengkapi semua kolom yang diperlukan.');</script>";
    }
}


// Ambil data wilayah
$query = "SELECT no_wil, nm_wil FROM wilayah";
$result = mysqli_query($koneksi, $query);
?>



<div class="container">
    <div class="card">
        <div class="card-header border-bottom">
            <h3 class="card-title">Data Lokasi</h3>
            
                <div class="text-end">
                    <button id="addButton" type="button" class="btn btn-danger">Tambah</button>
                </div>
            
        </div>
        <div class="card-body">
            <div class="card-datatable table-responsive">
                <table id="lokasi" class="table table-nobordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Lokasi </th>
                            <th>Nama Lokasi</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Kota</th>
                            <th>Alamat Jalan</th>

                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody> <!-- Kosongkan tbody untuk DataTables -->
                </table>
            </div>
        </div>
    </div>
</div>


<div class="offcanvas offcanvas-end" tabindex="-1" id="canvasAddUser" aria-labelledby="offcanvasAddUserLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Tambah Lokasi</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
        <form class="add-new-user pt-0" id="addNewUserForm" method="post">
            <div class="row">
                <div class="col mb-3">
                    <label for="Tipe" class="form-label">Wilayah</label>
                    <select name="tipe" class="form-select show-tick" id="wilayah" required>

                        <option value="" selected>-- Pilih Wilayah --</option>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <option value="<?php echo $row['no_wil']; ?>">
                                <?php echo $row['nm_wil']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="mb-2">
                <label class="form-label" for="no_lokasi">No Lokasi</label>
                <input type="text" class="form-control" name="no_lokasi" id="no_lokasi" readonly />
            </div>


            <div class="mb-2">
                <label class="form-label" for="nama-barang">Nama Lokasi</label>
                <input type="text" class="form-control" placeholder="masukkan nama lokasi"
                    aria-label="nama " name="nama_lokasi" />
            </div>
            <div class="mb-2">
                <label class="form-label" for="nama-barang">Alamat</label>
                <textarea type="text" class="form-control" placeholder="masukkan Alamat Jalan"
                    aria-label="alamat jalan" name="alamat_jalan"></textarea>

            </div>
            <div class="mb-2">
                <label class="form-label" for="nama-barang">Kelurahan</label>
                <input type="text" class="form-control" placeholder="masukkan nama Kelurahan"
                    aria-label="nama " name="kelurahan" />
            </div>
            <div class="mb-2">
                <label class="form-label" for="nama-barang">Kecamatan</label>
                <input type="text" class="form-control" placeholder="masukkan nama Kecamatan"
                    aria-label="nama " name="kecamatan" />
            </div>
            <div class="mb-2">
                <label class="form-label" for="nama-barang">Kode Pos</label>
                <input type="number" class="form-control" placeholder="masukkan kode pos"
                    aria-label="nama " name="kode_pos" />
            </div>
            <div class="mb-2">
                <label class="form-label">Pilih Lokasi di Peta</label>
                <div id="map" style="height: 300px;"></div>
            </div>

            <div class="mb-2">
                <label class="form-label" for="nama-barang">Kota</label>
                <input type="text" class="form-control" name="kota" id="kota" placeholder="masukkan nama Kota" />

            </div>
            <div class="mb-2">
                <label class="form-label" for="provinsi">Provinsi</label>
                <input type="text" class="form-control" name="propinsi" id="provinsi" placeholder="masukkan nama Provinsi" />
            </div>

            <div class="mb-2">
                <label class="form-label" for="nama-barang">Latitude</label>
                <input type="text" class="form-control" name="latitude" id="latitude" placeholder="masukkan Latitude" />
            </div>
            <div class="mb-2">
                <label class="form-label" for="nama-barang">Longatitude</label>
                <input type="text" class="form-control" name="longitude" id="longitude" placeholder="masukkan Longatitude" />
            </div>


            <button type="submit" name="tambah"
                class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
        </form>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mengambil tombol "Tambah" dan elemen offcanvas
        var addButton = document.querySelector('#addButton');
        var offcanvas = new bootstrap.Offcanvas(document.querySelector('#canvasAddUser'));

        // Menambahkan event listener ke tombol "Tambah"
        addButton.addEventListener('click', function() {
            offcanvas.show(); // Menampilkan elemen offcanvas saat tombol "Tambah" diklik
        });
    });
</script>
<script>
    var map = L.map('map').setView([-6.200000, 106.816666], 13); // Awal Jakarta

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var marker;

    function getCityName(lat, lng) {
        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
            .then(response => response.json())
            .then(data => {
                const address = data.address || {};

                // Kota
                if (address.city) {
                    document.getElementById('kota').value = address.city;
                } else if (address.town) {
                    document.getElementById('kota').value = address.town;
                } else if (address.village) {
                    document.getElementById('kota').value = address.village;
                } else {
                    document.getElementById('kota').value = '';
                }

                // Provinsi
                if (address.state) {
                    document.getElementById('provinsi').value = address.state;
                } else if (address.city && address.city.includes('Jakarta')) {
                    // fallback khusus untuk DKI Jakarta
                    document.getElementById('provinsi').value = 'DKI Jakarta';
                } else {
                    document.getElementById('provinsi').value = '';
                }
            })
            .catch(err => console.log(err));
    }


    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);

        // Isi input
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        // Ambil nama kota dari koordinat
        getCityName(lat, lng);

        // Tambah/Update Marker
        if (marker) {
            marker.setLatLng(e.latlng);
        } else {
            marker = L.marker(e.latlng).addTo(map);
        }
    });
</script>

<style>
    .table thead th {
        background-color:rgb(247, 237, 224);
        text-align: center;
    }
</style>