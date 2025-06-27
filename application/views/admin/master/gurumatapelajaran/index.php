<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Data Guru Mata Pelajaran</h4>
						<a href="<?= site_url('Admin/Gurumatapelajaran/Index/create') ?>" class="btn btn-primary mb-3"> <i class="fa fa-plus"></i> Tambah Guru Mata Pelajaran</a>
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
										<th>Nama Guru</th>
										<th>Mata Pelajaran</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($gurumatapelajaran as $row): ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= htmlspecialchars($row->nama_pegawai); ?></td>
											<td><?= htmlspecialchars($row->nama_matapelajaran); ?></td>
											<td>
												<a href="<?= site_url('Admin/Gurumatapelajaran/Index/edit/' . $row->id) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
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
