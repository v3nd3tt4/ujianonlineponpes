<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2>Form Tahun Akademik</h2>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="padding-bottom:50px;">
                <form method="post">
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="text" name="tahun" class="form-control" value="<?= set_value('tahun', isset($tahunakademik) ? $tahunakademik->tahun : '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="Ganjil" <?= set_select('semester', 'Ganjil', isset($tahunakademik) && $tahunakademik->semester == 'Ganjil') ?>>Ganjil</option>
                            <option value="Genap" <?= set_select('semester', 'Genap', isset($tahunakademik) && $tahunakademik->semester == 'Genap') ?>>Genap</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="Aktif" <?= set_select('status', 'Aktif', isset($tahunakademik) && $tahunakademik->status == 'Aktif') ?>>Aktif</option>
                            <option value="Nonaktif" <?= set_select('status', 'Nonaktif', isset($tahunakademik) && $tahunakademik->status == 'Nonaktif') ?>>Nonaktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= site_url('Admin/Tahunakademik/Index') ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div> 