<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Daftar Kelas Wali Kelas</h4>
					</div>
					<div class="card-body">
						<div class="alert alert-info">
							<i class="fas fa-info-circle"></i>
							Menampikan Kelas yang merupakan anda sebagai wali kelas nya.
							<p class="mb-0">
								Anda dapat melihat daftar siswa pada kelas tersebut dengan mengklik tombol "Lihat Siswa".
							</p>
						</div>
						<?php if (isset($kelas) && count($kelas) > 0): ?>
							<div class="table-responsive">
								<table class="table table-bordered table-striped mt-3 dataTables">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Kelas</th>
											<th>Tahun Akademik</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($kelas as $k): ?>
											<tr>
												<td><?= $no++; ?></td>
												<td><?= htmlspecialchars($k->nama_kelas); ?></td>
												<td><?= htmlspecialchars($k->tahun_akademik); ?></td>
												<td>
													<a href="<?= site_url('guru/kelas/daftar_siswa/' . $k->kelasrombel_id) ?>" class="btn btn-primary btn-sm">
														<i class="fas fa-eye"></i> Lihat Siswa
													</a>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						<?php else: ?>
							<div class="alert alert-info">
								Anda tidak menjadi wali kelas pada kelas manapun.
							</div>
						<?php endif; ?>
					</div>
				</div>

			</div>
		</div>
	</section>
</div>
