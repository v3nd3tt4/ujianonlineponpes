<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2>Form Ruangan</h2>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="padding-bottom:50px;">
                <form method="post">
                    <div class="form-group">
                        <label>Nama Ruangan</label>
                        <input type="text" name="nama_ruangan" class="form-control" value="<?= set_value('nama_ruangan', isset($ruangan) ? $ruangan->nama_ruangan : '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" required><?= set_value('keterangan', isset($ruangan) ? $ruangan->keterangan : '') ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= site_url('Admin/Ruangan/Index') ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div> 