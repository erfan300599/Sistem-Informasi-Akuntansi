<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_siswa WHERE id_siswa='".$_GET['kode']."'";
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

					<input type="hidden" class="form-control" id="id_siswa" name="id_siswa" value="<?php echo $data_cek['id_siswa']; ?>"
					 readonly/>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NISN</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nisn" name="nisn" value="<?php echo $data_cek['nisn']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Lengkap</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $data_cek['nama_siswa']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-6">
					 <select   class="form-control"  name="jenis_kelamin">        
           <option value="Laki-Laki"  <?php if ($data_cek['jenis_kelamin']=='Laki-Laki'){ echo "selected";} ?>>Laki-Laki</option>
           <option value="Perempuan"  <?php if ($data_cek['jenis_kelamin']=='Perempuan'){ echo "selected";} ?>>Perempuan</option>               
         </select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Telepon/WA</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="telepon_siswa" name="telepon_siswa" value="<?php echo $data_cek['telepon_siswa']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Alamat</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="alamat_siswa" name="alamat_siswa" value="<?php echo $data_cek['alamat_siswa']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Kelas</label>
				<div class="col-sm-6">
					 <select   class="form-control"  name="id_kelas">        
          <?php
            $query = $koneksi->query("SELECT * FROM tb_kelas ORDER by id_kelas");                            
           while ($tampil_t=$query->fetch_assoc()) {
            $pilih_t=($tampil_t['id_kelas']==$data_cek['id_kelas']?"selected":"");
            echo "<option value='$tampil_t[id_kelas]' $pilih_t> $tampil_t[nama_kelas]</option>";
             }
         ?>             
         </select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jurusan</label>
				<div class="col-sm-6">
					 <select   class="form-control"  name="id_jurusan">        
          <?php
            $query = $koneksi->query("SELECT * FROM tb_jurusan ORDER by id_jurusan");                            
           while ($tampil_t=$query->fetch_assoc()) {
            $pilih_t=($tampil_t['id_jurusan']==$data_cek['id_jurusan']?"selected":"");
            echo "<option value='$tampil_t[id_jurusan]' $pilih_t> $tampil_t[nama_jurusan]</option>";
             }
         ?>             
         </select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Status</label>
				<div class="col-sm-6">
				 <select   class="form-control"  name="status_siswa">        
           <option value="Aktif"  <?php if ($data_cek['status_siswa']=='Aktif'){ echo "selected";} ?>>Aktif</option>
           <option value="Tidak Aktif"  <?php if ($data_cek['status_siswa']=='Tidak Aktif'){ echo "selected";} ?>>Tidak Aktif</option>               
         </select>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-siswa" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
<?php

    if (isset ($_POST['Ubah'])){
     $sql_ubah = "UPDATE tb_siswa SET 
		nisn='".$_POST['nisn']."',
		nama_siswa='".$_POST['nama_siswa']."',
		jenis_kelamin='".$_POST['jenis_kelamin']."',
		telepon_siswa='".$_POST['telepon_siswa']."',
		alamat_siswa='".$_POST['alamat_siswa']."',
		id_kelas='".$_POST['id_kelas']."',
		id_jurusan='".$_POST['id_jurusan']."',
		status_siswa='".$_POST['status_siswa']."'
		WHERE id_siswa='".$_POST['id_siswa']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-siswa';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-siswa';
        }
      })</script>";
	    }}
