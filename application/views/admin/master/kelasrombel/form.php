<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>
							<?= isset($kelasrombel) ? 'Edit Kelas Rombel' : 'Tambah Kelas Rombel' ?>
						</h4>
						<div class="text-right mb-3">
							<a href="<?= base_url('Admin/Kelasrombel/Index') ?>" class="btn btn-secondary">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
						</div>
					</div>
					<div class="card-body">

						<form method="post">
							<div class="form-group">
								<label>Kelas</label>
								<select name="kelas_id" class="form-control select2" required>
									<option value="">Pilih Kelas</option>
									<?php foreach ($kelas as $k): ?>
										<option value="<?= $k->id ?>" <?= set_select('kelas_id', $k->id, (isset($kelasrombel) && $kelasrombel->kelas_id == $k->id)) ?>>
											<?= htmlspecialchars($k->nama_kelas); ?>
										</option>
									<?php endforeach; ?>
								</select>
								<?= form_error('kelas_id', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group">
								<label>Tahun Akademik</label>
								<select name="tahunakademik_id" class="form-control select2" required>
									<option value="">Pilih Tahun Akademik</option>
									<?php foreach ($tahunakademik as $ta): ?>
										<option value="<?= $ta->id ?>" <?= set_select('tahunakademik_id', $ta->id, (isset($kelasrombel) && $kelasrombel->tahunakademik_id == $ta->id)) ?>>
											<?= htmlspecialchars($ta->tahun); ?>
										</option>
									<?php endforeach; ?>
								</select>
								<?= form_error('tahunakademik_id', '<small class="text-danger">', '</small>'); ?>
							</div>
							<div class="form-group">
								<label>Wali Kelas</label>
								<select name="walikelas_id" class="form-control select2" required>
									<option value="">Pilih Wali Kelas</option>
									<?php foreach ($pegawai as $p): ?>
										<?php if ($p->role == 'guru') { ?>
											<option value="<?= $p->id ?>" <?= set_select('walikelas_id', $p->id, (isset($kelasrombel) && $kelasrombel->walikelas_id == $p->id)) ?>>
												<?= htmlspecialchars($p->nama); ?>
											</option>
										<?php } ?>
									<?php endforeach; ?>
								</select>
								<?= form_error('walikelas_id', '<small class="text-danger">', '</small>'); ?>
							</div>
							<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
							<a href="<?= site_url('Admin/Kelasrombel/Index') ?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
						</form>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>
