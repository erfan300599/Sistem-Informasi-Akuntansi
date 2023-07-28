<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIK</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nik_guru" name="nik_guru" placeholder="NIK" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_guru" name="nama_guru" placeholder="Nama" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jabatan</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="jabatan_guru" name="jabatan_guru" placeholder="Jabatan" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Alamat</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="alamat_guru" name="alamat_guru" placeholder="Alamat" required>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Telepon</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="telepon_guru" name="telepon_guru" placeholder="Telepon" required>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-guru" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
<?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
    	$nik_guru=$_POST['nik_guru'];
    	$nama_guru=$_POST['nama_guru'];
    	$jabatan_guru=$_POST['jabatan_guru'];
    	$alamat_guru=$_POST['alamat_guru'];
    	$telepon_guru=$_POST['telepon_guru'];
			$sql_cek_gejala=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_guru WHERE nama_guru='$nama_guru'"));
       
    if($sql_cek_gejala > 0){
      echo "<script>
      Swal.fire({title: 'Data Guru Yang Anda Masukkan Sudah Ada!',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-guru';
          }
      })</script>";
     }else{
     	 $sql_simpan = "INSERT INTO tb_guru (nik_guru, nama_guru, jabatan_guru,  alamat_guru, telepon_guru, status_guru) VALUES (
      		'".$_POST['nik_guru']."',
      		'".$_POST['nama_guru']."',
      		'".$_POST['jabatan_guru']."',
      		'".$_POST['alamat_guru']."',
      		'".$_POST['telepon_guru']."',
		'Aktif')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);
    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-guru';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-guru';
          }
      })</script>";
    }}}
     //selesai proses simpan data
