<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header d-flex justify-content-between">
						<h4>Data Jadwal Ujian</h4>
						<button class="btn btn-primary" id="add-button"><i class="fa fa-plus"></i> Tambah Jadwal Ujian</button>
					</div>

					<div class="card-body">
						<div class="table-responsive">
							<table id="jadwal-table" class="table-striped table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Mapel</th>
										<th>Mata Pelajaran</th>
										<th>Kelas Rombel</th>
										<th>Tanggal Ujian</th>
										<th>Jam Mulai</th>
										<th>Jenis Ujian</th>
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


<?php $this->load->view('admin/master/jadwalujian/form'); ?>
