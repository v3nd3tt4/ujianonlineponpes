<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Data Siswa</h4>
						<a href="<?= site_url('Admin/Siswa/Index/create') ?>" class="btn btn-primary mb-3"> <i class="fa fa-plus"></i> Tambah Siswa</a>
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
										<th>Nama</th>
										<th>NIS</th>
										<th>Tempat Lahir</th>
										<th>Tanggal Lahir</th>
										<th>Jenis Kelamin</th>
										<th>Alamat</th>
										<th>Email</th>
										<th>No HP</th>
										<th>Nama Ibu</th>
										<th>Nama Ayah</th>
										<th>Pekerjaan Ibu</th>
										<th>Pekerjaan Ayah</th>
										<th>Tahun Masuk</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($siswa as $row): ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= htmlspecialchars($row->nama); ?></td>
											<td><?= htmlspecialchars($row->nis); ?></td>
											<td><?= htmlspecialchars($row->tempat_lahir); ?></td>
											<td><?= htmlspecialchars($row->tanggal_lahir); ?></td>
											<td><?= $row->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
											<td><?= htmlspecialchars($row->alamat); ?></td>
											<td><?= htmlspecialchars($row->email); ?></td>
											<td><?= htmlspecialchars($row->no_hp); ?></td>
											<td><?= htmlspecialchars($row->nama_ibu); ?></td>
											<td><?= htmlspecialchars($row->nama_ayah); ?></td>
											<td><?= htmlspecialchars($row->pekerjaan_ibu); ?></td>
											<td><?= htmlspecialchars($row->pekerjaan_ayah); ?></td>
											<td><?= htmlspecialchars($row->tahun_masuk); ?></td>
											<td>
												<a href="<?= site_url('Admin/Siswa/Index/edit/' . $row->id) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
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
