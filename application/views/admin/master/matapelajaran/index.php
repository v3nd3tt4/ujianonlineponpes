<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Data Mata Pelajaran</h4>
						<a href="<?= site_url('Admin/Matapelajaran/Index/create') ?>" class="btn btn-primary mb-3"> <i class="fa fa-plus"></i> Tambah Mata Pelajaran</a>
					</div>

					<div class="card-body">

						<?php if ($this->session->flashdata('success')): ?>
							<div id="flash-success" data-message="<?= $this->session->flashdata('success'); ?>"></div>
						<?php endif; ?>


						<div class="table-responsive">
							<table class="table-striped table table-bordered dataTables table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Mata Pelajaran</th>
										<th>Nama Mata Pelajaran</th>
										<th>Keterangan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($matapelajaran as $row): ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= htmlspecialchars($row->kode_matapelajaran); ?></td>
											<td><?= htmlspecialchars($row->nama_matapelajaran); ?></td>
											<td><?= htmlspecialchars($row->keterangan); ?></td>
											<td>
												<a href="<?= site_url('Admin/Matapelajaran/Index/edit/' . $row->id) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
												<a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row->id ?>"><i class="fa fa-trash"></i> Hapus</a>
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
