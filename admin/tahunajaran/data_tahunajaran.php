<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Tahun Ajaran</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
					<a href="?page=add-tahunajaran" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Tahun Ajaran</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Tahun ajaran</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
			  $sql = $koneksi->query("SELECT * FROM tb_tahun_ajaran ORDER BY id_tahun_ajaran DESC");
              while ($data= $sql->fetch_assoc()) {
              $status =$data['status'];
            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['tahun_ajaran']; ?>
						</td>
						<td>
			                 <?php if ($status=="aktif") { ?>
			                   <a href="#" class="btn btn-success" title=""></i>Aktif</a>
			                 <?php } else{ ?>  
			                    <a href="?page=aktif-tahunajaran&aksi=aktif&kode=<?php echo $data['id_tahun_ajaran'] ?>" class="btn btn-danger" title=""></i>Aktifkan</a>
			                 <?php } ?>
                 		</td>
						<td>
							<a href="?page=edit-tahunajaran&kode=<?php echo $data['id_tahun_ajaran']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-tahunajaran&kode=<?php echo $data['id_tahun_ajaran']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
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