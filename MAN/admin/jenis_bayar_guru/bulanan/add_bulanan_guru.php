<?php
$id_jenis_bayar_guru = $_GET['kode'];
	
	$sql = $koneksi->query("SELECT * FROM tb_jenis_bayar_guru, tb_tahun_ajaran WHERE tb_jenis_bayar_guru.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran and tb_jenis_bayar_guru.id_jenis_bayar_guru ='$id_jenis_bayar_guru'");
	$data = $sql->fetch_assoc();

	$tipe_jenis_bayar_guru = $data['tipe_jenis_bayar_guru'];

	function uang_indo($angka){
    $rupiah="Rp.". number_format($angka,2,',','.');
    return $rupiah;
}


// Jika Tipe Pembayaran Bulanan
	if ($tipe_jenis_bayar_guru=="Bulanan") {
?>

<script>
function copytextbox() {
    document.getElementById('n1').value = document.getElementById('txtFirst').value;
    document.getElementById('n2').value = document.getElementById('txtFirst').value;
    document.getElementById('n3').value = document.getElementById('txtFirst').value;
    document.getElementById('n4').value = document.getElementById('txtFirst').value;
    document.getElementById('n5').value = document.getElementById('txtFirst').value;
    document.getElementById('n6').value = document.getElementById('txtFirst').value;
    document.getElementById('n7').value = document.getElementById('txtFirst').value;
    document.getElementById('n8').value = document.getElementById('txtFirst').value;
    document.getElementById('n9').value = document.getElementById('txtFirst').value;
    document.getElementById('n10').value = document.getElementById('txtFirst').value;
    document.getElementById('n11').value = document.getElementById('txtFirst').value;
    document.getElementById('n12').value = document.getElementById('txtFirst').value;
}
</script>

<!-- Form Pertama -->
<div class="card card-warning">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Pilih Kelas dan Input Pembayaran</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
<div class="row">
	<div class="col-sm-6">
		<br><br>
		<div class="card-body">
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

			<div class="form-group row">
				<label class="col-sm-4 col-form-label">Guru</label>
				<div class="col-sm-6">
				 <select class="form-control" name="id_guru" id="id_guru" required>
          <option value="" disabled selected>Pilih Guru</option>
           <?php
             $query = $koneksi->query("SELECT * FROM tb_guru ORDER by id_guru");
              while ($tampil_t=$query->fetch_assoc()) {
               echo "<option value='$tampil_t[id_guru]'> $tampil_t[nama_guru]</option>";
              }
            ?>
       </select>
			</div>
		</div>

		<div class="form-group row">
				<label class="col-sm-4 col-form-label">Iuran Setiap Bulan</label>
				<div class="col-sm-6">
				<input type="text" class="form-control" name="tarif" id="txtFirst" onkeyup="copytextbox();" autocomplete="off" required>
				</div>
		</div>

	</div>
</div>






<div class="col-sm-6">
		<div class="card-body">
		<div class="row">	
		<div class="col-sm-4">
			<div class="form-group row">
				<div class="col-sm-6">
					<label>Januari</label>
					<input type="text" class="form-control uang" name="n1" id="n1" required>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="form-group row">
				<div class="col-sm-6">
					<label>Februari</label>
					<input type="text" class="form-control uang" name="n2" id="n2" required>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="form-group row">
				<div class="col-sm-6">
					<label>Maret</label>
					<input type="text" class="form-control uang" name="n3" id="n3" required>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="form-group row">
				<div class="col-sm-6">
					<label>April</label>
					<input type="text" class="form-control uang" name="n4" id="n4" required>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="form-group row">
				<div class="col-sm-6">
					<label>Mei</label>
					<input type="text" class="form-control uang" name="n5" id="n5" required>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="form-group row">
				<div class="col-sm-6">
					<label>Juni</label>
					<input type="text" class="form-control uang" name="n6" id="n6" required>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="form-group row">
				<div class="col-sm-6">
					<label>Juli</label>
					<input type="text" class="form-control uang" name="n7" id="n7" required>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="form-group row">
				<div class="col-sm-6">
					<label>Agustus</label>
					<input type="text" class="form-control uang" name="n8" id="n8" required>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="form-group row">
				<div class="col-sm-6">
					<label>September</label>
					<input type="text" class="form-control uang" name="n9" id="n9" required>
				</div>
			</div>
		</div>

	<div class="col-sm-4">
			<div class="form-group row">
				<div class="col-sm-6">
					<label>Oktober</label>
					<input type="text" class="form-control uang" name="n10" id="n10" required>
				</div>
			</div>
		</div>


	<div class="col-sm-4">
			<div class="form-group row">
				<div class="col-sm-6">
					<label>November</label>
					<input type="text" class="form-control uang" name="n11" id="n11" required>
				</div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="form-group row">
				<div class="col-sm-6">
					<label>Desember</label>
					<input type="text" class="form-control uang" name="n12" id="n12" required>
				</div>
			</div>
		</div>

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
    //mulai proses simpan data

		$id_guru = $_POST['id_guru'];

		$sqlGuru=$koneksi->query("SELECT * FROM tb_guru WHERE id_guru NOT IN (SELECT id_guru FROM tb_tagihan_bulanan_guru WHERE id_jenis_bayar_guru='$id_jenis_bayar_guru') AND status_guru='Aktif'");

		$jmlGuru = $sqlGuru->num_rows;
		
		
		//nilai tarif
		$dt1=$_POST['n1'];
		$dt1_oke = str_replace(".", "", $dt1);

		$dt2=$_POST['n2'];
		$dt2_oke = str_replace(".", "", $dt2);

		$dt3=$_POST['n3'];
		$dt3_oke = str_replace(".", "", $dt3);

		$dt4=$_POST['n4'];
		$dt4_oke = str_replace(".", "", $dt4);

		$dt5=$_POST['n5'];
		$dt5_oke = str_replace(".", "", $dt5);

		$dt6=$_POST['n6'];
		$dt6_oke = str_replace(".", "", $dt6);

		$dt7=$_POST['n7'];
		$dt7_oke = str_replace(".", "", $dt7);

		$dt8=$_POST['n8'];
		$dt8_oke = str_replace(".", "", $dt8);

		$dt9=$_POST['n9'];
		$dt9_oke = str_replace(".", "", $dt9);

		$dt10=$_POST['n10'];
		$dt10_oke = str_replace(".", "", $dt10);

		$dt11=$_POST['n11'];
		$dt11_oke = str_replace(".", "", $dt11);

		$dt12=$_POST['n12'];
		$dt12_oke = str_replace(".", "", $dt12);

		if ($jmlGuru==0) {

		  echo "<script>
      Swal.fire({title: 'Mohon Maaf!',text: 'Data Tagihan Sudah Dibuat Silahkan Cari di Data Tagihan!',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location ='index.php?page=add-bulanan-guru&kode=$id_jenis_bayar_guru';
          }
      })</script>";
			
		}else{
			while($ds=$sqlGuru->fetch_assoc()){
			$idGuru = $ds['id_guru'];
			$jmlbulan = 12;
			for($j=1; $j<=$jmlbulan; $j++){
				 if ($j==1) {
          $dt=$dt1_oke;
        }

        if ($j==2) {
            $dt=$dt2_oke;
        }

        if ($j==3) {
         $dt=$dt3_oke;
        }
         if ($j==4) {
         $dt=$dt4_oke;
        }
         if ($j==5) {
         $dt=$dt5_oke;
        }
         if ($j==6) {
         $dt=$dt6_oke;
        }
         if ($j==7) {
         $dt=$dt7_oke;
        }
         if ($j==8) {
         $dt=$dt8_oke;
        }
         if ($j==9) {
         $dt=$dt9_oke;
        }
         if ($j==10) {
         $dt=$dt10_oke;
        }
        if ($j==11) {
         $dt=$dt11_oke;
        }
        if ($j==12) {
         $dt=$dt12_oke;
        }
				$query = $koneksi->query("INSERT INTO tb_tagihan_bulanan_guru (id_jenis_bayar_guru, id_guru, id_bulan, jml_bayar)
									VALUES('$id_jenis_bayar_guru', '$idGuru', '$j', '$dt')");
			}
		}
		 if ($query) {
      echo "<script>
      Swal.fire({title: 'Berhasil',text: 'Data Tagihan Berhasil Ditambahkan',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-bulanan-guru&kode=$id_jenis_bayar_guru';
          }
      })</script>";
      }
    }
     //selesai proses simpan data
	}
?>	
<!-- End Form Pertama -->


<!-- Form Kedua -->
<!-- Lihat Rincian Tagihan Siswa -->
<div class="card card-warning">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Tagihan Guru</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
		   <form  action="" method="post"> 
		   	<div class="row">
		    		<div class="col-md-3">    
		    			<div class="form-group"> 	
                       <select class="form-control" name="id_guru" required="" >
                          <option value="" disabled selected>Pilih Guru</option>
                              <?php
                               $query = $koneksi->query("SELECT * FROM tb_guru ORDER by id_guru");
                                while ($tampil_t=$query->fetch_assoc()) {
                                 echo "<option value='$tampil_t[id_guru]'> $tampil_t[nama_guru]</option>";
                             }
                            ?>
                       </select>
                 
               </div>
          </div>
          <div class="col-md-6">
          	<div class="form-group">
          		<button type="submit" name="filter" class="btn btn-info"> Cari </button>
          	</div>
          </div>
      </div>
      </form>
      </div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>Jabatan</th>
						<th>Total Tagihan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					 <?php 

                  if (isset($_POST['filter'])) {
                     		 $id_guru = $_POST['id_guru'];

                      $no = 1;

                      $sql = $koneksi->query("SELECT tb_guru.nik_guru, tb_guru.id_guru, tb_guru.nama_guru, tb_guru.jabatan_guru, sum(tb_tagihan_bulanan_guru.jml_bayar) as jml_bayar_oke from tb_tagihan_bulanan_guru
													
											INNER JOIN tb_guru ON tb_tagihan_bulanan_guru.id_guru = tb_guru.id_guru
											WHERE tb_tagihan_bulanan_guru.id_jenis_bayar_guru='$id_jenis_bayar_guru'
											AND tb_tagihan_bulanan_guru.id_guru='$id_guru'
                      GROUP BY tb_guru.id_guru	
                      	");


                      while ($data = $sql->fetch_assoc()) {
                        
                      
                   ?>


					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nik_guru']; ?>
						</td>
						<td>
							<?php echo $data['nama_guru']; ?>
						</td>
						<td>
							<?php echo $data['jabatan_guru']; ?>
						</td>
						<td>
							<?php echo uang_indo($data['jml_bayar_oke']) ?>
						</td>
						<td>
							<a href="?page=hapus-bulanan-guru&id_guru=<?php echo $data['id_guru']; ?>&id_jenis_bayar_guru=<?php echo $id_jenis_bayar_guru?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
								<a/>
							<a href="?page=edit-bulanan-guru&kode=<?php echo $data['id_guru']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
								<a href="#" type="button" class="btn btn-primary btn-sm" title="Detail Tagihan Guru" data-toggle="modal" data-target="#mymodal<?php echo $data['id_guru']; ?>"><i class="fa fa-eye"></i></a>
						</td>
					</tr>


						<!-- Modal -->
                 <div class="modal fade" role="dialog" id="mymodal<?php echo $data['id_guru']; ?>">
    								<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
										 <div class="modal-header bg-primary">
										          <h4 class="modal-title text text-white"><i class="icon fa fa-info-circle" aria-hidden="true"></i> Data Tagihan</h4>
										          <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
										    </div>
										    <div class="modal-body">
                        <?php 
                          $id_guru = $data['id_guru'];
                          $nama_guru = $data['nama_guru'];
                          $nik_guru = $data['nik_guru'];
                          ?>

								<div class="row">
                      <div class="col-md-12">  
                     <div class="row">
                         <div class="col-md-6">
                          <div class="form-group">
                            <label>NIK</label>
                            <input  type="text" name="nis" class="form-control" value="<?php echo  $nik_guru; ?>" readonly>      
                          </div>
                         </div> 

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Nama Guru</label>
                              <input  type="text" name="nis" class="form-control" value="<?php echo  $nama_guru; ?>" readonly>      
                            </div>
                          </div>
                         </div>
                     </div>   

                          <?php

                          $sql2 = $koneksi->query("select * from tb_tagihan_bulanan_guru, tb_bulan, tb_jenis_bayar_guru, tb_tahun_ajaran, tb_guru where tb_tagihan_bulanan_guru.id_jenis_bayar_guru=tb_jenis_bayar_guru.id_jenis_bayar_guru and tb_tahun_ajaran.id_tahun_ajaran=tb_jenis_bayar_guru.id_tahun_ajaran and
                            tb_tagihan_bulanan_guru.id_guru=tb_guru.id_guru and
                            tb_tagihan_bulanan_guru.id_bulan = tb_bulan.id_bulan and
                            tb_tagihan_bulanan_guru.id_guru='$id_guru' and tb_tagihan_bulanan_guru.id_jenis_bayar_guru='$id_jenis_bayar_guru' ORDER BY tb_bulan.urutan ASC");

                         while ($data2 = $sql2->fetch_assoc()) {
                          $status=$data2['status_bayar'] ;
                            if ($status==0) {
                              $status_t="Belum Lunas";
                              $color = "red";
                            }else{
                              $status_t="Lunas";
                              $color = "green";
                            }
                         ?>

                    <div class="col-md-12">   
                    <div class="row"> 
                      <div class="col-md-4">
                        <div class="form-group"  style="color: <?php echo $color ?>">
                          <label>Bulan</label>
                          <input  style="color: <?php echo $color ?>" type="text" name="nis" class="form-control" value="<?php echo $data2['nama_bulan']; ?>" required disabled>      
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group"  style="color: <?php echo $color ?>">
                          <label>Jumlah Tagihan</label>
                          <input  style="color: <?php echo $color ?>" type="text" name="nis" class="form-control" value="<?php echo uang_indo($data2['jml_bayar']) ?>" required disabled>      
                        </div>
                      </div>

                       <div class="col-md-4">
                        <div class="form-group" style="color: <?php echo $color ?>">
                          <label>Status</label>
                          <input  style="color: <?php echo $color ?>" type="text" name="nis" class="form-control" value="<?php echo $status_t ?>" required disabled>      
                        </div> 
                      </div>
                    </div> 
                    </div> 

                         <?php } ?> 

                      </div>
                    </div>
                      <div class="modal-footer">
                         <button type="button" class="btn btn-block btn-danger btn-lg" data-dismiss="modal">Close</button>
                      </div>
                            </div>

    </div>
  </div>

					<!-- End Modal -->

					<?php
              } }
            ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- End Lihat Rincian Tagihan Siswa -->
	<!-- End Form Kedua -->


<!-- Jika Tipe Pembayaran Bebas  -->
<?php }  else{ ?>

<!-- Form Pertama -->
<div class="card card-warning">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Pilih Kelas dan Input Pembayaran</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Pembayaran</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_bayar_guru" name="nama_bayar_guru" value="<?php echo $data['nama_bayar_guru'] ?>" readonly>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tahun Ajaran</label>
				<div class="col-sm-6">
						<input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="<?php echo $data['tahun_ajaran'] ?>" readonly>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tipe Pembayaran</label>
				<div class="col-sm-6">
				<input type="text" class="form-control" id="tipe_jenis_bayar_guru" name="tipe_jenis_bayar_guru" value="<?php echo $data['tipe_jenis_bayar_guru'] ?>" readonly>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Guru</label>
				<div class="col-sm-6">
				 <select class="form-control" name="id_guru" id="id_guru" required>
          <option value="" disabled selected>Pilih Guru</option>
           <?php
             $query = $koneksi->query("SELECT * FROM tb_guru ORDER by id_guru");
              while ($tampil_t=$query->fetch_assoc()) {
               echo "<option value='$tampil_t[id_guru]'> $tampil_t[nama_guru]</option>";
              }
            ?>
       </select>
			</div>
		</div>

		<div class="form-group row">
				<label class="col-sm-2 col-form-label">Iuran</label>
				<div class="col-sm-6">
				<input type="text" class="form-control" name="tarif" autocomplete="off" required>
				</div>
		</div>
	</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-jenis-bayar-guru" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

 <?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data

		$id_jenis_bayar_guru = $id_jenis_bayar_guru;
		$id_guru = $_POST['id_guru'];
		$tarif = $_POST['tarif'];
		$tarif_oke = str_replace(".", "", $tarif);

		$sqlGuru=$koneksi->query("SELECT * FROM tb_guru WHERE id_guru NOT IN (SELECT id_guru FROM tb_tagihan_bebas_guru WHERE id_jenis_bayar_guru='$id_jenis_bayar_guru') AND status_guru='Aktif'");

		$jmlGuru = $sqlGuru->num_rows;

		if ($jmlGuru==0) {

		  echo "<script>
      Swal.fire({title: 'Mohon Maaf!',text: 'Data Tagihan Sudah Dibuat Silahkan Cari di Data Tagihan!',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-bulanan-guru&kode=$id_jenis_bayar_guru';
          }
      })</script>";
			
		}else{
			while($ds=$sqlGuru->fetch_assoc()){
			$idGuru = $ds['id_guru'];
		
			$query= $koneksi->query("INSERT INTO tb_tagihan_bebas_guru(id_jenis_bayar_guru, id_guru, total_tagihan)
									VALUES('$id_jenis_bayar_guru', '$idGuru', '$tarif_oke')");
			}
		}
		 if ($query) {
      echo "<script>
      Swal.fire({title: 'Berhasil',text: 'Data Tagihan Berhasil Ditambahkan',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-bulanan-guru&kode=$id_jenis_bayar_guru';
          }
      })</script>";
      }
    }
     //selesai proses simpan data
?>	
<!-- End Form Pertama -->


<!-- Form Kedua -->
<div class="card card-warning">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Tagihan Guru</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
		   <form  action="" method="post"> 
		   	<div class="row">
		    		<div class="col-md-3">    
		    			<div class="form-group"> 	
                       <select class="form-control" name="id_guru" required="" >
                          <option value="" disabled selected>Pilih Guru</option>
                              <?php
                               $query = $koneksi->query("SELECT * FROM tb_guru ORDER by id_guru");
                                while ($tampil_t=$query->fetch_assoc()) {
                                 echo "<option value='$tampil_t[id_guru]'> $tampil_t[nama_guru]</option>";
                             }
                            ?>
                       </select>
                 
               </div>
          </div>
          <div class="col-md-6">
          	<div class="form-group">
          		<button type="submit" name="filter" class="btn btn-info"> Cari </button>
          	</div>
          </div>
      </div>
      </form>
      </div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>Jabatan</th>
						<th>Total Tagihan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					 <?php 

                  if (isset($_POST['filter'])) {
                     		 $id_guru = $_POST['id_guru'];

                      $no = 1;


                      $sql = $koneksi->query("SELECT * from tb_tagihan_bebas_guru
													
											INNER JOIN tb_guru ON tb_tagihan_bebas_guru.id_guru = tb_guru.id_guru
											WHERE tb_tagihan_bebas_guru.id_jenis_bayar_guru='$id_jenis_bayar_guru'
											AND tb_tagihan_bebas_guru.id_guru='$id_guru' GROUP BY tb_guru.id_guru	
                      	");


                      while ($data = $sql->fetch_assoc()) {
                        
                      
                   ?>


					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nik_guru']; ?>
						</td>
						<td>
							<?php echo $data['nama_guru']; ?>
						</td>
						<td>
							<?php echo $data['jabatan_guru']; ?>
						</td>
						<td>
							<?php echo uang_indo($data['total_tagihan']) ?>
						</td>
						<td>
							<a href="?page=hapus-bebas-guru&id_tagihan_bebas_guru=<?php echo $data['id_tagihan_bebas_guru']; ?>&id_jenis_bayar_guru=<?php echo $id_jenis_bayar_guru?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
								<a/>
						</td>
					</tr>

					<?php
              } }
            ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
<!-- End Form Kedua -->

<?php } ?>	


