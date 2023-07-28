<?php

   $id_pemasukan= $_GET['id_pemasukan'];
   $id_tahun_ajaran = $_GET['id_tahun_ajaran'];
  
  $sql = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_pemasukan_lain.nama_pemasukan, tb_pemasukan_lain.id_pemasukan, tb_pemasukan_lain.id_tahun_ajaran, Sum(tb_pemasukan_lain.total_tagihan) AS jmlTagihanBulanan, Sum(tb_pemasukan_lain.terbayar) AS total_terbayar from tb_pemasukan_lain
                        
                        INNER JOIN tb_tahun_ajaran ON tb_pemasukan_lain.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran
                        WHERE tb_pemasukan_lain.id_tahun_ajaran='$id_tahun_ajaran' and tb_pemasukan_lain.id_pemasukan='$id_pemasukan' GROUP BY tb_pemasukan_lain.id_pemasukan
                          ");

  $data = $sql->fetch_assoc();

  $nama_pemasukan= $data['nama_pemasukan'];

  $sisa = $data['jmlTagihanBulanan'] - $data['total_terbayar'];
  $terbayar = $data['total_terbayar'];
  $id_pemasukan= $data['id_pemasukan'];
  $keterangan = $nama_pemasukan;
   $tgl=date('Y-m-d');


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
      <i class="fa fa-edit"></i> Data Pemasukan Lainnya</h3>
  </div>
    <div class="card-body">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="nama_pemasukan" name="nama_pemasukan" value="<?php echo $data['nama_pemasukan'] ; ?>" readonly>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tahun Ajaran</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="tahun_ajaran"  value="<?php echo $data['tahun_ajaran'] ; ?>" readonly>
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
      <i class="fa fa-edit"></i> Pemasukan Lainnya</h3>
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
        {window.location = 'index.php?page=transaksi-pemasukan&id_pemasukan=$id_pemasukan&id_tahun_ajaran=$id_tahun_ajaran';
        }
      })</script>";               
 }else{
$query= $koneksi->query("INSERT INTO tb_bayar_pemasukan (id_pemasukan, tgl_bayar, jml_bayar, ket)values('$id_pemasukan', '$tgl_bayar', '$jml_bayar_oke', '$keterangan2') ");
$query= $koneksi->query("UPDATE tb_pemasukan_lain SET  terbayar=(terbayar+$jml_bayar_oke) WHERE id_pemasukan='$id_pemasukan'");
if ($query) {
 echo "<script>
      Swal.fire({title: 'Pembayaran',text: 'Berhasil Dilakukan',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=transaksi-pemasukan&id_pemasukan=$id_pemasukan&id_tahun_ajaran=$id_tahun_ajaran';
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
              $sql2 = $koneksi->query("SELECT * from tb_bayar_pemasukan WHERE id_pemasukan='$id_pemasukan'");
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
                <input type="hidden"  name="id_bayar_pemasukan" value="<?php echo $data['id_bayar_pemasukan'] ?>"> 
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

$id_bayar_pemasukan=$_POST['id_bayar_pemasukan'];
$jml_bayar2=$_POST['jml_bayar'];
$query= $koneksi->query("DELETE FROM tb_bayar_pemasukan WHERE id_bayar_pemasukan='$id_bayar_pemasukan'");
$query= $koneksi->query("UPDATE tb_pemasukan_lain set terbayar=(terbayar-$jml_bayar2) WHERE id_pemasukan='$id_pemasukan'");

 if ($query) {
    echo "<script>
      Swal.fire({title: 'Pembayaran',text: 'Berhasil Dihapus',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=transaksi-pemasukan&id_pemasukan=$id_pemasukan&id_tahun_ajaran=$id_tahun_ajaran';
        }
      })</script>";
    }
  }
?>
























































