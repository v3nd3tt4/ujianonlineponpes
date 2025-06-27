<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>
							<?= isset($ruangan) ? 'Edit Ruangan' : 'Tambah Ruangan' ?>
						</h4>
						<div class="text-right mb-3">
							<a href="<?= base_url('Admin/Ruangan/Index') ?>" class="btn btn-secondary">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</div>
					</div>
					<div class="card-body">
						<form method="post">
							<div class="form-group">
								<label>Nama Ruangan</label>
								<input type="text" name="nama_ruangan" class="form-control" value="<?= set_value('nama_ruangan', isset($ruangan) ? $ruangan->nama_ruangan : '') ?>" required>
							</div>
							<div class="form-group">
								<label>Keterangan</label>
								<textarea name="keterangan" class="form-control" required><?= set_value('keterangan', isset($ruangan) ? $ruangan->keterangan : '') ?></textarea>
							</div>
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
							<a href="<?= site_url('Admin/Ruangan/Index') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
						</form>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>
