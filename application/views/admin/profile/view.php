<!-- views/admin/profile/view.php -->
<div class="section-header">
	<h1>Edit Profil Pegawai</h1>
</div>
<div class="section-body">
	<?php if (isset($validation_errors) && $validation_errors): ?>
		<div class="alert alert-danger"><?php echo $validation_errors; ?></div>
	<?php endif; ?>
	<form method="post" action="<?php echo site_url('admin/profile/edit/' . $pegawai->id); ?>">
		<input type="hidden" name="id" value="<?php echo $pegawai->id; ?>">
		<div class="form-group">
			<label>Nama <span class="text-danger">*</span></label>
			<input type="text" name="nama" class="form-control" value="<?php echo set_value('nama', $pegawai->nama); ?>" required>
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" name="email" class="form-control" value="<?php echo set_value('email', $pegawai->email); ?>" readonly>
		</div>
		<div class="form-group">
			<label>Tempat Lahir <span class="text-danger">*</span></label>
			<input type="text" name="tempat_lahir" class="form-control" value="<?php echo set_value('tempat_lahir', $pegawai->tempat_lahir); ?>" required>
		</div>
		<div class="form-group">
			<label>Tanggal Lahir <span class="text-danger">*</span></label>
			<input type="date" name="tanggal_lahir" class="form-control" value="<?php echo set_value('tanggal_lahir', $pegawai->tanggal_lahir); ?>" required>
		</div>
		<div class="form-group">
			<label>Jenis Kelamin <span class="text-danger">*</span></label>
			<select name="jenis_kelamin" class="form-control" required>
				<option value="L" <?php echo set_select('jenis_kelamin', 'L', $pegawai->jenis_kelamin == 'L'); ?>>Laki-laki</option>
				<option value="P" <?php echo set_select('jenis_kelamin', 'P', $pegawai->jenis_kelamin == 'P'); ?>>Perempuan</option>
			</select>
		</div>
		<div class="form-group">
			<label>No Telepon</label>
			<input type="text" name="no_telepon" class="form-control" value="<?php echo set_value('no_telepon', $pegawai->no_telepon); ?>">
		</div>
		<div class="form-group">
			<label>Alamat</label>
			<textarea name="alamat" class="form-control"><?php echo set_value('alamat', $pegawai->alamat); ?></textarea>
		</div>
		<div class="form-group">
			<label>Role</label>
			<input type="text" name="role" class="form-control" value="<?php echo set_value('role', $pegawai->role); ?>" readonly>
		</div>
		<div class="form-group">
			<label>Password (isi jika ingin mengganti)</label>
			<input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter">
		</div>
		<div class="form-group">
			<label>Created At</label>
			<input type="text" class="form-control" value="<?php echo $pegawai->created_at; ?>" readonly>
		</div>
		<div class="form-group">
			<label>Updated At</label>
			<input type="text" class="form-control" value="<?php echo $pegawai->updated_at; ?>" readonly>
		</div>
		<button type="submit" class="btn btn-success">Simpan</button>
		<a href="<?php echo site_url('admin/profile'); ?>" class="btn btn-secondary">Batal</a>
	</form>
</div>
