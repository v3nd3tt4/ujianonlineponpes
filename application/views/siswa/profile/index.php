<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">
			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Profil Siswa</h4>
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
						<!-- Flash Messages - Now handled by SweetAlert -->
						<?php /* if ($this->session->flashdata('success')): ?>
							<div class="alert alert-success alert-dismissible show fade">
								<div class="alert-body">
									<button class="close" data-dismiss="alert"><span>&times;</span></button>
									<i class="fa fa-check-circle"></i> <?= $this->session->flashdata('success'); ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if ($this->session->flashdata('error')): ?>
							<div class="alert alert-danger alert-dismissible show fade">
								<div class="alert-body">
									<button class="close" data-dismiss="alert"><span>&times;</span></button>
									<i class="fa fa-exclamation-circle"></i> <?= $this->session->flashdata('error'); ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if (validation_errors()): ?>
							<div class="alert alert-warning alert-dismissible show fade">
								<div class="alert-body">
									<button class="close" data-dismiss="alert"><span>&times;</span></button>
									<i class="fa fa-exclamation-triangle"></i> <?= validation_errors(); ?>
								</div>
							</div>
						<?php endif; */ ?>

						<form id="form-profile" action="<?= site_url('User/Profile/edit/' . $siswa->id) ?>" method="post" enctype="multipart/form-data">
							
							<!-- Foto Profil -->
							<div class="text-center mb-4">
								<img id="preview-foto" src="<?= base_url(($siswa->foto && file_exists(FCPATH . 'assets/uploads/profile_photos/' . $siswa->foto)) ? 'assets/uploads/profile_photos/' . $siswa->foto : 'assets/img/avatar/avatar-1.png') ?>" 
									class="img-fluid rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
								<div class="mt-2">
									<input type="file" name="foto" id="foto" class="d-none" accept="image/*" onchange="previewImage(this)">
									<button type="button" class="btn btn-light" onclick="document.getElementById('foto').click()" id="btn-upload-foto" style="display: none;">
										<i class="fa fa-camera"></i> Ganti Foto
									</button>
								</div>
							</div>
							
							<!-- Biodata Siswa -->
							<div class="card card-primary">
								<div class="card-header">
									<h4><i class="fa fa-user"></i> Biodata Siswa</h4>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>NIS <span class="text-muted">(Tidak dapat diubah)</span></label>
												<input type="text" class="form-control bg-light" name="nis" id="nis"
													value="<?= htmlspecialchars($siswa->nis) ?>" readonly>
												<div class="invalid-feedback" id="error-nis"></div>
											</div>

											<div class="form-group">
												<label>Nama Lengkap <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="nama" id="nama"
													value="<?= htmlspecialchars($siswa->nama) ?>" readonly>
												<div class="invalid-feedback" id="error-nama"></div>
											</div>

											<div class="form-group">
												<label>Tempat Lahir <span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir"
													value="<?= htmlspecialchars($siswa->tempat_lahir) ?>" readonly>
												<div class="invalid-feedback" id="error-tempat_lahir"></div>
											</div>

											<div class="form-group">
												<label>Tanggal Lahir <span class="text-danger">*</span></label>
												<input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
													value="<?= $siswa->tanggal_lahir ?>" readonly>
												<div class="invalid-feedback" id="error-tanggal_lahir"></div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label>Jenis Kelamin <span class="text-danger">*</span></label>
												<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" disabled>
													<option value="L" <?= $siswa->jenis_kelamin == 'L' ? 'selected' : '' ?>>Laki-laki</option>
													<option value="P" <?= $siswa->jenis_kelamin == 'P' ? 'selected' : '' ?>>Perempuan</option>
												</select>
												<div class="invalid-feedback" id="error-jenis_kelamin"></div>
											</div>

											<div class="form-group">
												<label>Email <span class="text-muted">(Tidak dapat diubah)</span></label>
												<input type="email" class="form-control bg-light" name="email" id="email"
													value="<?= htmlspecialchars($siswa->email) ?>" readonly>
												<div class="invalid-feedback" id="error-email"></div>
											</div>

											<div class="form-group">
												<label>No HP</label>
												<input type="text" class="form-control" name="no_hp" id="no_hp"
													value="<?= htmlspecialchars($siswa->no_hp) ?>" readonly>
												<div class="invalid-feedback" id="error-no_hp"></div>
												<small class="form-text text-muted">Masukkan nomor HP yang aktif</small>
											</div>

											<div class="form-group">
												<label>Alamat</label>
												<textarea class="form-control" name="alamat" id="alamat" rows="3" readonly><?= htmlspecialchars($siswa->alamat) ?></textarea>
												<div class="invalid-feedback" id="error-alamat"></div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Biodata Orang Tua -->
							<div class="card card-info">
								<div class="card-header">
									<h4><i class="fa fa-users"></i> Biodata Orang Tua</h4>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<h6 class="text-primary"><i class="fa fa-male"></i> Data Ayah</h6>
											<div class="form-group">
												<label>Nama Ayah</label>
												<input type="text" class="form-control" name="nama_ayah" id="nama_ayah"
													value="<?= htmlspecialchars($siswa->nama_ayah) ?>" readonly>
												<div class="invalid-feedback" id="error-nama_ayah"></div>
											</div>

											<div class="form-group">
												<label>Pekerjaan Ayah</label>
												<input type="text" class="form-control" name="pekerjaan_ayah" id="pekerjaan_ayah"
													value="<?= htmlspecialchars($siswa->pekerjaan_ayah) ?>" readonly>
												<div class="invalid-feedback" id="error-pekerjaan_ayah"></div>
											</div>
										</div>

										<div class="col-md-6">
											<h6 class="text-info"><i class="fa fa-female"></i> Data Ibu</h6>
											<div class="form-group">
												<label>Nama Ibu</label>
												<input type="text" class="form-control" name="nama_ibu" id="nama_ibu"
													value="<?= htmlspecialchars($siswa->nama_ibu) ?>" readonly>
												<div class="invalid-feedback" id="error-nama_ibu"></div>
											</div>

											<div class="form-group">
												<label>Pekerjaan Ibu</label>
												<input type="text" class="form-control" name="pekerjaan_ibu" id="pekerjaan_ibu"
													value="<?= htmlspecialchars($siswa->pekerjaan_ibu) ?>" readonly>
												<div class="invalid-feedback" id="error-pekerjaan_ibu"></div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- Data Akademik -->
							<div class="card card-warning">
								<div class="card-header">
									<h4><i class="fa fa-graduation-cap"></i> Data Akademik</h4>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Tahun Masuk <span class="text-muted">(Tidak dapat diubah)</span></label>
												<input type="number" class="form-control bg-light" name="tahun_masuk" id="tahun_masuk"
													value="<?= htmlspecialchars($siswa->tahun_masuk) ?>" readonly>
												<div class="invalid-feedback" id="error-tahun_masuk"></div>
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
									Data NIS, Email, dan Tahun Masuk tidak dapat diubah
								</small>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
