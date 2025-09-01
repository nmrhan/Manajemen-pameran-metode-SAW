<?php
$id = $_GET['nolokasi'];




$lat = !empty($data['latitude']) ? $data['latitude'] : -6.200000;
$lng = !empty($data['longitude']) ? $data['longitude'] : 106.816666;


$sql = $koneksi->query("SELECT * FROM lokasi_pamerans 
     WHERE no_lokasi ='$id' ");
while ($data = $sql->fetch_assoc()) {
    
$lat = !empty($data['latitude']) ? $data['latitude'] : -6.200000;
$lng = !empty($data['longitude']) ? $data['longitude'] : 106.816666;
    
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card mb-2">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="modal-title" id="exampleModalLabel1">Ubah Lokasi</h5>

                    </div>

                    <form method="post" action="page/lokasi/update_lokasi.php">
                        <div class="card-body">
                            <!-- Hidden input untuk no_lokasi (digunakan saat proses update) -->
                            <input type="hidden" name="no_lokasi" value="<?php echo $data['no_lokasi']; ?>">


                            <!-- No Lokasi (readonly) -->
                            <div class="mb-2">
                                <label class="form-label">No Lokasi</label>
                                <input type="text" class="form-control" value="<?php echo $data['no_lokasi']; ?>" readonly>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Nama Lokasi</label>
                                <input type="text" class="form-control" name="nama_lokasi" value="<?php echo $data['nama_lokasi']; ?>" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Alamat Jalan</label>
                                <textarea class="form-control" name="alamat_jalan" required><?php echo $data['alamat_jalan']; ?></textarea>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Kelurahan</label>
                                <input type="text" class="form-control" name="kelurahan" value="<?php echo $data['kelurahan']; ?>" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" name="kecamatan" value="<?php echo $data['kecamatan']; ?>" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Kode Pos</label>
                                <input type="number" class="form-control" name="kode_pos" value="<?php echo $data['kode_pos']; ?>" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Kota</label>
                                <input type="text" class="form-control" name="kota" id="kota" value="<?php echo $data['kota']; ?>" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Latitude</label>
                                <input type="text" class="form-control" name="latitude" id ="latitude" value="<?php echo $data['latitude']; ?>" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Longitude</label>
                                <input type="text" class="form-control" name="longitude" id="longitude" value="<?php echo $data['longitude']; ?>" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Update Lokasi di Peta</label>
                                <div id="map" style="height: 300px;"></div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="?page=lokasi" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>
<?php } ?>

<script>
    var map = L.map('map').setView([<?php echo $lat; ?>, <?php echo $lng; ?>], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    var marker = L.marker([<?php echo $lat; ?>, <?php echo $lng; ?>]).addTo(map);

    function getCityName(lat, lng) {
        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
            .then(response => response.json())
            .then(data => {
                if (data.address && data.address.city) {
                    document.getElementById('kota').value = data.address.city;
                } else if (data.address && data.address.town) {
                    document.getElementById('kota').value = data.address.town;
                } else {
                    document.getElementById('kota').value = '';
                }
            })
            .catch(err => console.log(err));
    }

    map.on('click', function(e) {
        const lat = e.latlng.lat.toFixed(6);
        const lng = e.latlng.lng.toFixed(6);

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;

        getCityName(lat, lng);

        marker.setLatLng(e.latlng);
    });
</script>
