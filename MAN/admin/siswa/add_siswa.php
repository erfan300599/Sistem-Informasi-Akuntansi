<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NISN</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nisn" name="nisn" placeholder="Nomor Induk Siswa Nasional" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Lengkap</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama Lengkap" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-6">
						<select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
						<option value="" disabled selected>Pilih Jenis Kelamin</option>
						<option>Laki-Laki</option>
						<option>Perempuan</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Telepon/WA</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="telepon_siswa" name="telepon_siswa" placeholder="Nomor Telepon" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Alamat</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="alamat_siswa" name="alamat_siswa" placeholder="Alamat Lengkap" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Kelas</label>
				<div class="col-sm-6">
				<select name="id_kelas" id="id_kelas" class="form-control"  required>
					<option value="" disabled selected>Pilih Kelas</option>
					<?php
					$query= mysqli_query($koneksi, "SELECT * from tb_kelas WHERE id_kelas");
					
					while($row=mysqli_fetch_array($query)){
					?>
					<option value="<?php echo $row['id_kelas']?>"><?php echo $row['nama_kelas']?></option>
					<?php
				}
					?>
				</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Jurusan</label>
				<div class="col-sm-6">
				<select name="id_jurusan" id="id_jurusan" class="form-control"  required>
					<option value="" disabled selected>Pilih Jurusan</option>
					<?php
					$query= mysqli_query($koneksi, "SELECT * from tb_jurusan WHERE id_jurusan");
					
					while($row=mysqli_fetch_array($query)){
					?>
					<option value="<?php echo $row['id_jurusan']?>"><?php echo $row['nama_jurusan']?></option>
					<?php
				}
					?>
				</select>
				</div>
			</div>


			


		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-siswa" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
<?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
    	$nisn=$_POST['nisn'];
    	$nama_siswa=$_POST['nama_siswa'];
    	$jenis_kelamin=$_POST['jenis_kelamin'];
    	$telepon_siswa=$_POST['telepon_siswa'];
    	$alamat_siswa=$_POST['alamat_siswa'];
    	$id_kelas=$_POST['id_kelas'];
    	$id_jurusan=$_POST['id_jurusan'];
			$sql_cek_siswa=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE nisn='$nisn'"));
       
    if($sql_cek_siswa > 0){
      echo "<script>
      Swal.fire({title: 'Data Siswa Yang Anda Masukkan Sudah Ada!',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-siswa';
          }
      })</script>";
     }else{
     	 $sql_simpan = "INSERT INTO tb_siswa (nisn, nama_siswa, jenis_kelamin, telepon_siswa, alamat_siswa, id_kelas, id_jurusan, status_siswa) VALUES (
      		'".$_POST['nisn']."',
      		'".$_POST['nama_siswa']."',
      		'".$_POST['jenis_kelamin']."',
      		'".$_POST['telepon_siswa']."',
      		'".$_POST['alamat_siswa']."',
      		'".$_POST['id_kelas']."',
      		'".$_POST['id_jurusan']."',
      			'Aktif')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);
    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-siswa';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-siswa';
          }
      })</script>";
    }}}
     //selesai proses simpan data
