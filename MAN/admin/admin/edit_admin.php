<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tb_admin WHERE id_admin='".$_GET['kode']."'";
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

			<input type='hidden' class="form-control" name="id_admin" value="<?php echo $data_cek['id_admin']; ?>"
			 readonly/>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Admin</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_admin" name="nama_admin" value="<?php echo $data_cek['nama_admin']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Username</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="username" name="username" value="<?php echo $data_cek['username']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Password</label>
				<div class="col-sm-6">
					<input type="password" class="form-control" id="pass" name="password" value="<?php echo $data_cek['password']; ?>"
					/>
					<input id="mybutton" onclick="change()" type="checkbox" class="form-checkbox"> Lihat Password
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-admin" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>



<?php

    if (isset ($_POST['Ubah'])){
    $sql_ubah = "UPDATE tb_admin SET
        nama_admin='".$_POST['nama_admin']."',
        username='".$_POST['username']."',
        password='".$_POST['password']."'
        WHERE id_admin='".$_POST['id_admin']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-admin';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-admin';
        }
      })</script>";
    }}
?>

<script type="text/javascript">
    function change()
    {
    var x = document.getElementById('pass').type;

    if (x == 'password')
    {
        document.getElementById('pass').type = 'text';
        document.getElementById('mybutton').innerHTML;
    }
    else
    {
        document.getElementById('pass').type = 'password';
        document.getElementById('mybutton').innerHTML;
    }
    }
</script>