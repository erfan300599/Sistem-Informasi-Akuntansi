<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tahun Ajaran</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" placeholder="Tahun Ajaran" required>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-tahunajaran" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
    	$tahun_ajaran=$_POST['tahun_ajaran'];
			$sql_cek_tahunajaran=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_tahun_ajaran WHERE tahun_ajaran='$tahun_ajaran'"));

    if ($sql_cek_tahunajaran > 0) {
      echo "<script>
      Swal.fire({title: 'Data Tahun Ajaran Yang Anda Masukkan Sudah Ada!',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-tahunajaran';
          }
      })</script>";
      }else{
      	$sql_simpan = "INSERT INTO tb_tahun_ajaran (tahun_ajaran, status) VALUES (
        '".$_POST['tahun_ajaran']."',
        'tidak')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

      if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-tahunajaran';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-tahunajaran';
          }
      })</script>";
    }}}
     //selesai proses simpan data
