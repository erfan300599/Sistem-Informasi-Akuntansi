<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_jenis_bayar_siswa WHERE id_jenis_bayar_siswa='".$_GET['kode']."'";
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

					<input type="hidden" class="form-control" id="id_jenis_bayar_siswa" name="id_jenis_bayar_siswa" value="<?php echo $data_cek['id_jenis_bayar_siswa']; ?>"
					 readonly/>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Pembayaran</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_bayar_siswa" name="nama_bayar_siswa" value="<?php echo $data_cek['nama_bayar_siswa']; ?>" required>
				</div>
			</div>

		<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tipe Pembayaran</label>
				<div class="col-sm-6">
					 <select   class="form-control"  name="tipe_jenis_bayar_siswa">        
           <option value="Bulanan"  <?php if ($data_cek['tipe_jenis_bayar_siswa']=='Bulanan'){ echo "selected";} ?>>Bulanan</option>
           <option value="Bebas"  <?php if ($data_cek['tipe_jenis_bayar_siswa']=='Bebas'){ echo "selected";} ?>>Bebas</option>               
         </select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tahun Ajaran</label>
				<div class="col-sm-6">
				 <select   class="form-control"  name="id_tahun_ajaran">        
          <?php
            $query = $koneksi->query("SELECT * FROM tb_tahun_ajaran ORDER by id_tahun_ajaran");                            
           while ($tampil_t=$query->fetch_assoc()) {
            $pilih_t=($tampil_t['id_tahun_ajaran']==$data_cek['id_tahun_ajaran']?"selected":"");
            echo "<option value='$tampil_t[id_tahun_ajaran]' $pilih_t> $tampil_t[tahun_ajaran]</option>";
             }
         ?>             
         </select>
       </div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-jenis-bayar-siswa" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>

<?php

    if (isset ($_POST['Ubah'])){
     $sql_ubah = "UPDATE tb_jenis_bayar_siswa SET 
    id_tahun_ajaran='".$_POST['id_tahun_ajaran']."',
		nama_bayar_siswa='".$_POST['nama_bayar_siswa']."',
		tipe_jenis_bayar_siswa='".$_POST['tipe_jenis_bayar_siswa']."'
		WHERE id_jenis_bayar_siswa='".$_POST['id_jenis_bayar_siswa']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-jenis-bayar-siswa';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-jenis-bayar-siswa';
        }
      })</script>";
    }
   }
