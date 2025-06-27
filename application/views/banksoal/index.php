<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Data Bank Soal</h4>
						<a href="#" class="btn btn-primary mb-3 btn-buat-bank-soal"> <i class="fa fa-plus"></i> Buat Bank Soal</a>
					</div>

					<div class="card-body">
						<?php if ($this->session->flashdata('success')): ?>
							<div id="flash-success" data-message="<?= $this->session->flashdata('success'); ?>"></div>
						<?php endif; ?>
						<?php if ($this->session->flashdata('error')): ?>
							<div id="flash-error" data-message="<?= $this->session->flashdata('error'); ?>"></div>
						<?php endif; ?>

						<div class="table-responsive">
							<table class="table-striped table table-bordered dataTables table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Keterangan</th>
										<th>Mata Pelajaran</th>
										<th>Dibuat Oleh</th>
										<th>Tanggal Dibuat</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; ?>
									<?php foreach ($banksoal->result() as $bs): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= htmlspecialchars($bs->keterangan) ?></td>
											<td><?= htmlspecialchars($bs->kode_matapelajaran) ?> - <?= htmlspecialchars($bs->nama_matapelajaran) ?></td>
											<td><?= htmlspecialchars($bs->nama_pegawai) ?></td>
											<td><?= date('d/m/Y H:i', strtotime($bs->created_at)) ?></td>
											<td>
												<a href="<?= base_url() ?>banksoal/soalkuncijawaban/<?= $bs->id ?>" class="btn btn-sm btn-primary">
													<i class="fa fa-eye"></i> Soal &amp; Kunci Jawaban
												</a>
												<a href="#" class="btn btn-sm btn-warning btn-edit-bank-soal" data-id="<?= $bs->id ?>">
													<i class="fa fa-edit"></i> Edit
												</a>
												<a href="<?= site_url('banksoal/delete/' . $bs->id) ?>" class="btn btn-sm btn-danger btn-delete-bank-soal">
													<i class="fa fa-trash"></i> Hapus
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>

<!-- Modal Tambah Bank Soal -->
<div class="modal fade" id="modalBuatBankSoal" tabindex="-1" role="dialog" aria-labelledby="modalBuatBankSoalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form method="post" action="<?= site_url('banksoal/create'); ?>" id="formBuatBankSoal">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalBuatBankSoalLabel">Buat Bank Soal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="keterangan">Keterangan:</label>
						<input type="text" name="keterangan" id="keterangan" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="matapelajaran_id">Mata Pelajaran:</label>
						<select name="matapelajaran_id" id="matapelajaran_id" class="form-control select2" style="width: 100%;" required>
							<option value="">--PILIH--</option>
							<?php foreach ($mapel->result() as $mp) { ?>
								<option value="<?= $mp->id ?>"><?= $mp->kode_matapelajaran ?> - <?= $mp->nama_matapelajaran ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Modal Edit Bank Soal -->
<div class="modal fade" id="modalEditBankSoal" tabindex="-1" role="dialog" aria-labelledby="modalEditBankSoalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form method="post" action="<?= site_url('banksoal/update'); ?>" id="formEditBankSoal">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalEditBankSoalLabel">Edit Bank Soal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id" id="edit_id">
					<div class="form-group">
						<label for="edit_keterangan">Keterangan:</label>
						<input type="text" name="keterangan" id="edit_keterangan" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="edit_matapelajaran_id">Mata Pelajaran:</label>
						<select name="matapelajaran_id" id="edit_matapelajaran_id" class="form-control select2" style="width: 100%;" required>
							<option value="">--PILIH--</option>
							<?php foreach ($mapel->result() as $mp) { ?>
								<option value="<?= $mp->id ?>"><?= $mp->kode_matapelajaran ?> - <?= $mp->nama_matapelajaran ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
				</div>
			</div>
		</form>
	</div>
</div>
