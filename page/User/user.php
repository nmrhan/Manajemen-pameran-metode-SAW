<?php
if (isset($_POST['tambahuser'])) {
    $nama = $_POST['userFullname'];
    $username = $_POST['userUsername'];
    $password = md5($_POST['userPassword']);
    $role = $_POST['role'];

    if ($role == 'Dealer') {
        $kd_dealer = $_POST['kd_dealer'];
        $nm_dlr = $_POST['nm_dlr']; // ambil nama dealer
    } else {
        $kd_dealer = 'MKT';
        $nm_dlr = ''; // kosongkan jika bukan dealer
    }

    // Cek apakah username sudah ada
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("Username sudah ada dalam database. Silakan coba lagi.");</script>';
    } else {
        // Insert ke tabel users
        $insert_user = "INSERT INTO users (name, username, password, kd_dealer) 
                        VALUES ('$nama', '$username', '$password', '$kd_dealer')";
        if (mysqli_query($koneksi, $insert_user)) {
            
            // Jika role adalah Dealer, juga insert ke master_dealer
            if ($role == 'Dealer') {
                // Cek apakah dealer sudah ada (berdasarkan no_dlr)
                $cek_dealer = "SELECT * FROM master_dealer WHERE no_dlr = '$kd_dealer'";
                $res_dealer = mysqli_query($koneksi, $cek_dealer);

                if (mysqli_num_rows($res_dealer) == 0) {
                    $insert_dealer = "INSERT INTO master_dealer (no_dlr, nm_dlr) 
                                      VALUES ('$kd_dealer', '$nm_dlr')";
                    mysqli_query($koneksi, $insert_dealer);
                }
            }

            echo '<script>alert("Data user berhasil ditambahkan.");</script>';
            echo '<script>window.location.href = "?page=users";</script>';
        } else {
            echo '<script>alert("Terjadi kesalahan dalam penambahan data user.");</script>';
        }
    }
}

if (isset($_POST['updateusers'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah password diisi atau tidak
    if (!empty($password)) {
        // Jika diisi, update dengan password baru (md5)
        $password_hashed = md5($password);
        $update_query = "UPDATE users SET name = '$nama', username = '$username', password = '$password_hashed' WHERE id = '$id'";
    } else {
        // Jika kosong, tidak mengubah password
        $update_query = "UPDATE users SET name = '$nama', username = '$username' WHERE id = '$id'";
    }

    if (mysqli_query($koneksi, $update_query)) {
        echo '<script>alert("Data user berhasil diperbarui.");</script>';
        echo '<script>window.location.href="?page=users";</script>';
    } else {
        echo '<script>alert("Gagal memperbarui data user.");</script>';
    }
}

?>

<div class="container-xxl flex-grow-1 container-p-y">



      <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <h3 class="card-title ">Data user</h3>
            <div class="text-end ">
                <button id="addButton" type="button" class="btn btn-danger">Tambah</button>
            </div>
        </div>
        <div class="card-body">
            <div class="card-datatable table-responsive">
                <table id="example" class="table table-nobordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Kode Dealer</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $statement = mysqli_query($koneksi, "SELECT * FROM `users` ORDER BY id DESC");
                        foreach ($statement as $key) {
                        ?>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $key['name']; ?></td>
                            <td><?php echo $key['username']; ?></td>
                            <td><?php echo $key['kd_dealer']; ?></td>

                            <td>
                                <button type="button" class="btn btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $key['id']; ?>">
                                    <span class="ti ti-edit"></span>
                                </button>
                                <button type="button" class="btn btn-icon btn-danger">
                                    <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=users&aksi=deleteuser&id=<?php echo $key['id']; ?>" style="color:white;">
                                        <span class="ti ti-trash"></span>
                                    </a>
                                </button>
                            </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="canvasAddUser" aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Tambah Data User</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
                <form class="add-new-user pt-0" id="addNewUserForm" method="post">
                    <div class="mb-3">
                        <label class="form-label" for="user-fullname">Name</label>
                        <input type="text" class="form-control" id="user-fullname" placeholder="masukkan nama" name="userFullname" aria-label="nama" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user-username">Username</label>
                        <input type="text" id="user-username" class="form-control" placeholder="masukkan username" aria-label="username" name="userUsername" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user-password">Password</label>
                        <input type="password" id="user-password" class="form-control" placeholder="******" aria-label="******" name="userPassword" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="user-role">Role</label>
                        <select id="user-role" class="form-select" name="role" onchange="toggleKodeDealer()">
                            <option value="MKT">MKT</option>
                            <option value="Dealer">Dealer</option>
                        </select>
                    </div>

                    <div class="mb-3" id="kode-dealer-field" style="display: none;">
                        <label class="form-label" for="kd_dealer">Kode Dealer</label>
                        <input type="number" class="form-control" placeholder="Masukkan kode dealer" name="kd_dealer" />
                    </div>
                    <div class="mb-3" id="nama-dealer-field" style="display: none;">
                        <label class="form-label" for="kd_dealer">Nama Dealer</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama dealer" name="nm_dlr" />
                    </div>

                    <script>
                        function toggleKodeDealer() {
                            var role = document.getElementById("user-role").value;
                            var kdDealerField = document.getElementById("kode-dealer-field");
                            var nmDealerField = document.getElementById("nama-dealer-field");
                            nmDealerField.style.display = (role === "Dealer") ? "block" : "none";
                            kdDealerField.style.display = (role === "Dealer") ? "block" : "none";
                        }
                    </script>

                    <button type="submit" name="tambahuser" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                    <!-- <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button> -->
                </form>
            </div>
        </div>
        <!-- edit modal  -->
        <?php
        $sql = $koneksi->query("SELECT * FROM users");
        while ($data = $sql->fetch_assoc()) {
        ?>
            <div class="modal fade" id="editModal<?php echo $data['id']; ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Ubah Data User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                            <form method="post" action="#">
                                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" id="nameBasic" class="form-control" placeholder="nama" name="nama" value="<?php echo $data['name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="name" class="form-label">Username</label>
                                            <input type="text" id="nameBasic" class="form-control" name="username" value="<?php echo $data['username']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="Password" class="form-label">Password</label>
                                            <input type="password" id="nameBasic" class="form-control" name="password" placeholder="Kosongkan jika tidak diubah">
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button> -->
                                    <button type="submit" class="btn btn-primary" name="updateusers">Update</button>

                                </div>
                            </form>
                    </div>
                </div>
            </div>
        <?php  } ?>

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

<style>
    .table thead th {
        background-color:rgb(247, 237, 224);
        text-align: center;
    }
</style>