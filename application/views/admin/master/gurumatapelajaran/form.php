<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>
							<?= isset($gurumatapelajaran) ? 'Edit Guru Mata Pelajaran' : 'Tambah Guru Mata Pelajaran' ?>
						</h4>
						<div class="text-right mb-3">
							<a href="<?= base_url('Admin/Gurumatapelajaran/Index') ?>" class="btn btn-secondary">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</div>
					</div>
					<div class="card-body">
						<form method="post">
							<div class="form-group">
								<label>Guru</label>
								<select name="pegawai_id" class="form-control select2" required>
									<option value="">Pilih Guru</option>
									<?php foreach ($pegawai as $p): ?>
										<option value="<?= $p->id ?>" <?= set_select('pegawai_id', $p->id, isset($gurumatapelajaran) && $gurumatapelajaran->pegawai_id == $p->id) ?>>
											<?= htmlspecialchars($p->nama) ?> (<?= htmlspecialchars($p->role) ?>)
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Mata Pelajaran</label>
								<select name="matapelajaran_id" class="form-control select2" required>
									<option value="">Pilih Mata Pelajaran</option>
									<?php foreach ($matapelajaran as $m): ?>
										<option value="<?= $m->id ?>" <?= set_select('matapelajaran_id', $m->id, isset($gurumatapelajaran) && $gurumatapelajaran->matapelajaran_id == $m->id) ?>>
											<?= htmlspecialchars($m->kode_matapelajaran) ?> - <?= htmlspecialchars($m->nama_matapelajaran) ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
							<a href="<?= site_url('Admin/Gurumatapelajaran/Index') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
