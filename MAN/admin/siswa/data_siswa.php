<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Siswa</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-siswa" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>NISN</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Alamat</th>
						<th>Telepon/WA</th>
						<th>Ruang Kelas</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
			  $sql = $koneksi->query("SELECT * FROM tb_siswa ORDER BY id_siswa DESC");
              while ($data= $sql->fetch_assoc()) {
              $ruangkelas=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tb_kelas WHERE id_kelas ='$data[id_kelas]'"));
              $jurusan=mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM tb_jurusan WHERE id_jurusan ='$data[id_jurusan]'"));
            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nisn']; ?>
						</td>
						<td>
							<?php echo $data['nama_siswa']; ?>
						</td>
						<td>
							<?php echo $data['jenis_kelamin']; ?>
						</td>
						<td>
							<?php echo $data['telepon_siswa']; ?>
						</td>
						<td>
							<?php echo $data['alamat_siswa']; ?>
						</td>
						<td>
							<?php echo $ruangkelas['nama_kelas']; ?> - <?php echo $jurusan['nama_jurusan']; ?>
						</td>
						<td>
							<?php echo $data['status_siswa']; ?>
						</td>

						<td>
							<a href="?page=edit-siswa&kode=<?php echo $data['id_siswa']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-siswa&kode=<?php echo $data['id_siswa']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
								<a/>
						</td>
					</tr>

					<?php
              }
            ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- /.card-body -->