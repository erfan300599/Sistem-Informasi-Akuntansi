<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_jurusan WHERE id_jurusan='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
}
?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

					<input type="hidden" class="form-control" id="id_jurusan" name="id_jurusan" value="<?php echo $data_cek['id_jurusan']; ?>"
					 readonly/>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="<?php echo $data_cek['nama_jurusan']; ?>" required>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-jurusan" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<?php

    if (isset ($_POST['Ubah'])){

     $sql_ubah = "UPDATE tb_jurusan SET 
		nama_jurusan='".$_POST['nama_jurusan']."'
		WHERE id_jurusan='".$_POST['id_jurusan']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-jurusan';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-jurusan';
        }
      })</script>";
    }
   }
