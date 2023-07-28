<?php
include "../../../inc/koneksi.php";

function uang_indo($angka)
{
    $rupiah = "Rp. " . number_format($angka, 2, ',', '.');
    return $rupiah;
}

$no = 1;

// Mengambil tahun ajaran aktif
$sqlTahunAjaranAktif = $koneksi->query("SELECT id_tahun_ajaran FROM tb_tahun_ajaran WHERE status = 'aktif'");
if ($sqlTahunAjaranAktif->num_rows > 0) {
    $rowTahunAjaranAktif = $sqlTahunAjaranAktif->fetch_assoc();
    $idTahunAjaranAktif = $rowTahunAjaranAktif['id_tahun_ajaran'];

    // Query untuk mengambil data jumlah tagihan bebas yang sudah terbayar
    $sql = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, 
                            SUM(tb_tagihan_bebas_siswa.terbayar) AS total_pembayaran, 
                            SUM(tb_tagihan_bebas_siswa.total_tagihan - tb_tagihan_bebas_siswa.terbayar) AS total_belum_terbayar 
                        FROM tb_tahun_ajaran
                        LEFT JOIN tb_jenis_bayar_siswa ON tb_tahun_ajaran.id_tahun_ajaran = tb_jenis_bayar_siswa.id_tahun_ajaran
                        LEFT JOIN tb_tagihan_bebas_siswa ON tb_jenis_bayar_siswa.id_jenis_bayar_siswa = tb_tagihan_bebas_siswa.id_jenis_bayar_siswa
                        WHERE tb_tahun_ajaran.id_tahun_ajaran = $idTahunAjaranAktif
                        GROUP BY tb_tahun_ajaran.id_tahun_ajaran");


    if ($sql && $sql->num_rows > 0) {
        $data1 = $koneksi->query("SELECT * FROM tb_sekolah ")->fetch_assoc();
?>

        <!DOCTYPE html>
        <html>

        <head>
            <style>
                hr {
                    border: none;
                    border-top: 3px solid black;
                    margin: 1px 0;
                }

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

            <title>Cetak - Rincian Laporan pembayaran bebas siswa </title>
        </head>

        <body onload="window.print()">

            <table width="100%">
                <tr>
                    <?php $gambar = "../../../admin/gambar/" . $data1['gambar_sekolah']; ?>
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
            </table>
            <hr>

            <div align="center">
                <h2>PEMBAYARAN BEBAS SEMUA SISWA</h2>
            </div>

            <table border="1" width="100%" class="tabel">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun Ajaran</th>
                        <th>Total Dibayar</th>
                        <th>Total Belum Dibayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($data3 = $sql->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data3['tahun_ajaran']; ?></td>
                            <td><?php echo uang_indo($data3['total_pembayaran']); ?></td>
                            <td><?php echo uang_indo($data3['total_belum_terbayar']); ?></td>
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


        </body>

        </html>

<?php
    } else {
        echo "Tidak ada data tagihan bebas pada tahun ajaran aktif.";
    }
} else {
    echo "Tidak ada tahun ajaran aktif.";
}
?>