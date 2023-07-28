<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" placeholder="Jurusan" required>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-jurusan" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
    	$nama_jurusan=$_POST['nama_jurusan'];
			$sql_cek_jurusan=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_jurusan WHERE nama_jurusan='$nama_jurusan'"));

    if ($sql_cek_jurusan > 0) {
      echo "<script>
      Swal.fire({title: 'Data Jurusan Yang Anda Masukkan Sudah Ada!',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-jurusan';
          }
      })</script>";
      }else{
      	$sql_simpan = "INSERT INTO tb_jurusan (nama_jurusan) VALUES (
        '".$_POST['nama_jurusan']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

      if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-jurusan';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-jurusan';
          }
      })</script>";
    }}}
     //selesai proses simpan data
