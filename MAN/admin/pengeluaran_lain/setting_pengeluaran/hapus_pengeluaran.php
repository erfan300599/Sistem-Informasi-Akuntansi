<?php 


    $id_pengeluaran = $_GET['id_pengeluaran'];
    $id_tagihan_pengeluaran= $_GET['id_tagihan_pengeluaran'];

      $sql_hapus=$koneksi->query("DELETE FROM tb_tagihan_pengeluaran WHERE id_pengeluaran='$id_pengeluaran' AND id_tagihan_pengeluaran='$id_tagihan_pengeluaran'");

    if ($sql_hapus) {
         echo "<script>
                Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-pengeluaran-lain';
                    }
                })</script>";
                }else{
                echo "<script>
                Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-pengeluaran-lain';
                    }
                })</script>";
    }

 ?>



