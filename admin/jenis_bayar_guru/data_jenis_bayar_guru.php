<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Jenis Pembayaran Guru</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
	<div class="row">	
			<div class="col-md-3">
					<a href="?page=add-jenis-bayar-guru" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Jenis Pembayaran Guru</a>
			</div>
			<br>
		<div class="col-md-3">    
		    <div class="form-group"> 	
		    	<form  action="" method="post" enctype="multipart/form-data"> 
                       <select class="form-control" name="tahun_ajaran" required="" >
                          <option value="" disabled selected>Pilih Tahun Ajaran</option>
                              <?php
                               $query = $koneksi->query("SELECT * FROM tb_tahun_ajaran ORDER by id_tahun_ajaran ASC");
                                while ($tampil_t=$query->fetch_assoc()) {
                                 echo "<option value='$tampil_t[id_tahun_ajaran]'> $tampil_t[tahun_ajaran]</option>";
                             }
                            ?>
                       </select>
                 
               </div>
          </div>
          <div class="col-md-3">
          	<div class="form-group">
          		<button type="submit" name="filter" class="btn btn-info"> Cari </button>
          	</div>
          </div>
      </form>
      </div>

			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Pembayaran</th>
						<th>Tipe Pembayaran</th>
						<th>Tahun Ajaran</th>
						<th>Setting Pembayaran</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
                   if (isset($_POST['filter'])) {
                  		$tahun_ajaran=$_POST['tahun_ajaran'];	 
       				
                     if($tahun_ajaran =="") {
                      $no = 1;
                      $sql = $koneksi->query("SELECT * FROM tb_jenis_bayar_guru, tb_tahun_ajaran WHERE tb_jenis_bayar_guru.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran AND tb_tahun_ajaran.status='aktif'");
                     }else{
                     	$no = 1;
                      	$sql = $koneksi->query("SELECT * FROM tb_jenis_bayar_guru, tb_tahun_ajaran WHERE tb_jenis_bayar_guru.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran AND tb_jenis_bayar_guru.id_tahun_ajaran='$tahun_ajaran'");
                     }
                      while ($data = $sql->fetch_assoc()) {

            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nama_bayar_guru']; ?>
						</td>
						<td>
							<?php echo $data['tipe_jenis_bayar_guru']; ?>
						</td>
						<td>
							<?php echo $data['tahun_ajaran']; ?>
						</td>
						<td><a  href="?page=add-bulanan-guru&kode=<?php echo $data['id_jenis_bayar_guru'] ;?>" title="Setting Pembayaran" class="btn btn-warning sm">
							<i class="fa fa-cogs"></i> Setting Pembayaran
						</a>
						</td>
						<td>
							<a href="?page=edit-jenis-bayar-guru&kode=<?php echo $data['id_jenis_bayar_guru']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-jenis-bayar-guru&kode=<?php echo $data['id_jenis_bayar_guru']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
								<a/>
						</td>
					</tr>

					<?php
              } }else{

                      $no = 1;
                      $sql = $koneksi->query("SELECT * FROM tb_jenis_bayar_guru, tb_tahun_ajaran WHERE tb_jenis_bayar_guru.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran AND tb_tahun_ajaran.status='aktif'");
                      while ($data = $sql->fetch_assoc()) {

            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nama_bayar_guru']; ?>
						</td>
						<td>
							<?php echo $data['tipe_jenis_bayar_guru']; ?>
						</td>
						<td>
							<?php echo $data['tahun_ajaran']; ?>
						</td>
						<td><a  href="?page=add-bulanan-guru&kode=<?php echo $data['id_jenis_bayar_guru'] ;?>" title="Setting Pembayaran" class="btn btn-warning sm">
							<i class="fa fa-cogs"></i> Setting Pembayaran
						</a>
						</td>
						<td>
							<a href="?page=edit-jenis-bayar-guru&kode=<?php echo $data['id_jenis_bayar_guru']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-jenis-bayar-guru&kode=<?php echo $data['id_jenis_bayar_guru']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
								<a/>
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
	<!-- /.card-body -->