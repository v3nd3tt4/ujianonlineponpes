<div class="kartu-ujian">
	<div class="header">
		<h3 class="title">KARTU UJIAN</h3>
		<p class="subtitle">
			Tahun Akademik <?= $detail_siswa->tahun ?? '-' ?>
			Semester <?= $detail_siswa->semester ?? '-' ?>
		</p>
	</div>

	<div class="content">
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
						if (isset($detail_siswa->jenis_kelamin)) {
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
						<?= isset($detail_siswa->tanggal_lahir) ? date('d/m/Y', strtotime($detail_siswa->tanggal_lahir)) : '-' ?>
					</td>
				</tr>
			</table>
		</div>

		<div class="right-section">
			<img src="<?= $qr_code_image ?>" alt="QR Code" width="65%">
			<div class="qr-text">( Scan untuk verifikasi )</div>
		</div>
	</div>

	<div class="footer">
		Kartu Ujian Siswa di Cetak pada: <?= $tanggal_cetak ?>
	</div>
</div>
