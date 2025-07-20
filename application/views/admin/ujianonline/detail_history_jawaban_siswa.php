<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-wrap">
							<div class="card-header d-flex justify-content-between">
								<h4>Detail Jawaban Ujian</h4>
								<a href="<?= base_url('ujianonline/history_jawaban_siswa/' . $jadwal_ujian_id) ?>" class="btn btn-secondary">
									<i class="fa fa-arrow-left"></i> Kembali
								</a>
							</div>
							<div class="card-body">
								<div class="table-responsive mb-3">
									<table class="table table-bordered" style="width: 100%; font-size: 14px;">
										<tr>
											<th style="width: 15%; padding: 6px;">NIS</th>
											<td style="width: 35%; padding: 6px;"><?= $jawaban_ujian->nis ?></td>
											<th style="width: 15%; padding: 6px;">Nama Siswa</th>
											<td style="width: 35%; padding: 6px;"><?= $jawaban_ujian->nama_siswa ?></td>
										</tr>
										<tr>
											<th style="padding: 6px;">Mata Pelajaran</th>
											<td style="padding: 6px;"><?= $jawaban_ujian->nama_matapelajaran ?></td>
											<th style="padding: 6px;">Kelas</th>
											<td style="padding: 6px;"><?= $jawaban_ujian->nama_kelas ?></td>
										</tr>
										<tr>
											<th style="padding: 6px;">Jenis Ujian</th>
											<td style="padding: 6px;"><?= $jawaban_ujian->jenis_ujian ?></td>
											<th style="padding: 6px;">Tanggal Ujian</th>
											<td style="padding: 6px;"><?= date('d/m/Y', strtotime($jawaban_ujian->tanggal_ujian)) ?></td>
										</tr>
										<tr>
											<th style="padding: 6px;">Nilai Akhir</th>
											<td style="padding: 6px;"><?= number_format($jawaban_ujian->nilai_akhir, 1) ?></td>
											<td colspan="2"></td>
										</tr>
									</table>
								</div>


								<div class="alert alert-info">
									<b>Statistik:</b>
									<span class="badge badge-success ml-2">Benar: <?= $statistik['benar'] ?></span>
									<span class="badge badge-danger ml-2">Salah: <?= $statistik['salah'] ?></span>
									<span class="badge badge-warning ml-2">Kosong: <?= $statistik['kosong'] ?></span>
									<span class="badge badge-primary ml-2">Total Soal: <?= $statistik['total'] ?></span>
								</div>


								<div class="table-responsive">
									<table class="table table-bordered table-hover">
										<thead>
											<tr>
												<th width="5%">No</th>
												<th>Pertanyaan</th>
												<th width="10%">Jawaban Anda</th>
												<th width="10%">Kunci</th>
												<th width="10%">Status</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($detail_jawaban as $row): ?>
												<tr>
													<td class="text-center"><b><?= $row['nomor'] ?></b></td>
													<td><?= htmlspecialchars($row['soal']->soal) ?>
														<?php if ($row['soal']->gambar_soal): ?>
															<br><br>
															<img src="<?= base_url('assets/uploads/soal/' . $row['soal']->gambar_soal) ?>"
																alt="Gambar Soal"
																style="max-width: 300px; max-height: 200px; border: 1px solid #ddd; border-radius: 4px;">
														<?php endif; ?>
													</td>
													<td class="text-center">
														<?php if ($row['jawaban_siswa']): ?>
															<span class="badge badge-<?= $row['status'] == 'benar' ? 'success' : ($row['status'] == 'salah' ? 'danger' : 'secondary') ?>">
																<?= $row['jawaban_siswa'] ?>
															</span>
														<?php else: ?>
															<span class="badge badge-secondary">-</span>
														<?php endif; ?>
													</td>
													<td class="text-center"><span class="badge badge-primary"><?= $row['kunci_jawaban'] ?></span></td>
													<td class="text-center">
														<?php if ($row['status'] == 'benar'): ?>
															<span class="badge badge-success">Benar</span>
														<?php elseif ($row['status'] == 'salah'): ?>
															<span class="badge badge-danger">Salah</span>
														<?php else: ?>
															<span class="badge badge-secondary">Kosong</span>
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
			</div>
		</div>
	</section>
</div>
