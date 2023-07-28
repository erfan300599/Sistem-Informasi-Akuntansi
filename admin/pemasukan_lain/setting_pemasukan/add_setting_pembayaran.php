<?php
$id_pemasukan = $_GET['kode'];

$sql = $koneksi->query("SELECT * FROM tb_pemasukan_lain, tb_tahun_ajaran WHERE tb_pemasukan_lain.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran and tb_pemasukan_lain.id_pemasukan ='$id_pemasukan'");
$data = $sql->fetch_assoc();


function uang_indo($angka)
{
	$rupiah = "Rp." . number_format($angka, 2, ',', '.');
	return $rupiah;
}

?>



<!-- Form Pertama -->
<div class="card card-warning">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Input Pembayaran
		</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Pemasukan</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_pemasukan" name="nama_pemasukan" value="<?php echo $data['nama_pemasukan'] ?>" readonly>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tahun Ajaran</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="<?php echo $data['tahun_ajaran'] ?>" readonly>
				</div>
			</div>


			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Iuran</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="tarif" autocomplete="off" required>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-pemasukan-lain" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

if (isset($_POST['Simpan'])) {
	//mulai proses simpan data

	$id_pemasukan = $id_pemasukan;
	$tarif = $_POST['tarif'];
	$tarif_oke = str_replace(".", "", $tarif);

	$sql_cek_tagihan = mysqli_query($koneksi, "SELECT * FROM tb_tagihan_pemasukan WHERE id_pemasukan='$id_pemasukan'");
	$pemasukan = $sql_cek_tagihan->num_rows;
	if ($pemasukan > 0) {
		echo "<script>
       Swal.fire({title: 'Mohon Maaf!',text: 'Data Tagihan Sudah Dibuat Silahkan Cari di Data Tagihan!',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=setting-pemasukan&kode=$id_pemasukan';
          }
      })</script>";
	} else {
		while ($ds = $sql_cek_tagihan->fetch_assoc()) {
			$idPemasukan = $ds['id_pemasukan'];
			$sql_simpan = $koneksi->query("INSERT INTO tb_tagihan_pemasukan (id_pemasukan, total_tagihan) VALUES ('$idPemasukan', '$tarif_oke')");
		}

		if ($sql_simpan) {
			echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=setting-pemasukan&kode=$id_pemasukan';
          }
      })</script>";
		}
	}
}
//selesai proses simpan data
?>
<!-- End Form Pertama -->


<!-- Form Kedua -->
<div class="card card-warning">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Tagihan
		</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<form action="" method="post">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<select class="form-control" name="id_pemasukan" required="">
									<option value="" disabled selected>Pilih Pemasukan</option>
									<?php
									$query = $koneksi->query("SELECT * FROM tb_pemasukan_lain ORDER by id_pemasukan");
									while ($tampil_t = $query->fetch_assoc()) {
										echo "<option value='$tampil_t[id_pemasukan]'> $tampil_t[nama_pemasukan]</option>";
									}
									?>
								</select>

							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<button type="submit" name="filter" class="btn btn-info"> Cari </button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Total Pemasukan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php

					if (isset($_POST['filter'])) {
						$id_pemasukan = $_POST['id_pemasukan'];

						$no = 1;

						$sql = $koneksi->query("SELECT * from tb_tagihan_pemasukan
											INNER JOIN tb_pemasukan_lain ON tb_tagihan_pemasukan.id_pemasukan = tb_pemasukan_lain.id_pemasukan
											WHERE tb_tagihan_pemasukan.id_pemasukan='$id_pemasukan'
                      	");


						while ($data = $sql->fetch_assoc()) {


					?>


							<tr>
								<td>
									<?php echo $no++; ?>
								</td>
								<td>
									<?php echo $data['nama_pemasukan']; ?>
								</td>
								<td>
									<?php echo uang_indo($data['total_tagihan']) ?>
								</td>
								<td>
									<a href="?page=hapus-pemasukan&id_tagihan_pemasukan=<?php echo $data['id_tagihan_pemasukan']; ?>&id_pemasukan=<?php echo $id_pemasukan ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
										<i class="fa fa-trash"></i>
										<a />
								</td>
							</tr>

					<?php
						}
					}
					?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- End Form Kedua -->