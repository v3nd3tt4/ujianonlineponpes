<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Data Jadwal Ujian Online</h4>
					</div>

					<div class="card-body">
						<div class="responsive-table">
							<table class="table table-striped table-bordered dataTables table-hover">
								<thead>
									<tr>
										<th width="5%">No</th>
										<th>Mata Pelajaran</th>
										<th>Kelas</th>
										<th>Tahun Akademik</th>
										<th>Tanggal Ujian</th>
										<th>Waktu</th>
										<th>Durasi</th>
										<th>Jenis Ujian</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($jadwal_ujian as $row):
									?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $row->nama_matapelajaran ?></td>
											<td><?= $row->nama_kelas ?></td>
											<td><?= $row->tahun ?> - <?= $row->semester ?></td>
											<td><?= date('d/m/Y', strtotime($row->tanggal_ujian)) ?></td>
											<td><?= date('H:i', strtotime($row->jam_mulai)) ?> - <?= date('H:i', strtotime($row->jam_selesai)) ?></td>
											<td><?= $row->lama_ujian ?> Menit</td>
											<td><?= $row->jenis_ujian ?></td>
											<td>
												<a href="<?= base_url('ujianonline/absensi/' . $row->id) ?>" class="btn btn-primary btn-sm">
													<i class="fa fa-users"></i> Absensi
												</a>
												<?php if ($this->session->userdata('rule') == 'guru' || $this->session->userdata('rule') == 'kepala sekolah' || $this->session->userdata('rule') == 'admin'): ?>
													<a href="<?= base_url('ujianonline/history_jawaban_siswa/' . $row->id) ?>" class="btn btn-warning btn-sm">
														<i class="fa fa-history"></i> Histori Jawaban Siswa
													</a>
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
