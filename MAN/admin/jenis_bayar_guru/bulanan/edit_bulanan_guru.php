<?php 

   $id_guru = $_GET['kode'];
  
  $sql = $koneksi->query("select * from tb_tagihan_bulanan_guru, tb_jenis_bayar_guru, tb_tahun_ajaran, tb_guru where tb_tagihan_bulanan_guru.id_jenis_bayar_guru=tb_jenis_bayar_guru.id_jenis_bayar_guru and tb_tahun_ajaran.id_tahun_ajaran=tb_jenis_bayar_guru.id_tahun_ajaran and
    tb_tagihan_bulanan_guru.id_guru=tb_guru.id_guru and
    tb_tagihan_bulanan_guru.id_guru='$id_guru'");
  $data = $sql->fetch_assoc();

 $nama_bayar_guru = $data['nama_bayar_guru'];
 $tipe_jenis_bayar_guru = $data['tipe_jenis_bayar_guru'];
 $tahun_ajaran = $data['tahun_ajaran'];
 $jabatan_guru = $data['jabatan_guru'];
 $nik_guru = $data['nik_guru'];
 $nama_guru = $data['nama_guru'];

 ?>

<div class="card card-warning">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Data Pembayaran Guru</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
<div class="row">
	<div class="col-sm-6">
		<br>
		<div class="card-body">
			<div class="form-group row">
				<label class="col-sm-4 col-form-label">NIK</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nik_guru" name="nik_guru" value="<?php echo $data['nik_guru'] ?>" readonly>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Nama</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_guru" name="nama_guru" value="<?php echo $data['nama_guru'] ?>" readonly>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Jabatan</label>
				<div class="col-sm-6">
				<input type="text" class="form-control" id="jabatan_guru" name="jabatan_guru" value="<?php echo $data['jabatan_guru'] ?>" readonly>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Nama Pembayaran</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_bayar_guru" name="nama_bayar_guru" value="<?php echo $data['nama_bayar_guru'] ?>" readonly>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Tahun Ajaran</label>
				<div class="col-sm-6">
						<input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="<?php echo $data['tahun_ajaran'] ?>" readonly>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Tipe Pembayaran</label>
				<div class="col-sm-6">
				<input type="text" class="form-control" id="tipe_jenis_bayar_guru" name="tipe_jenis_bayar_guru" value="<?php echo $data['tipe_jenis_bayar_guru'] ?>" readonly>
				</div>
			</div>

	</div>
</div>






<div class="col-sm-6">
		<div class="card-body">
		<div class="row">	
			 <?php
                  $sqlEdit1 = $koneksi->query("SELECT * from tb_tagihan_bulanan_guru
                      
                      
                      INNER JOIN tb_bulan ON tb_tagihan_bulanan_guru.id_bulan = tb_bulan.id_bulan
                      WHERE  tb_tagihan_bulanan_guru.id_guru='$id_guru' ORDER BY tb_bulan.urutan ASC");
                  while($rec=$sqlEdit1->fetch_assoc()){
                  ?>
                  <input type="hidden" name="idt<?php echo $rec['id_bulan']; ?>" value="<?php echo $rec['id_tagihan_bulanan_guru']; ?>" >
		<div class="col-sm-4">
			<div class="form-group row">
				<div class="col-sm-6">
					<label><?php echo $rec['nama_bulan']; ?></label>
					<input type="text"  name="n<?php echo $rec['id_bulan']; ?>" class="form-control uang" value="<?php echo $rec['jml_bayar']; ?>"> 
				</div>
			</div>
		</div>
	<?php } ?>

	</div>
	</div>
</div>
</div>




		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-jenis-bayar-guru" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>
<script type="text/javascript" src="admin/ckeditor/ckeditor.js"></script>
    <?php

    if (isset ($_POST['Simpan'])){
    $nn = 12; // membaca jumlah data bulan
    // looping
    for($i=1; $i<=$nn; $i++){
      $idts = $_POST['idt'.$i];
      $jmlBayar = $_POST['n'.$i];
      $jmlBayar_oke = str_replace(".", "", $jmlBayar);

      $query= $koneksi->query("UPDATE tb_tagihan_bulanan_guru SET jml_bayar='$jmlBayar_oke'
                    WHERE id_tagihan_bulanan_guru='$idts'");
    }
		
		 if ($query) {
      echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-jenis-bayar-guru';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-jenis-bayar-guru';
          }
      })</script>";
      }
    }
     //selesai proses simpan data

?>