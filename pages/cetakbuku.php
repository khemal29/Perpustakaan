<?php
include "../koneksi.php";

?>
<link rel="stylesheet" type="text/css" href="../style.css">
<h3>Data Buku</h3></div>
<div id="content">
<table border="1" id="tabel-tampil">
		<tr>
			<th id="label-tampil-no">No</th>
			<th>ID Buku</th>
			<th>Judul Buku</th>
			<th>Kategori</th>
			<th>Pengarang</th>
            <th>Penerbit</th>
			<th>Status</th>
		</tr>
		
		<?php		
		$nomor=1;
		$query="SELECT * FROM tbbuku ORDER BY idbuku DESC";
		$q_tampil_anggota = mysqli_query($db, $query);
		if(mysqli_num_rows($q_tampil_anggota)>0)
		{
		while($r_tampil_anggota=mysqli_fetch_array($q_tampil_anggota)){
		?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $r_tampil_anggota['idbuku']; ?></td>
			<td><?php echo $r_tampil_anggota['judulbuku']; ?></td>
			<td><?php echo $r_tampil_anggota['kategori']; ?></td>
			<td><?php echo $r_tampil_anggota['pengarang']; ?></td>	
            <td><?php echo $r_tampil_anggota['penerbit']; ?></td>
            <td><?php echo $r_tampil_anggota['status']; ?></td>	
		</tr>		
		<?php $nomor++; } 
		}?>		
	</table>
	<script>
		window.print();
	</script>
</div>
