<?php

include "../../inc/koneksi.php";
$tahun_ajaran = $_GET['id_tahun_ajaran'];

// $sql = $koneksi->query("SELECT * FROM tb_tahun_ajaran where id_tahun_ajaran='$_GET[id_tahun_ajaran]'");
// $ta = $sql->fetch_assoc();
// $id_tahun_ajaran = $ta['id_tahun_ajaran'];
// $tahun_ajaran = $ta['tahun_ajaran'];


$satu_hari        = mktime(0, 0, 0, date("n"), date("j"), date("Y"));

function tglIndonesia($str)
{
   $tr   = trim($str);
   $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
   return $str;
}

function uang_indo($angka)
{
   $rupiah = "Rp." . number_format($angka, 2, ',', '.');
   return $rupiah;
}

?>
<!DOCTYPE html>
<html>

<head>
   <title>Cetak - Laporan Arus Keuangan</title>
   <style type="text/css">
      .tabel {
         border-collapse: collapse;
      }

      .tabel th {
         padding: 8px 5px;
         background-color: #cccccc;
      }

      .tabel td {
         padding: 8px 5px;
      }
   </style>

   <script>
      window.print();
      window.onfocus = function() {
         window.close();
      }
   </script>

</head>

<body onload="window.print()">

   <?php

   $sql = $koneksi->query("SELECT * FROM tb_sekolah ");

   $data1 = $sql->fetch_assoc();

   ?>

   <table width="100%">
      <tr>
      <tr>
         <?php $gambar = "../../admin/gambar/" . $data1['gambar_sekolah']; ?>
         <td width="10" rowspan="3" valign="top"><img src="<?php echo $gambar; ?>" width="140" height="110" /></td>
         <td width="383">
            <div align="center"><b><?php echo $data1['yayasan_sekolah']; ?></b></div>
         </td>
      </tr>
      <tr>
         <td>
            <div align="center">
               <font size="5"><b>KOMITE <?php echo $data1['nama_sekolah']; ?></b></font>
            </div>
         </td>
      </tr>
      <tr>
         <td>
            <div align="center"><b><?php echo $data1['alamat_sekolah']; ?> <?php echo $data1['kec_sekolah']; ?> <?php echo $data1['kab_sekolah']; ?> <?php echo $data1['prov_sekolah']; ?> Telp. <?php echo $data1['telepon_sekolah']; ?></b></div>
         </td>
      </tr>
   </table>
   <hr>

   <br>

   <div align="center">
      <h3>ARUS KEUANGAN</h3>
   </div>

   <table border="1" width="100%" class="tabel">
      <thead>
         <tr>
            <th>No</th>
            <th>Total Pemasukan</th>
            <th>Total Pengeluaran</th>
            <th>Saldo</th>
         </tr>
      </thead>
      <tbody>

         <?php
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
               <td align="center"><?php echo $no++; ?></td>
               <td align="left"><?php echo uang_indo($total_pemasukan); ?></td>
               <td align="left"><?php echo uang_indo($total_pengeluaran); ?></td>
               <td align="left" style="color: red;"><?php echo uang_indo($saldo); ?></td>
            </tr>
         <?php } ?>
      </tbody>

   </table><br>
   <?php $tgl = date('Y-m-d'); ?>
   <table width="100%">
      <tr>
         <td align="center"></td>
         <td align="center" width="200px">
            Adonara, <?php echo tglIndonesia(date('d F Y', strtotime($tgl))) ?>
            <br />Bendahara,<br /><br /><br /><br />
            <b><u><?php echo $data1['nama_bendahara']; ?></u><br /><?php echo $data1['nip_bendahara']; ?></b>
         </td>
      </tr>
   </table>


</body>

</html>