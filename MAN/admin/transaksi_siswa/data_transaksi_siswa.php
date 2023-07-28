<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Pembayaran Siswa</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">


			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>NISN</th>
						<th>Nama</th>
						<th>Kelas</th>
						<th>Pembayaran</th>
					</tr>
				</thead>
				<tbody>

					<?php

                      $no = 1;
                       $sql = $koneksi->query("SELECT * FROM tb_siswa, tb_kelas WHERE tb_siswa.id_kelas=tb_kelas.id_kelas ORDER BY tb_siswa.id_siswa DESC");
                      while ($data = $sql->fetch_assoc()) {

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
							<?php echo $data['nama_kelas']; ?>
						</td>
						<td>
							<a href="?page=detail-transaksi-siswa&kode=<?php echo $data['id_siswa']; ?>" title="Detail Pembayaran"
							 class="btn btn-primary btn-sm">
								<i class="fa fa-eye"></i>
							</a>
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