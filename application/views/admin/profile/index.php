<!-- views/admin/profile/index.php -->
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Profil Pegawai</h4>
						<div>
							<button id="btn-edit" class="btn btn-warning" onclick="toggleEditMode()">
								<i class="fa fa-edit"></i> Edit Profil
							</button>
							<button id="btn-cancel" class="btn btn-secondary" onclick="cancelEdit()" style="display: none;">
								<i class="fa fa-times"></i> Batal
							</button>
						</div>
					</div>

					<div class="card-body">

						<form id="form-profile" action="<?= site_url('admin/profile/edit/' . $pegawai->id) ?>" method="post" enctype="multipart/form-data">
							<input type="hidden" name="id" id="id" value="<?= htmlspecialchars($pegawai->id) ?>">
							
							<!-- Foto Profil -->
							<div class="text-center mb-4">
								<img id="preview-foto" src="<?= base_url(($pegawai->foto && file_exists(FCPATH . 'assets/uploads/profile_photos/' . $pegawai->foto)) ? 'assets/uploads/profile_photos/' . $pegawai->foto : 'assets/img/avatar/avatar-1.png') ?>" 
									class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
								<div class="mt-2">
									<input type="file" name="foto" id="foto" class="d-none" accept="image/*" onchange="previewImage(this)">
									<button type="button" class="btn btn-light" onclick="document.getElementById('foto').click()" id="btn-upload-foto" style="display: none;">
										<i class="fa fa-camera"></i> Ganti Foto
									</button>
								</div>
							</div>

							<!-- Biodata Pegawai -->
							<div class="card card-primary">
								<div class="card-header">
									<h4><i class="fa fa-user"></i> Biodata Pegawai</h4>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<!-- tambahkan nik -->
											<div class="form-group">
												<label>NIK <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="nik" id="nik"
													value="<?= htmlspecialchars($pegawai->nik) ?>" readonly>
												<div class="invalid-feedback" id="error-nik"></div>
											</div>
											<div class="form-group">
												<label>Nama Lengkap <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="nama" id="nama"
													value="<?= htmlspecialchars($pegawai->nama) ?>" readonly>
												<div class="invalid-feedback" id="error-nama"></div>
											</div>
											<div class="form-group">
												<label>Tempat Lahir <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
													value="<?= htmlspecialchars($pegawai->tempat_lahir) ?>" readonly>
												<div class="invalid-feedback" id="error-tempat_lahir"></div>
											</div>
											<div class="form-group">
												<label>Tanggal Lahir <span class="text-danger">*</span></label>
												<input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
													value="<?= $pegawai->tanggal_lahir ?>" readonly>
												<div class="invalid-feedback" id="error-tanggal_lahir"></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Jenis Kelamin <span class="text-danger">*</span></label>
												<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" disabled>
													<option value="L" <?= $pegawai->jenis_kelamin == 'L' ? 'selected' : '' ?>>Laki-laki</option>
													<option value="P" <?= $pegawai->jenis_kelamin == 'P' ? 'selected' : '' ?>>Perempuan</option>
												</select>
												<div class="invalid-feedback" id="error-jenis_kelamin"></div>
											</div>
											<div class="form-group">
												<label>Email <span class="text-muted">(Tidak dapat diubah)</span></label>
												<input type="email" class="form-control bg-light" name="email" id="email"
													value="<?= htmlspecialchars($pegawai->email) ?>" readonly>
												<div class="invalid-feedback" id="error-email"></div>
											</div>
											<div class="form-group">
												<label>No Telepon</label>
												<input type="text" class="form-control" name="no_telepon" id="no_telepon"
													value="<?= htmlspecialchars($pegawai->no_telepon) ?>" readonly>
												<div class="invalid-feedback" id="error-no_telepon"></div>
												<small class="form-text text-muted">Masukkan nomor telepon yang aktif</small>
											</div>
											<div class="form-group">
												<label>Alamat</label>
												<textarea class="form-control" name="alamat" id="alamat" rows="3" readonly><?= htmlspecialchars($pegawai->alamat) ?></textarea>
												<div class="invalid-feedback" id="error-alamat"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Data Role & Timestamps -->
							<div class="card card-info">
								<div class="card-header">
									<h4><i class="fa fa-id-badge"></i> Data Role & Timestamps</h4>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Role <span class="text-muted">(Tidak dapat diubah)</span></label>
												<input type="text" class="form-control bg-light" name="role" id="role"
													value="<?= htmlspecialchars($pegawai->role) ?>" readonly>
												<div class="invalid-feedback" id="error-role"></div>
											</div>
											<div class="form-group">
												<label>Created At</label>
												<input type="text" class="form-control bg-light" name="created_at" id="created_at"
													value="<?= htmlspecialchars($pegawai->created_at) ?>" readonly>
											</div>
											<div class="form-group">
												<label>Updated At</label>
												<input type="text" class="form-control bg-light" name="updated_at" id="updated_at"
													value="<?= htmlspecialchars($pegawai->updated_at) ?>" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Security -->
							<div class="card card-danger" id="security-group" style="display: none;">
								<div class="card-header">
									<h4><i class="fa fa-lock"></i> Keamanan</h4>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Password Baru</label>
												<input type="password" class="form-control" name="password" id="password"
													placeholder="Masukkan password baru (kosongkan jika tidak ingin mengubah)" readonly>
												<div class="invalid-feedback" id="error-password"></div>
												<small class="form-text text-muted">Minimal 6 karakter. Kosongkan jika tidak ingin mengubah password.</small>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Action Buttons -->
							<div class="form-group" id="save-group" style="display: none;">
								<div class="text-center">
									<button type="button" class="btn btn-success btn-lg" onclick="confirmSave()">
										<i class="fa fa-save"></i> Simpan Perubahan
									</button>
								</div>
								<small class="form-text text-muted text-center mt-2">
									<span class="text-danger">*</span> Wajib diisi |
									Data Email, Role, Created At, dan Updated At tidak dapat diubah
								</small>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
