<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>
							<?= isset($siswa) ? 'Edit Siswa' : 'Tambah Siswa' ?>
						</h4>
						<div class="text-right mb-3">
							<a href="<?= base_url('Admin/Siswa/Index') ?>" class="btn btn-secondary">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</div>
					</div>

					<div class="card-body">
						<form method="post">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="nama" class="form-control" value="<?= set_value('nama', isset($siswa) ? $siswa->nama : '') ?>" required>
							</div>
							<div class="form-group">
								<label>NIS</label>
								<input type="text" name="nis" class="form-control" value="<?= set_value('nis', isset($siswa) ? $siswa->nis : '') ?>" required>
							</div>
							<div class="form-group">
								<label>Tempat Lahir</label>
								<input type="text" name="tempat_lahir" class="form-control" value="<?= set_value('tempat_lahir', isset($siswa) ? $siswa->tempat_lahir : '') ?>" required>
							</div>
							<div class="form-group">
								<label>Tanggal Lahir</label>
								<input type="date" name="tanggal_lahir" class="form-control" value="<?= set_value('tanggal_lahir', isset($siswa) ? $siswa->tanggal_lahir : '') ?>" required>
							</div>
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<select name="jenis_kelamin" class="form-control" required>
									<option value="">Pilih</option>
									<option value="L" <?= set_select('jenis_kelamin', 'L', isset($siswa) && $siswa->jenis_kelamin == 'L') ?>>Laki-laki</option>
									<option value="P" <?= set_select('jenis_kelamin', 'P', isset($siswa) && $siswa->jenis_kelamin == 'P') ?>>Perempuan</option>
								</select>
							</div>
							<div class="form-group">
								<label>Alamat</label>
								<textarea name="alamat" class="form-control" required><?= set_value('alamat', isset($siswa) ? $siswa->alamat : '') ?></textarea>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="email" class="form-control" value="<?= set_value('email', isset($siswa) ? $siswa->email : '') ?>" required>
							</div>
							<div class="form-group">
								<label>Password <?= isset($siswa) ? '(Kosongkan jika tidak diubah)' : '' ?></label>
								<input type="password" name="password" class="form-control" <?= isset($siswa) ? '' : 'required' ?> minlength="6">
							</div>
							<div class="form-group">
								<label>No HP</label>
								<input type="text" name="no_hp" class="form-control" value="<?= set_value('no_hp', isset($siswa) ? $siswa->no_hp : '') ?>" required>
							</div>
							<div class="form-group">
								<label>Nama Ibu</label>
								<input type="text" name="nama_ibu" class="form-control" value="<?= set_value('nama_ibu', isset($siswa) ? $siswa->nama_ibu : '') ?>" required>
							</div>
							<div class="form-group">
								<label>Pekerjaan Ibu</label>
								<input type="text" name="pekerjaan_ibu" class="form-control" value="<?= set_value('pekerjaan_ibu', isset($siswa) ? $siswa->pekerjaan_ibu : '') ?>" required>
							</div>
							<div class="form-group">
								<label>Nama Ayah</label>
								<input type="text" name="nama_ayah" class="form-control" value="<?= set_value('nama_ayah', isset($siswa) ? $siswa->nama_ayah : '') ?>" required>
							</div>
							<div class="form-group">
								<label>Pekerjaan Ayah</label>
								<input type="text" name="pekerjaan_ayah" class="form-control" value="<?= set_value('pekerjaan_ayah', isset($siswa) ? $siswa->pekerjaan_ayah : '') ?>" required>
							</div>
							<div class="form-group">
								<label>Tahun Masuk</label>
								<select name="tahun_masuk" class="form-control select2" required>
									<option value="">Pilih</option>
									<?php for ($i = date('Y'); $i >= 2000; $i--): ?>
										<option value="<?= $i ?>" <?= set_select('tahun_masuk', $i, isset($siswa) && $siswa->tahun_masuk == $i) ?>><?= $i ?></option>
									<?php endfor; ?>
								</select>
							</div>
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
							<a href="<?= site_url('Admin/Siswa/Index') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
