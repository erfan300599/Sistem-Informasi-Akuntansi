<?php
  	function uang_indo($angka){
    $rupiah="Rp.". number_format($angka,2,',','.');
    return $rupiah;
}
?>


<!-- Iuran Bebas -->
	<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Data Pengeluaran Lainnya</h3>
	</div>

	<!-- Tabel -->
	<div class="card-body">
		<div class="table-responsive">

	<div class="row">
		<div class="col-md-3">    
		    <div class="form-group"> 	
		    	<form  action="" method="post" enctype="multipart/form-data"> 
                       <select class="form-control" name="tahun_ajaran" required="" >
                          <option value="" disabled selected>Pilih Tahun Ajaran</option>
                              <?php
                               $query = $koneksi->query("SELECT * FROM tb_tahun_ajaran ORDER by id_tahun_ajaran ASC");
                                while ($tampil_t=$query->fetch_assoc()) {
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

			<table id="example1" class="table table-bordered table-striped">
				<thead>
				<tr>
				  <th>No</th>
                  <th>Tahun Ajaran</th>
                  <th>Nama Pengeluaran</th>
                  <th>Jenis Pembayaran</th>
                  <th>Total Iuran</th>
                  <th>Iuran Dibayar</th>
                  <th>Sisa Iuran </th>
                  <th>Aksi </th>
				</tr>
				</thead>
				<tbody>

					<?php
						if (isset($_POST['filter'])) {
                  		$tahun_ajaran=$_POST['tahun_ajaran'];
                      $no = 1;
                    $sql2 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran,tb_pengeluaran_lain.id_pengeluaran, tb_pengeluaran_lain.nama_pengeluaran,tb_pengeluaran_lain.jenis_pengeluaran, tb_pengeluaran_lain.total_tagihan, tb_pengeluaran_lain.terbayar from tb_pengeluaran_lain
                          
                        INNER JOIN tb_tahun_ajaran ON tb_pengeluaran_lain.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran
                        WHERE tb_pengeluaran_lain.id_tahun_ajaran ='$tahun_ajaran' GROUP BY tb_pengeluaran_lain.id_pengeluaran
                          ");
                      while ($data2= $sql2->fetch_assoc()) {
                      $jml_tagihan2 = $data2['total_tagihan'];
                      $terbayar2 =  $data2['terbayar'];
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
							<?php echo $data2['nama_pengeluaran']; ?>
						</td>
						<td>
							<?php echo $data2['jenis_pengeluaran']; ?>
						</td>
						<td>
							<?php echo uang_indo($data2['total_tagihan']) ?>
						</td>
						<td>
							<?php echo uang_indo($data2['terbayar']) ?>
						</td>
						<td>
							<?php echo uang_indo($sisa2) ?>
						</td>
						<td>
							<a href="?page=transaksi-pengeluaran&&id_pengeluaran=<?php echo $data2['id_pengeluaran'] ?>&id_tahun_ajaran=<?php echo $data2['id_tahun_ajaran']; ?>" title="Detail Pembayaran"
							 class="btn btn-primary btn-sm">
								<i class="fa fa-eye"></i>
							</a>
						</td>
					</tr>

					<?php
              } }else{
              	    $no = 1;
                    $sql2 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran,tb_pengeluaran_lain.id_pengeluaran, tb_pengeluaran_lain.nama_pengeluaran,tb_pengeluaran_lain.jenis_pengeluaran, tb_pengeluaran_lain.total_tagihan, tb_pengeluaran_lain.terbayar from tb_pengeluaran_lain
                          
                        INNER JOIN tb_tahun_ajaran ON tb_pengeluaran_lain.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran
                        WHERE tb_pengeluaran_lain.id_pengeluaran 
                          ");
                      while ($data2= $sql2->fetch_assoc()) {
                      $jml_tagihan2 = $data2['total_tagihan'];
                      $terbayar2 =  $data2['terbayar'];
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
							<?php echo $data2['nama_pengeluaran']; ?>
						</td>
						<td>
							<?php echo $data2['jenis_pengeluaran']; ?>
						</td>
						<td>
							<?php echo uang_indo($data2['total_tagihan']) ?>
						</td>
						<td>
							<?php echo uang_indo($data2['terbayar']) ?>
						</td>
						<td>
							<?php echo uang_indo($sisa2) ?>
						</td>
						<td>
							<a href="?page=transaksi-pengeluaran&&id_pengeluaran=<?php echo $data2['id_pengeluaran'] ?>&id_tahun_ajaran=<?php echo $data2['id_tahun_ajaran']; ?>" title="Detail Pembayaran"
							 class="btn btn-primary btn-sm">
								<i class="fa fa-eye"></i>
							</a>
						</td>
					</tr>

        <?php }} ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- End Tabel -->
</div>
<!-- End Iuran Bebas -->
