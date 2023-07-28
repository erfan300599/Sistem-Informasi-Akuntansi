<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Kelas</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_kelas" name="nama_kelas" placeholder="Kelas" required>
				</div>
			</div>

<!-- 			<div class="form-group row">
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
			</div> -->

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-kelas" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
    <?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
    	$nama_kelas=$_POST['nama_kelas'];
			$sql_cek_kelas=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM tb_kelas WHERE nama_kelas='$nama_kelas'"));

    if ($sql_cek_kelas > 0) {
      echo "<script>
      Swal.fire({title: 'Data Kelas Yang Anda Masukkan Sudah Ada!',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-kelas';
          }
      })</script>";
      }else{
      	  $sql_simpan = "INSERT INTO tb_kelas (nama_kelas) VALUES (
            '".$_POST['nama_kelas']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

      if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-kelas';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-kelas';
          }
      })</script>";
    }}}
     //selesai proses simpan data
