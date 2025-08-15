<div class="main-content">
	<section class="section">
		<div class="section-header d-flex align-items-center justify-content-between">
			<div>
				<h1 class="h5 mb-0 font-weight-bold text-dark">
					Daftar Siswa - <?= htmlspecialchars($kelas->nama_kelas) ?> (<?= htmlspecialchars($kelas->tahun) ?> - <?= htmlspecialchars($kelas->semester) ?>)
				</h1>
			</div>
			<a href="<?= site_url('Guru/kelas') ?>" class="btn btn-primary">
				<i class="fas fa-arrow-left"></i> Kembali
			</a>
		</div>
		<div class="section-body">
			<div class="card">
				<div class="card-body">
					<?php if (isset($siswa) && count($siswa) > 0): ?>
						<div class="table-responsive">
							<table class="table table-bordered table-striped dataTables">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Siswa</th>
										<th>NIS</th>
										<th>Jenis Kelamin</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($siswa as $sw): ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= htmlspecialchars($sw->nama); ?></td>
											<td><?= htmlspecialchars($sw->nis); ?></td>
											<td>
												<?= $sw->jenis_kelamin == 'L' ? 'Pria' : ($sw->jenis_kelamin == 'P' ? 'Wanita' : '-') ?>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php else: ?>
						<div class="alert alert-warning">
							Tidak ada siswa di kelas ini.
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
</div>
