<?php 

 		$id_tahun_ajaran = $_GET['kode'];

 		$sql = $koneksi->query("update  tb_tahun_ajaran set status='aktif' where id_tahun_ajaran='$id_tahun_ajaran'");

 		$sql = $koneksi->query("update  tb_tahun_ajaran set status='tidak' where id_tahun_ajaran!='$id_tahun_ajaran'");

 		if ($sql) {
                   echo "<script>
                Swal.fire({title: 'Tahun Ajaran Berhasil Diaktifkan',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-tahunajaran';
                    }
                })</script>";
                  }
  ?>
