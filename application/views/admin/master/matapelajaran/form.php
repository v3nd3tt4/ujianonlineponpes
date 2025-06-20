<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2>Form Mata Pelajaran</h2>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="padding-bottom:50px;">
                <form method="post">
                    <div class="form-group">
                        <label>Kode Mata Pelajaran</label>
                        <input type="text" name="kode_matapelajaran" class="form-control" value="<?= set_value('kode_matapelajaran', isset($matapelajaran) ? $matapelajaran->kode_matapelajaran : '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Mata Pelajaran</label>
                        <input type="text" name="nama_matapelajaran" class="form-control" value="<?= set_value('nama_matapelajaran', isset($matapelajaran) ? $matapelajaran->nama_matapelajaran : '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" required><?= set_value('keterangan', isset($matapelajaran) ? $matapelajaran->keterangan : '') ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= site_url('Admin/Matapelajaran/Index') ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div> 