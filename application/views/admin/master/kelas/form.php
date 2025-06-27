<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>
							<?= isset($kelas) ? 'Edit Kelas' : 'Tambah Kelas' ?>
						</h4>
						<div class="text-right mb-3">
							<a href="<?= base_url('Admin/Kelas/Index') ?>" class="btn btn-secondary">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</div>
					</div>
					<div class="card-body">
						<form method="post">
							<div class="form-group">
								<label>Nama Kelas</label>
								<input type="text" name="nama_kelas" class="form-control" value="<?= set_value('nama_kelas', isset($kelas) ? $kelas->nama_kelas : '') ?>" required>
							</div>
							<div class="form-group">
								<label>Keterangan</label>
								<textarea name="keterangan" class="form-control" required><?= set_value('keterangan', isset($kelas) ? $kelas->keterangan : '') ?></textarea>
							</div>
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
							<a href="<?= site_url('Admin/Kelas/Index') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
