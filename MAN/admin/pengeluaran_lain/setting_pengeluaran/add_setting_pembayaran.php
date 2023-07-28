<?php
$id_pengeluaran = $_GET['kode'];
	
	$sql = $koneksi->query("SELECT * FROM tb_pengeluaran_lain, tb_tahun_ajaran WHERE tb_pengeluaran_lain.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran and tb_pengeluaran_lain.id_pengeluaran ='$id_pengeluaran'");
	$data = $sql->fetch_assoc();


	function uang_indo($angka){
    $rupiah="Rp.". number_format($angka,2,',','.');
    return $rupiah;
}

?>



<!-- Form Pertama -->
<div class="card card-warning">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Input Pembayaran</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Pengeluaran</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_pengeluaran" name="nama_pengeluaran" value="<?php echo $data['nama_pengeluaran'] ?>" readonly>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jenis Pengeluaran</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="jenis_pengeluaran" name="jenis_pengeluaran" value="<?php echo $data['jenis_pengeluaran'] ?>" readonly>
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
			<a href="?page=data-pengeluaran-lain" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

 <?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data

    	$id_pengeluaran=$id_pengeluaran;
     	$tarif = $_POST['tarif'];
			$tarif_oke = str_replace(".", "", $tarif);
    
			$sql_cek_tagihan=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_tagihan_pengeluaran WHERE id_pengeluaran='$id_pengeluaran'"));
       
    if($sql_cek_tagihan > 0){
      echo "<script>
       Swal.fire({title: 'Mohon Maaf!',text: 'Data Tagihan Sudah Dibuat Silahkan Cari di Data Tagihan!',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-pengeluaran-lain';
          }
      })</script>";
     }else{
     	 $sql_simpan = "INSERT INTO tb_tagihan_pengeluaran (id_pengeluaran, total_tagihan) VALUES ('$id_pengeluaran', '$tarif_oke')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);
    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-pengeluaran-lain';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-pengeluaran-lain';
          }
      })</script>";
    }}}
     //selesai proses simpan data
?>	
<!-- End Form Pertama -->


<!-- Form Kedua -->
<div class="card card-warning">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Tagihan</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
		   <form  action="" method="post"> 
		   	<div class="row">
		    		<div class="col-md-3">    
		    			<div class="form-group"> 	
                       <select class="form-control" name="id_pengeluaran" required="" >
                          <option value="" disabled selected>Pilih Pengeluaran</option>
                              <?php
                               $query = $koneksi->query("SELECT * FROM tb_pengeluaran_lain ORDER by id_pengeluaran");
                                while ($tampil_t=$query->fetch_assoc()) {
                                 echo "<option value='$tampil_t[id_pengeluaran]'> $tampil_t[nama_pengeluaran]</option>";
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
						<th>Jenis</th>
						<th>Total Tagihan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					 <?php 

                  if (isset($_POST['filter'])) {
                     		 $id_pengeluaran = $_POST['id_pengeluaran'];

                      $no = 1;

                       $sql = $koneksi->query("SELECT * from tb_tagihan_pengeluaran
											INNER JOIN tb_pengeluaran_lain ON tb_tagihan_pengeluaran.id_pengeluaran = tb_pengeluaran_lain.id_pengeluaran
											WHERE tb_tagihan_pengeluaran.id_pengeluaran='$id_pengeluaran'
                      	");


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
							<?php echo uang_indo($data['total_tagihan']) ?>
						</td>
						<td>
							<a href="?page=hapus-pengeluaran&id_tagihan_pengeluaran=<?php echo $data['id_tagihan_pengeluaran']; ?>&id_pengeluaran=<?php echo $id_pengeluaran?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
								<a/>
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
<!-- End Form Kedua -->




