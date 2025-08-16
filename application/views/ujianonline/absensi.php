<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- start: Content -->
<div id="content">
	<div class="panel box-shadow-none content-header">
		<div class="panel-body">
			<div class="col-md-12">
				<h3 class="animated fadeInLeft">Absensi Ujian Online</h3>
				<p class="animated fadeInDown">
					Ujian Online <span class="fa-angle-right fa"></span> Absensi <span class="fa-angle-right fa"></span> <?= $jadwal->nama_matapelajaran ?>
				</p>
			</div>
		</div>
	</div>

	<div class="col-md-12 top-20 padding-0">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<h3>Data Peserta Ujian</h3>
				</div>
				<div class="panel-body">
					
					<div class="row">
						<div class="col-md-12">
							<table class="table">
								<tr>
									<th width="200">Mata Pelajaran</th>
									<td width="10">:</td>
									<td><?= $jadwal->nama_matapelajaran ?></td>
								</tr>
								<tr>
									<th>Kelas</th>
									<td>:</td>
									<td><?= $jadwal->nama_kelas ?></td>
								</tr>
								<tr>
									<th>Tahun Akademik</th>
									<td>:</td>
									<td><?= $jadwal->tahun ?> - <?= $jadwal->semester ?></td>
								</tr>
								<tr>
									<th>Tanggal Ujian</th>
									<td>:</td>
									<td><?= date('d/m/Y', strtotime($jadwal->tanggal_ujian)) ?></td>
								</tr>
								<tr>
									<th>Waktu</th>
									<td>:</td>
									<td><?= date('H:i', strtotime($jadwal->jam_mulai)) ?> - <?= date('H:i', strtotime($jadwal->jam_selesai)) ?> (<?= $jadwal->lama_ujian ?> Menit)</td>
								</tr>
								<tr>
									<th>Jenis Ujian</th>
									<td>:</td>
									<td><?= $jadwal->jenis_ujian ?></td>
								</tr>
							</table>
						</div>
					</div>
					<hr>
					<div class="responsive-table">
						<table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th width="15%">NIS</th>
									<th>Nama Siswa</th>
									<th width="10%">L/P</th>
									<th width="15%">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($siswa as $row):
								?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $row->nis ?></td>
										<td><?= $row->nama ?></td>
										<td><?= $row->jenis_kelamin ?></td>
										<td>
											<span class="label label-success">Hadir</span>
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
</div>
<!-- end: content -->

<script type="text/javascript">
	$(document).ready(function() {
		$('#datatables-example').DataTable();
	});
</script>
