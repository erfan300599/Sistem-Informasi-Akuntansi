<?php 

include "../../../inc/koneksi.php";


$sql = $koneksi->query("SELECT * FROM tb_tahun_ajaran where id_tahun_ajaran='$_GET[id_tahun_ajaran]'");
$ta = $sql->fetch_assoc();
$id_tahun_ajaran = $ta['id_tahun_ajaran'];
$tahun_ajaran = $ta['tahun_ajaran'];


$satu_hari        = mktime(0,0,0,date("n"),date("j"),date("Y"));
       
          function tglIndonesia($str){
             $tr   = trim($str);
             $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
             return $str;
         }

   function uang_indo($angka){
    $rupiah="Rp.". number_format($angka,2,',','.');
    return $rupiah;
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Cetak - Laporan Pembayaran Guru</title>
   <style type="text/css">

      .tabel{border-collapse: collapse;}
      .tabel th{padding: 8px 5px;  background-color:  #cccccc;  }
      .tabel td{padding: 8px 5px;     }
   </style>

   <script>
   

         window.print();
         window.onfocus=function() {window.close();}

</script>

</head>
<body onload="window.print()">

<?php 

    $sql = $koneksi->query("SELECT * FROM tb_sekolah ");

    $data1 = $sql->fetch_assoc();

 ?>

<table width="100%" >
  <tr>
   <tr>
    <?php $gambar="../../../admin/gambar/" . $data1['gambar_sekolah'];?>   
    <td width="10" rowspan="3" valign="top"><img src="<?php echo $gambar;?>" width="140" height="110" /></td>
    <td width="383"><div align="center"><b><?php echo $data1['yayasan_sekolah']; ?></b></div></td>
  </tr>
  <tr>
    <td><div align="center"><font size="5"><b>KOMITE <?php echo $data1['nama_sekolah']; ?></b></font></div></td>
  </tr>
  <tr>
    <td><div align="center"><b><?php echo $data1['alamat_sekolah']; ?> <?php echo $data1['kec_sekolah']; ?> <?php echo $data1['kab_sekolah']; ?> <?php echo $data1['prov_sekolah']; ?>  Telp. <?php echo $data1['telepon_sekolah']; ?></b></div></td>
  </tr>
</table>
<hr>

<br>  


<?php
$sqlGuru= $koneksi->query("SELECT * FROM tb_guru where id_guru='$_GET[id_guru]' AND status_guru='Aktif' ORDER BY nama_guru ASC");
$dtguru=$sqlGuru->fetch_assoc();

$id_guru = $dtguru['id_guru'];
$nik_guru = $dtguru['nik_guru'];
$nama_guru = $dtguru['nama_guru'];
$jabatan_guru = $dtguru['jabatan_guru'];
?>

<div align="center">
<h3>PEMBAYARAN GURU</h3>
</div>

<table width="100%" >

   <tr>
    <td>&nbsp;</td>
    <td width="700">&nbsp;</td>
    <td width="16">&nbsp;</td>
    <td width="2000">&nbsp;</td>
    <td width="500">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td width="375">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="80px">Nama Guru</td>
    <td>:</td>
    <td><?php echo $nama_guru ?></td>
    <td width="20px">Jabatan</td>
    <td>:</td>
    <td><?php echo $jabatan_guru ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>NIK</td>
    <td>:</td>
    <td><?php echo $nik_guru ?></td>
     <td >Tahun Ajaran</td>
    <td>:</td>
    <td><?php echo $tahun_ajaran ?></td>
  </tr>

   
</table>
<br>


<table border="1" width="100%" class="tabel">
   <thead>
      <tr>
         <th>No</th>
         <!-- <th>Jenis Pembayaran</th> -->
         <th>Total Tagihan</th>
         <th>Tagihan Terbayar</th>
         <th>Sisa Tagihan</th>
      </tr>
   </thead>
   <tbody>

         <?php 
         $no=1;
         $jml_tagihan=0;
         $jml_terbayar=0;
         $jml_sisa=0; 
         $sqlJenisBayarGuru =  $koneksi->query("SELECT * from tb_jenis_bayar_guru
            WHERE id_tahun_ajaran='$id_tahun_ajaran' and tipe_jenis_bayar_guru='bulanan'");
               while($djb=$sqlJenisBayarGuru->fetch_assoc()){
                  

            
             $sql = $koneksi->query("SELECT tb_jenis_bayar_guru.nama_bayar_guru, tb_guru.nama_guru, tb_bulan.nama_bulan, tb_bulan.urutan, tb_tagihan_bulanan_guru.jml_bayar, SUM(tb_tagihan_bulanan_guru.jml_bayar) as totaljmlbayar2, SUM(tb_tagihan_bulanan_guru.terbayar) as totalterbayar FROM tb_jenis_bayar_guru 
                 left JOIN tb_tahun_ajaran ON tb_jenis_bayar_guru.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran 
                  
                 left JOIN tb_tagihan_bulanan_guru on tb_tagihan_bulanan_guru.id_jenis_bayar_guru=tb_jenis_bayar_guru.id_jenis_bayar_guru
                  left JOIN tb_guru ON tb_tagihan_bulanan_guru.id_guru=tb_guru.id_guru
                  left JOIN tb_bulan ON tb_tagihan_bulanan_guru.id_bulan = tb_bulan.id_bulan 

                     where 
                     tb_tagihan_bulanan_guru.id_jenis_bayar_guru='$djb[id_jenis_bayar_guru]' and
                     tb_tagihan_bulanan_guru.id_guru='$id_guru' 
                   GROUP BY tb_tagihan_bulanan_guru.id_tagihan_bulanan_guru");

              While ($data = $sql->fetch_assoc()){

               $t_tagihan = $data['totaljmlbayar2'];
               $t_terbayar = $data['totalterbayar'];
               $sisa = $data['totaljmlbayar2']-$data['totalterbayar'];

          ?>


      <tr>
         <td align="center"><?php echo $no++; ?></td>
 <!--         <td><?php echo $djb['nama_bayar_guru']; ?></td>
     -->    <td align="left"><?php echo $data['nama_bulan']; ?>: <?php echo uang_indo($t_tagihan); ?></td>
         <td align="left"><?php echo $data['nama_bulan']; ?>: <?php echo uang_indo($t_terbayar); ?></td>
         <td align="left" style="color: red;"><?php echo $data['nama_bulan']; ?>: <?php echo uang_indo($sisa); ?></td>
      </tr>
         <?php
         $jml_tagihan=$jml_tagihan+$t_tagihan;
         $jml_terbayar=$jml_terbayar+$t_terbayar;
         $jml_sisa = $jml_sisa+$sisa;
      } }
      ?>


      <tr style="background-color: yellow;">     
         <td align="center" style="font-size: 18px; font-weight: bold;" colspan="1">Total</td>
         <td align="left" style="font-weight: bold;"><?php echo uang_indo($jml_tagihan); ?></td>
         <td align="left" style="font-weight: bold;"><?php echo uang_indo($jml_terbayar); ?></td>
         <td align="left" style="color: red; font-weight: bold;"><?php echo uang_indo($jml_sisa); ?></td>
   </tr>

   </tbody>

</table><br>
<?php $tgl=date('Y-m-d'); ?>
<table width="100%">
<tr>
  <td align="center"></td>
  <td align="center" width="200px">
   Adonara, <?php echo tglIndonesia(date('d F Y', strtotime($tgl))) ?>
    <br/>Bendahara,<br/><br/><br/><br/>
    <b><u><?php echo $data1['nama_bendahara']; ?></u><br/><?php echo $data1['nip_bendahara']; ?></b>
  </td>
</tr>
</table>


</body>
</html>