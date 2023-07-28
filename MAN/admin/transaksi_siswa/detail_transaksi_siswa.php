<?php

 $id_siswa = $_GET['kode'];
  
  $sql = $koneksi->query("SELECT * FROM tb_siswa, tb_kelas WHERE tb_siswa.id_kelas=tb_kelas.id_kelas AND tb_siswa.id_siswa='$id_siswa'");
  $data = $sql->fetch_assoc();
  $nisn = $data['nisn'];

  	function uang_indo($angka){
    $rupiah="Rp.". number_format($angka,2,',','.');
    return $rupiah;
}
?>

<!-- Data Siswa -->
<div class="row">
<div class="col-sm-12">
<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Data Siswa</h3>
	</div>
		<div class="card-body">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NISN</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nisn" name="nisn" value="<?php echo $nisn ; ?>" readonly>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $data['nama_siswa'] ; ?>" readonly>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Kelas</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?php echo $data['nama_kelas'] ; ?>" readonly>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tahun Ajaran</label>
				<div class="col-sm-6">
					<input type="text" class="form-control"  value="Semua Tahun Ajaran" readonly>
				</div>
			</div>

		</div>
</div>
</div>
<!-- End Data Siswa -->

<!-- Iuran Bebas -->
<div class="col-sm-12">
	<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Data Iuran Lain - Lain</h3>
	</div>

	<!-- Tabel -->
	<div class="card-body">
		<div class="table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
				<tr>
				  <th>No</th>
                  <th>Tahun Ajaran</th>
                  <th>Jenis Pembayaran</th>
                  <th>Total Iuran</th>
                  <th>Iuran Dibayar</th>
                  <th>Sisa Iuran </th>
                  <th>Aksi </th>
				</tr>
				</thead>
				<tbody>

					<?php

                      $no = 1;
                    $sql2 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_jenis_bayar_siswa.nama_bayar_siswa, tb_tagihan_bebas_siswa.id_jenis_bayar_siswa, Sum(tb_tagihan_bebas_siswa.total_tagihan) AS jmlTagihanBulanan2, Sum(tb_tagihan_bebas_siswa.terbayar) AS jml_terbayar2 from tb_jenis_bayar_siswa
                          
                        INNER JOIN tb_tagihan_bebas_siswa ON tb_tagihan_bebas_siswa.id_jenis_bayar_siswa = tb_jenis_bayar_siswa.id_jenis_bayar_siswa
                        INNER JOIN tb_tahun_ajaran ON tb_jenis_bayar_siswa.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran

                        INNER JOIN tb_siswa ON tb_tagihan_bebas_siswa.id_siswa = tb_siswa.id_siswa
                        INNER JOIN tb_kelas ON tb_tagihan_bebas_siswa.id_kelas = tb_kelas.id_kelas
                        WHERE tb_siswa.nisn='$nisn' GROUP BY tb_jenis_bayar_siswa.id_jenis_bayar_siswa
                          ");
                      while ($data2= $sql2->fetch_assoc()) {
                       $jml_tagihan2 = $data2['jmlTagihanBulanan2'];
                      $terbayar2 =  $data2['jml_terbayar2'];
                      $sisa2 = $jml_tagihan2-$terbayar2;

            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data2['tahun_ajaran']; ?>
						</td>
						<td>
							<?php echo $data2['nama_bayar_siswa']; ?>
						</td>
						<td>
							<?php echo uang_indo($data2['jmlTagihanBulanan2']) ?>
						</td>
						<td>
							<?php echo uang_indo($data2['jml_terbayar2']) ?>
						</td>
						<td>
							<?php echo uang_indo($sisa2) ?>
						</td>
						<td>
							<a href="?page=transaksi-bebas-siswa&nisn=<?php echo $nisn ;?>&id_jenis_bayar_siswa=<?php echo $data2['id_jenis_bayar_siswa'] ?>&id_tahun_ajaran=<?php echo $data2['id_tahun_ajaran']; ?>" title="Detail Pembayaran"
							 class="btn btn-primary btn-sm">
								<i class="fa fa-eye"></i>
							</a>
						</td>
					</tr>

					<?php
              }
            ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- End Tabel -->
</div>
</div>
<!-- End Iuran Bebas -->


<!-- Iuran Bulanan -->
<div class="col-sm-12">
	<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Data Iuran Bulanan</h3>
	</div>

	<!-- Tabel -->
	<div class="card-body">
		<div class="table-responsive">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
				  <th>No</th>
                  <th>Tahun Ajaran</th>
                  <th>Jenis Pembayaran</th>
                  <th>Total Iuran</th>
                  <th>Iuran Dibayar</th>
                  <th>Sisa Iuran </th>
                  <th>Aksi </th>
					</tr>
				</thead>
				<tbody>

					<?php

                      $no = 1;
                     $sql = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_jenis_bayar_siswa.nama_bayar_siswa, tb_tagihan_bulanan_siswa.id_jenis_bayar_siswa, Sum(tb_tagihan_bulanan_siswa.jml_bayar) AS jmlTagihanBulanan, Sum(tb_tagihan_bulanan_siswa.terbayar) AS jml_terbayar from tb_jenis_bayar_siswa
                          
                        INNER JOIN tb_tagihan_bulanan_siswa ON tb_tagihan_bulanan_siswa.id_jenis_bayar_siswa = tb_jenis_bayar_siswa.id_jenis_bayar_siswa
                        INNER JOIN tb_tahun_ajaran ON tb_jenis_bayar_siswa.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran

                        INNER JOIN tb_siswa ON tb_tagihan_bulanan_siswa.id_siswa = tb_siswa.id_siswa
                        INNER JOIN tb_kelas ON tb_tagihan_bulanan_siswa.id_kelas = tb_kelas.id_kelas
                        WHERE tb_siswa.nisn='$nisn' GROUP BY tb_jenis_bayar_siswa.id_jenis_bayar_siswa
                          ");
                      while ($data = $sql->fetch_assoc()) {
                      	
                      $jml_tagihan = $data['jmlTagihanBulanan'];
                      $terbayar =  $data['jml_terbayar'];
                      $sisa = $jml_tagihan-$terbayar;

            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['tahun_ajaran']; ?>
						</td>
						<td>
							<?php echo $data['nama_bayar_siswa']; ?>
						</td>
						<td>
							<?php echo uang_indo($data['jmlTagihanBulanan']) ?>
						</td>
						<td>
							<?php echo uang_indo($data['jml_terbayar']) ?>
						</td>
						<td>
							<?php echo uang_indo($sisa) ?>
						</td>
						<td>
							<a href="?page=transaksi-bulanan-siswa&nisn=<?php echo $nisn ;?>&id_jenis_bayar_siswa=<?php echo $data['id_jenis_bayar_siswa'] ?>&id_tahun_ajaran=<?php echo $data['id_tahun_ajaran']; ?>" title="Detail Pembayaran"
							 class="btn btn-primary btn-sm">
								<i class="fa fa-eye"></i>
							</a>
						</td>
					</tr>

					<?php
              }
            ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- End Tabel -->
</div>
</div>
<!-- End Iuran Bulanan -->





</div>
