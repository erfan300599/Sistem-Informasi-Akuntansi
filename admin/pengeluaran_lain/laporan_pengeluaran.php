<?php
include "../../inc/koneksi.php";

function uang_indo($angka)
{
    $rupiah = "Rp. " . number_format($angka, 2, ',', '.');
    return $rupiah;
}

if (isset($_POST['filter'])) {
    $tahun_ajaran = $_POST['tahun_ajaran'];

    $no = 1;
    $sql2 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_pengeluaran_lain.id_pengeluaran, tb_pengeluaran_lain.nama_pengeluaran, tb_pengeluaran_lain.total_tagihan, tb_pengeluaran_lain.terbayar
        FROM tb_pengeluaran_lain
        INNER JOIN tb_tahun_ajaran ON tb_pengeluaran_lain.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran
        WHERE tb_pengeluaran_lain.id_tahun_ajaran ='$tahun_ajaran' GROUP BY tb_pengeluaran_lain.id_pengeluaran");

    if ($sql2->num_rows > 0) {
        echo '
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun Ajaran</th>
                        <th>Nama Pengeluaran</th>
                        <th>Total pengeluaran</th>
                        <th>dibayar</th>
                        <th>sisa pengeluaran</th>
                    </tr>
                </thead>
                <tbody>
        ';

        while ($data2 = $sql2->fetch_assoc()) {
            $jml_tagihan2 = $data2['total_tagihan'];
            $terbayar2 = $data2['terbayar'];
            $sisa2 = $jml_tagihan2 - $terbayar2;

            echo '
                <tr>
                    <td>' . $no++ . '</td>
                    <td>' . $data2['tahun_ajaran'] . '</td>
                    <td>' . $data2['nama_pengeluaran'] . '</td>
                    <td>' . uang_indo($data2['total_tagihan']) . '</td>
                    <td>' . uang_indo($data2['terbayar']) . '</td>
                    <td>' . uang_indo($sisa2) . '</td>
                </tr>
            ';
        }

        echo '
                </tbody>
            </table>
        </div>
        ';
    } else {
        echo '<div class="alert alert-info">Tidak ada data pengeluaran pada tahun ajaran ini.</div>';
    }
} else {
    $no = 1;
    $sql2 = $koneksi->query("SELECT tb_tahun_ajaran.tahun_ajaran, tb_tahun_ajaran.id_tahun_ajaran, tb_pengeluaran_lain.id_pengeluaran, tb_pengeluaran_lain.nama_pengeluaran, tb_pengeluaran_lain.jenis_pengeluaran, tb_pengeluaran_lain.total_tagihan, tb_pengeluaran_lain.terbayar 
        FROM tb_pengeluaran_lain
        INNER JOIN tb_tahun_ajaran ON tb_pengeluaran_lain.id_tahun_ajaran = tb_tahun_ajaran.id_tahun_ajaran
        WHERE tb_tahun_ajaran.status = 'aktif'");

    $sql = $koneksi->query("SELECT * FROM tb_sekolah");
    $data1 = $sql->fetch_assoc();

    $tgl = date('Y-m-d');

    echo '
        <head>
            <style>
                hr {
                    border: none;
                    border-top: 3px solid black;
                    margin: 1px 0;
                }
            </style>
            <title>Cetak - Rincian Laporan Pemasukan Lainya</title>
            <table width="100%">
                
                    <tr>
                        <td width="10" rowspan="3" valign="top"><img src="../../admin/gambar/' . $data1['gambar_sekolah'] . '" width="115" height="85" /></td>
                        <td width="2000">
                            <div align="center"><b>' . $data1['yayasan_sekolah'] . '</b></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                                <font size="5"><b>KOMITE ' . $data1['nama_sekolah'] . '</b></font>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center"><b>' . $data1['alamat_sekolah'] . ' ' . $data1['kec_sekolah'] . ' ' . $data1['kab_sekolah'] . ' ' . $data1['prov_sekolah'] . ' Telp. ' . $data1['telepon_sekolah'] . '</b></div>
                        </td>
                    </tr>
                </tr>
            </table>
            <hr>
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
                <h2>RINCIAN PENGELUARAN LAINYA</h2>
            </div>
            <table border="1" width="100%" class="tabel">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun Ajaran</th>
                        <th>Nama Pengeluaran</th>
                        <th>Total pengeluaran</th>
                        <th>dibayar</th>
                        <th>sisa pengeluaran</th>
                    </tr>
                </thead>
                <tbody>
    ';

    while ($data2 = $sql2->fetch_assoc()) {
        $jml_tagihan2 = $data2['total_tagihan'];
        $terbayar2 = $data2['terbayar'];
        $sisa2 = $jml_tagihan2 - $terbayar2;

        echo '
            <tr>
                <td>' . $no++ . '</td>
                <td>' . $data2['tahun_ajaran'] . '</td>
                <td>' . $data2['nama_pengeluaran'] . '</td>
                <td>' . uang_indo($data2['total_tagihan']) . '</td>
                <td>' . uang_indo($data2['terbayar']) . '</td>
                <td style="color:red;" >' . uang_indo($sisa2) . '</td>
            </tr>
        ';
    }

    echo '
    
    </tbody>
            </table>
            <table width="100%"> <br><br><br>
                <tr>
                    <td align="center"></td>
                    <td align="center" width="200px">
                        Adonara, ' . date('d F Y', strtotime($tgl)) . '
                        <br />
                        Bendahara
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <br />
                        <strong> <u>' . $data1['nama_bendahara'] . '</u></strong>
                        <br/>
                          <strong>' . $data1['nip_bendahara'];
    '</u>
                    </td>
                </tr>
            </table>
        </body>
    ';
}
