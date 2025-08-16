<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Kartu Ujian Siswa</title>
	<style>
		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
			border: 0;
		}

		body {
			font-family: Arial, sans-serif;
			font-size: 9px;
			margin: 0;
			padding: 0;
			background: #f9f9f9;
		}

		.kartu-ujian {
			width: 95mm;
			height: 35mm;
			border: 1px solid #0066cc;
			border-radius: 3px;
			padding: 2mm;
			box-sizing: border-box;
			background: #fff;
			position: relative;
			overflow: hidden;
		}

		.header {
			text-align: center;
			margin-bottom: 2mm;
			border-bottom: 1px solid #0066cc;
			padding-bottom: 1mm;
		}

		.title {
			font-size: 11px;
			font-weight: bold;
			color: #0066cc;
			margin: 0;
		}

		.subtitle {
			font-size: 7px;
			color: #666;
			margin: 0;
		}

		.content {
			width: 100%;
			overflow: hidden;
			margin-top: 2mm;
		}

		.left-section {
			width: 64.5%;
			float: left;
		}

		.right-section {
			width: 35%;
			display: flex;
			text-align: center;
			flex-direction: column;
			align-items: center;
			justify-content: center;
		}

		.info-table {
			width: 100%;
			font-size: 10px;
		}

		.info-label {
			font-weight: bold;
			color: #333;
			width: 20mm;
			white-space: nowrap;
			font-size: 9px;
		}

		.info-colon {
			width: 3mm;
			color: #333;
			text-align: center;
			font-size: 9px;
		}

		.info-value {
			color: #000;
			white-space: nowrap;
			font-size: 9px;
		}

		.qr-text {
			font-size: 4px;
			margin-top: 1mm;
			color: #666;
			font-style: italic;
		}

		.footer {
			font-size: 4px;
			color: #666;
			text-align: center;
			border-top: 1px solid #ddd;
			padding-top: 1mm;
			margin-top: 2mm;
		}
	</style>
</head>

<body>
	<div class="kartu-ujian">

		<!-- Header -->
		<div class="header">
			<h3 class="title">KARTU UJIAN</h3>
			<p class="subtitle">Tahun Akademik <?= $detail_siswa->tahun ?? '-' ?> Semester <?= $detail_siswa->semester ?? '-' ?></p>
		</div>

		<!-- Content -->
		<div class="content">
			<!-- Data Siswa -->
			<div class="left-section">
				<table class="info-table">
					<tr>
						<td class="info-label">NIS</td>
						<td class="info-colon">:</td>
						<td class="info-value"><?= $detail_siswa->nis ?? '-' ?></td>
					</tr>
					<tr>
						<td class="info-label">Nama</td>
						<td class="info-colon">:</td>
						<td class="info-value"><?= $detail_siswa->nama ?? '-' ?></td>
					</tr>
					<tr>
						<td class="info-label">Kelas</td>
						<td class="info-colon">:</td>
						<td class="info-value"><?= $detail_siswa->nama_kelas ?? '-' ?></td>
					</tr>
					<tr>
						<td class="info-label">L/P</td>
						<td class="info-colon">:</td>
						<td class="info-value">
							<?php
							if ($detail_siswa->jenis_kelamin ?? null) {
								echo ($detail_siswa->jenis_kelamin === 'L') ? 'Laki-laki' : 'Perempuan';
							} else {
								echo '-';
							}
							?>
						</td>

					</tr>
					<tr>
						<td class="info-label">TTL</td>
						<td class="info-colon">:</td>
						<td class="info-value">
							<?= $detail_siswa->tempat_lahir ?? '-' ?>,
							<?= $detail_siswa->tanggal_lahir ? date('d F Y', strtotime($detail_siswa->tanggal_lahir)) : '-' ?>
						</td>
					</tr>
				</table>
			</div>

			<!-- QR Code -->
			<div class="right-section">
				<img src="<?= $qr_code_image ?>" alt="QR Code" width="65%">
				<div class="qr-text">( Scan untuk verifikasi )</div>
			</div>
		</div>

		<!-- Footer -->
		<div class="footer">
			Kartu Ujian Siswa di Cetak pada: <?= $tanggal_cetak ?>
		</div>
	</div>
</body>

</html>
