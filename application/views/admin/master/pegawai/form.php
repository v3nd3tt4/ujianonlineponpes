<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 text-left">
                        <h2>Form Pegawai</h2>
                    </div>
                    <!-- <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                        <a href="<?= site_url('Admin/Pegawai/Index/create') ?>" class="btn btn-primary mb-3"> <i class="fa fa-plus"></i> Tambah Pegawai</a>
                    </div> -->
                </div>
            </div>
            <div class="panel-body" style="padding-bottom:50px;">
                <form method="post">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= set_value('nama', isset($pegawai) ? $pegawai->nama : '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="<?= set_value('tempat_lahir', isset($pegawai) ? $pegawai->tempat_lahir : '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="<?= set_value('tanggal_lahir', isset($pegawai) ? $pegawai->tanggal_lahir : '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="L" <?= set_select('jenis_kelamin', 'L', isset($pegawai) && $pegawai->jenis_kelamin == 'L') ?>>Laki-laki</option>
                            <option value="P" <?= set_select('jenis_kelamin', 'P', isset($pegawai) && $pegawai->jenis_kelamin == 'P') ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" required><?= set_value('alamat', isset($pegawai) ? $pegawai->alamat : '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>No Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" value="<?= set_value('no_telepon', isset($pegawai) ? $pegawai->no_telepon : '') ?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?= set_value('email', isset($pegawai) ? $pegawai->email : '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Password <?= isset($pegawai) ? '(Kosongkan jika tidak diubah)' : '' ?></label>
                        <input type="password" name="password" class="form-control" <?= isset($pegawai) ? '' : 'required' ?> minlength="6">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="admin" <?= set_select('role', 'admin', isset($pegawai) && $pegawai->role == 'admin') ?>>Admin</option>
                            <option value="operator" <?= set_select('role', 'operator', isset($pegawai) && $pegawai->role == 'operator') ?>>Operator</option>
                            <option value="guru" <?= set_select('role', 'guru', isset($pegawai) && $pegawai->role == 'guru') ?>>Guru</option>
                            <option value="kepala sekolah" <?= set_select('role', 'kepala sekolah', isset($pegawai) && $pegawai->role == 'kepala sekolah') ?>>Kepala Sekolah</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <a href="<?= site_url('Admin/Pegawai/Index') ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>