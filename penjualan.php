<!DOCTYPE html>
<html>
<head>
    <title>DataTables Server-side Processing</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#penjualan').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "data_penjualan.php", // Ganti dengan nama file server-side script Anda
                    "type": "POST"
                },
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthChange": true,
                "pageLength": 10,
                "language": {
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    }
                },
                "columns": [
                    { "data": "No" },
                    { "data": "Tanggal" },
                    { "data": "Kode Spare Part" },
                    { "data": "Nama Spare Part" },
                    { "data": "Jumlah" },
                    { 
                        "data": "Aksi",
                        "orderable": false,
                        "searchable": false
                    }
                ]
            });
        });
    </script>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header border-bottom">
            <h3 class="card-title">Data Penjualan</h3>
            <div class="text-end">
                <button id="addButton" type="button" class="btn btn-danger">Tambah</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">
                    Import
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="card-datatable table-responsive">
                <table id="penjualan" class="table table-nobordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Kode Spare Part</th>
                            <th>Nama Spare Part</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody> <!-- Kosongkan tbody untuk DataTables -->
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
