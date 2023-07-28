<?php

   $nisn = $_GET['nisn'];
   $id_jenis_bayar_siswa = $_GET['id_jenis_bayar_siswa'];
   $id_tahun_ajaran = $_GET['id_tahun_ajaran'];
  
  $sql = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_jenis_bayar_siswa.nama_bayar_siswa, tb_jenis_bayar_siswa.id_jenis_bayar_siswa, tb_jenis_bayar_siswa.id_tahun_ajaran, tb_siswa.nisn, tb_siswa.nama_siswa, tb_siswa.telepon_siswa, tb_kelas.nama_kelas, tb_tagihan_bulanan_siswa.id_jenis_bayar_siswa, Sum(tb_tagihan_bulanan_siswa.jml_bayar) AS jmlTagihanBulanan from tb_jenis_bayar_siswa
                          
                        INNER JOIN tb_tagihan_bulanan_siswa ON tb_tagihan_bulanan_siswa.id_jenis_bayar_siswa = tb_jenis_bayar_siswa.id_jenis_bayar_siswa
                        INNER JOIN tb_tahun_ajaran ON tb_jenis_bayar_siswa.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran

                        INNER JOIN tb_siswa ON tb_tagihan_bulanan_siswa.id_siswa = tb_siswa.id_siswa
                        INNER JOIN tb_kelas ON tb_tagihan_bulanan_siswa.id_kelas = tb_kelas.id_kelas
                        WHERE tb_siswa.nisn='$nisn' and tb_jenis_bayar_siswa.id_tahun_ajaran='$id_tahun_ajaran' and tb_jenis_bayar_siswa.id_jenis_bayar_siswa='$id_jenis_bayar_siswa' GROUP BY tb_jenis_bayar_siswa.id_jenis_bayar_siswa 
                          ");

  $data = $sql->fetch_assoc();

  $nama_bayar_siswa= $data['nama_bayar_siswa'];
  $nama_siswa = $data['nama_siswa'];
  $keterangan = 'pembayaran'.'&nbsp'.$nama_bayar_siswa.'&nbsp'.'Atas Nama'.'&nbsp'.$nama_siswa;

   $telepon_siswa = $data['telepon_siswa'];

  $nama_kelas = $data['nama_kelas'];

  	function uang_indo($angka){
    $rupiah="Rp.". number_format($angka,2,',','.');
    return $rupiah;
}
          function tglIndonesia3($str){
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
      <i class="fa fa-edit"></i> Pembayaran Iuran Bulanan</h3>
  </div>

  <!-- Tabel -->
  <div class="card-body">     
    <div class="table-responsive">
      <table id="example1" class="table table-bordered table-striped">

        <thead>
        <tr>
          <th>No</th>
          <th>Bulan</th>
          <th>Jumlah Pembayaran</th>
          <th>Status</th>
          <th>Tanggal Pembayaran</th>
          <th>Tipe Bayar</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>

          <?php

                      $no = 1;

                     $sql2 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_jenis_bayar_siswa.nama_bayar_siswa, tb_jenis_bayar_siswa.id_jenis_bayar_siswa, tb_jenis_bayar_siswa.id_tahun_ajaran, tb_siswa.nisn, tb_siswa.nama_siswa, tb_kelas.nama_kelas, tb_tagihan_bulanan_siswa.id_jenis_bayar_siswa, tb_tagihan_bulanan_siswa.tgl_bayar, tb_bulan.nama_bulan, tb_bulan.urutan, tb_tagihan_bulanan_siswa.jml_bayar, tb_tagihan_bulanan_siswa.id_tagihan_bulanan_siswa, tb_tagihan_bulanan_siswa.status_bayar from tb_jenis_bayar_siswa
                          
                        INNER JOIN tb_tagihan_bulanan_siswa ON tb_tagihan_bulanan_siswa.id_jenis_bayar_siswa = tb_jenis_bayar_siswa.id_jenis_bayar_siswa
                        INNER JOIN tb_tahun_ajaran ON tb_jenis_bayar_siswa.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran
                        INNER JOIN tb_bulan ON tb_tagihan_bulanan_siswa.id_bulan = tb_bulan.id_bulan

                        INNER JOIN tb_siswa ON tb_tagihan_bulanan_siswa.id_siswa = tb_siswa.id_siswa
                        INNER JOIN tb_kelas ON tb_tagihan_bulanan_siswa.id_kelas = tb_kelas.id_kelas
                        WHERE tb_siswa.nisn='$nisn' and tb_jenis_bayar_siswa.id_tahun_ajaran='$id_tahun_ajaran' and tb_jenis_bayar_siswa.id_jenis_bayar_siswa='$id_jenis_bayar_siswa' order BY tb_bulan.urutan 
                          ");

                      while ($data = $sql2->fetch_assoc()) {


                        $status=$data['status_bayar'] ;

                        if ($status==0) {
                          $status_t="Belum Lunas";
                          $color = "red";
                        }else{
                          $status_t="Lunas";
                          $color = "green";
                        }

                        $tgl=date('Y-m-d');

            ?>

          <tr>
            <td>
              <?php echo $no++; ?>
            </td>
            <td style="color:<?php echo $color ?>"><?php echo $data['nama_bulan'] ?>
            </td>
              <form method="POST">
                <td> <input style="color:<?php echo $color ?>; width: 100px;" type="text" value="<?php echo number_format($data['jml_bayar']) ?>"  class="form-control" readonly="" name="jml_bayar"></td>
                <td style="color:<?php echo $color ?>"><?php echo $status_t ?></td>
                <td><input style=" width: 150px;" type="date" value="<?php echo $tgl ?>"  class="form-control" name="tgl_bayar"></td>
                <td >
                <div class="form-group">
                  <select style=" width: 100px;"   class="form-control"  name="tipe_bayar">
                    <option value="Cash" >Cash</option>
                    <option value="Transfer" >Transfer</option>       
                  </select>
                </div> 
                </td> 
                <input type="hidden"  name="id_tagihan_bulanan_siswa" value="<?php echo $data['id_tagihan_bulanan_siswa'] ?>">
                <?php if ($status==0) {
                    
                  ?>
                  <td> <button type="submit"  name="simpan" class="btn btn-primary btn-sm"><i class="fa fa-money"></i> Bayar
                  </button></td>
                  <td ><a href="" disabled="" class="btn btn-default" title=""><i class="fa fa-print"></i> Cetak</a></td>

                  <?php } else{ ?>
                  <td ><button type="submit" dis  name="simpan2" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus </button></td>
                  <td ><a target="blank" href="admin/transaksi_siswa/bebas/cetak_transaksi_bulanan_siswa.php?id_tagihan_bulanan_siswa=<?php echo $data['id_tagihan_bulanan_siswa'] ?>" class="btn btn-default" title=""><i class="fa fa-print"></i> Cetak</a></td>
                  <?php } ?>
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
if (isset($_POST['simpan'])) {

$jml_bayar = $_POST['jml_bayar'];
$jml_bayar_oke = $jml_bayar;
$tgl_bayar = $_POST['tgl_bayar'];
$tipe_bayar = $_POST['tipe_bayar'];
$id_tagihan_bulanan_siswa = $_POST['id_tagihan_bulanan_siswa'];

$query= $koneksi->query("UPDATE tb_tagihan_bulanan_siswa SET status_bayar='1', tgl_bayar='$tgl_bayar',  cara_bayar='$tipe_bayar', terbayar=(terbayar+jml_bayar) WHERE id_tagihan_bulanan_siswa='$id_tagihan_bulanan_siswa' ");

 if ($query) {
    echo "<script>
      Swal.fire({title: 'Pembayaran',text: 'Berhasil Dilakukan',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=transaksi-bulanan-siswa&nisn=$nisn&id_jenis_bayar_siswa=$id_jenis_bayar_siswa&id_tahun_ajaran=$id_tahun_ajaran';
        }
      })</script>";
    }
  }
?>

<?php 
if (isset($_POST['simpan2'])) {

$tgl_bayar = $_POST['tgl_bayar'];
$tipe_bayar = $_POST['tipe_bayar'];
$id_tagihan_bulanan_siswa = $_POST['id_tagihan_bulanan_siswa'];

$query= $koneksi->query("UPDATE tb_tagihan_bulanan_siswa SET status_bayar='0', tgl_bayar='0000-00-00', terbayar=(terbayar-jml_bayar), cara_bayar='' WHERE id_tagihan_bulanan_siswa='$id_tagihan_bulanan_siswa' ");

 if ($query) {
    echo "<script>
      Swal.fire({title: 'Pembayaran',text: 'Berhasil Dihapus',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=transaksi-bulanan-siswa&nisn=$nisn&id_jenis_bayar_siswa=$id_jenis_bayar_siswa&id_tahun_ajaran=$id_tahun_ajaran';
        }
      })</script>";
    }
  }
?>
























































