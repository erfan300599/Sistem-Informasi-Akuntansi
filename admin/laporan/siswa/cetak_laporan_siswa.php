<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "../../../inc/koneksi.php";
$id_kelas = $_GET['id_kelas'];
$id_jurusan = $_GET['id_jurusan'];

$kelast = $koneksi->query("SELECT * FROM tb_kelas WHERE id_kelas='$id_kelas'");
$datak = $kelast->fetch_assoc();

$kelas_oke = $datak['nama_kelas'];

$jurusant = $koneksi->query("SELECT * FROM tb_jurusan WHERE id_jurusan='$id_jurusan'");
$dataj = $jurusant->fetch_assoc();

$jurusan_oke = $dataj['nama_jurusan'];


$satu_hari        = mktime(0, 0, 0, date("n"), date("j"), date("Y"));

function tglIndonesia($str)
{
  $tr   = trim($str);
  $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
  return $str;
}

?>
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
      <?php $gambar = "../../../admin/gambar/" . $data1['gambar_sekolah']; ?>
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
        <div align="center"><b><?php echo $data1['alamat_sekolah']; ?> <?php echo $data1['kec_sekolah']; ?> <?php echo $data1['keb_sekolah']; ?> <?php echo $data1['prov_sekolah']; ?> Telp. <?php echo $data1['telepon_sekolah']; ?></b></div>
      </td>
    </tr>
  </table>
  <hr>

  <br>



</body>



<table width="100%">
  <tr>
    <td width="0">&nbsp;</td>
    <td colspan="6">
      <div align="center">
        <font size="5"> <strong>Laporan Data Siswa</strong> </font>
      </div>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="100">&nbsp;</td>
    <td width="16">&nbsp;</td>
    <td width="2200">&nbsp;</td>
    <td width="200">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td width="375">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td> <strong> Kelas</td> </strong>
    <td>:</td>
    <td> <strong> <?php echo $kelas_oke ?> </strong> </td>
  </tr>
  <tr>
    <td> &nbsp;</td>
    <td> <strong>Jurusan </strong></td>
    <td>:</td>
    <td> <strong> <?php echo $jurusan_oke ?> </strong> </td>

  </tr>

</table><br>


<table class="tabel" border="1" width="100%">

  <thead>
    <tr>

      <th>No</th>
      <th>NISN</th>
      <th>Nama</th>
      <th>Jenis Kelamin</th>
      <th>Telepon/WA</th>
      <th>Alamat</th>

    </tr>
  </thead>
  <tbody>

    <?php

    $no = 1;

    $sql = $koneksi->query("SELECT tb_siswa.nisn, tb_siswa.nama_siswa, tb_siswa.telepon_siswa, tb_siswa.jenis_kelamin, tb_siswa.alamat_siswa, tb_siswa.status_siswa, tb_kelas.nama_kelas, tb_jurusan.nama_jurusan FROM tb_siswa
                        INNER JOIN tb_kelas ON tb_kelas.id_kelas = tb_siswa.id_kelas
                        INNER JOIN tb_jurusan on tb_jurusan.id_jurusan = tb_siswa.id_jurusan WHERE tb_siswa.id_kelas ='$id_kelas' AND tb_siswa.id_jurusan ='$id_jurusan'");

    while ($data = $sql->fetch_assoc()) {

    ?>


      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $data['nisn'] ?></td>
        <td><?php echo $data['nama_siswa'] ?></td>
        <td><?php echo $data['jenis_kelamin'] ?></td>
        <td><?php echo $data['telepon_siswa'] ?></td>
        <td><?php echo $data['alamat_siswa'] ?></td>


      </tr>

    <?php


    }

    ?>



  </tbody>
</table><br><br><br>

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