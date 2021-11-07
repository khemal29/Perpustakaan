<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<span class="fas fa-users text primary mt-2 pr-3">Data Anggota</span>
		</div>

		<div class="card-body">
			<div style="float: left;">
				<!--<button type ="button" class="btn btn-danger" data-toogle="modal" data-target="#anggota-input">
					<i class="fas fa-plus-circle"></i>Tambah Anggota Baru
				</button>-->
				<a href="index.php?p=anggota-input" class="btn btn-danger"><i class="fas fa-plus-circle"></i>Tambah Anggota Baru</a>
				<a href="pages/cetak.php" class="btn btn-success"><i class="fa fa-print"></i></a>
			</div>
			<div style="float: right;">
				<form class="form-inline" method="post">
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
			      <th>Id Anggota</th>
			      <th>Nama</th>
			      <th>Foto</th>
			      <th>Jenis Kelamin</th>
			      <th>Alamat</th>
			      <th id ="label-opsi">Opsi</th>
    			</tr>
			</thead>

			<tbody>
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
				$sql = "SELECT * FROM tbanggota WHERE nama LIKE '%$pencarian%'
						OR idanggota LIKE '%$pencarian%'
						OR jeniskelamin LIKE '%$pencarian%'
						OR alamat LIKE '%$pencarian%'";
				
				$query = $sql;
				$queryJml = $sql;	
						
			}
			else {
				$query = "SELECT * FROM tbanggota LIMIT $posisi, $batas";
				$queryJml = "SELECT * FROM tbanggota";
				$no = $posisi * 1;
			}			
		}
		else {
			$query = "SELECT * FROM tbanggota LIMIT $posisi, $batas";
			$queryJml = "SELECT * FROM tbanggota";
			$no = $posisi * 1;
		}
		
		//$sql="SELECT * FROM tbanggota ORDER BY idanggota DESC";
		$q_tampil_anggota = mysqli_query($db, $query);
		if(mysqli_num_rows($q_tampil_anggota)>0)
		{
		while($r_tampil_anggota=mysqli_fetch_array($q_tampil_anggota)){
			if(empty($r_tampil_anggota['foto'])or($r_tampil_anggota['foto']=='-'))
				$foto = "admin-no-photo.jpg";
			else
				$foto = $r_tampil_anggota['foto'];
		?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $r_tampil_anggota['idanggota']; ?></td>
			<td><?php echo $r_tampil_anggota['nama']; ?></td>
			<td><img src="images/<?php echo $foto; ?>" width=70px height=70px></td>
			<td><?php echo $r_tampil_anggota['jeniskelamin']; ?></td>
			<td><?php echo $r_tampil_anggota['alamat']; ?></td>
			<td>

			<div class="btn-group" role="group" arial-label="basic example">
				<a target="_blank" href="pages/cetak_kartu.php?id=<?php echo $r_tampil_anggota['idanggota'];?>" class="btn btn-sm btn-success"><i class="fas fa-fw fa-print"></i></a>
				<a href="index.php?p=anggota-edit&id=<?php echo $r_tampil_anggota['idanggota'];?>" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-edit"></i></a>
				<a href="proses/anggota-hapus.php?id=<?php echo $r_tampil_anggota['idanggota']; ?>" onclick = "return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i></a>
			</div>
			</td>			
		</tr>		
				
			</tbody>
		
	
	
		
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
		<div style="float: right;">		
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
						echo "<a href=\"?p=anggota&hal=$i\">$i</a>";
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