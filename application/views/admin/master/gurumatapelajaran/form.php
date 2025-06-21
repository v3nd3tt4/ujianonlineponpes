<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2>Form Guru Mata Pelajaran</h2>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="padding-bottom:50px;">
                <form method="post">
                    <div class="form-group">
                        <label>Guru</label>
                        <select name="pegawai_id" class="form-control" required>
                            <option value="">Pilih Guru</option>
                            <?php foreach ($pegawai as $p): ?>
                                <option value="<?= $p->id ?>" <?= set_select('pegawai_id', $p->id, isset($gurumatapelajaran) && $gurumatapelajaran->pegawai_id == $p->id) ?>>
                                    <?= htmlspecialchars($p->nama) ?> (<?= htmlspecialchars($p->role) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mata Pelajaran</label>
                        <select name="matapelajaran_id" class="form-control" required>
                            <option value="">Pilih Mata Pelajaran</option>
                            <?php foreach ($matapelajaran as $m): ?>
                                <option value="<?= $m->id ?>" <?= set_select('matapelajaran_id', $m->id, isset($gurumatapelajaran) && $gurumatapelajaran->matapelajaran_id == $m->id) ?>>
                                    <?= htmlspecialchars($m->kode_matapelajaran) ?> - <?= htmlspecialchars($m->nama_matapelajaran) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= site_url('Admin/Gurumatapelajaran/Index') ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div> 