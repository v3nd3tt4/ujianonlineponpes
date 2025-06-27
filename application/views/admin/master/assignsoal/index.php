<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Data Penetapan Soal Ujian</h4>
					</div>

					<div class="card-body">
						<div class="alert alert-info" role="alert">
							<i class="fa fa-info-circle"></i>
							Pilih jadwal ujian dan tetapkan bank soal yang akan digunakan.
						</div>

						<div class="table-responsive">
							<table id="assign-table" class="table-striped table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Mata Pelajaran</th>
										<th>Kelas</th>
										<th>Tanggal Ujian</th>
										<th>Bank Soal Terpasang</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>

					</div>

				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('admin/master/assignsoal/form'); ?>
