<?php
include "../../inc/koneksi.php";

function uang_indo($angka)
{
    $rupiah = "Rp. " . number_format($angka, 2, '.', '.');
    return $rupiah;
}

if (isset($_POST['filter'])) {
    $tahun_ajaran = $_POST['tahun_ajaran'];

    function uang_indo($angka)
    {
        $rupiah = "Rp." . number_format($angka, 2, ',', '.');
        return $rupiah;
    }

    $no = 1;

    $sql2 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_pemasukan_lain.id_pemasukan, tb_pemasukan_lain.nama_pemasukan, tb_pemasukan_lain.total_tagihan, tb_pemasukan_lain.terbayar
        FROM tb_pemasukan_lain
        INNER JOIN tb_tahun_ajaran ON tb_pemasukan_lain.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran
        WHERE tb_pemasukan_lain.id_tahun_ajaran = '$tahun_ajaran' GROUP BY tb_pemasukan_lain.id_pemasukan");
?>



    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tahun Ajaran</th>
                    <th>Jenis Pemasukan</th>
                    <th>Total Pemasukan</th>
                    <th>Pemasukan Dibayar</th>
                    <th>Sisa Pemasukan</th>

                </tr>
            </thead>
            <tbody>
                <?php while ($data2 = $sql2->fetch_assoc()) {
                    $jml_tagihan2 = $data2['total_tagihan'];
                    $terbayar2 = $data2['terbayar'];
                    $sisa2 = $jml_tagihan2 - $terbayar2;
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data2['tahun_ajaran']; ?></td>
                        <td><?php echo $data2['nama_pemasukan']; ?></td>
                        <td><?php echo uang_indo($data2['total_tagihan']); ?></td>
                        <td><?php echo uang_indo($data2['terbayar']); ?></td>
                        <td><?php echo uang_indo($sisa2); ?></td>

                        <td>
                            <a href="?page=transaksi-pemasukan&&id_pemasukan=<?php echo $data2['id_pemasukan']; ?>&id_tahun_ajaran=<?php echo $data2['id_tahun_ajaran']; ?>" title="Detail Pembayaran" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="admin/pemasukan_lain/laporan_pemasukan.php?id_pemasukan=<?php echo $data2['id_pemasukan']; ?>&id_tahun_ajaran=<?php echo $data2['id_tahun_ajaran']; ?>" title="Cetak Laporan" class="btn btn-success btn-sm">
                                <i class="fa fa-print"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php
} else {
    $no = 1;
    $sql2 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_pemasukan_lain.id_pemasukan, tb_pemasukan_lain.nama_pemasukan, tb_pemasukan_lain.total_tagihan, tb_pemasukan_lain.terbayar
        FROM tb_pemasukan_lain
        INNER JOIN tb_tahun_ajaran ON tb_pemasukan_lain.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran
        WHERE tb_tahun_ajaran.status = 'aktif'");

    if (mysqli_num_rows($sql2) > 0) {
    ?>
        <?php
        $sql = $koneksi->query("SELECT * FROM tb_sekolah ");
        $data1 = $sql->fetch_assoc();
        ?>

        <head>
            <style>
                hr {
                    border: none;
                    border-top: 3px solid black;
                    /* Mengatur ketebalan garis */
                    margin: 1px 0;
                    /* Mengatur margin di atas dan di bawah garis */
                }
            </style>

            <title>Cetak - Rincian Laporan Pemasukan Lainya</title>

            <table width="100%">
                <tr>
                <tr>
                    <?php $gambar = "../../admin/gambar/" . $data1['gambar_sekolah']; ?>
                    <td width="10" rowspan="3" valign="top"><img src="<?php echo $gambar; ?>" width="115" height="85" /></td>
                    <td width="2000">
                        <div align="center"><b><?php echo $data1['yayasan_sekolah']; ?></b></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div align="center">
                            <font size="5"><b>KOMITE <?php echo $data1['nama_sekolah']; ?></b></font>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div align="center"><b><?php echo $data1['alamat_sekolah']; ?> <?php echo $data1['kec_sekolah']; ?> <?php echo $data1['kab_sekolah']; ?> <?php echo $data1['prov_sekolah']; ?> Telp. <?php echo $data1['telepon_sekolah']; ?></b></div>
                    </td>

                </tr>
                </tr>
            </table>
            <hr> <!-- Tambahkan baris ini untuk menambahkan garis pemisah -->



            <style type="text/css">
                .tabel {
                    border-collapse: collapse;
                }

                .tabel th {
                    padding: 8px 5px;
                    background-color: #cccccc;
                }

                .tabel td {
                    padding: 7px 5px;
                }
            </style>

            <script>
                window.print();
                window.onfocus = function() {
                    window.close();
                }
            </script>

        </head>

        <body onload="window.print()">

            <div align="center">
                <h2>RINCIAN PEMASUKAN LAINYA</h2>
            </div>

            <table border="1" width="100%" class="tabel">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun Ajaran</th>
                        <th>Jenis Pemasukan</th>
                        <th>Total Pemasukan</th>
                        <th>Pemasukan Dibayar</th>
                        <th>Sisa Pemasukan</th>

                    </tr>
                </thead>
                <tbody>
                    <?php while ($data2 = $sql2->fetch_assoc()) {
                        $jml_tagihan2 = $data2['total_tagihan'];
                        $terbayar2 = $data2['terbayar'];
                        $sisa2 = $jml_tagihan2 - $terbayar2;
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data2['tahun_ajaran']; ?></td>
                            <td><?php echo $data2['nama_pemasukan']; ?></td>
                            <td>
                                <font size="3"><?php echo uang_indo($data2['total_tagihan']); ?>
                            </td>
                            <td><?php echo uang_indo($data2['terbayar']); ?></td>
                            <td style="color:red;"><?php echo uang_indo($sisa2); ?></td>

                            </td>
                        </tr>


                    <?php } ?>


                    <?php $tgl = date('Y-m-d'); ?>
                    <table width="100%"> <br><br><br>
                        <tr>
                            <td align="center"></td>
                            <td align="center" width="200px">
                                Adonara, <?php echo date('d F Y', strtotime($tgl)) ?>
                                <br />Bendahara,<br /><br /><br /><br />
                                <b><u><?php echo $data1['nama_bendahara']; ?></u><br /><?php echo $data1['nip_bendahara']; ?></b>
                            </td>
                        </tr>
                    </table>
                </tbody>

            </table>


            </div>


    <?php
    } else {
        echo '<div align="center"><b><font size="5">Data tidak tersedia</font></b></div>';
    }
}
    ?>