<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>
							<?= isset($tahunakademik) ? 'Edit Tahun Akademik' : 'Tambah Tahun Akademik' ?>
						</h4>
						<div class="text-right mb-3">
							<a href="<?= base_url('Admin/Tahunakademik/Index') ?>" class="btn btn-secondary">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</div>
					</div>
					<div class="card-body">
						<form method="post">
							<div class="form-group">
								<label>Tahun</label>
								<input type="text" name="tahun" class="form-control" value="<?= set_value('tahun', isset($tahunakademik) ? $tahunakademik->tahun : '') ?>" required>
							</div>

							<div class="form-group">
								<label>Status</label>
								<select name="status" class="form-control" required>
									<option value="">Pilih</option>
									<option value="Aktif" <?= set_select('status', 'Aktif', isset($tahunakademik) && $tahunakademik->status == 'Aktif') ?>>Aktif</option>
									<option value="Nonaktif" <?= set_select('status', 'Nonaktif', isset($tahunakademik) && $tahunakademik->status == 'Nonaktif') ?>>Nonaktif</option>
								</select>
							</div>
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
							<a href="<?= site_url('Admin/Tahunakademik/Index') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
