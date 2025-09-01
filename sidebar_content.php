  <?php
          $page = isset($_GET['page']) ? $_GET['page'] : '';
          $aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

          if ($page == "dashboard") {
            if ($aksi == "") {
              include "page/Dashboard/dashboard.php";
            }
          }
          if ($page == "marketing") {
            if ($aksi == "") {
              include "page/Dashboard/marketing.php";
            }
          }
          if ($page == "users") {
            if ($aksi == "") {
              include "page/User/user.php";
            }
            if ($aksi == "deleteuser") {
              include "page/User/deleteuser.php";
            }
          }
          // if ($page == "penjualan") {
          //   if ($aksi == "") {
          //     include "page/penjualan/penjualan.php";
          //   }
          //   if ($aksi == "deletepenjualan") {
          //     include "page/Penjualan/deletepenjualan.php";
          //   }
          // }
        
          // if ($page == "updatepenjualan") {
          //   if ($aksi == "") {
          //     include "page/penjualan/formupdate.php";
          //   }
          // }

          // if ($page == "persediaan") {
          //   if ($aksi == "") {
          //     include "page/persediaan/persediaan.php";
          //   }
          //   if ($aksi == "deletepersediaan") {
          //     include "page/persediaan/deletepersediaan.php";
          //   }
          // }
          // if ($page == "updatepersediaan") {
          //   if ($aksi == "") {
          //     include "page/persediaan/formupdate.php";
          //   }
          // }

          if ($page == "lokasi") {
            if ($aksi == "") {
              include "page/lokasi/lokasi.php";
            }
            if ($aksi == "deletelokasi") {
              include "page/lokasi/deletelokasi.php";
            }
          }
          if ($page == "updatelokasi") {
            if ($aksi == "") {
              include "page/lokasi/formupdate.php";
            }
          }

          if ($page == "proposal") {
            if ($aksi == "") {
              include "page/proposal/proposal.php";
            }
            if ($aksi == "deleteproposal") {
              include "page/proposal/deleteproposal.php";
            }
          } 
          if ($page == "pengajuanproposal") {
            if ($aksi == "") {
              include "page/proposal/pengajuanproposal.php";
            }
          }
          if ($page == "updateproposal") {
            if ($aksi == "") {
              include "page/proposal/formupdate.php";
            }
          }
          if ($page == "detailproposal") {
            if ($aksi == "") {
              include "page/proposal/detailproposal.php";
            }
          }
          if ($page == "updatestatus") {
            if ($aksi == "") {
              include "page/proposal/updatestatus.php";
            }
          }
          if ($page == "realisasievent") {
            if ($aksi == "") {
              include "page/proposal/realisasiproposal.php";
            }

          } 
          if ($page == "realisasiupdate") {
            if ($aksi == "") {
              include "page/proposal/realisasiupdate.php";
            }
          }

          if ($page == "laporan") {
            if ($aksi == "") {
              include "page/laporan/laporan.php";
            }
            // if ($aksi == "deletelaporan") {
            //   include "page/Laporan/deletelaporan.php";
            // }
          }

            if ($page == "lokasi_strategis") {
            if ($aksi == "") {
              include "page/lokasi_strategis/saw_lokasi.php";
            }
          }

          if ($page == "kalenderevent") {
            if ($aksi == "") {
              include "page/kalender/kalenderevent.php";
            }
           
          } 


          if ($page == "prediksi") {
            if ($aksi == "") {
              include "page/prediksi/prediksi.php";
            }
          }
       
          ?>
