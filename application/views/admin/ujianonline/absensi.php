<!-- Additional CSS for better flash message styling -->
<style>
	#flashMessage .alert {
		margin-bottom: 15px;
		border-radius: 4px;
	}

	#flashMessage .alert-success {
		background-color: #d4edda;
		border-color: #c3e6cb;
		color: #155724;
	}

	#flashMessage .alert-danger {
		background-color: #f8d7da;
		border-color: #f5c6cb;
		color: #721c24;
	}

	#flashMessage .alert-info {
		background-color: #d1ecf1;
		border-color: #bee5eb;
		color: #0c5460;
	}

	#flashMessage .fa {
		margin-right: 8px;
	}
</style>

<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Data Peserta Ujian Online</h4>
						<div>
							<a href="<?= base_url('Ujianonline') ?>" class="btn btn-secondary">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#scanModal">
								<i class="fa fa-qrcode"></i> Scan QR Code
							</button>
						</div>
					</div>

					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover">
										<tr>
											<th width="200">Mata Pelajaran</th>
											<td width="10">:</td>
											<td><?= $jadwal->nama_matapelajaran ?></td>
										</tr>
										<tr>
											<th>Kelas</th>
											<td>:</td>
											<td><?= $jadwal->nama_kelas ?></td>
										</tr>
										<tr>
											<th>Tahun Akademik</th>
											<td>:</td>
											<td><?= $jadwal->tahun ?> - <?= $jadwal->semester ?></td>
										</tr>
										<tr>
											<th>Tanggal Ujian</th>
											<td>:</td>
											<td><?= date('d/m/Y', strtotime($jadwal->tanggal_ujian)) ?></td>
										</tr>
										<tr>
											<th>Waktu</th>
											<td>:</td>
											<td><?= date('H:i', strtotime($jadwal->jam_mulai)) ?> - <?= date('H:i', strtotime($jadwal->jam_selesai)) ?> (<?= $jadwal->lama_ujian ?> Menit)</td>
										</tr>
										<tr>
											<th>Jenis Ujian</th>
											<td>:</td>
											<td><?= $jadwal->jenis_ujian ?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>

						<hr>

						<div class="table-responsive">
							<table id="datatables-example" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th width="5%">No</th>
										<th width="15%">NIS</th>
										<th>Nama Siswa</th>
										<th width="10%">L/P</th>
										<th width="15%">Status</th>
										<th width="15%">Waktu Hadir</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($siswa as $row):
									?>
										<tr id="siswa-<?= $row->id ?>">
											<td><?= $no++ ?></td>
											<td><?= $row->nis ?></td>
											<td><?= $row->nama ?></td>
											<td><?= $row->jenis_kelamin ?></td>
											<td>
												<?php if ($row->waktu_hadir): ?>
													<span class="label label-success">Hadir</span>
												<?php else: ?>
													<span class="label label-warning">Belum Hadir</span>
												<?php endif; ?>
											</td>
											<td>
												<?php if ($row->waktu_hadir): ?>
													<?= date('d/m/Y H:i', strtotime($row->waktu_hadir)) ?>
												<?php else: ?>
													-
												<?php endif; ?>
											</td>

										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- Modal QR Scanner -->
<div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-labelledby="scanModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="scanModalLabel">Scan QR Code</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Flash Message Container -->
				<div id="flashMessage" style="display: none;"></div>

				<div class="alert alert-info">
					<i class="fa fa-info-circle"></i> Silakan scan QR Code pada kartu ujian siswa.
				</div>
				<div id="reader"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					<i class="fa fa-times"></i> Tutup
				</button>
			</div>
		</div>
	</div>
</div>
