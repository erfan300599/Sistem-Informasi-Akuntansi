<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Pembayaran Guru
		</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<form action="" method="post">
					<div class="row">
						<!-- <div class="col-md-3">    
		    		<div class="form-group"> 	
                       <select class="form-control" name="id_guru" required="" >
                          <option value="" disabled selected>Pilih Guru</option>
                              <?php
								$query = $koneksi->query("SELECT * FROM tb_guru ORDER by id_guru");
								while ($tampil_t = $query->fetch_assoc()) {
									echo "<option value='$tampil_t[id_guru]'> $tampil_t[nama_guru]</option>";
								}
								?>
                       </select>
                 
               		</div>
          		</div> -->

						<div class="col-md-3">
							<div class="form-group">
								<select class="form-control" name="id_tahun_ajaran" required="">
									<option value="" disabled selected>Pilih Tahun Ajaran</option>
									<?php
									$query = $koneksi->query("SELECT * FROM tb_tahun_ajaran ORDER by id_tahun_ajaran");
									while ($tampil_t = $query->fetch_assoc()) {
										echo "<option value='$tampil_t[id_tahun_ajaran]'> $tampil_t[tahun_ajaran]</option>";
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
						<div class="col-sm-12">
							<a href="admin/laporan/guru/cetak_total.php" class="btn btn-primary" target="_blank">
								<i class="fas fa-print"></i> Cetak Total
							</a>

							<br></br>
						</div>
				</form>
			</div>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>Jabatan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php

					if (isset($_POST['filter'])) {
						// $id_guru = $_POST['id_guru'];
						$id_tahun_ajaran = $_POST['id_tahun_ajaran'];

						$no = 1;

						$sql = $koneksi->query("SELECT * FROM tb_guru WHERE status_guru='aktif' ");

						while ($data = $sql->fetch_assoc()) {
							$jml_data = $sql->num_rows;

					?>


							<tr>
								<td>
									<?php echo $no++; ?>
								</td>
								<td>
									<?php echo $data['nik_guru']; ?>
								</td>
								<td>
									<?php echo $data['nama_guru']; ?>
								</td>
								<td>
									<?php echo $data['jabatan_guru']; ?>
								</td>
								<td>
									<a href="admin/laporan/guru/cetak_pembayaran_gaji_per_guru.php?id_guru=<?php echo $data['id_guru'] ?>&id_tahun_ajaran=<?php echo $id_tahun_ajaran ?>" title="Cetak" target="_blank" class="btn btn-primary btn-sm">
										<i class="fa fa-print"></i>
									</a>
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