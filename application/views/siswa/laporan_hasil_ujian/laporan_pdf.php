<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Laporan Hasil Ujian Siswa</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 20px;
			font-size: 12px;
		}

		.header {
			text-align: center;
			margin-bottom: 20px;
			border-bottom: 2px solid #333;
			padding-bottom: 10px;
		}

		.header h2 {
			margin: 0;
			font-size: 18px;
			font-weight: bold;
			letter-spacing: 1px;
		}

		.header h3 {
			margin: 5px 0;
			font-size: 14px;
			font-weight: normal;
		}

		.info-section {
			margin-bottom: 20px;
		}

		.info-table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 15px;
		}

		.info-table td {
			padding: 3px 5px;
			vertical-align: top;
		}

		.info-table td:first-child {
			font-weight: bold;
			width: 120px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
			font-size: 11px;
		}

		th,
		td {
			border: 1px solid #333;
			padding: 5px;
			text-align: left;
		}

		th {
			background: #f2f2f2;
			font-weight: bold;
			text-align: center;
		}

		.footer {
			text-align: right;
			font-size: 10px;
			margin-top: 30px;
		}

		.no-data {
			text-align: center;
			color: #888;
			font-style: italic;
			padding: 20px;
		}

		.nilai {
			text-align: center;
			font-weight: bold;
		}

		.status-lulus {
			color: #28a745;
			font-weight: bold;
		}

		.status-tidak-lulus {
			color: #dc3545;
			font-weight: bold;
		}
	</style>
</head>

<body>
	<div class="header">
		<h2>LAPORAN HASIL UJIAN SISWA</h2>
		<h3>Sistem Ujian Online Pondok Pesantren</h3>
	</div>

	<div class="info-section">
		<table class="info-table">
			<tr>
				<td>Nama Siswa</td>
				<td>: <?= $detail_siswa->nama ?></td>
				<td>Kelas</td>
				<td>: <?= $detail_kelas->nama_kelas ?></td>
			</tr>
			<tr>
				<td>NIS</td>
				<td>: <?= $detail_siswa->nis ?></td>
				<td>Wali Kelas</td>
				<td>: <?= $detail_kelas->wali_kelas ?></td>
			</tr>
			<tr>
				<td>Tempat, Tanggal Lahir</td>
				<td>: <?= $detail_siswa->tempat_lahir ?>, <?= date('d-m-Y', strtotime($detail_siswa->tanggal_lahir)) ?></td>
				<td>Tahun Akademik</td>
				<td>: <?= $detail_kelas->tahun ?> (<?= $detail_kelas->semester ?>)</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>: <?= $detail_siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
				<td>Tanggal Cetak</td>
				<td>: <?= date('d-m-Y H:i') ?></td>
			</tr>
		</table>
	</div>

	<?php if (!empty($hasil_ujian)): ?>
		<table>
			<thead>
				<tr>
					<th width="5%">No</th>
					<th width="20%">Mata Pelajaran</th>
					<th width="25%">Jenis Ujian</th>
					<th width="12%">Tanggal Ujian</th>
					<th width="10%">Nilai Akhir</th>
					<th width="8%">Status</th>
					<!-- <th width="20%">Keterangan</th> -->
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; foreach ($hasil_ujian as $row): ?>
					<tr>
						<td style="text-align: center;"><?= $no++ ?></td>
						<td><?= $row->nama_matapelajaran ?></td>
						<td><?= $row->jenis_ujian ?></td>
						<td style="text-align: center;"><?= date('d-m-Y', strtotime($row->tanggal_ujian)) ?></td>
						<td class="nilai"><?= number_format($row->nilai_akhir, 1) ?></td>
						<td style="text-align: center;">
							<?php if ($row->status == 'selesai'): ?>
								<span class="status-lulus">Selesai</span>
							<?php else: ?>
								<span class="status-tidak-lulus"><?= ucfirst($row->status) ?></span>
							<?php endif; ?>
						</td>
						<!-- <td>
							<?php 
							if ($row->nilai_akhir >= 75) {
								echo "Sangat Baik";
							} elseif ($row->nilai_akhir >= 60) {
								echo "Baik";
							} elseif ($row->nilai_akhir >= 40) {
								echo "Cukup";
							} else {
								echo "Kurang";
							}
							?>
						</td> -->
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<div style="margin-top: 20px;">
			<table class="info-table">
				<tr>
					<td>Total Ujian</td>
					<td>: <?= count($hasil_ujian) ?> kali</td>
				</tr>
				<tr>
					<td>Rata-rata Nilai</td>
					<td>: <?= number_format(array_sum(array_column($hasil_ujian, 'nilai_akhir')) / count($hasil_ujian), 1) ?></td>
				</tr>
				<tr>
					<td>Jumlah Selesai</td>
					<td>: <?= count(array_filter($hasil_ujian, function($item) { return $item->status == 'selesai'; })) ?> kali</td>
				</tr>
				<tr>
					<td>Jumlah Belum Selesai</td>
					<td>: <?= count(array_filter($hasil_ujian, function($item) { return $item->status != 'selesai'; })) ?> kali</td>
				</tr>
			</table>
		</div>
	<?php else: ?>
		<div class="no-data">
			Belum ada data hasil ujian untuk kelas yang dipilih.
		</div>
	<?php endif; ?>

	<div class="footer">
		<p>Dicetak pada: <?= date('d-m-Y H:i:s') ?></p>
		<p>Laporan ini dibuat secara otomatis oleh sistem</p>
	</div>
</body>

</html> 