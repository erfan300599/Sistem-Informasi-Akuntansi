<?php 


    $id_jenis_bayar_siswa = $_GET['id_jenis_bayar_siswa'];
    $id_siswa = $_GET['id_siswa'];

      $sql_hapus=$koneksi->query("DELETE FROM tb_tagihan_bulanan_siswa WHERE id_jenis_bayar_siswa='$id_jenis_bayar_siswa' AND id_siswa='$id_siswa'");

    if ($sql_hapus) {
         echo "<script>
                Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-jenis-bayar-siswa';
                    }
                })</script>";
                }else{
                echo "<script>
                Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-jenis-bayar-siswa';
                    }
                })</script>";
    }

 ?>


