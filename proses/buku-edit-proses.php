<?php
include'../koneksi.php';

$id_buku=$_POST['id_buku'];
$Judul_Buku=$_POST['nama'];
$kategori=$_POST['kategori'];
$Pengarang=$_POST['pengarang'];
$Penerbit=$_POST['penerbit'];
$status="Tersedia";

If(isset($_POST['simpan'])){
	
	
	mysqli_query($db,
		"UPDATE tbbuku
		SET nama='$Judul_Buku',kategori='$kategori',pengarang='$pengarang',Penerbit='$penerbit'
		WHERE id_buku='$id_buku'"
	);
	header("location:../index.php?p=buku");
}
?>
