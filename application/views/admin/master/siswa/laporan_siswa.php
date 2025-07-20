<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title><?= $judul ?></title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 20px;
		}

		.header {
			text-align: center;
			margin-bottom: 10px;
		}

		.kop-image {
			width: 100%;
			max-height: 150px;
			margin-bottom: 20px;
		}


		.header h2 {
			margin: 0;
			font-size: 28px;
			font-weight: bold;
			letter-spacing: 1px;
		}

		.desc {
			margin-bottom: 50px;
			font-size: 16px;
			text-align: center;
		}

		.info {
			margin-bottom: 20px;
			font-size: 14px;
			text-align: right;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
			font-size: 13px;
		}

		th,
		td {
			border: 1px solid #333;
			padding: 7px 5px;
			text-align: left;
		}

		th {
			background: #f2f2f2;
			font-weight: bold;
			text-align: center;
		}

		.footer {
			text-align: right;
			font-size: 13px;
			margin-top: 10px;
		}
	</style>
</head>

<body>
	<div class="header">
		<img src="<?= base_url('assets/kop.png') ?>" class="kop-image" alt="Kop Surat">
		<h2><?= strtoupper($judul) ?></h2>
	</div>
	<div class="desc">
		<?= $deskripsi ?>
	</div>
	<div class="info">
		<strong>Total Data:</strong> <?= $total_data ?>
	</div>
	<table>
		<thead>
			<tr>
				<?php foreach ($header as $h): ?>
					<th><?= htmlspecialchars($h) ?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php if (!empty($data)): ?>
				<?php foreach ($data as $row): ?>
					<tr>
						<?php foreach ($row as $i => $col): ?>
							<td>
								<?php
								// Jenis Kelamin
								if ($header[$i] == 'Jenis Kelamin') {
									echo $col == 'L' ? 'Laki-laki' : ($col == 'P' ? 'Perempuan' : '-');
								} else {
									echo htmlspecialchars($col);
								}
								?>
							</td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			<?php else: ?>
				<tr>
					<td colspan="<?= count($header) ?>" style="text-align:center; color:#888;">Tidak ada data siswa.</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>

	<div class="footer">
		<strong>Waktu Cetak:</strong> <?= $waktu_cetak ?>
	</div>
</body>

</html>
