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
</style>

<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Mengerjakan Ujian: <?= htmlspecialchars($jadwal->nama_matapelajaran ?? '-') ?></h4>
					</div>

					<div class="card-body">
						<div class="row">
							<div class="col-md-2 col-sm-3" id="soal-nav-col">
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
							<div class="col-md-10 col-sm-9">
								<div class="row">
									<div class="col-md-6">
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

								<div class="alert alert-info">Waktu Tersisa: <span id="timer"></span></div>
								<?php if (!empty($soal)): ?>
								<?php endif; ?>

								<form method="post" action="<?= base_url('user/ujianonline/submit_jawaban/' . $jadwal->id) ?>" id="form-ujian">
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
										<div class="mt-3">
											<button type="submit" class="btn btn-success">Selesai &amp; Simpan Jawaban</button>
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
