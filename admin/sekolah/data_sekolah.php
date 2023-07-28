<?php

        $sql_cek = "SELECT * FROM tb_sekolah WHERE id_sekolah";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);

   if ($data_cek['gambar_sekolah']) {
      $gambar = "admin/gambar/" . $data_cek['gambar_sekolah'];
    } else {
      $gambar = "admin/gambar/noimage.png";
    }
?>

<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-school"></i> Pengaturan Profil Sekolah</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

					<input type="hidden" class="form-control" id="id_sekolah" name="id_sekolah" value="<?php echo $data_cek['id_sekolah']; ?>"
					 readonly/>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Sekolah</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="<?php echo $data_cek['nama_sekolah']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Yayasan</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="yayasan_sekolah" name="yayasan_sekolah" value="<?php echo $data_cek['yayasan_sekolah']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Alamat</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="alamat_sekolah" name="alamat_sekolah" value="<?php echo $data_cek['alamat_sekolah']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Kecematan</label>
				<div class="col-sm-6">
						<input type="text" class="form-control" id="kec_sekolah" name="kec_sekolah" value="<?php echo $data_cek['kec_sekolah']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Kabupaten</label>
				<div class="col-sm-6">
						<input type="text" class="form-control" id="kab_sekolah" name="kab_sekolah" value="<?php echo $data_cek['kab_sekolah']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Provinsi</label>
				<div class="col-sm-6">
						<input type="text" class="form-control" id="prov_sekolah" name="prov_sekolah"value="<?php echo $data_cek['prov_sekolah']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Telepon</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="telepon_sekolah" name="telepon_sekolah" value="<?php echo $data_cek['telepon_sekolah']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Bendahara</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_bendahara" name="nama_bendahara" value="<?php echo $data_cek['nama_bendahara']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIP</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nip_bendahara" name="nip_bendahara" value="<?php echo $data_cek['nip_bendahara']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Kepala Sekolah</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_kepalasekolah" name="nama_kepalasekolah" value="<?php echo $data_cek['nama_kepalasekolah']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIP</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nip_kepalasekolah" name="nip_kepalasekolah" value="<?php echo $data_cek['nip_kepalasekolah']; ?>"
					/>
			</div>
		</div>

 			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Logo Sekolah</label>
				<div class="col-sm-6">
					<input type="file" class="form-control" id="upload" name="gambar_sekolah" value="<?php echo $data_cek['gambar_sekolah']; ?>"
					/>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label"></label>
				<div class="col-sm-6">
					<img  id="preview" src="<?php echo $gambar; ?>" width="200px">
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="index.php" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
<script>
  function readURL(input) {

    if (input.files &&
      input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#preview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#upload").change(function() {
    readURL(this);
  });

  $(function() {
    CKEDITOR.replace('editor1');
    CKEDITOR.replace('editor2');
    CKEDITOR.replace('editor1a');
    CKEDITOR.replace('editor2a');
  })
</script>
<?php

    if (isset ($_POST['Ubah'])){
   $fileName = $_FILES['gambar_sekolah']['name'];
   if ($fileName) {
 move_uploaded_file($_FILES['gambar_sekolah']['tmp_name'], "admin/gambar/" . $_FILES['gambar_sekolah']['name']);
     $sql_ubah = "UPDATE tb_sekolah SET 
		nama_sekolah='".$_POST['nama_sekolah']."',
		yayasan_sekolah='".$_POST['yayasan_sekolah']."',
		alamat_sekolah='".$_POST['alamat_sekolah']."',
		kec_sekolah='".$_POST['kec_sekolah']."',
		kab_sekolah='".$_POST['kab_sekolah']."',
		prov_sekolah='".$_POST['prov_sekolah']."',
		telepon_sekolah='".$_POST['telepon_sekolah']."',
		nama_bendahara='".$_POST['nama_bendahara']."',
		nip_bendahara='".$_POST['nip_bendahara']."',
		nama_kepalasekolah='".$_POST['nama_kepalasekolah']."',
		nip_kepalasekolah='".$_POST['nip_kepalasekolah']."',
		gambar_sekolah='$fileName'
		WHERE id_sekolah='".$_POST['id_sekolah']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Data Berhasil Disimpan',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-sekolah';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Data Gagal Disimpan',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-sekolah';
        }
      })</script>";
	    } } }
?>