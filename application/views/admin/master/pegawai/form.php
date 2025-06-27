<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>
							<?= isset($pegawai) ? 'Edit Pegawai' : 'Tambah Pegawai' ?>
						</h4>
						<div class="text-right mb-3">
							<a href="<?= base_url('Admin/Pegawai/Index') ?>" class="btn btn-secondary">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</div>
					</div>
					<div class="card-body">
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
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
							<a href="<?= site_url('Admin/Pegawai/Index') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
