-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Bulan Mei 2023 pada 20.05
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakuntansi_araman`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'Araman Patymoa', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_arus_keuangan`
--

CREATE TABLE `tb_arus_keuangan` (
  `id_arus_uang` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `total_pemasukan` int(100) NOT NULL,
  `total_pengeluran` int(100) NOT NULL,
  `saldo` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bayar_bebas`
--

CREATE TABLE `tb_bayar_bebas` (
  `id_bayar_bebas` int(11) NOT NULL,
  `id_tagihan_bebas_siswa` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `ket` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bayar_pemasukan`
--

CREATE TABLE `tb_bayar_pemasukan` (
  `id_bayar_pemasukan` int(11) NOT NULL,
  `id_pemasukan` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `ket` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bayar_pengeluaran`
--

CREATE TABLE `tb_bayar_pengeluaran` (
  `id_bayar_pengeluaran` int(11) NOT NULL,
  `id_pengeluaran` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `ket` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bulan`
--

CREATE TABLE `tb_bulan` (
  `id_bulan` int(11) NOT NULL,
  `nama_bulan` varchar(20) NOT NULL,
  `urutan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_bulan`
--

INSERT INTO `tb_bulan` (`id_bulan`, `nama_bulan`, `urutan`) VALUES
(1, 'Januari', 1),
(2, 'Februari', 2),
(3, 'Maret', 3),
(4, 'April', 4),
(5, 'Mei', 5),
(6, 'Juni', 6),
(7, 'Juli', 7),
(8, 'Agustus', 8),
(9, 'September', 9),
(10, 'Oktober', 10),
(11, 'November', 11),
(12, 'Desember', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id_guru` int(11) NOT NULL,
  `nik_guru` varchar(20) NOT NULL,
  `nama_guru` varchar(200) NOT NULL,
  `jabatan_guru` varchar(200) NOT NULL,
  `alamat_guru` varchar(100) NOT NULL,
  `telepon_guru` varchar(20) NOT NULL,
  `status_guru` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_guru`
--

INSERT INTO `tb_guru` (`id_guru`, `nik_guru`, `nama_guru`, `jabatan_guru`, `alamat_guru`, `telepon_guru`, `status_guru`) VALUES
(1, '839027800443', 'Ade Irma Baharuddin, S.Pd', 'Guru Honorer', 'Belakang Pasar Inpres', '082327823412', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_bayar_guru`
--

CREATE TABLE `tb_jenis_bayar_guru` (
  `id_jenis_bayar_guru` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `nama_bayar_guru` varchar(200) NOT NULL,
  `tipe_jenis_bayar_guru` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jenis_bayar_guru`
--

INSERT INTO `tb_jenis_bayar_guru` (`id_jenis_bayar_guru`, `id_tahun_ajaran`, `nama_bayar_guru`, `tipe_jenis_bayar_guru`) VALUES
(1, 3, 'Gaji Guru Honorer', 'Bulanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_bayar_siswa`
--

CREATE TABLE `tb_jenis_bayar_siswa` (
  `id_jenis_bayar_siswa` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `nama_bayar_siswa` varchar(200) NOT NULL,
  `tipe_jenis_bayar_siswa` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jenis_bayar_siswa`
--

INSERT INTO `tb_jenis_bayar_siswa` (`id_jenis_bayar_siswa`, `id_tahun_ajaran`, `nama_bayar_siswa`, `tipe_jenis_bayar_siswa`) VALUES
(6, 3, 'Biaya Pendaftaran', 'Bebas'),
(7, 3, 'Iuran Sumbangan Pembinaan Pendidikan (SPP)', 'Bulanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jurusan`
--

CREATE TABLE `tb_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'IPA'),
(3, 'IPS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'XIIB'),
(3, 'XIIA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemasukan_lain`
--

CREATE TABLE `tb_pemasukan_lain` (
  `id_pemasukan` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `nama_pemasukan` varchar(300) NOT NULL,
  `total_tagihan` int(100) NOT NULL,
  `terbayar` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengeluaran_lain`
--

CREATE TABLE `tb_pengeluaran_lain` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `nama_pengeluaran` varchar(300) NOT NULL,
  `jenis_pengeluaran` varchar(300) NOT NULL,
  `total_tagihan` int(100) NOT NULL,
  `terbayar` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_sekolah`
--

CREATE TABLE `tb_sekolah` (
  `id_sekolah` int(11) NOT NULL,
  `nama_sekolah` varchar(200) NOT NULL,
  `yayasan_sekolah` varchar(300) NOT NULL,
  `alamat_sekolah` varchar(100) NOT NULL,
  `kec_sekolah` varchar(200) NOT NULL,
  `kab_sekolah` varchar(100) NOT NULL,
  `prov_sekolah` varchar(200) NOT NULL,
  `telepon_sekolah` varchar(20) NOT NULL,
  `nama_bendahara` varchar(200) NOT NULL,
  `nip_bendahara` varchar(20) NOT NULL,
  `nama_kepalasekolah` varchar(200) NOT NULL,
  `nip_kepalasekolah` varchar(20) NOT NULL,
  `gambar_sekolah` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_sekolah`
--

INSERT INTO `tb_sekolah` (`id_sekolah`, `nama_sekolah`, `yayasan_sekolah`, `alamat_sekolah`, `kec_sekolah`, `kab_sekolah`, `prov_sekolah`, `telepon_sekolah`, `nama_bendahara`, `nip_bendahara`, `nama_kepalasekolah`, `nip_kepalasekolah`, `gambar_sekolah`) VALUES
(1, 'MAN 1 FLORES TIMUR', 'YAYASAN PENDIDIKAN KESEJAHTERAAN ISLAM AL-IKHLAS', 'Jln. Trans Adonara No.1', 'Waiwerang', 'Flores Timur', 'Nusa Tenggara TImur', '(0388) 22896', 'Halimah Hamja,S.Pd', '1968890993933434', 'Fitriyadi,S.Pd', '1979123120050210', 'logooo.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id_siswa` int(11) NOT NULL,
  `nisn` varchar(50) NOT NULL,
  `nama_siswa` varchar(200) NOT NULL,
  `jenis_kelamin` varchar(200) NOT NULL,
  `telepon_siswa` varchar(200) NOT NULL,
  `alamat_siswa` varchar(200) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `status_siswa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`id_siswa`, `nisn`, `nama_siswa`, `jenis_kelamin`, `telepon_siswa`, `alamat_siswa`, `id_kelas`, `id_jurusan`, `status_siswa`) VALUES
(4, '3090667088', 'Rey Naldi', 'Laki-Laki', '081338025056', 'Jln. Gajah Mada', 3, 3, 'Aktif'),
(5, '3090667033', 'Andreas', 'Laki-Laki', '081338025056', 'Jln. Gajah Mada', 1, 1, 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tagihan_bebas_siswa`
--

CREATE TABLE `tb_tagihan_bebas_siswa` (
  `id_tagihan_bebas_siswa` int(11) NOT NULL,
  `id_jenis_bayar_siswa` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `total_tagihan` int(11) NOT NULL,
  `terbayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tagihan_bulanan_guru`
--

CREATE TABLE `tb_tagihan_bulanan_guru` (
  `id_tagihan_bulanan_guru` int(11) NOT NULL,
  `id_jenis_bayar_guru` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_bulan` int(11) NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `terbayar` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `status_bayar` int(11) NOT NULL,
  `cara_bayar` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tagihan_bulanan_siswa`
--

CREATE TABLE `tb_tagihan_bulanan_siswa` (
  `id_tagihan_bulanan_siswa` int(11) NOT NULL,
  `id_jenis_bayar_siswa` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_bulan` int(11) NOT NULL,
  `jml_bayar` int(11) NOT NULL,
  `terbayar` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `status_bayar` int(11) NOT NULL,
  `cara_bayar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tahun_ajaran`
--

CREATE TABLE `tb_tahun_ajaran` (
  `id_tahun_ajaran` int(11) NOT NULL,
  `tahun_ajaran` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tahun_ajaran`
--

INSERT INTO `tb_tahun_ajaran` (`id_tahun_ajaran`, `tahun_ajaran`, `status`) VALUES
(1, '2019/2020', 'tidak'),
(2, '2020/2021', 'tidak'),
(3, '2022/2023', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_arus_keuangan`
--
ALTER TABLE `tb_arus_keuangan`
  ADD PRIMARY KEY (`id_arus_uang`);

--
-- Indeks untuk tabel `tb_bayar_bebas`
--
ALTER TABLE `tb_bayar_bebas`
  ADD PRIMARY KEY (`id_bayar_bebas`);

--
-- Indeks untuk tabel `tb_bayar_pemasukan`
--
ALTER TABLE `tb_bayar_pemasukan`
  ADD PRIMARY KEY (`id_bayar_pemasukan`);

--
-- Indeks untuk tabel `tb_bayar_pengeluaran`
--
ALTER TABLE `tb_bayar_pengeluaran`
  ADD PRIMARY KEY (`id_bayar_pengeluaran`);

--
-- Indeks untuk tabel `tb_bulan`
--
ALTER TABLE `tb_bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indeks untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `tb_jenis_bayar_guru`
--
ALTER TABLE `tb_jenis_bayar_guru`
  ADD PRIMARY KEY (`id_jenis_bayar_guru`);

--
-- Indeks untuk tabel `tb_jenis_bayar_siswa`
--
ALTER TABLE `tb_jenis_bayar_siswa`
  ADD PRIMARY KEY (`id_jenis_bayar_siswa`);

--
-- Indeks untuk tabel `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tb_pemasukan_lain`
--
ALTER TABLE `tb_pemasukan_lain`
  ADD PRIMARY KEY (`id_pemasukan`);

--
-- Indeks untuk tabel `tb_pengeluaran_lain`
--
ALTER TABLE `tb_pengeluaran_lain`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indeks untuk tabel `tb_sekolah`
--
ALTER TABLE `tb_sekolah`
  ADD PRIMARY KEY (`id_sekolah`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `tb_tagihan_bebas_siswa`
--
ALTER TABLE `tb_tagihan_bebas_siswa`
  ADD PRIMARY KEY (`id_tagihan_bebas_siswa`);

--
-- Indeks untuk tabel `tb_tagihan_bulanan_guru`
--
ALTER TABLE `tb_tagihan_bulanan_guru`
  ADD PRIMARY KEY (`id_tagihan_bulanan_guru`);

--
-- Indeks untuk tabel `tb_tagihan_bulanan_siswa`
--
ALTER TABLE `tb_tagihan_bulanan_siswa`
  ADD PRIMARY KEY (`id_tagihan_bulanan_siswa`);

--
-- Indeks untuk tabel `tb_tahun_ajaran`
--
ALTER TABLE `tb_tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun_ajaran`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_arus_keuangan`
--
ALTER TABLE `tb_arus_keuangan`
  MODIFY `id_arus_uang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_bayar_bebas`
--
ALTER TABLE `tb_bayar_bebas`
  MODIFY `id_bayar_bebas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_bayar_pemasukan`
--
ALTER TABLE `tb_bayar_pemasukan`
  MODIFY `id_bayar_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_bayar_pengeluaran`
--
ALTER TABLE `tb_bayar_pengeluaran`
  MODIFY `id_bayar_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_bulan`
--
ALTER TABLE `tb_bulan`
  MODIFY `id_bulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_jenis_bayar_guru`
--
ALTER TABLE `tb_jenis_bayar_guru`
  MODIFY `id_jenis_bayar_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_jenis_bayar_siswa`
--
ALTER TABLE `tb_jenis_bayar_siswa`
  MODIFY `id_jenis_bayar_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_pemasukan_lain`
--
ALTER TABLE `tb_pemasukan_lain`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_pengeluaran_lain`
--
ALTER TABLE `tb_pengeluaran_lain`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_sekolah`
--
ALTER TABLE `tb_sekolah`
  MODIFY `id_sekolah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_tagihan_bebas_siswa`
--
ALTER TABLE `tb_tagihan_bebas_siswa`
  MODIFY `id_tagihan_bebas_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_tagihan_bulanan_guru`
--
ALTER TABLE `tb_tagihan_bulanan_guru`
  MODIFY `id_tagihan_bulanan_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT untuk tabel `tb_tagihan_bulanan_siswa`
--
ALTER TABLE `tb_tagihan_bulanan_siswa`
  MODIFY `id_tagihan_bulanan_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT untuk tabel `tb_tahun_ajaran`
--
ALTER TABLE `tb_tahun_ajaran`
  MODIFY `id_tahun_ajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
