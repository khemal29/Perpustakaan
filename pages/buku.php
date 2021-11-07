<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<span class="fas fa-users text primary mt-2 pr-3">Data Buku</span>
		</div>

		<div class="card-body">
			<div style="float: left;">
				<a href="index.php?p=buku-input" class="btn btn-danger"><i class="fas fa-plus-circle"></i>Tambah Buku Baru</a>
				<a target="_blank" a href="pages/cetak.php" class="btn btn-success"><i class="fa fa-print"></i></a>
			</div>

			<div style="float: right;">
				<form class="form-inline" method="POST">
					<form method="post">
						<div class="input-group mb-3">
							<input type="text" name="form-control" name="pencarian">
							<div class="input-group-append">
								<input class="btn btn-outline-success" type="submit" name="search" value="search" class="tombol">
							</div>
						</div>
					</form>
				</form>
			</div>

			<div class="card-body">			
				<div class="table ">
					<table class="table table-stripped" width="100%" cellspacing="0">
						<thead>
							<tr>
						      <th class="text-capitalize">#</th>
						      <th>ID Buku</th>
								<th>Judul Buku</th>
								<th>Kategori</th>
								<th>Pengarang</th>
								<th>Penerbit</th>
					            <th>status</th>
						      <th id ="label-opsi">Opsi</th>
			    			</tr>
						</thead>
						<?php
		$batas = 5;
		extract($_GET);
		if(empty($hal)){
			$posisi = 0;
			$hal = 1;
			$nomor = 1;
		}
		else {
			$posisi = ($hal - 1) * $batas;
			$nomor = $posisi+1;
		}	
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$pencarian = trim(mysqli_real_escape_string($db, $_POST['pencarian']));
			if($pencarian != ""){
				$sql = "SELECT * FROM tbbuku WHERE idbuku LIKE '%$pencarian%'
						OR judulbuku LIKE '%$pencarian%'
						OR kategori LIKE '%$pencarian%'
						OR pengarang LIKE '%$pencarian%'";
				
				$query = $sql;
				$queryJml = $sql;	
						
			}
			else {
				$query = "SELECT * FROM tbbuku LIMIT $posisi, $batas";
				$queryJml = "SELECT * FROM tbbuku";
				$no = $posisi * 1;
			}			
		}
		else {
			$query = "SELECT * FROM tbbuku LIMIT $posisi, $batas";
			$queryJml = "SELECT * FROM tbbuku";
			$no = $posisi * 1;
		}
		
		//$sql="SELECT * FROM tbbuku ORDER BY idbuku DESC";
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
			<td>
				<div class="btn-group" role="group" arial-label="basic example">
				<!--<a target="_blank" href="pages/cetak_kartu.php?id=<?php echo $r_tampil_anggota['idanggota'];?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-print"></i></a>-->
				<a href="index.php?p=buku-edit&id=<?php echo $r_tampil_anggota['idbuku'];?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i></a>
				<a href="proses/buku-hapus.php?id=<?php echo $r_tampil_anggota['idbuku']; ?>" onclick = "return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></a>
			</div>
			</td>			
		</tr>		
		<?php $nomor++; } 
		}
		else {
			echo "<tr><td colspan=6>Data Tidak Ditemukan</td></tr>";
		}?>		
	</table>
	<?php
	if(isset($_POST['pencarian'])){
	if($_POST['pencarian']!=''){
		echo "<div style=\"float:left;\">";
		$jml = mysqli_num_rows(mysqli_query($db, $queryJml));
		echo "Data Hasil Pencarian: <b>$jml</b>";
		echo "</div>";
	}
	}
	else{ ?>
		<div style="float: left;">		
		<?php
			$jml = mysqli_num_rows(mysqli_query($db, $queryJml));
			echo "Jumlah Data : <b>$jml</b>";
		?>			
		</div>		
		<div class="pagination">		
				<?php
				$jml_hal = ceil($jml/$batas);
				for($i=1; $i<=$jml_hal; $i++){
					if($i != $hal){
						echo "<a href=\"?p=buku&hal=$i\">$i</a>";
					}
					else {
						echo "<a class=\"active\">$i</a>";
					}
				}
				?>
		</div>
	<?php
	}
	?>
</div>