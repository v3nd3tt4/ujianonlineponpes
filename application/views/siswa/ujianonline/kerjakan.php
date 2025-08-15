<style>
	.soal-card {
		display: inline-block;
		width: 40px;
		height: 40px;
		line-height: 40px;
		text-align: center;
		border-radius: 8px;
		background: #eee;
		margin: 0 4px 8px 0;
		font-weight: bold;
		cursor: pointer;
		border: 2px solid #ccc;
		transition: 0.2s;
	}

	.soal-card.active {
		background: orange;
		color: #fff;
		border-color: orange;
	}

	.soal-card.answered {
		background: #4caf50;
		color: #fff;
		border-color: #4caf50;
	}

	.soal-card.unanswered {
		background: #eee;
		color: #888;
		border-color: #ccc;
	}

	/* Styling untuk tombol navigasi */
	.navigation-buttons {
		margin-top: 20px;
		padding: 15px 0;
		border-top: 1px solid #eee;
	}

	.navigation-buttons .btn {
		min-width: 120px;
		margin: 0 5px;
	}

	/* Responsive untuk mobile */
	@media (max-width: 768px) {
		.navigation-buttons .btn {
			min-width: 100px;
			font-size: 14px;
			padding: 8px 12px;
		}

		.card-header .row {
			flex-direction: column;
		}

		.card-header .col-md-4 {
			margin-top: 10px;
			text-align: center !important;
		}
	}

	/* Styling untuk timer dan tombol akhiri */
	.timer-section {
		background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
		color: white;
		padding: 15px;
		border-radius: 8px;
		margin-bottom: 20px;
	}

	.btn-akhiri-ujian {
		background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
		border: none;
		transition: all 0.3s ease;
	}

	.btn-akhiri-ujian:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
	}

	/* Styling untuk Accordion */
	.card.akordion {
		border: 1px solid #e3e6f0;
		border-radius: 8px;
		box-shadow: 0 2px 4px rgba(0,0,0,0.1);
		margin-bottom: 20px;
	}

	.card.akordion .card-header {
		background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
		border-bottom: 1px solid #e3e6f0;
		padding: 0;
		border-radius: 8px 8px 0 0;
	}

	.card.akordion .card-header button {
		text-decoration: none;
		color: white;
		font-weight: 600;
		padding: 15px 20px;
		width: 100%;
		text-align: left;
		border: none;
		background: transparent;
		transition: all 0.3s ease;
	}

	.card.akordion .card-header button:hover {
		background: rgba(255, 255, 255, 0.1);
		color: white;
		text-decoration: none;
	}

	.card.akordion .card-header button:focus {
		box-shadow: none;
		outline: none;
	}

	.card.akordion .card-header button.collapsed {
		background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
	}

	.card.akordion .card-header button:not(.collapsed) {
		background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
		color: white;
	}

	.card.akordion .card-header button i.fa-chevron-down {
		transition: transform 0.3s ease;
	}

	.card.akordion .card-header button:not(.collapsed) i.fa-chevron-down {
		transform: rotate(180deg);
	}

	.card.akordion .card-body {
		padding: 20px;
		background: white;
		border-radius: 0 0 8px 8px;
	}

	.card.akordion .table {
		margin-bottom: 0;
	}

	.card.akordion .table th {
		background: #f8f9fc;
		border-color: #e3e6f0;
		font-weight: 600;
		color: #5a5c69;
		width: 40%;
	}

	.card.akordion .table td {
		border-color: #e3e6f0;
		color: #858796;
	}

	/* Responsive untuk accordion */
	@media (max-width: 768px) {
		.card.akordion .card-header button {
			padding: 12px 15px;
			font-size: 14px;
		}

		.card.akordion .card-body {
			padding: 15px;
		}

		.card.akordion .table th,
		.card.akordion .table td {
			padding: 8px;
			font-size: 14px;
		}
	}

	/* Styling untuk card keterangan warna */
	.card .card-header h4 i {
		color: #4e73df;
		margin-right: 8px;
	}

	.card .card-body .d-flex.align-items-center {
		padding: 8px 0;
		border-bottom: 1px solid #f8f9fc;
	}

	.card .card-body .d-flex.align-items-center:last-child {
		border-bottom: none;
	}

	.card .card-body .text-muted {
		font-size: 14px;
		font-weight: 500;
	}

	/* Hover effect untuk keterangan */
	.card .card-body .d-flex.align-items-center:hover {
		background: #f8f9fc;
		border-radius: 6px;
		padding: 8px;
		margin: 0 -8px;
	}

	/* Responsive untuk keterangan warna */
	@media (max-width: 768px) {
		.card .card-body .d-flex.align-items-center {
			padding: 6px 0;
		}

		.card .card-body .text-muted {
			font-size: 13px;
		}

		.card .card-body .soal-card {
			width: 35px;
			height: 35px;
			line-height: 35px;
			font-size: 12px;
		}
	}
</style>

<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="row">
				<div class="col-md-4">
					<div class="card akordion">
						<div class="card-wrap">
							<div class="card-header" id="headingInfo">
								<h2 class="mb-0">
									<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseInfo" aria-expanded="true" aria-controls="collapseInfo">
										<i class="fas fa-info-circle"></i> Informasi Ujian: <?= htmlspecialchars($jadwal->nama_matapelajaran ?? '-') ?>
										<span class="float-right">
											<i class="fas fa-chevron-down"></i>
										</span>
									</button>
								</h2>
							</div>

							<div id="collapseInfo" class="collapse show" aria-labelledby="headingInfo">
								<div class="card-body">
									<table class="table table-bordered">
										<tr>
											<th>Mata Pelajaran</th>
											<td><?= htmlspecialchars($jadwal->nama_matapelajaran ?? '-') ?></td>
										</tr>
										<tr>
											<th>Kelas</th>
											<td><?= htmlspecialchars($jadwal->nama_kelas ?? '-') ?></td>
										</tr>
										<tr>
											<th>Tanggal Ujian</th>
											<td><?= htmlspecialchars($jadwal->tanggal_ujian ?? '-') ?></td>
										</tr>
										<tr>
											<th>Lama Ujian</th>
											<td><?= htmlspecialchars($jadwal->lama_ujian ?? '-') ?> Menit</td>
										</tr>
										<tr>
											<th>Jenis Ujian</th>
											<td><?= htmlspecialchars($jadwal->jenis_ujian ?? '-') ?></td>
										</tr>
										<tr>
											<th>Jumlah Soal</th>
											<td><?= isset($soal) ? count($soal) : 0 ?></td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-wrap">
							<div class="card-header d-flex justify-content-between">
								<h4>Nomor Soal</h4>
							</div>

							<div class="card-body">
								<div class="" id="soal-nav-col">
									<div id="soal-nav">
										<?php if (!empty($soal)): ?>
											<?php $no = 1;
											$jawaban_lama = $jawaban_ujian ? json_decode($jawaban_ujian->jawaban, true) : []; ?>
											<?php foreach ($soal as $idx => $s): ?>
												<span class="soal-card" data-no="<?= $idx ?>" id="card-<?= $idx ?>">
													<?= $no++ ?>
												</span>
											<?php endforeach; ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-wrap">
							<div class="card-header d-flex justify-content-between">
								<h4><i class="fas fa-info-circle"></i> Keterangan Warna</h4>
							</div>

							<div class="card-body">
								<div class="row">
									<div class="col-12">
										<div class="d-flex align-items-center mb-2">
											<span class="soal-card active" style="margin-right: 10px;">1</span>
											<span class="text-muted">Soal yang sedang aktif</span>
										</div>
										<div class="d-flex align-items-center mb-2">
											<span class="soal-card answered" style="margin-right: 10px;">2</span>
											<span class="text-muted">Soal yang sudah dijawab</span>
										</div>
										<div class="d-flex align-items-center">
											<span class="soal-card unanswered" style="margin-right: 10px;">3</span>
											<span class="text-muted">Soal yang belum dijawab</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-wrap">
							<div class="card-body">
								<div class="row">
									<div class="col-md-6">
										<div class="timer-section">
											<i class="fas fa-clock"></i> Waktu Tersisa: <span id="timer" style="font-weight: bold; font-size: 18px;"></span>
										</div>
									</div>
									<div class="col-md-6">
										<button type="button" class="btn btn-danger btn-akhiri-ujian float-right" id="btn-akhiri-ujian">
											<i class="fas fa-stop"></i> Akhiri Ujian
										</button>
									</div>
								</div>


								<?php if (!empty($soal)): ?>
								<?php endif; ?>

								<form method="post" action="<?= base_url('User/Ujianonline/submit_jawaban/' . $jadwal->id) ?>" id="form-ujian">
									<input type="hidden" name="banksoal_id" value="<?= $jadwal->banksoal_id ?>">
									<?php if (empty($soal)): ?>
										<div class="alert alert-warning">Soal belum tersedia.</div>
									<?php else: ?>
										<?php foreach ($soal as $idx => $s): ?>
											<div class="form-group soal-item" id="soal-<?= $idx ?>" style="display:<?= $idx == 0 ? 'block' : 'none' ?>;">
												<label><b><?= ($idx + 1) ?>. <?= htmlspecialchars($s->soal) ?></b></label>
												<?php if ($s->gambar_soal): ?>
													<div style="margin: 10px 0;">
														<img src="<?= base_url('assets/uploads/soal/' . $s->gambar_soal) ?>"
															alt="Gambar Soal"
															style="max-width: 100%; max-height: 300px; border: 1px solid #ddd; border-radius: 4px;">
													</div>
												<?php endif; ?>
												<div>
													<?php foreach (['A', 'B', 'C', 'D'] as $opt): ?>
														<div class="radio">
															<label>
																<input type="radio" name="jawaban[<?= $s->id ?>]" value="<?= $opt ?>" <?= (isset($jawaban_lama[$s->id]) && $jawaban_lama[$s->id] == $opt) ? 'checked' : '' ?>>
																<?= htmlspecialchars($s->{'pilihan_' . strtolower($opt)}) ?>
															</label>
														</div>
													<?php endforeach; ?>
												</div>
											</div>
										<?php endforeach; ?>

										<!-- Tombol Navigasi -->
										<div class="navigation-buttons">
											<div class="row">
												<div class="col-md-6">
													<button type="button" class="btn btn-secondary" id="btn-sebelumnya" style="display: none;">
														<i class="fas fa-arrow-left"></i> Sebelumnya
													</button>
												</div>
												<div class="col-md-6 text-right">
													<button type="button" class="btn btn-primary" id="btn-selanjutnya">
														Selanjutnya <i class="fas fa-arrow-right"></i>
													</button>
													<button type="submit" class="btn btn-success" id="btn-selesai" style="display: none;">
														<i class="fas fa-check"></i> Selesai &amp; Simpan Jawaban
													</button>
												</div>
											</div>
										</div>
									<?php endif; ?>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
