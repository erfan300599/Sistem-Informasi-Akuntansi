<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_pemasukan_lain WHERE id_pemasukan='".$_GET['kode']."'";
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

					<input type="hidden" class="form-control" id="id_pemasukan" name="id_pemasukan" value="<?php echo $data_cek['id_pemasukan']; ?>"
					 readonly/>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Pemasukan</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_pemasukan" name="nama_pemasukan" value="<?php echo $data_cek['nama_pemasukan']; ?>" required>
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

		<div class="form-group row">
				<label class="col-sm-2 col-form-label">Iuran</label>
				<div class="col-sm-6">
				<input type="text" class="form-control" id= "total_tagihan" name="total_tagihan" value="<?php echo $data_cek['total_tagihan']; ?>" required>
				</div>
		</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-pemasukan-lain" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>

<?php

    if (isset ($_POST['Ubah'])){
     $sql_ubah = "UPDATE tb_pemasukan_lain SET 
    id_tahun_ajaran='".$_POST['id_tahun_ajaran']."',
		nama_pemasukan='".$_POST['nama_pemasukan']."',
		total_tagihan='".$_POST['total_tagihan']."'
		WHERE id_pemasukan='".$_POST['id_pemasukan']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-pemasukan-lain';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-pemasukan-lain';
        }
      })</script>";
    }
   }
