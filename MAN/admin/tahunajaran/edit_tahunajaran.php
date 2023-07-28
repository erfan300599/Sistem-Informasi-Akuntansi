<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_tahun_ajaran WHERE id_tahun_ajaran='".$_GET['kode']."'";
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

					<input type="hidden" class="form-control" id="id_tahun_ajaran" name="id_tahun_ajaran" value="<?php echo $data_cek['id_tahun_ajaran']; ?>"
					 readonly/>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tahun Ajaran</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="<?php echo $data_cek['tahun_ajaran']; ?>" required>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-tahunajaran" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<?php

    if (isset ($_POST['Ubah'])){

     $sql_ubah = "UPDATE tb_tahun_ajaran SET 
		tahun_ajaran='".$_POST['tahun_ajaran']."',
		status='tidak'
		WHERE id_tahun_ajaran='".$_POST['id_tahun_ajaran']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-tahunajaran';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-tahunajaran';
        }
      })</script>";
    }
   }
