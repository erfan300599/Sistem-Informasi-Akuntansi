<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Pembayaran Iuran Lainnya</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
		   <form  action="" method="post"> 
		   	<div class="row">
		    	<div class="col-md-3">    
		    		<div class="form-group"> 	
                       <select class="form-control" name="id_kelas" required="" >
                          <option value="" disabled selected>Pilih Kelas</option>
                              <?php
                               $query = $koneksi->query("SELECT * FROM tb_kelas ORDER by id_kelas");
                                while ($tampil_t=$query->fetch_assoc()) {
                                 echo "<option value='$tampil_t[id_kelas]'> $tampil_t[nama_kelas]</option>";
                             }
                            ?>
                       </select>
                 
               		</div>
          		</div>

          	<div class="col-md-3">    
		    	<div class="form-group"> 	
                    <select class="form-control" name="id_tahun_ajaran" required="" >
                          <option value="" disabled selected>Pilih Tahun Ajaran</option>
                              <?php
                               $query = $koneksi->query("SELECT * FROM tb_tahun_ajaran ORDER by id_tahun_ajaran");
                                while ($tampil_t=$query->fetch_assoc()) {
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
      </div>
      </form>
      </div>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>NISN</th>
						<th>Nama</th>
						<th>Kelas</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					 <?php 

                  if (isset($_POST['filter'])) {
                     		 $id_kelas = $_POST['id_kelas'];
                     		 $id_tahun_ajaran = $_POST['id_tahun_ajaran'];

                      $no = 1;

                      $sql = $koneksi->query("SELECT * FROM tb_siswa, tb_kelas WHERE tb_siswa.id_kelas=tb_kelas.id_kelas AND tb_siswa.id_kelas='$id_kelas' AND status_siswa='aktif'");

                      while ($data = $sql->fetch_assoc()) {
                        	$jml_data = $sql->num_rows;	
                      
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
							<a href="admin/laporan/siswa/cetak_pembayaran_bebas_per_siswa.php?id_siswa=<?php echo $data['id_siswa'] ?>&id_tahun_ajaran=<?php echo $id_tahun_ajaran ?>" title="Cetak" target="_blank"
							 class="btn btn-primary btn-sm">
								<i class="fa fa-print"></i>
							</a>
						</td>
					</tr>  


					<?php
              } }
            ?>
				</tbody>
				</tfoot>

			</table>
		</div>
	</div>