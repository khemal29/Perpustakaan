<?php
include'../koneksi.php';
$id_buku=$_POST['id_buku'];
$Judul_Buku=$_POST['nama'];
$kategori=$_POST['kategori'];
$Pengarang=$_POST['pengarang'];
$Penerbit=$_POST['penerbit'];
$status="Tersedia";
	
if(isset($_POST['simpan'])){	
	$sql = 
	"INSERT INTO tbbuku
		VALUES('$id_buku','$Judul_Buku','$kategori','$Pengarang','$Penerbit','$status')";
	$query = mysqli_query($db, $sql);

	header("location:../index.php?p=buku");
}
?>