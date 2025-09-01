<?php
 
 $no_pengajuan = $_GET['nopengajuan'];
 $sql = $koneksi->query("delete from proposal_pengajuans where no_pengajuan = '$no_pengajuan'");

 if ($sql) {
 
 ?>
 
	<script type="text/javascript">
	alert("Data Berhasil Dihapus");
	window.location.href="?page=proposal";
	</script>
	
 <?php
 
 }else{?>
	
	<script type="text/javascript">
	alert("Silahkan Periksa Data Kembali!");
	window.location.href="?page=proposal";
	</script>
	
 <?php }?>
 
 ?>