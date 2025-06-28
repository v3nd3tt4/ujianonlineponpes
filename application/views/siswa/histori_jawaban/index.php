<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-wrap">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Histori Jawaban Ujian</h4>
                            </div>

                            <div class="card-body">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    Berikut adalah daftar ujian yang telah anda kerjakan. Klik tombol "Detail" untuk melihat jawaban anda per nomor soal.
                                </div>

                                <?php if (empty($hasil_ujian)): ?>
                                    <div class="text-center py-4">
                                        <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Belum ada data ujian</h5>
                                        <p class="text-muted">Anda belum mengerjakan ujian apapun.</p>
                                    </div>
                                <?php else: ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th width="15%">Mata Pelajaran</th>
                                                    <th width="15%">Jenis Ujian</th>
                                                    <th width="10%">Kelas</th>
                                                    <th width="12%">Tanggal Ujian</th>
                                                    <th width="10%">Jam</th>
                                                    <th width="10%">Nilai</th>
                                                    <th width="10%">Status</th>
                                                    <th width="13%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; foreach ($hasil_ujian as $ujian): ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td>
                                                            <strong><?= $ujian->nama_matapelajaran ?></strong>
                                                        </td>
                                                        <td><?= $ujian->jenis_ujian ?></td>
                                                        <td><?= $ujian->nama_kelas ?></td>
                                                        <td><?= date('d/m/Y', strtotime($ujian->tanggal_ujian)) ?></td>
                                                        <td><?= $ujian->jam_mulai ?> - <?= $ujian->jam_selesai ?></td>
                                                        <td>
                                                            <?php if ($ujian->nilai_akhir !== null): ?>
                                                                <span class="badge badge-<?= $ujian->nilai_akhir >= 75 ? 'success' : ($ujian->nilai_akhir >= 60 ? 'warning' : 'danger') ?>">
                                                                    <?= number_format($ujian->nilai_akhir, 1) ?>
                                                                </span>
                                                            <?php else: ?>
                                                                <span class="badge badge-secondary">-</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($ujian->status == 'selesai'): ?>
                                                                <span class="badge badge-success">Selesai</span>
                                                            <?php elseif ($ujian->status == 'sedang'): ?>
                                                                <span class="badge badge-warning">Sedang</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-secondary">Belum</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?= base_url('user/histori_jawaban/detail/' . $ujian->id) ?>" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i> Detail
                                                            </a>
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
            </div>
        </div>
    </section>
</div> 