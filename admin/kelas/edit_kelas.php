<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_kelas WHERE id_kelas='".$_GET['kode']."'";
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

					<input type="hidden" class="form-control" id="id_kelas" name="id_kelas" value="<?php echo $data_cek['id_kelas']; ?>"
					 readonly/>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Kelas</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?php echo $data_cek['nama_kelas']; ?>" required>
				</div>
			</div>

<!-- 			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Jurusan</label>
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
			</div> -->

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-kelas" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>

<?php

    if (isset ($_POST['Ubah'])){
     $sql_ubah = "UPDATE tb_kelas SET 
		nama_kelas='".$_POST['nama_kelas']."'
		WHERE id_kelas='".$_POST['id_kelas']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-kelas';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-kelas';
        }
      })</script>";
    }
   }
