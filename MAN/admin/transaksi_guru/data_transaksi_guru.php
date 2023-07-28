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
						<th>NIK</th>
						<th>Nama</th>
						<th>Jabatan</th>
						<th>Pembayaran</th>
					</tr>
				</thead>
				<tbody>

					<?php

                      $no = 1;
                       $sql = $koneksi->query("SELECT * FROM tb_guru ORDER BY tb_guru.id_guru DESC");
                      while ($data = $sql->fetch_assoc()) {

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
							<a href="?page=detail-transaksi-guru&kode=<?php echo $data['id_guru']; ?>" title="Detail Pembayaran"
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