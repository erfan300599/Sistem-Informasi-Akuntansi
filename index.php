<?php
//Mulai Sesion
session_start();
if (isset($_SESSION["ses_username"]) == "") {
	header("location: login.php");
} else {
	$data_pass = $_SESSION["ses_password"];
	$data_id = $_SESSION["ses_id"];
	$data_nama = $_SESSION["ses_nama"];
	$data_user = $_SESSION["ses_username"];
}
//KONEKSI DB
include "inc/koneksi.php";

$satu_hari        = mktime(0, 0, 0, date("n"), date("j"), date("Y"));

function tglIndonesia($str)
{
	$tr   = trim($str);
	$str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
	return $str;
}
date_default_timezone_set("Asia/Ujung_Pandang")
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>MAN 1 FLORES TIMUR</title>
	<link rel="icon" href="dist/img/logooo.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- Alert -->
	<script src="plugins/alert.js"></script>
</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-success navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#">
						<i class="fas fa-bars text-white"></i>
					</a>
				</li>
				<li>
					<a href="index.php" class="nav-link">
						<font color="white">
							<b>Selamat Datang <?php echo $data_nama; ?></b>
						</font>
					</a>
				</li>
			</ul>

			<!-- SEARCH FORM -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item d-none d-sm-inline-block">
					<a href="index.php" class="nav-link">
						<font color="white">
							<i class="nav-icon fas fa-calendar-alt"></i>
							<?php $tgl = date('Y-m-d'); ?>
							<b><?php echo tglIndonesia(date('d F Y', strtotime($tgl))) ?> |</b>
							<b><span id="jam"></span></b>
						</font>
					</a>
				</li>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="index.php" class="brand-link">
				<img src="dist/img/logooo.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
				<span class="brand-text">MAN 1 FLOTIM</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

						<!-- Halaman Admin -->

						<li class="nav-item">
							<a href="index.php" class="nav-link">
								<i class="nav-icon fas fa-home"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>

						<li class="nav-header">Master Data</li>

						<li class="nav-item">
							<a href="?page=data-sekolah" class="nav-link">
								<i class="nav-icon fas fa-school"></i>
								<p>Data Sekolah</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?page=data-admin" class="nav-link">
								<i class="nav-icon fas fa-user"></i>
								<p>Data Admin</p>
							</a>
						</li>
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-table"></i>
								<p>
									Data Siswa
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="?page=data-tahunajaran" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Data Tahun Ajaran</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-jurusan" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Data Jurusan</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-kelas" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Data Kelas</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-siswa" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Tambah Data Siswa</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="?page=data-guru" class="nav-link">
								<i class="nav-icon fas fa-chalkboard-teacher"></i>
								<p>Data Guru</p>
							</a>
						</li>




						<li class="nav-header"> Master Data Transaksi</li>

						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-money-bill-alt"></i>
								<p>
									Jenis Pemasukkan
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="?page=data-jenis-bayar-siswa" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Jenis Pembayaran siswa</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-pemasukan-lain" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Jenis Pemasukan Lainnya</p>
									</a>
								</li>
							</ul>
						</li>

						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-search-dollar"></i>
								<p>
									Jenis Pengeluaran
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="?page=data-jenis-bayar-guru" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Jenis Pembayaran Guru</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-pengeluaran-lain" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Jenis Pengeluaran Lainnya</p>
									</a>
								</li>
							</ul>
						</li>


						<li class="nav-header"> Menu Transaksi</li>

						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-calculator"></i>
								<p>
									Menu Pembayaran
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="?page=data-transaksi-siswa" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Pembayaran siswa</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-transaksi-guru" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Pembayaran Guru</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=detail-transaksi-pemasukan" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Dana Pemasukan Lainnya</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=detail-transaksi-pengeluaran" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Dana Pengeluaran Lainnya</p>
									</a>
								</li>
							</ul>
						</li>

						<li class="nav-header">Laporan</li>

						<li class="nav-item">
							<a href="?page=data-laporan-siswa" class="nav-link">
								<i class="nav-icon fas fa-table"></i>
								<p>
									Data Siswa
								</p>
							</a>
						</li>
						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-money-bill-alt"></i>
								<p>
									Data Keuangan
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="?page=data-pembayaran-spp-siswa" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Pembayaran SPP</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-pembayaran-bebas-siswa" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Pembayaran Bebas</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-pembayaran-gaji-guru" class="nav-link">
										<i class="nav-icon far fa-circle text-warning"></i>
										<p>Pembayaran Guru</p>
									</a>
								</li>

								<!-- 									<li class="nav-item">
										<a href="#" class="nav-link">
											<i class="nav-icon far fa-circle text-warning"></i>
											<p>Arus Keuangan</p>
										</a>
									</li> -->
							</ul>
						<li class="nav-item">
							<a href="?page=data-arus-keuangan" class="nav-link">
								<i class="nav-icon fas fa-reply"></i>
								<p>
									Arus Keuangan
								</p>
							</a>
						</li>
						</li>







						<li class="nav-header">Setting</li>

						<li class="nav-item">
							<a href="?page=update-password" class="nav-link">
								<i class="nav-icon fas fa-cogs"></i>
								<p>
									Update Password
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?page=view-admin" class="nav-link">
								<i class="nav-icon fas fa-user"></i>
								<p>
									Profile
								</p>
							</a>
						</li>

						<li class="nav-item">
							<a onclick="return confirm('Apakah anda yakin akan keluar ?')" href="logout.php" class="nav-link">
								<i class="nav-icon fas fa-arrow-circle-right"></i>
								<p>
									Logout
								</p>
							</a>
						</li>

				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			</section>

			<!-- Main content -->
			<section class="content">
				<!-- /. WEB DINAMIS DISINI ############################################################################### -->
				<div class="container-fluid">

					<?php
					if (isset($_GET['page'])) {
						$hal = $_GET['page'];

						switch ($hal) {

								//Profil Sekolah
							case 'data-sekolah':
								include "admin/sekolah/data_sekolah.php";
								break;

								//Guru
							case 'data-guru':
								include "admin/guru/data_guru.php";
								break;
							case 'add-guru':
								include "admin/guru/add_guru.php";
								break;
							case 'edit-guru':
								include "admin/guru/edit_guru.php";
								break;
							case 'del-guru':
								include "admin/guru/del_guru.php";
								break;

								//Admin
							case 'data-admin':
								include "admin/admin/data_admin.php";
								break;
							case 'add-admin':
								include "admin/admin/add_admin.php";
								break;
							case 'edit-admin':
								include "admin/admin/edit_admin.php";
								break;
							case 'del-admin':
								include "admin/admin/del_admin.php";
								break;
							case 'view-admin':
								include "admin/admin/view_admin.php";
								break;
							case 'update-password':
								include "admin/admin/update_password.php";
								break;

								//Jurusan
							case 'data-jurusan':
								include "admin/jurusan/data_jurusan.php";
								break;
							case 'add-jurusan':
								include "admin/jurusan/add_jurusan.php";
								break;
							case 'edit-jurusan':
								include "admin/jurusan/edit_jurusan.php";
								break;
							case 'del-jurusan':
								include "admin/jurusan/del_jurusan.php";
								break;

								//Kelas
							case 'data-kelas':
								include "admin/kelas/data_kelas.php";
								break;
							case 'add-kelas':
								include "admin/kelas/add_kelas.php";
								break;
							case 'edit-kelas':
								include "admin/kelas/edit_kelas.php";
								break;
							case 'del-kelas':
								include "admin/kelas/del_kelas.php";
								break;

								// Siswa
							case 'data-siswa':
								include "admin/siswa/data_siswa.php";
								break;
							case 'add-siswa':
								include "admin/siswa/add_siswa.php";
								break;
							case 'edit-siswa':
								include "admin/siswa/edit_siswa.php";
								break;
							case 'del-siswa':
								include "admin/siswa/del_siswa.php";
								break;

								//Tahun Ajaran
							case 'data-tahunajaran':
								include "admin/tahunajaran/data_tahunajaran.php";
								break;
							case 'add-tahunajaran':
								include "admin/tahunajaran/add_tahunajaran.php";
								break;
							case 'edit-tahunajaran':
								include "admin/tahunajaran/edit_tahunajaran.php";
								break;
							case 'del-tahunajaran':
								include "admin/tahunajaran/del_tahunajaran.php";
								break;
							case 'aktif-tahunajaran':
								include "admin/tahunajaran/aktif_tahunajaran.php";
								break;

								//Jenis Bayar Siswa
							case 'data-jenis-bayar-siswa':
								include "admin/jenis_bayar_siswa/data_jenis_bayar_siswa.php";
								break;
							case 'add-jenis-bayar-siswa':
								include "admin/jenis_bayar_siswa/add_jenis_bayar_siswa.php";
								break;
							case 'edit-jenis-bayar-siswa':
								include "admin/jenis_bayar_siswa/edit_jenis_bayar_siswa.php";
								break;
							case 'del-jenis-bayar-siswa':
								include "admin/jenis_bayar_siswa/del_jenis_bayar_siswa.php";
								break;
								//Bulanan dan Bebas
							case 'add-bulanan':
								include "admin/jenis_bayar_siswa/bulanan/add_bulanan.php";
								break;
							case 'hapus-bulanan':
								include "admin/jenis_bayar_siswa/bulanan/hapus_bulanan.php";
								break;
							case 'hapus-bebas':
								include "admin/jenis_bayar_siswa/bulanan/hapus_bebas.php";
								break;

								//Jenis Pemasukan Lainya
							case 'data-pemasukan-lain':
								include "admin/pemasukan_lain/data_pemasukan_lain.php";
								break;
							case 'add-pemasukan-lain':
								include "admin/pemasukan_lain/add_pemasukan_lain.php";
								break;
							case 'edit-pemasukan-lain':
								include "admin/pemasukan_lain/edit_pemasukan_lain.php";
								break;
							case 'del-pemasukan-lain':
								include "admin/pemasukan_lain/del_pemasukan_lain.php";
								break;
							case 'detail-transaksi-pemasukan':
								include "admin/pemasukan_lain/detail_transaksi_pemasukan.php";
								break;
							case 'transaksi-pemasukan':
								include "admin/pemasukan_lain/transaksi_pemasukan.php";
								break;
								//Setting Pemasukan
							case 'setting-pemasukan':
								include "admin/pemasukan_lain/setting_pemasukan/add_setting_pembayaran.php";
								break;
							case 'hapus-pemasukan':
								include "admin/pemasukan_lain/setting_pemasukan/hapus_pemasukan.php";
								break;

								//Jenis Pengeluaran Lainya
							case 'data-pengeluaran-lain':
								include "admin/pengeluaran_lain/data_pengeluaran_lain.php";
								break;
							case 'add-pengeluaran-lain':
								include "admin/pengeluaran_lain/add_pengeluaran_lain.php";
								break;
							case 'edit-pengeluaran-lain':
								include "admin/pengeluaran_lain/edit_pengeluaran_lain.php";
								break;
							case 'del-pengeluaran-lain':
								include "admin/pengeluaran_lain/del_pengeluaran_lain.php";
								break;
							case 'detail-transaksi-pengeluaran':
								include "admin/pengeluaran_lain/detail_transaksi_pengeluaran.php";
								break;
							case 'transaksi-pengeluaran':
								include "admin/pengeluaran_lain/transaksi_pengeluaran.php";
								break;
								//Setting Pengeluaran
							case 'setting-pengeluaran':
								include "admin/pengeluaran_lain/setting_pengeluaran/add_setting_pembayaran.php";
								break;
							case 'hapus-pengeluaran':
								include "admin/pengeluaran_lain/setting_pengeluaran/hapus_pengeluaran.php";
								break;

								//Jenis Bayar Guru
							case 'data-jenis-bayar-guru':
								include "admin/jenis_bayar_guru/data_jenis_bayar_guru.php";
								break;
							case 'add-jenis-bayar-guru':
								include "admin/jenis_bayar_guru/add_jenis_bayar_guru.php";
								break;
							case 'edit-jenis-bayar-guru':
								include "admin/jenis_bayar_guru/edit_jenis_bayar_guru.php";
								break;
							case 'del-jenis-bayar-guru':
								include "admin/jenis_bayar_guru/del_jenis_bayar_guru.php";
								break;
								//Bulanan dan Bebas
							case 'add-bulanan-guru':
								include "admin/jenis_bayar_guru/bulanan/add_bulanan_guru.php";
								break;
							case 'hapus-bulanan-guru':
								include "admin/jenis_bayar_guru/bulanan/hapus_bulanan_guru.php";
								break;
							case 'edit-bulanan-guru':
								include "admin/jenis_bayar_guru/bulanan/edit_bulanan_guru.php";
								break;
							case 'hapus-bebas-guru':
								include "admin/jenis_bayar_guru/bulanan/hapus_bebas_guru.php";
								break;

								//Transaksi Siswa
							case 'data-transaksi-siswa':
								include "admin/transaksi_siswa/data_transaksi_siswa.php";
								break;
							case 'detail-transaksi-siswa':
								include "admin/transaksi_siswa/detail_transaksi_siswa.php";
								break;
								//Transaksi Iuran lainya
							case 'transaksi-bebas-siswa':
								include "admin/transaksi_siswa/bebas/transaksi_bebas_siswa.php";
								break;
							case 'transaksi-bulanan-siswa':
								include "admin/transaksi_siswa/bebas/transaksi_bulanan_siswa.php";
								break;

								//Transaksi Guru
							case 'data-transaksi-guru':
								include "admin/transaksi_guru/data_transaksi_guru.php";
								break;
							case 'detail-transaksi-guru':
								include "admin/transaksi_guru/detail_transaksi_guru.php";
								break;
								//Transaksi Iuran lainya
							case 'transaksi-bebas-guru':
								include "admin/transaksi_guru/bebas/transaksi_bebas_guru.php";
								break;
							case 'transaksi-bulanan-guru':
								include "admin/transaksi_guru/bebas/transaksi_bulanan_guru.php";
								break;

								//Arus Keuangan
							case 'data-arus-keuangan':
								include "admin/arus_keuangan/data_arus_keuangan.php";
								break;

								//Laporan Siswa
							case 'data-laporan-siswa':
								include "admin/laporan/siswa/data_laporan_siswa.php";
								break;
							case 'data-pembayaran-spp-siswa':
								include "admin/laporan/siswa/data_pembayaran_spp_siswa.php";
								break;
							case 'data-pembayaran-bebas-siswa':
								include "admin/laporan/siswa/data_pembayaran_bebas_siswa.php";
								break;

								//Laporan Guru
							case 'data-pembayaran-gaji-guru':
								include "admin/laporan/guru/data_pembayaran_gaji_guru.php";
								break;


								//default
							default:
								echo "<center><h1> ERROR !</h1></center>";
								break;
						}
					} else {
						// Auto Halaman Home Pengguna
						include "home/admin.php";
					}
					?>

				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			Copyright &copy; 2023. Developer -
			<a target="_blank" href="#">
				<strong> Araman Patymoa</strong>
			</a>.
			All rights reserved.
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Select2 -->
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<!-- DataTables -->
	<script src="plugins/datatables/jquery.dataTables.js"></script>
	<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="dist/js/demo.js"></script>
	<!-- page script -->
	<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

	<script>
		$(function() {
			$("#example1").DataTable();
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
			});
		});
	</script>

	<script>
		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2()

			//Initialize Select2 Elements
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			})
		})
	</script>
	<script type="text/javascript">
		window.onload = function() {
			jam();
		}

		function jam() {
			var e = document.getElementById('jam'),
				d = new Date(),
				h, m, s;
			h = d.getHours();
			m = set(d.getMinutes());
			s = set(d.getSeconds());

			e.innerHTML = h + ':' + m + ':' + s;

			setTimeout('jam()', 1000);
		}

		function set(e) {
			e = e < 10 ? '0' + e : e;
			return e;
		}
	</script>
</body>

</html>