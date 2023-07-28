<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_guru WHERE id_guru='".$_GET['kode']."'";
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

					<input type="hidden" class="form-control" id="id_guru" name="id_guru" value="<?php echo $data_cek['id_guru']; ?>"
					 readonly/>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIK</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nik_guru" name="nik_guru" value="<?php echo $data_cek['nik_guru']; ?>"
					/>
				</div>
			</div>

<script>
  var inputNISN = document.getElementById("nik_guru");
  inputNISN.addEventListener("input", function() {
    this.value = this.value.replace(/[^0-9]/g, "");
  });
</script>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?php echo $data_cek['nama_guru']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jabatan</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="jabatan_guru" name="jabatan_guru" value="<?php echo $data_cek['jabatan_guru']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Alamat</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="alamat_guru" name="alamat_guru" value="<?php echo $data_cek['alamat_guru']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Telepon</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="telepon_guru" name="telepon_guru" value="<?php echo $data_cek['telepon_guru']; ?>"
					/>
				</div>
			</div>

<script>
  var inputNISN = document.getElementById("telepon_guru");
  inputNISN.addEventListener("input", function() {
    this.value = this.value.replace(/[^0-9]/g, "");
  });
</script>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Status</label>
				<div class="col-sm-6">
				 <select   class="form-control"  name="status_guru">        
           <option value="Aktif"  <?php if ($data_cek['status_guru']=='Aktif'){ echo "selected";} ?>>Aktif</option>
           <option value="Tidak Aktif"  <?php if ($data_cek['status_guru']=='Tidak Aktif'){ echo "selected";} ?>>Tidak Aktif</option>               
         </select>
       </div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-guru" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>

<?php

    if (isset ($_POST['Ubah'])){

     $sql_ubah = "UPDATE tb_guru SET
    nik_guru='".$_POST['nik_guru']."', 
		nama_guru='".$_POST['nama_guru']."',
		jabatan_guru='".$_POST['jabatan_guru']."',
		alamat_guru='".$_POST['alamat_guru']."',
		telepon_guru='".$_POST['telepon_guru']."',
		status_guru='".$_POST['status_guru']."'
		WHERE id_guru='".$_POST['id_guru']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-guru';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-guru';
        }
      })</script>";
	    }}
