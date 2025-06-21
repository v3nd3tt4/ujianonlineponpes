<div id="content">
    <div class="col-md-12" style="padding:20px;">
        <!-- Informasi Bank Soal -->
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <h3>Bank Soal: <?= htmlspecialchars($banksoal->keterangan) ?></h3>
                        <p>
                            <strong>Mata Pelajaran:</strong> <?= htmlspecialchars($banksoal->nama_matapelajaran) ?> (<?= htmlspecialchars($banksoal->kode_matapelajaran) ?>)<br>
                            <strong>Dibuat Oleh:</strong> <?= htmlspecialchars($banksoal->nama_pegawai) ?><br>
                            <strong>Jumlah Soal:</strong> <?= count($soal) ?>
                        </p>
                    </div>
                    <div class="col-md-4 text-right">
                        <a href="<?= site_url('banksoal') ?>" class="btn btn-default">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSoal">
                            <i class="fa fa-plus"></i> Tambah Soal
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Soal -->
        <div class="panel">
            <div class="panel-heading bg-white border-none">
                <h4>Daftar Soal</h4>
            </div>
            <div class="panel-body">
                <?php if ($this->session->flashdata('success')): ?>
                    <div id="flash-success" data-message="<?= $this->session->flashdata('success'); ?>"></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div id="flash-error" data-message="<?= $this->session->flashdata('error'); ?>"></div>
                <?php endif; ?>

                <table class="table table-bordered dt-table">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Soal</th>
                            <th width="15%">Kunci Jawaban</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($soal as $s): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $s->soal ?></td>
                            <td><?= htmlspecialchars($s->kunci_jawaban) ?></td>
                            <td>
                                <a href="#" class="btn btn-xs btn-warning btn-edit-soal" data-id="<?= $s->id ?>">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="<?= site_url('banksoal/delete_soal/'.$s->id) ?>" class="btn btn-xs btn-danger btn-delete-soal">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Soal -->
<div class="modal fade" id="modalTambahSoal" tabindex="-1" role="dialog" aria-labelledby="modalTambahSoalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" action="<?= site_url('banksoal/create_soal'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahSoalLabel">Tambah Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="banksoal_id" value="<?= $banksoal->id ?>">
                    <div class="form-group">
                        <label for="soal">Soal</label>
                        <textarea name="soal" id="soal" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pilihan_a">Pilihan A</label>
                        <input type="text" name="pilihan_a" id="pilihan_a" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="pilihan_b">Pilihan B</label>
                        <input type="text" name="pilihan_b" id="pilihan_b" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="pilihan_c">Pilihan C</label>
                        <input type="text" name="pilihan_c" id="pilihan_c" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="pilihan_d">Pilihan D</label>
                        <input type="text" name="pilihan_d" id="pilihan_d" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="kunci_jawaban">Kunci Jawaban</label>
                        <select name="kunci_jawaban" id="kunci_jawaban" class="form-control" required>
                            <option value="">--PILIH--</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Soal -->
<div class="modal fade" id="modalEditSoal" tabindex="-1" role="dialog" aria-labelledby="modalEditSoalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form method="post" action="<?= site_url('banksoal/update_soal'); ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditSoalLabel">Edit Soal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_soal_id">
                    <input type="hidden" name="banksoal_id" value="<?= $banksoal->id ?>">
                    <div class="form-group">
                        <label for="edit_soal">Soal</label>
                        <textarea name="soal" id="edit_soal" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_pilihan_a">Pilihan A</label>
                        <input type="text" name="pilihan_a" id="edit_pilihan_a" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_pilihan_b">Pilihan B</label>
                        <input type="text" name="pilihan_b" id="edit_pilihan_b" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_pilihan_c">Pilihan C</label>
                        <input type="text" name="pilihan_c" id="edit_pilihan_c" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_pilihan_d">Pilihan D</label>
                        <input type="text" name="pilihan_d" id="edit_pilihan_d" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_kunci_jawaban">Kunci Jawaban</label>
                        <select name="kunci_jawaban" id="edit_kunci_jawaban" class="form-control" required>
                            <option value="">--PILIH--</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div> 