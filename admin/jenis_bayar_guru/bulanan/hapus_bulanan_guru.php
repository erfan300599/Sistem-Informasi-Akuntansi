<?php 


    $id_jenis_bayar_guru = $_GET['id_jenis_bayar_guru'];
    $id_guru = $_GET['id_guru'];

      $sql_hapus=$koneksi->query("DELETE FROM tb_tagihan_bulanan_guru WHERE id_jenis_bayar_guru='$id_jenis_bayar_guru' AND id_guru='$id_guru'");

    if ($sql_hapus) {
         echo "<script>
                Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-jenis-bayar-guru';
                    }
                })</script>";
                }else{
                echo "<script>
                Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-jenis-bayar-guru';
                    }
                })</script>";
    }

 ?>


