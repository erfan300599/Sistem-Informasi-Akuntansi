<?php

   $nisn = $_GET['nisn'];
   $id_jenis_bayar_siswa = $_GET['id_jenis_bayar_siswa'];
   $id_tahun_ajaran = $_GET['id_tahun_ajaran'];
  
  $sql = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_jenis_bayar_siswa.nama_bayar_siswa, tb_jenis_bayar_siswa.id_jenis_bayar_siswa, tb_jenis_bayar_siswa.id_tahun_ajaran, tb_siswa.nisn, tb_siswa.nama_siswa, tb_siswa.telepon_siswa, tb_kelas.nama_kelas, tb_tagihan_bebas_siswa.id_tagihan_bebas_siswa, tb_tagihan_bebas_siswa.id_jenis_bayar_siswa, Sum(tb_tagihan_bebas_siswa.total_tagihan) AS jmlTagihanBulanan, Sum(tb_tagihan_bebas_siswa.terbayar) AS total_terbayar from tb_jenis_bayar_siswa
                          
                        INNER JOIN tb_tagihan_bebas_siswa ON tb_tagihan_bebas_siswa.id_jenis_bayar_siswa= tb_jenis_bayar_siswa.id_jenis_bayar_siswa
                        INNER JOIN tb_tahun_ajaran ON tb_jenis_bayar_siswa.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran

                        INNER JOIN tb_siswa ON tb_tagihan_bebas_siswa.id_siswa = tb_siswa.id_siswa
                        INNER JOIN tb_kelas ON tb_tagihan_bebas_siswa.id_kelas = tb_kelas.id_kelas
                        WHERE tb_siswa.nisn='$nisn' and tb_jenis_bayar_siswa.id_tahun_ajaran='$id_tahun_ajaran' and tb_jenis_bayar_siswa.id_jenis_bayar_siswa='$id_jenis_bayar_siswa' GROUP BY tb_jenis_bayar_siswa.id_jenis_bayar_siswa
                          ");

  $data = $sql->fetch_assoc();

  $nama_bayar_siswa= $data['nama_bayar_siswa'];
  $nama_siswa = $data['nama_siswa'];
  $keterangan = 'pembayaran'.'&nbsp'.$nama_bayar_siswa.'&nbsp'.'Atas Nama'.'&nbsp'.$nama_siswa;

  $sisa = $data['jmlTagihanBulanan'] - $data['total_terbayar'];
  $terbayar = $data['total_terbayar'];
  $id_tagihan_bebas_siswa = $data['id_tagihan_bebas_siswa'];
  
   $tgl=date('Y-m-d');

   $telepon_siswa = $data['telepon_siswa'];

  $nama_kelas = $data['nama_kelas'];

  	function uang_indo($angka){
    $rupiah="Rp.". number_format($angka,2,',','.');
    return $rupiah;
}
          function tglIndonesia2($str){
             $tr   = trim($str);
             $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
             return $str;
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
          <input type="text" class="form-control" name="tahun_ajaran"  value="<?php echo $data['tahun_ajaran'] ; ?>" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tipe Pembayaran</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="nama_bayar_siswa" value="<?php echo $data['nama_bayar_siswa'] ; ?>" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Jumlah Iuran</label>
        <div class="col-sm-6">
          <input type="text" class="form-control"  name="total_tagihan" value="<?php echo uang_indo($data['jmlTagihanBulanan']) ?>" readonly>
        </div>
      </div>

    </div>
</div>
</div>
<!-- End Data Siswa -->

<!-- Data Pembayaran Iuran Lain-Lain Siswa -->
<div class="col-sm-12">
  <div class="card card-primary">
  <div class="card-header">
    <h3 class="card-title">
      <i class="fa fa-edit"></i> Pembayaran Iuran Lain - Lain</h3>
  </div>

  <!-- Tabel -->
  <div class="card-body">
       <?php if ($sisa!=0) {
        
      ?>  
    <form action="" method="post" enctype="multipart/form-data">
      <div class="card-body">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tanggal Bayar</label>
        <div class="col-sm-6">
          <input type="date" class="form-control" id="tgl_bayar" name="tgl_bayar" value="<?php echo $tgl; ?>" required>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Jumlah Bayar</label>
        <div class="col-sm-6">
          <input type="text" class="form-control uang" id="jml_bayar" name="jml_bayar" value="<?php echo $sisa; ?>" required>
        </div>
      </div>

       <div class="form-group row">
        <label class="col-sm-2 col-form-label">Keterangan</label>
        <div class="col-sm-6">
          <select name="keterangan" id="keterangan" class="form-control" required>
            <option value="Lunas">Lunas</option>
            <option value="Belum Lunas">Belum Lunas</option>
          </select>
        </div>
      </div>
   <input type="submit" name="simpan" value="Bayar" class="btn btn-primary"><br><br>
    </div>
   
  </form>
<?php } ?>
 <?php 

if (isset($_POST['simpan'])) {
                 
$tgl_bayar = $_POST['tgl_bayar'];
$jml_bayar = $_POST['jml_bayar'];
$keterangan2 = $_POST['keterangan'];
$jml_bayar_oke = $jml_bayar;
$keterangan_oke = $keterangan.'&nbsp'.$keterangan2;

  if ($jml_bayar_oke > $sisa) {
   echo "<script>
      Swal.fire({title: 'Mohon Maaf',text: 'Jumlah Tagihan Lebih',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=transaksi-bebas-siswa&nisn=$nisn&id_jenis_bayar_siswa=$id_jenis_bayar_siswa&id_tahun_ajaran=$id_tahun_ajaran';
        }
      })</script>";               
 }else{
$query= $koneksi->query("INSERT INTO tb_bayar_bebas (id_tagihan_bebas_siswa, tgl_bayar, jml_bayar, ket)values('$id_tagihan_bebas_siswa', '$tgl_bayar', '$jml_bayar_oke', '$keterangan2') ");
$query= $koneksi->query("UPDATE tb_tagihan_bebas_siswa SET  terbayar=(terbayar+$jml_bayar_oke) WHERE id_tagihan_bebas_siswa='$id_tagihan_bebas_siswa'");
if ($query) {
 echo "<script>
      Swal.fire({title: 'Pembayaran',text: 'Berhasil Dilakukan',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=transaksi-bebas-siswa&nisn=$nisn&id_jenis_bayar_siswa=$id_jenis_bayar_siswa&id_tahun_ajaran=$id_tahun_ajaran';
        }
      })</script>";     
      }
    }
  }
?>      
    <div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped">
 
    



        <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Jumlah Pembayaran</th>
          <th>Keterangan</th>
          <th>Aksi </th>
        </tr>
        </thead>
        <tbody>

          <?php
              $no = 1;
              $sql2 = $koneksi->query("SELECT * from tb_bayar_bebas WHERE id_tagihan_bebas_siswa='$id_tagihan_bebas_siswa'");
              while ($data = $sql2->fetch_assoc()) {

            ?>

          <tr>
            <td>
              <?php echo $no++; ?>
            </td>
            <td>
              <?php echo tglIndonesia2(date('d F Y', strtotime($data['tgl_bayar']))) ?>
            </td>
            <td>
              <?php echo uang_indo($data['jml_bayar']) ?>
            </td>
            <td>
              <?php echo $data['ket'] ?>
            </td>
            <td>
              <form method="POST">
                <input type="hidden" name="jml_bayar" value="<?php echo $data['jml_bayar'] ?>" class="form-control" readonly>
                <input type="hidden"  name="id_bayar_bebas" value="<?php echo $data['id_bayar_bebas'] ?>"> 
                <button type="submit" dis  name="simpan2" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            </td>
              </form>
          </tr>

          <?php } ?>
        </tbody>
        </tfoot>
      </table>
    </div>
  </div>
  <!-- End Tabel -->
</div>
</div>
<!-- End Data Pembayaran Iuran Lain-Lain Siswa -->
<?php 
if (isset($_POST['simpan2'])) {

$id_bayar_bebas=$_POST['id_bayar_bebas'];
$jml_bayar2=$_POST['jml_bayar'];
$query= $koneksi->query("DELETE FROM tb_bayar_bebas WHERE id_bayar_bebas='$id_bayar_bebas'");
$query= $koneksi->query("UPDATE tb_tagihan_bebas_siswa set terbayar=(terbayar-$jml_bayar2) WHERE id_tagihan_bebas_siswa='$id_tagihan_bebas_siswa'");

 if ($query) {
    echo "<script>
      Swal.fire({title: 'Pembayaran',text: 'Berhasil Dihapus',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=transaksi-bebas-siswa&nisn=$nisn&id_jenis_bayar_siswa=$id_jenis_bayar_siswa&id_tahun_ajaran=$id_tahun_ajaran';
        }
      })</script>";
    }
  }
?>
























































