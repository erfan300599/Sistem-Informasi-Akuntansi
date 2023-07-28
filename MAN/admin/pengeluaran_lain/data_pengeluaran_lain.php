<?php

	function uang_indo($angka){
    $rupiah="Rp.". number_format($angka,2,',','.');
    return $rupiah;
}

?>

<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Jenis Pengeluaran Lainnya</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
	<div class="row">	
			<div class="col-md-3">
					<a href="?page=add-pengeluaran-lain" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Jenis Pengeluaran Lainnya</a>
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
						<th>Nama Pengeluaran Lainnya</th>
						<th>Jenis Pengeluaran Lainnya</th>
						<th>Tahun Ajaran</th>
						<th>Total Tagihan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
                   if (isset($_POST['filter'])) {
                  		$tahun_ajaran=$_POST['tahun_ajaran'];	 
       				
                     if($tahun_ajaran =="") {
                      $no = 1;
                      $sql = $koneksi->query("SELECT * FROM tb_pengeluaran_lain, tb_tahun_ajaran WHERE tb_pengeluaran_lain.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran AND tb_tahun_ajaran.status='aktif'");
                     }else{
                     	$no = 1;
                      	$sql = $koneksi->query("SELECT * FROM tb_pengeluaran_lain, tb_tahun_ajaran WHERE tb_pengeluaran_lain.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran AND tb_pengeluaran_lain.id_tahun_ajaran='$tahun_ajaran'");
                     }
                      while ($data = $sql->fetch_assoc()) {

            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nama_pengeluaran']; ?>
						</td>
						<td>
							<?php echo $data['jenis_pengeluaran']; ?>
						</td>
						<td>
							<?php echo $data['tahun_ajaran']; ?>
						</td>
						<td><!-- <a  href="?page=setting-pengeluaran&kode=<?php echo $data['id_pengeluaran'] ;?>" title="Setting Pembayaran" class="btn btn-warning sm">
							<i class="fa fa-cogs"></i> Setting Pembayaran
						</a> -->
							<?php echo uang_indo($data['total_tagihan']); ?>
						</td>
						<td>
							<a href="?page=edit-pengeluaran-lain&kode=<?php echo $data['id_pengeluaran']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-pengeluaran-lain&kode=<?php echo $data['id_pengeluaran']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
								<a/>
						</td>
					</tr>

					<?php
              } }else{

                      $no = 1;
                      $sql = $koneksi->query("SELECT * FROM tb_pengeluaran_lain, tb_tahun_ajaran WHERE tb_pengeluaran_lain.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran AND tb_tahun_ajaran.status='aktif'");
                      while ($data = $sql->fetch_assoc()) {

            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nama_pengeluaran']; ?>
						</td>
						<td>
							<?php echo $data['jenis_pengeluaran']; ?>
						</td>
						<td>
							<?php echo $data['tahun_ajaran']; ?>
						</td>
						<td><!-- <a  href="?page=setting-pengeluaran&kode=<?php echo $data['id_pengeluaran'] ;?>" title="Setting Pembayaran" class="btn btn-warning sm">
							<i class="fa fa-cogs"></i> Setting Pembayaran
						</a> -->
						<?php echo uang_indo($data['total_tagihan']); ?>
						</td>
						<td>
							<a href="?page=edit-pengeluaran-lain&kode=<?php echo $data['id_pengeluaran']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-pengeluaran-lain&kode=<?php echo $data['id_pengeluaran']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
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