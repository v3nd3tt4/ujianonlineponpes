<style>
	#qrcode {
		display: inline-block;
		margin: 0 auto;
	}
</style>

<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Data Kelas Anda</h4>
					</div>

					<div class="card-body">
						<?php if (!empty($kelas_list)): ?>
							<div class="responsive-table">
								<table class="table table-striped table-bordered dataTables table-hover">
									<thead>
										<tr>
											<th width="5%">No</th>
											<th width="15%">Nama Kelas</th>
											<th width="20%">Tahun Akademik</th>
											<th width="20%">Wali Kelas</th>
											<th width="25%">Keterangan</th>
											<th width="15%">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($kelas_list as $kelas): ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= htmlspecialchars($kelas->nama_kelas) ?></td>
												<td><?= htmlspecialchars($kelas->tahun) ?></td>
												<td><?= htmlspecialchars($kelas->wali_kelas) ?></td>
												<td><?= htmlspecialchars($kelas->keterangan) ?></td>
												<td>
													<button class="btn btn-warning btn-sm" onclick="showQRCode('<?= $this->session->userdata('nis') ?>', '<?= $this->session->userdata('id_user') ?>', '<?= htmlspecialchars($this->session->userdata('nama')) ?>')">
														<i class="fa fa-qrcode"></i> QR Kartu Ujian
													</button>
													<a href="<?= base_url('User/kelas/cetak_kartu_ujian') ?>" class="btn btn-primary btn-sm" target="_blank">
														<i class="fa fa-print"></i> Cetak Kartu Ujian
													</a>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						<?php else: ?>
							<div class="alert alert-warning">
								<strong>Peringatan!</strong> Anda belum terdaftar di kelas manapun.
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- Modal Daftar Siswa Kelas -->
<div class="modal fade" id="siswaKelasModal" tabindex="-1" role="dialog" aria-labelledby="siswaKelasModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="siswaKelasModalLabel">Daftar Siswa Kelas</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="siswaKelasContent">
				<!-- Content will be loaded here -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-check"></i> Tutup</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Biodata -->
<div class="modal fade" id="biodataModal" tabindex="-1" role="dialog" aria-labelledby="biodataModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="biodataModalLabel">Biodata Siswa</h4>
			</div>
			<div class="modal-body" id="biodataContent">
				<!-- Content will be loaded here -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal QR Code -->
<div class="modal fade" id="qrCodeModal" tabindex="-1" role="dialog" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title" id="qrCodeModalLabel">QR Code Siswa</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body text-center">
				<!-- Keterangan / Notice -->
				<div id="qrcode" class="mb-3" style="border: 2px solid #e0e0e0; border-radius: 16px; display: inline-block; padding: 16px; background: #fff;"></div>

				<div class="alert alert-info p-2" role="alert" style="font-size: 14px;">
					Tunjukkan QR Code ini kepada petugas untuk verifikasi kehadiran.
				</div>
			</div>

			<hr style="margin:0;">
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">
					<i class="fa fa-check"></i> Tutup
				</button>
			</div>

		</div>
	</div>
</div>


<!-- Modal Pilihan Cetak -->
<div class="modal fade" id="kartujianModal" tabindex="-1" role="dialog" aria-labelledby="kartujianModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="kartujianModalLabel">Cetak Kartu Ujian</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<div class="mb-3">
					<i class="fa fa-id-card" style="font-size: 48px; color: #0066cc;"></i>
				</div>
				<p>Pilih format cetak kartu ujian:</p>

				<div class="d-grid gap-2">
					<a href="<?= base_url('User/kelas/cetak_kartu_ujian') ?>" target="_blank" class="btn btn-primary">
						<i class="fa fa-id-card"></i> Ukuran Kartu (85x54mm)
					</a>
					<a href="<?= base_url('User/kelas/cetak_kartu_ujian_a4') ?>" target="_blank" class="btn btn-success">
						<i class="fa fa-file-pdf-o"></i> Format A4 (2 Kartu + Backup)
					</a>
				</div>

				<div class="alert alert-info mt-3 p-2" role="alert" style="font-size: 12px;">
					<strong>Info:</strong> Kartu dilengkapi QR Code untuk verifikasi kehadiran ujian.
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
					<i class="fa fa-times"></i> Tutup
				</button>
			</div>
		</div>
	</div>
</div>
