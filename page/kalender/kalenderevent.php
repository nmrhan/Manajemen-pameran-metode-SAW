<style>
    #kalender-event {
        width: 100%;
        /* bisa diubah sesuai kebutuhan */
        height: 500px;
        /* atur tinggi kalender */
        max-width: 900px;
        /* optional, untuk membatasi lebar maksimum */
        margin: 0 auto;
        /* agar kalender center */
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">


    <div class="card app-calendar-wrapper">
        <div class="row g-0 p-3">
            <form id="filterForm" class="mb-3">
                <div class=" g-2">
                    <div class="row mb-1">
                        <div class="col-md-3">
                            <label for="periode_awal_event" class="form-label">Periode Awal <span style="color:red">* </span>:</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="periode_awal_event" name="periode_awal_event" >
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-3">
                            <label for="periode_akhir_event" class="form-label">Periode Akhir <span style="color:red">*</span></label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="periode_akhir_event" name="periode_akhir_event" >
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-3">
                            <label for="nm_dlr" class="form-label">Nama Dealer</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="nm_dlr" name="nm_dlr" placeholder="Nama Dealer">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="nama_lokasi" class="form-label">Nama Lokasi</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi" placeholder="Nama Lokasi">
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <button type="submit" class="btn btn-success">Filter</button>
                        <button type="button" id="resetFilter" class="btn btn-secondary ms-2">Reset</button>

                    </div>
                </div>
            </form>

            <div class="card mt-4">
                <div class="card-body table-responsive">
                    <div class="d-flex justify-content-between mb-2">
                        <button class="btn btn-primary btn-sm" id="prevMonth">
                            << Prev</button>
                                <h5 id="bulanTahun" class="my-auto" style="display:none;"></h5>

                                <button class="btn btn-primary btn-sm" id="nextMonth">Next >></button>
                    </div>
                    <table class="table table-bordered" id="tabel-jadwal-event">
                        <thead id="thead-tanggal"></thead>
                        <tbody id="tbody-jadwal"></tbody>
                    </table>
                    <!-- Tempatkan tombol di bawah tabel -->
                    <div id="paginationControls" style="margin-top:10px;">
                        <button id="prevPage" class="btn btn-secondary btn-sm">Previous</button>
                        <span id="pageInfo"></span>
                        <button id="nextPage" class="btn btn-secondary btn-sm">Next</button>
                    </div>
                    <div id="legend" style="margin-top: 10px; font-size: 14px;">
                     <span style="display: inline-block; width: 16px; height: 16px; background-color: #9e9e9e; margin-right: 5px;"></span>
                        Tunggu Approval
                        &nbsp;&nbsp;&nbsp;    
                    <span style="display: inline-block; width: 16px; height: 16px; background-color: #4caf50; margin-right: 5px;"></span>
                        Disetujui
                        &nbsp;&nbsp;&nbsp;
                     
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

