<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Data SDM</h4>
						<div>
							<a href="<?= site_url('Admin/Pegawai/Index/create') ?>" class="btn btn-primary mb-3"> <i class="fa fa-plus"></i> Tambah Pegawai</a>
							<a href="<?= site_url('Admin/Pegawai/Index/cetak_pdf' . (isset($filter_role) && $filter_role ? '/' . str_replace(' ', '-', $filter_role) : '')) ?>" target="_blank" class="btn btn-danger mb-3"><i class="fa fa-file-pdf"></i> Cetak PDF</a>
						</div>
					</div>

					<div class="card-body">

						<?php if ($this->session->flashdata('success')): ?>
							<div id="flash-success" data-message="<?= $this->session->flashdata('success'); ?>"></div>
						<?php endif; ?>

						<!-- Filter Role -->
						<form method="get" id="filterRoleForm" class="form-inline mb-3">
							<label for="role" class="mr-2">Filter Role:</label>
							<select name="role" id="role" class="form-control mr-2" onchange="filterRole()">
								<option value="" <?= empty($filter_role) ? 'selected' : '' ?>>Semua</option>
								<option value="admin" <?= (isset($filter_role) && $filter_role == 'admin') ? 'selected' : '' ?>>Admin</option>
								<option value="pegawai" <?= (isset($filter_role) && $filter_role == 'pegawai') ? 'selected' : '' ?>>Pegawai</option>
								<option value="kepala-sekolah" <?= (isset($filter_role) && $filter_role == 'kepala sekolah') ? 'selected' : '' ?>>Kepala Sekolah</option>
								<option value="operator" <?= (isset($filter_role) && $filter_role == 'operator') ? 'selected' : '' ?>>Pengawas</option>
							</select>
						</form>
						<script>
							function filterRole() {
								var role = document.getElementById('role').value;
								var baseUrl = '<?= site_url('Admin/Pegawai/Index') ?>';
								if(role) {
									window.location.href = baseUrl + '/' + role;
								} else {
									window.location.href = baseUrl;
								}
							}
						</script>
						<!-- End Filter Role -->

						<div class="table-responsive">
							<table class="table-striped table table-bordered dataTables table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>NIK</th>
										<th>Nama</th>
										<th>Tempat Lahir</th>
										<th>Tanggal Lahir</th>
										<th>Jenis Kelamin</th>
										<th>Alamat</th>
										<th>No Telepon</th>
										<th>Email</th>
										<th>Role</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($pegawai as $row): ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= htmlspecialchars($row->nik); ?></td>
											<td><?= htmlspecialchars($row->nama); ?></td>
											<td><?= htmlspecialchars($row->tempat_lahir); ?></td>
											<td><?= htmlspecialchars($row->tanggal_lahir); ?></td>
											<td><?= $row->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
											<td><?= htmlspecialchars($row->alamat); ?></td>
											<td><?= htmlspecialchars($row->no_telepon); ?></td>
											<td><?= htmlspecialchars($row->email); ?></td>
											<td><?= htmlspecialchars($row->role) == 'operator' ? 'Pengawas' : htmlspecialchars($row->role); ?></td>
											<td>
												<a href="<?= site_url('Admin/Pegawai/Index/edit/' . $row->id) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
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
