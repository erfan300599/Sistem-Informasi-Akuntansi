<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Pembayaran</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_bayar_siswa" name="nama_bayar_siswa" placeholder="Nama Pembayaran" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tipe Pembayaran</label>
				<div class="col-sm-6">
						<select name="tipe_jenis_bayar_siswa" id="tipe_jenis_bayar_siswa" class="form-control" required>
						<option value="" disabled selected>Pilih Tipe Pembayaran</option>
						<option>Bulanan</option>
						<option>Bebas</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tahun Ajaran</label>
				<div class="col-sm-6">
				<select name="id_tahun_ajaran" id="id_tahun_ajaran" class="form-control"  required>
					<?php
					$query= mysqli_query($koneksi, "SELECT * from tb_tahun_ajaran WHERE status='aktif'");
					
					while ($tampil_t=$query->fetch_assoc()) {                                    
           echo "<option value='$tampil_t[id_tahun_ajaran]'> $tampil_t[tahun_ajaran]</option>";
         }
					?>
				</select>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-jenis-bayar-siswa" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
    <?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
      	  $sql_simpan = "INSERT INTO tb_jenis_bayar_siswa (id_tahun_ajaran, nama_bayar_siswa, tipe_jenis_bayar_siswa) VALUES (
            '".$_POST['id_tahun_ajaran']."',
            '".$_POST['nama_bayar_siswa']."',
            '".$_POST['tipe_jenis_bayar_siswa']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

      if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-jenis-bayar-siswa';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-jenis-bayar-siswa';
          }
      })</script>";
    }}
     //selesai proses simpan data
