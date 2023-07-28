<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-user"></i> Profil</h3>
		</h3>
		<div class="card-tools">
		</div>
	</div>
	<div class="card-body p-0">
		<table class="table">
			<tbody>
				<tr>
					<td style="width: 150px">
						<b>Nama</b>
					</td>
					<td>: 
							<?php echo $data_nama; ?>
					</td>
				</tr>
				<tr>
					<td style="width: 150px">
						<b>Username</b>
					</td>
					<td>:
							<?php echo $data_user; ?>
					</td>
				</tr>
				<tr>
					<td style="width: 150px">
						<b>Password</b>
					</td>
					<td>:
							<?php echo $data_pass; ?>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="card-footer">
			<a href="index.php" class="btn btn-warning">Kembali</a>
		</div>
	</div>
</div>