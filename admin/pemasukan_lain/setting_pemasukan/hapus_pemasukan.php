<?php 


    $id_pemasukan = $_GET['id_pemasukan'];
    $id_tagihan_pemasukan= $_GET['id_tagihan_pemasukan'];

      $sql_hapus=$koneksi->query("DELETE FROM tb_tagihan_pemasukan WHERE id_pemasukan='$id_pemasukan' AND id_tagihan_pemasukan='$id_tagihan_pemasukan'");

    if ($sql_hapus) {
         echo "<script>
                Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-pemasukan-lain';
                    }
                })</script>";
                }else{
                echo "<script>
                Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-pemasukan-lain';
                    }
                })</script>";
    }

 ?>



