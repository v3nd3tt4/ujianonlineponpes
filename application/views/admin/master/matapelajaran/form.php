<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>
							<?= isset($matapelajaran) ? 'Edit Mata Pelajaran' : 'Tambah Mata Pelajaran' ?>
						</h4>
						<div class="text-right mb-3">
							<a href="<?= base_url('Admin/Matapelajaran/Index') ?>" class="btn btn-secondary">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</div>
					</div>
					<div class="card-body">
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
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
							<a href="<?= site_url('Admin/Matapelajaran/Index') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
