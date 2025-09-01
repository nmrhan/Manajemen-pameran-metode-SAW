<?php
 
 $id = $_GET['nolokasi'];
 $sql = $koneksi->query("delete from lokasi_pamerans where no_lokasi = '$id'");

 if ($sql) {
 
 ?>
 
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=lokasi";
	</script>
	
 <?php
 
 }else{?>
	
	<script type="text/javascript">
	alert("Silahkan Periksa Data Kembali!");
	window.location.href="?page=lokasi";
	</script>
	
 <?php }?>
 
 ?>