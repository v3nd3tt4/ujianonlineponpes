<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2>Form Kelas Siswa</h2>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="padding-bottom:50px;">
                <form method="post">
                    <div class="form-group">
                        <label>Siswa</label>
                        <select name="siswa_id" class="form-control js-example-basic-single" required>
                            <option value="">Pilih Siswa</option>
                            <?php foreach ($siswa as $s): ?>
                                <option value="<?= $s->id ?>" <?= set_select('siswa_id', $s->id, isset($kelassiswa) && $kelassiswa->siswa_id == $s->id) ?>><?= $s->nama . ' - ' . $s->nis ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <select name="kelas_id" class="form-control" required>
                            <option value="">Pilih Kelas</option>
                            <option value="<?= $kelas->id ?>"><?= $kelas->nama_kelas ?></option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= site_url('Admin/Kelassiswa/Index') ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div> 