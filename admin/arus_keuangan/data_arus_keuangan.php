<?php

function uang_indo($angka)
{
  $rupiah = "Rp." . number_format($angka, 2, ',', '.');
  return $rupiah;
}

?>

<div class="card card-info">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fa fa-table"></i> Data Arus Keuangan
    </h3>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <div class="table-responsive">


      <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <form action="" method="post" enctype="multipart/form-data">
              <select class="form-control" name="tahun_ajaran" required="">
                <option value="" disabled selected>Pilih Tahun Ajaran</option>
                <?php
                $query = $koneksi->query("SELECT * FROM tb_tahun_ajaran ORDER by id_tahun_ajaran ASC");
                while ($tampil_t = $query->fetch_assoc()) {
                  echo "<option value='$tampil_t[id_tahun_ajaran]'> $tampil_t[tahun_ajaran]</option>";
                }
                ?>
              </select>

          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <button type="submit" name="filter" class="btn btn-info"> Cari </button>
          </div>
        </div>
        </form>
      </div>


      <br>
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Tahun Ajaran</th>
            <th>Total Pemasukan</th>
            <th>Total Pengeluaran</th>
            <th>Saldo</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

          <?php
          if (isset($_POST['filter'])) {
            $tahun_ajaran = $_POST['tahun_ajaran'];
            // var_dump($tahun_ajaran); 
            $no = 1;
            $sqlta =  $koneksi->query("SELECT * from tb_tahun_ajaran
            WHERE id_tahun_ajaran = '$tahun_ajaran'");
            $sql11 =  $koneksi->query("SELECT * from tb_jenis_bayar_siswa
            WHERE id_tahun_ajaran");
            $sql12 =  $koneksi->query("SELECT * from tb_jenis_bayar_guru
            WHERE id_tahun_ajaran");
            $sql13 =  $koneksi->query("SELECT * from tb_pemasukan_lain
            WHERE id_tahun_ajaran");
            $sql14 =  $koneksi->query("SELECT * from tb_pengeluaran_lain
            WHERE id_tahun_ajaran");
            while (($d1 = $sql11->fetch_assoc()) && ($d2 = $sql12->fetch_assoc()) && ($d3 = $sql13->fetch_assoc()) && ($d4 = $sql14->fetch_assoc()) && ($dta = $sqlta->fetch_assoc())) {
              //Bulanan Guru
              $sql = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_jenis_bayar_guru.nama_bayar_guru, tb_tagihan_bulanan_guru.id_jenis_bayar_guru, Sum(tb_tagihan_bulanan_guru.terbayar) AS jml_terbayar from tb_jenis_bayar_guru
                          
                        INNER JOIN tb_tagihan_bulanan_guru ON tb_tagihan_bulanan_guru.id_jenis_bayar_guru = tb_jenis_bayar_guru.id_jenis_bayar_guru
                        INNER JOIN tb_tahun_ajaran ON tb_jenis_bayar_guru.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran

                        INNER JOIN tb_guru ON tb_tagihan_bulanan_guru.id_guru = tb_guru.id_guru
                        WHERE tb_jenis_bayar_guru.id_tahun_ajaran = '$tahun_ajaran'");

              //Pengeluaran Lain
              $sql5 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_pengeluaran_lain.nama_pengeluaran, tb_pengeluaran_lain.id_pengeluaran, Sum(tb_pengeluaran_lain.terbayar) AS jml_terbayar5 from tb_pengeluaran_lain
                          
                        INNER JOIN tb_tahun_ajaran ON tb_pengeluaran_lain.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran
                        WHERE tb_pengeluaran_lain.id_tahun_ajaran ='$tahun_ajaran'");


              //Bulanan Siswa
              $sql2 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_jenis_bayar_siswa.nama_bayar_siswa, tb_tagihan_bulanan_siswa.id_jenis_bayar_siswa, Sum(tb_tagihan_bulanan_siswa.terbayar) AS jml_terbayar2 from tb_jenis_bayar_siswa
                          
                        INNER JOIN tb_tagihan_bulanan_siswa ON tb_tagihan_bulanan_siswa.id_jenis_bayar_siswa = tb_jenis_bayar_siswa.id_jenis_bayar_siswa
                        INNER JOIN tb_tahun_ajaran ON tb_jenis_bayar_siswa.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran

                        INNER JOIN tb_siswa ON tb_tagihan_bulanan_siswa.id_siswa = tb_siswa.id_siswa
                        INNER JOIN tb_kelas ON tb_tagihan_bulanan_siswa.id_kelas = tb_kelas.id_kelas
                        WHERE tb_jenis_bayar_siswa.id_tahun_ajaran = '$tahun_ajaran'");

              //Bebas Siswa
              $sql3 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_jenis_bayar_siswa.nama_bayar_siswa, tb_tagihan_bebas_siswa.id_jenis_bayar_siswa, Sum(tb_tagihan_bebas_siswa.terbayar) AS jml_terbayar3 from tb_jenis_bayar_siswa
                          
                        INNER JOIN tb_tagihan_bebas_siswa ON tb_tagihan_bebas_siswa.id_jenis_bayar_siswa = tb_jenis_bayar_siswa.id_jenis_bayar_siswa
                        INNER JOIN tb_tahun_ajaran ON tb_jenis_bayar_siswa.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran

                        INNER JOIN tb_siswa ON tb_tagihan_bebas_siswa.id_siswa = tb_siswa.id_siswa
                        INNER JOIN tb_kelas ON tb_tagihan_bebas_siswa.id_kelas = tb_kelas.id_kelas
                        WHERE tb_jenis_bayar_siswa.id_tahun_ajaran = '$tahun_ajaran'");

              //Pemasukan Lain
              $sql4 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_pemasukan_lain.nama_pemasukan, tb_pemasukan_lain.id_tahun_ajaran, Sum(tb_pemasukan_lain.terbayar) AS jml_terbayar4 from tb_pemasukan_lain

                        INNER JOIN tb_tahun_ajaran ON tb_pemasukan_lain.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran
                        WHERE tb_pemasukan_lain.id_tahun_ajaran ='$tahun_ajaran'");

              $data = $sql->fetch_assoc();
              $data2 = $sql2->fetch_assoc();
              $data3 = $sql3->fetch_assoc();
              $data4 = $sql4->fetch_assoc();
              $data5 = $sql5->fetch_assoc();

              //Total Pengeluaran
              $terbayar =  $data['jml_terbayar'];
              $terbayar5 =  $data5['jml_terbayar5'];
              $total_pengeluaran = $terbayar + $terbayar5;

              //Total Pemasukan
              $terbayar2 =  $data2['jml_terbayar2'];
              $terbayar3 =  $data3['jml_terbayar3'];
              $terbayar4 =  $data4['jml_terbayar4'];
              $total_pemasukan = $terbayar2 + $terbayar3 + $terbayar4;

              //Total Saldo
              if ($total_pemasukan > $total_pengeluaran) {
                $saldo = $total_pemasukan - $total_pengeluaran;
              } else {
                $saldo = ($total_pemasukan - $total_pengeluaran) * (-1);
              }

          ?>

              <tr>
                <td>
                  <?php echo $no++; ?>
                </td>
                <td>
                  <?php echo $dta['tahun_ajaran']; ?>
                </td>
                <td>
                  <?php echo uang_indo($total_pemasukan); ?>
                </td>
                <td>
                  <?php echo uang_indo($total_pengeluaran); ?>
                </td>
                <td>
                  <?php echo uang_indo($saldo); ?>
                </td>
                <td>
                  <a href="admin/arus_keuangan/cetak_arus_keuangan.php?id_tahun_ajaran=<?php echo $tahun_ajaran ?>" title="Cetak" target="_blank" class="btn btn-primary btn-sm">
                    <i class="fa fa-print"></i>
                  </a>
                </td>
              </tr>

          <?php
            }
          }
          ?>
        </tbody>
        </tfoot>
      </table>
    </div>
  </div>
  <!-- /.card-body -->