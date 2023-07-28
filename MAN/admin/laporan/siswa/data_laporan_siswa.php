<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Siswa</h3>
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
						<th>Jenis Kelamin</th>
						<th>Telepon/WA</th>
						<th>Alamat</th>
					</tr>
				</thead>
				<tbody>

					 <?php 

                  if (isset($_POST['filter'])) {
                     		 $id_kelas = $_POST['id_kelas'];

                      $no = 1;

                      $sql = $koneksi->query("SELECT * FROM tb_siswa, tb_kelas WHERE tb_siswa.id_kelas=tb_kelas.id_kelas AND tb_siswa.id_kelas='$id_kelas' ");

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
							<?php echo $data['jenis_kelamin']; ?>
						</td>
						<td>
							<?php echo $data['telepon_siswa']; ?>
						</td>
						<td>
							<?php echo $data['alamat_siswa']; ?>
						</td>
					</tr>
  

					<?php
              } 
            ?>
				</tbody>
				</tfoot>
					<?php if ($jml_data !=0) {
               
              ?> 	              
              <div class="form-group">
		                <a target="blank" href="admin/laporan/siswa/cetak_laporan_siswa.php?id_kelas=<?php echo $id_kelas ?>" class="btn btn-primary" title=""><i class="fa fa-print"></i>  Cetak </a>
		          </div>

		       <?php } } ?>   
			</table>
		</div>
	</div>