<div class="row">
	<div class="col-md-8">
		<h4>Biodata Siswa</h4>
		<table class="table table-bordered">
			<tr>
				<th width="150">Nama Lengkap</th>
				<td><?= htmlspecialchars($siswa->nama) ?></td>
			</tr>
			<tr>
				<th>NIS</th>
				<td><?= htmlspecialchars($siswa->nis) ?></td>
			</tr>
			<tr>
				<th>Tempat Lahir</th>
				<td><?= htmlspecialchars($siswa->tempat_lahir) ?></td>
			</tr>
			<tr>
				<th>Tanggal Lahir</th>
				<td><?= date('d/m/Y', strtotime($siswa->tanggal_lahir)) ?></td>
			</tr>
			<tr>
				<th>Jenis Kelamin</th>
				<td><?= $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
			</tr>
			<tr>
				<th>Alamat</th>
				<td><?= htmlspecialchars($siswa->alamat) ?></td>
			</tr>
			<tr>
				<th>Email</th>
				<td><?= htmlspecialchars($siswa->email) ?></td>
			</tr>
			<tr>
				<th>No HP</th>
				<td><?= htmlspecialchars($siswa->no_hp) ?></td>
			</tr>
			<tr>
				<th>Nama Ibu</th>
				<td><?= htmlspecialchars($siswa->nama_ibu) ?></td>
			</tr>
			<tr>
				<th>Nama Ayah</th>
				<td><?= htmlspecialchars($siswa->nama_ayah) ?></td>
			</tr>
			<tr>
				<th>Pekerjaan Ibu</th>
				<td><?= htmlspecialchars($siswa->pekerjaan_ibu) ?></td>
			</tr>
			<tr>
				<th>Pekerjaan Ayah</th>
				<td><?= htmlspecialchars($siswa->pekerjaan_ayah) ?></td>
			</tr>
			<tr>
				<th>Tahun Masuk</th>
				<td><?= htmlspecialchars($siswa->tahun_masuk) ?></td>
			</tr>
		</table>
	</div>
	<div class="col-md-4">
		<h4>QR Code</h4>
		<div class="text-center">
			<img src="<?= base_url('user/kelas/generate_qr/' . $siswa->id) ?>"
				alt="QR Code"
				class="img-responsive"
				style="max-width: 300px; margin: 0 auto;">
			<br>
			<small class="text-muted">QR Code berisi data: <?= htmlspecialchars($qr_data) ?></small>
		</div>
	</div>
</div>
