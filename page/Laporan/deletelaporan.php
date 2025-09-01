<?php
 
 $id = $_GET['id_laporan'];
 $sql = $koneksi->query("delete from laporan where id_laporan = '$id'");

 if ($sql) {
 
 ?>
 
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=laporan";
	</script>
	
 <?php
 
 }
 
 ?>