<?php

   function uang_indo($angka){
    $rupiah="Rp.". number_format($angka,2,',','.');
    return $rupiah;
}
  $sql = $koneksi->query("SELECT COUNT(id_guru) as guru  from tb_guru");
  while ($data= $sql->fetch_assoc()) {
    $guru=$data['guru'];
  }

  $sql = $koneksi->query("SELECT COUNT(id_siswa) as siswa  from tb_siswa");
  while ($data= $sql->fetch_assoc()) {
    $siswa=$data['siswa'];
  }


$total_pemasukan=0;
$total_pengeluaran=0;
$saldo=0;

   $sql11 =  $koneksi->query("SELECT * from tb_jenis_bayar_siswa,tb_tahun_ajaran
            WHERE tb_jenis_bayar_siswa.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran");
                  $sql12 =  $koneksi->query("SELECT * from tb_jenis_bayar_guru,tb_tahun_ajaran
            WHERE tb_jenis_bayar_guru.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran");
                  $sql13 =  $koneksi->query("SELECT * from tb_pemasukan_lain,tb_tahun_ajaran
            WHERE tb_pemasukan_lain.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran");
                  $sql14 =  $koneksi->query("SELECT * from tb_pengeluaran_lain,tb_tahun_ajaran
            WHERE tb_pengeluaran_lain.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran");
                  while (($d1=$sql11->fetch_assoc()) && ($d2=$sql12->fetch_assoc()) && ($d3=$sql13->fetch_assoc()) && ($d4=$sql14->fetch_assoc())){
        			  $sql = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_jenis_bayar_guru.nama_bayar_guru, tb_tagihan_bulanan_guru.id_jenis_bayar_guru, Sum(tb_tagihan_bulanan_guru.terbayar) AS jml_terbayar from tb_jenis_bayar_guru
                          
                        INNER JOIN tb_tagihan_bulanan_guru ON tb_tagihan_bulanan_guru.id_jenis_bayar_guru = tb_jenis_bayar_guru.id_jenis_bayar_guru
                        INNER JOIN tb_tahun_ajaran ON tb_jenis_bayar_guru.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran

                        INNER JOIN tb_guru ON tb_tagihan_bulanan_guru.id_guru = tb_guru.id_guru
                        WHERE tb_jenis_bayar_guru.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran AND tb_tahun_ajaran.status='aktif'");

                     //Pengeluaran Lain
                      $sql5 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_pengeluaran_lain.nama_pengeluaran, tb_pengeluaran_lain.id_pengeluaran, Sum(tb_pengeluaran_lain.terbayar) AS jml_terbayar5 from tb_pengeluaran_lain
                          
                        INNER JOIN tb_tahun_ajaran ON tb_pengeluaran_lain.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran
                        WHERE tb_pengeluaran_lain.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran AND tb_tahun_ajaran.status='aktif'");


                      //Bulanan Siswa
                       $sql2 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_jenis_bayar_siswa.nama_bayar_siswa, tb_tagihan_bulanan_siswa.id_jenis_bayar_siswa, Sum(tb_tagihan_bulanan_siswa.terbayar) AS jml_terbayar2 from tb_jenis_bayar_siswa
                          
                        INNER JOIN tb_tagihan_bulanan_siswa ON tb_tagihan_bulanan_siswa.id_jenis_bayar_siswa = tb_jenis_bayar_siswa.id_jenis_bayar_siswa
                        INNER JOIN tb_tahun_ajaran ON tb_jenis_bayar_siswa.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran

                        INNER JOIN tb_siswa ON tb_tagihan_bulanan_siswa.id_siswa = tb_siswa.id_siswa
                        INNER JOIN tb_kelas ON tb_tagihan_bulanan_siswa.id_kelas = tb_kelas.id_kelas
                        WHERE tb_jenis_bayar_siswa.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran AND tb_tahun_ajaran.status='aktif'");

                      //Bebas Siswa
                       $sql3 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_jenis_bayar_siswa.nama_bayar_siswa, tb_tagihan_bebas_siswa.id_jenis_bayar_siswa, Sum(tb_tagihan_bebas_siswa.terbayar) AS jml_terbayar3 from tb_jenis_bayar_siswa
                          
                        INNER JOIN tb_tagihan_bebas_siswa ON tb_tagihan_bebas_siswa.id_jenis_bayar_siswa = tb_jenis_bayar_siswa.id_jenis_bayar_siswa
                        INNER JOIN tb_tahun_ajaran ON tb_jenis_bayar_siswa.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran

                        INNER JOIN tb_siswa ON tb_tagihan_bebas_siswa.id_siswa = tb_siswa.id_siswa
                        INNER JOIN tb_kelas ON tb_tagihan_bebas_siswa.id_kelas = tb_kelas.id_kelas
                        WHERE tb_jenis_bayar_siswa.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran AND tb_tahun_ajaran.status='aktif'");

                     //Pemasukan Lain
                      $sql4 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_pemasukan_lain.nama_pemasukan, tb_pemasukan_lain.id_pemasukan, Sum(tb_pemasukan_lain.terbayar) AS jml_terbayar4 from tb_pemasukan_lain

                        INNER JOIN tb_tahun_ajaran ON tb_pemasukan_lain.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran
                        WHERE tb_pemasukan_lain.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran AND tb_tahun_ajaran.status='aktif'");

                     $data = $sql->fetch_assoc();
                     $data2 = $sql2->fetch_assoc();
                     $data3 = $sql3->fetch_assoc();
                     $data4 = $sql4->fetch_assoc();
                     $data5 = $sql5->fetch_assoc();

                      //Total Pengeluaran
                      $terbayar =  $data['jml_terbayar'];
                      $terbayar5 =  $data5['jml_terbayar5'];
                      $total_pengeluaran += ($terbayar + $terbayar5);

                      //Total Pemasukan
                      $terbayar2 =  $data2['jml_terbayar2'];
                      $terbayar3 =  $data3['jml_terbayar3'];
                      $terbayar4 =  $data4['jml_terbayar4'];
                      $total_pemasukan += ($terbayar2 + $terbayar3 + $terbayar4);

                      //Total Saldo
                      if($total_pemasukan > $total_pengeluaran){
                      $saldo += ($total_pemasukan - $total_pengeluaran);
                    }else{
                       $saldo += (($total_pemasukan - $total_pengeluaran)*(-1));
                    }

                  }

?>

<div class="row">
	<!-- Guru -->
	<div class="col-lg-4 col-6">
		<div class="small-box bg-info">
			<div class="inner">
				<h3>
					<?php echo $guru;  ?>
				</h3>

				<p>Total Guru</p>
			</div>
			<div class="icon text-white">
				<i class="ion ion-android-people"></i>
			</div>
						<a href="index.php?page=data-guru" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

	<!-- Siswa -->
	<div class="col-lg-4 col-6">
		<div class="small-box bg-secondary">
			<div class="inner">
				<h3>
					<?php echo $siswa;  ?>
				</h3>

				<p>Total Siswa</p>
			</div>
			<div class="icon text-white">
				<i class="ion ion-android-people"></i>
			</div>
						<a href="index.php?page=data-siswa" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

		<!-- Pemasukan -->
<!-- 	<div class="col-lg-4 col-6">
		<div class="small-box bg-orange">
			<div class="inner">
				<h3>
					<?php echo uang_indo($total_pemasukan);  ?>
				</h3>

				<p>Total Pemasukan</p>
			</div>
			<div class="icon text-white">
				<i class="ion ion-android-people"></i>
			</div>
						<a href="index.php?page=data-arus-keuangan" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div> -->

		<!-- Pengeluaran -->
	<div class="col-lg-4 col-6">
		<div class="small-box bg-danger">
			<div class="inner">
				<h3>
					<?php echo uang_indo($total_pengeluaran);  ?>
				</h3>

				<p>Total Pengeluaran</p>
			</div>
			<div class="icon text-white">
				<i class="ion ion-android-people"></i>
			</div>
						<a href="index.php?page=data-arus-keuangan" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>

			<!-- Saldo -->
	<div class="col-lg-4 col-6">
		<div class="small-box bg-olive">
			<div class="inner">
				<h3>
					<?php echo uang_indo($saldo);  ?>
				</h3>

				<p>Total Saldo</p>
			</div>
			<div class="icon text-white">
				<i class="ion ion-android-people"></i>
			</div>
						<a href="index.php?page=data-arus-keuangan" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>


</div>