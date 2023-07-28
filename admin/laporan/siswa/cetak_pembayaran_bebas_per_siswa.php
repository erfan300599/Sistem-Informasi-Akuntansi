<?php
include "../../../inc/koneksi.php";

$sql = $koneksi->query("SELECT * FROM tb_tahun_ajaran WHERE id_tahun_ajaran='$_GET[id_tahun_ajaran]'");
$ta = $sql->fetch_assoc();
$id_tahun_ajaran = $ta['id_tahun_ajaran'];
$tahun_ajaran = $ta['tahun_ajaran'];

$satu_hari = mktime(0, 0, 0, date("n"), date("j"), date("Y"));

function tglIndonesia($str)
{
    $tr = trim($str);
    $str = str_replace(
        array(
            'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March',
            'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
        ),
        array(
            'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret',
            'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ),
        $tr
    );
    return $str;
}

function uang_indo($angka)
{
    $rupiah = "Rp." . number_format($angka, 2, ',', '.');
    return $rupiah;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cetak - Laporan Bebas Siswa</title>
    <style type="text/css">
        .tabel {
            border-collapse: collapse;
        }

        .tabel th {
            padding: 8px 5px;
            background-color: #cccccc;
        }

        .tabel td {
            padding: 8px 5px;
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

    <?php
    $sql = $koneksi->query("SELECT * FROM tb_sekolah ");
    $data1 = $sql->fetch_assoc();
    ?>

    <table width="100%">
        <tr>
        <tr>
            <?php $gambar = "../../../admin/gambar/" . $data1['gambar_sekolah']; ?>
            <td width="10" rowspan="3" valign="top"><img src="<?php echo $gambar; ?>" width="140" height="110" /></td>
            <td width="383">
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
    <hr>
    <br>

    <?php
    $sqlSiswa = $koneksi->query("SELECT tb_siswa.id_siswa, tb_siswa.nisn, tb_siswa.nama_siswa, tb_siswa.telepon_siswa, tb_siswa.jenis_kelamin, tb_siswa.alamat_siswa, tb_kelas.nama_kelas, tb_jurusan.nama_jurusan FROM tb_siswa
                                    INNER JOIN tb_kelas ON tb_kelas.id_kelas = tb_siswa.id_kelas
                                    INNER JOIN tb_jurusan ON tb_jurusan.id_jurusan = tb_siswa.id_jurusan 
         WHERE tb_siswa.id_kelas=tb_kelas.id_kelas AND id_siswa='$_GET[id_siswa]' ORDER BY nama_siswa ASC");
    $dtsiswa = $sqlSiswa->fetch_assoc();

    $id_siswa = $dtsiswa['id_siswa'];
    $nisn = $dtsiswa['nisn'];
    $nama_siswa = $dtsiswa['nama_siswa'];
    $nama_kelas = $dtsiswa['nama_kelas'];
    $nama_jurusan = $dtsiswa['nama_jurusan'];
    ?>

    <div align="center">
        <h3>PEMBAYARAN BEBAS SISWA</h3>
    </div>

    <table width="100%">

        <tr>
            <td>&nbsp;</td>
            <td width="700">&nbsp;</td>
            <td width="16">&nbsp;</td>
            <td width="2000">&nbsp;</td>
            <td width="500">&nbsp;</td>
            <td width="15">&nbsp;</td>
            <td width="375">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td width="80px">Nama Siswa</td>
            <td>:</td>
            <td><?php echo $nama_siswa ?></td>
            <td width="20px">Kelas</td>
            <td>:</td>
            <td><?php echo $nama_kelas ?> - <?php echo $nama_jurusan ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>NISN</td>
            <td>:</td>
            <td><?php echo $nisn ?></td>
            <td>Tahun Ajaran</td>
            <td>:</td>
            <td><?php echo $tahun_ajaran ?></td>
        </tr>

    </table>
    <br>

    <table border="1" width="100%" class="tabel">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Pembayaran</th>
                <th>Total Tagihan</th>
                <th>Tagihan Terbayar</th>
                <th>Sisa Tagihan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $jml_tagihan = 0;
            $jml_terbayar = 0;
            $jml_sisa = 0;
            $sqlJenisBayar = $koneksi->query("SELECT * FROM tb_jenis_bayar_siswa
            WHERE id_tahun_ajaran='$id_tahun_ajaran' AND tipe_jenis_bayar_siswa='bebas'");
            while ($djb = $sqlJenisBayar->fetch_assoc()) {
                $sql = $koneksi->query("SELECT tb_jenis_bayar_siswa.nama_bayar_siswa, tb_siswa.nama_siswa, SUM(tb_tagihan_bebas_siswa.total_tagihan) as totaljmlbayar2, SUM(tb_tagihan_bebas_siswa.terbayar) as totalterbayar FROM tb_jenis_bayar_siswa 
                 LEFT JOIN tb_tahun_ajaran ON tb_jenis_bayar_siswa.id_tahun_ajaran=tb_tahun_ajaran.id_tahun_ajaran 
                 LEFT JOIN tb_tagihan_bebas_siswa ON tb_tagihan_bebas_siswa.id_jenis_bayar_siswa=tb_jenis_bayar_siswa.id_jenis_bayar_siswa
                 LEFT JOIN tb_siswa ON tb_tagihan_bebas_siswa.id_siswa=tb_siswa.id_siswa
                 WHERE 
                     tb_tagihan_bebas_siswa.id_jenis_bayar_siswa='$djb[id_jenis_bayar_siswa]' AND
                     tb_tagihan_bebas_siswa.id_siswa='$id_siswa' 
                   GROUP BY tb_tagihan_bebas_siswa.id_jenis_bayar_siswa");

                $data = $sql->fetch_assoc();
                $t_tagihan = $data['totaljmlbayar2'];
                $t_terbayar = $data['totalterbayar'];
                $sisa = $data['totaljmlbayar2'] - $data['totalterbayar'];
            ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $djb['nama_bayar_siswa']; ?></td>
                    <td align="right"><?php echo uang_indo($t_tagihan); ?></td>
                    <td align="right"><?php echo uang_indo($t_terbayar); ?></td>
                    <td align="right" style="color: red;"><?php echo uang_indo($sisa); ?></td>
                </tr>
            <?php
                $jml_tagihan += $t_tagihan;
                $jml_terbayar += $t_terbayar;
                $jml_sisa += $sisa;
            }
            ?>
            <tr>
                <td align="center" style="font-size: 18px; font-weight: bold;" colspan="2">Total</td>
                <td align="right"><?php echo uang_indo($jml_tagihan); ?></td>
                <td align="right"><?php echo uang_indo($jml_terbayar); ?></td>
                <td align="right" style="color: red;"><?php echo uang_indo($jml_sisa); ?></td>
            </tr>
        </tbody>
    </table><br>
    <?php $tgl = date('Y-m-d'); ?>
    <table width="100%">
        <tr>
            <td align="center"></td>
            <td align="center" width="200px">
                Adonara, <?php echo tglIndonesia(date('d F Y', strtotime($tgl))) ?>
                <br />Bendahara,<br /><br /><br /><br />
                <b><u><?php echo $data1['nama_bendahara']; ?></u><br /><?php echo $data1['nip_bendahara']; ?></b>
            </td>
        </tr>
    </table>
</body>

</html>