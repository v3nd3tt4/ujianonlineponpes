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
                                <a href="<?= base_url('ujianonline/') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>NIS:</strong> <?= $jawaban_ujian->nis ?> <br>
                                    <strong>Nama Siswa:</strong> <?= $jawaban_ujian->nama_siswa ?> <br>
                                    <strong>Mata Pelajaran:</strong> <?= $jawaban_ujian->nama_matapelajaran ?> <br>
                                    <strong>Kelas:</strong> <?= $jawaban_ujian->nama_kelas ?> <br>
                                    <strong>Jenis Ujian:</strong> <?= $jawaban_ujian->jenis_ujian ?> <br>
                                    <strong>Tanggal Ujian:</strong> <?= date('d/m/Y', strtotime($jawaban_ujian->tanggal_ujian)) ?> <br>
                                    <strong>Nilai Akhir:</strong> <?= number_format($jawaban_ujian->nilai_akhir, 1) ?>
                                </div>
                                <div class="alert alert-info">
                                    <b>Statistik:</b> Benar: <?= $statistik['benar'] ?> | Salah: <?= $statistik['salah'] ?> | Kosong: <?= $statistik['kosong'] ?> | Total Soal: <?= $statistik['total'] ?>
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