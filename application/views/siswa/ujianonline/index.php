<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">

			<?php if ($this->session->flashdata('hasil_ujian')): 
				$hasil = $this->session->flashdata('hasil_ujian'); ?>
			<div class="row justify-content-center mb-4" id="hasil-ujian-card-row">
				<div class="col-md-6">
					<div class="card shadow border-<?= $hasil['status'] == 'Lulus' ? 'success' : 'danger' ?> position-relative">
						<button type="button" class="close position-absolute" style="right:18px;top:18px;font-size:2em;z-index:2;" aria-label="Close" onclick="document.getElementById('hasil-ujian-card-row').style.display='none';">
							<span aria-hidden="true">&times;</span>
						</button>
						<div class="card-body text-center">
							<h4 class="mb-3">Hasil Ujian Anda</h4>
							<div style="font-size:2.5em; font-weight:bold; color:<?= $hasil['status'] == 'Lulus' ? '#28a745' : '#dc3545' ?>;">
								<?= $hasil['nilai'] ?>
							</div>
							<div class="mb-2">Nilai KKM: <span style="font-weight:bold; color:#007bff;"><?= $hasil['kkm'] ?></span></div>
							<div class="mb-3">
								<?php if ($hasil['status'] == 'Lulus'): ?>
									<span class="badge badge-success" style="font-size:1.1em; padding:10px 20px;">Lulus 🎉</span>
								<?php else: ?>
									<span class="badge badge-danger" style="font-size:1.1em; padding:10px 20px;">Remedial 😢</span>
								<?php endif; ?>
							</div>
							<p class="text-muted mb-0">Silakan hubungi guru jika ingin melakukan remedial atau konsultasi nilai.</p>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Data Jadwal Ujian</h4>
					</div>

					<div class="card-body">
						<?php if (empty($jadwal)): ?>
							<div class="alert alert-info d-flex align-items-center" role="alert" style="font-size: 1.1em; padding: 20px;">
								<i class="fa fa-info-circle mr-3" style="font-size: 2em;"></i>
								<div>
									<strong>Tidak ada jadwal ujian online saat ini.</strong><br>
									<span class="text-dark">Silakan hubungi guru atau admin untuk informasi lebih lanjut.</span>
								</div>
							</div>
						<?php else: ?>
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover dataTables">
									<thead>
										<tr>
											<th width="5%">No</th>
											<th>Mata Pelajaran</th>
											<th>Kelas</th>
											<th>Tanggal Ujian</th>
											<th>Lama Ujian</th>
											<th>Jenis Ujian</th>
											<th>Waktu Presensi</th>
											<th>Status Ujian</th>
											<th>Nilai</th>
											<th>Benar</th>
											<th>Salah</th>
											<th>Keterangan</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php $no = 1;
										foreach ($jadwal as $j): ?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= htmlspecialchars($j->nama_matapelajaran) ?></td>
												<td><?= htmlspecialchars($j->nama_kelas) ?></td>
												<td><?= htmlspecialchars($j->tanggal_ujian) ?></td>
												<td><?= htmlspecialchars($j->lama_ujian) ?> Menit</td>
												<td><?= htmlspecialchars($j->jenis_ujian) ?></td>
												<td><?= htmlspecialchars($j->waktu_hadir) ?></td>
												<td>
													<?php
													if ($j->status_ujian == 'sedang') {
														echo '<span class="label label-warning">Sedang Mengerjakan</span>';
													} else if ($j->status_ujian == 'selesai') {
														echo '<span class="label label-success">Selesai</span>';
													} else {
														echo '<span class="label label-default">Belum</span>';
													}
													?>
												</td>
												<td>
													<?php if ($j->status_ujian == 'selesai'): ?>
														<?= is_null($j->nilai_akhir) ? '-' : $j->nilai_akhir ?>
													<?php else: ?>
														-
													<?php endif; ?>
												</td>
												<td>
													<?php if ($j->status_ujian == 'selesai' && $j->jawaban):
														// Ambil kunci jawaban dari database
														$soal = [];
														if (!empty($j->banksoal_id)) {
															$CI = &get_instance();
															$CI->load->database();
															$soal = $CI->db->get_where('tb_soal', ['banksoal_id' => $j->banksoal_id])->result();
														}
														$jawaban = json_decode($j->jawaban, true);
														$benar = 0;
														foreach ($soal as $s) {
															if (isset($jawaban[$s->id]) && $jawaban[$s->id] == $s->kunci_jawaban) {
																$benar++;
															}
														}
														echo $benar;
													else:
														echo '-';
													endif; ?>
												</td>
												<td>
													<?php if ($j->status_ujian == 'selesai' && $j->jawaban):
														$salah = 0;
														if (!empty($soal)) {
															$salah = count($soal) - $benar;
														}
														echo $salah;
													else:
														echo '-';
													endif; ?>
												</td>
												<td>
													<?php
													if ($j->status_ujian == 'selesai' && !is_null($j->nilai_akhir)) {
														$kkm = 60;
														if ($j->nilai_akhir >= $kkm) {
															echo '<span class="badge badge-success">Lulus</span>';
														} else {
															echo '<span class="badge badge-danger">Remedial</span>';
														}
													} else {
														echo '-';
													}
													?>
												</td>
												<td>
													<?php if ($j->status_ujian == 'sedang'): ?>
														<a href="<?= base_url('user/ujianonline/kerjakan/' . $j->id) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Kerjakan Ujian</a>
													<?php elseif ($j->status_ujian == 'selesai'): ?>
														<button class="btn btn-success btn-sm" disabled><i class="fa fa-check"></i> Ujian Selesai</button>
													<?php else: ?>
														<a href="<?= base_url('user/ujianonline/mulai/' . $j->id) ?>" class="btn btn-primary btn-sm"><i class="fa fa-play"></i> Mulai Ujian</a>
													<?php endif; ?>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						<?php endif; ?>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>
