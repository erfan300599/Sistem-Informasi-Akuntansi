<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Pengeluaran</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_pengeluaran" name="nama_pengeluaran" placeholder="Nama Pengeluaran" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jenis Pengeluaran</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="jenis_pengeluaran" name="jenis_pengeluaran" placeholder="Jenis Pengeluaran" required>
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

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Iuran</label>
				<div class="col-sm-6">
				<input type="text" class="form-control" id= "total_tagihan" name="total_tagihan" required>
				</div>
		</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-pengeluaran-lain" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
    <?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
      	  $sql_simpan = "INSERT INTO tb_pengeluaran_lain (id_tahun_ajaran, nama_pengeluaran, jenis_pengeluaran, total_tagihan) VALUES (
            '".$_POST['id_tahun_ajaran']."',
            '".$_POST['nama_pengeluaran']."',
            '".$_POST['jenis_pengeluaran']."',
          	'".$_POST['total_tagihan']."')";
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
          window.location = 'index.php?page=add-pengeluaran-lain';
          }
      })</script>";
    }}
     //selesai proses simpan data
