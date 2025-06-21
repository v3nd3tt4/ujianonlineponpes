<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2>Form Kelas Rombel</h2>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="padding-bottom:50px;">
                <form method="post">
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="kelas_id" class="form-control" required>
                            <option value="">Pilih Kelas</option>
                            <?php foreach ($kelas as $k): ?>
                                <option value="<?= $k->id ?>" <?= set_select('kelas_id', $k->id, (isset($kelasrombel) && $kelasrombel->kelas_id == $k->id)) ?>>
                                    <?= htmlspecialchars($k->nama_kelas); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('kelas_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label>Tahun Akademik</label>
                        <select name="tahunakademik_id" class="form-control" required>
                            <option value="">Pilih Tahun Akademik</option>
                            <?php foreach ($tahunakademik as $ta): ?>
                                <option value="<?= $ta->id ?>" <?= set_select('tahunakademik_id', $ta->id, (isset($kelasrombel) && $kelasrombel->tahunakademik_id == $ta->id)) ?>>
                                    <?= htmlspecialchars($ta->tahun); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('tahunakademik_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label>Wali Kelas</label>
                        <select name="walikelas_id" class="form-control" required>
                            <option value="">Pilih Wali Kelas</option>
                            <?php foreach ($pegawai as $p): ?>
                                <?php if($p->role == 'guru'){?>
                                <option value="<?= $p->id ?>" <?= set_select('walikelas_id', $p->id, (isset($kelasrombel) && $kelasrombel->walikelas_id == $p->id)) ?>>
                                    <?= htmlspecialchars($p->nama); ?>
                                </option>
                                <?php }?>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('walikelas_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= site_url('Admin/Kelasrombel/Index') ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div> 