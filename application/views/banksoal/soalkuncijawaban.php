<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<div>
							<h4 style="font-weight: bold; color: #2c3e50; margin-bottom: 0;">
								Data Bank Soal
							</h4>
							<span style="font-weight: 500; color:rgb(160, 22, 40); font-size: 1.2em; font-style: bold; font-family: Arial, sans-serif; font-weight: bold;">
								<?= htmlspecialchars($banksoal->keterangan) ?>
							</span>
						</div>
						<div class="">
							<a href="<?= site_url('banksoal') ?>" class="btn btn-primary">
								<i class="fa fa-arrow-left"></i> Kembali
							</a>
							<a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modalTambahSoal">
								<i class="fa fa-plus"></i> Tambah Soal
							</a>
							<a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalImportSoal">
								<i class="fa fa-file"></i> Import Excel
							</a>
						</div>
					</div>

					<div class="card-body">

						<table class="table table-bordered table-striped table-hover" style="width: 50%;">
							<tr>
								<th>Mata Pelajaran</th>
								<td><?= htmlspecialchars($banksoal->nama_matapelajaran) ?> (<?= htmlspecialchars($banksoal->kode_matapelajaran) ?>)</td>
							</tr>
							<tr>
								<th>Dibuat Oleh</th>
								<td><?= htmlspecialchars($banksoal->nama_pegawai) ?></td>
							</tr>
							<tr>
								<th>Jumlah Soal</th>
								<td><?= count($soal) ?></td>
							</tr>
						</table>

						<hr>

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
										<th width="5%">No</th>
										<th>Soal</th>
										<th width="15%">Kunci Jawaban</th>
										<th width="15%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1; ?>
									<?php foreach ($soal as $s): ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $s->soal ?></td>
											<td><?= htmlspecialchars($s->kunci_jawaban) ?></td>
											<td>
												<a href="#" class="btn btn-xs btn-warning btn-edit-soal" data-id="<?= $s->id ?>">
													<i class="fa fa-edit"></i>
												</a>
												<a href="<?= site_url('banksoal/delete_soal/' . $s->id) ?>" class="btn btn-xs btn-danger btn-delete-soal">
													<i class="fa fa-trash"></i>
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
	</section>
</div>


<!-- Modal Tambah Soal -->
<div class="modal fade" id="modalTambahSoal" tabindex="-1" role="dialog" aria-labelledby="modalTambahSoalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form method="post" action="<?= site_url('banksoal/create_soal'); ?>">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTambahSoalLabel">Tambah Soal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="banksoal_id" value="<?= $banksoal->id ?>">
					<div class="form-group">
						<label for="soal">Soal</label>
						<textarea name="soal" id="soal" class="form-control" rows="3" required></textarea>
					</div>
					<div class="form-group">
						<label for="pilihan_a">Pilihan A</label>
						<input type="text" name="pilihan_a" id="pilihan_a" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="pilihan_b">Pilihan B</label>
						<input type="text" name="pilihan_b" id="pilihan_b" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="pilihan_c">Pilihan C</label>
						<input type="text" name="pilihan_c" id="pilihan_c" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="pilihan_d">Pilihan D</label>
						<input type="text" name="pilihan_d" id="pilihan_d" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="kunci_jawaban">Kunci Jawaban</label>
						<select name="kunci_jawaban" id="kunci_jawaban" class="form-control" required>
							<option value="">--PILIH--</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
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

<!-- Modal Edit Soal -->
<div class="modal fade" id="modalEditSoal" tabindex="-1" role="dialog" aria-labelledby="modalEditSoalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form method="post" action="<?= site_url('banksoal/update_soal'); ?>">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalEditSoalLabel">Edit Soal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id" id="edit_soal_id">
					<input type="hidden" name="banksoal_id" value="<?= $banksoal->id ?>">
					<div class="form-group">
						<label for="edit_soal">Soal</label>
						<textarea name="soal" id="edit_soal" class="form-control" rows="3" required></textarea>
					</div>
					<div class="form-group">
						<label for="edit_pilihan_a">Pilihan A</label>
						<input type="text" name="pilihan_a" id="edit_pilihan_a" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="edit_pilihan_b">Pilihan B</label>
						<input type="text" name="pilihan_b" id="edit_pilihan_b" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="edit_pilihan_c">Pilihan C</label>
						<input type="text" name="pilihan_c" id="edit_pilihan_c" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="edit_pilihan_d">Pilihan D</label>
						<input type="text" name="pilihan_d" id="edit_pilihan_d" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="edit_kunci_jawaban">Kunci Jawaban</label>
						<select name="kunci_jawaban" id="edit_kunci_jawaban" class="form-control" required>
							<option value="">--PILIH--</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
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

<!-- Modal Import Soal -->
<div class="modal fade" id="modalImportSoal" tabindex="-1" role="dialog" aria-labelledby="modalImportSoalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form id="formImportSoal" method="post" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalImportSoalLabel">Import Soal dari Excel</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="banksoal_id" value="<?= $banksoal->id ?>">
					<div class="form-group">
						<label for="file_excel">Pilih File Excel</label>
						<input type="file" name="file_excel" id="file_excel" class="form-control" accept=".xls,.xlsx" required>
					</div>
					<div class="form-group">
						<p class="text-white bg-danger p-2">
							<i class="fa fa-info-circle"></i>
							Pastikan file Excel sesuai dengan template yang telah disediakan. <br>
						</p>
						<a href="<?= base_url('templates/template_soal.xlsx') ?>"><i class="fa fa-download"></i> Download Template Soal</a>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload &amp; Preview</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
				</div>
			</div>
		</form>
	</div>
</div>

<!-- Modal Preview Soal -->
<div class="modal fade" id="modalPreviewSoal" tabindex="-1" role="dialog" aria-labelledby="modalPreviewSoalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form method="post" action="<?= site_url('banksoal/import_soal'); ?>">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalPreviewSoalLabel">Preview Soal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="banksoal_id" value="<?= $banksoal->id ?>">
					<div id="preview-area"></div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan ke Database</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
				</div>
			</div>
		</form>
	</div>
</div>
