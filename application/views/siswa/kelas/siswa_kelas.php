<div class="table-responsive">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th width="5%">No</th>
				<th width="15%">NIS</th>
				<th>Nama Siswa</th>
				<th width="10%">L/P</th>
				<th width="15%">Email</th>
				<th width="15%">No HP</th>
				<th width="15%">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php if (empty($siswa_kelas)): ?>
				<tr>
					<td colspan="7" class="text-center">Belum ada siswa di kelas ini</td>
				</tr>
			<?php else: ?>
				<?php $no = 1;
				foreach ($siswa_kelas as $siswa): ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= htmlspecialchars($siswa->nis) ?></td>
						<td><?= htmlspecialchars($siswa->nama) ?></td>
						<td><?= $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
						<td><?= htmlspecialchars($siswa->email) ?></td>
						<td><?= htmlspecialchars($siswa->no_hp) ?></td>
						<td>
							<button class="btn btn-info btn-sm" onclick="showBiodata(<?= $siswa->id ?>)">
								<i class="fa fa-user"></i> Biodata
							</button>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
</div>
