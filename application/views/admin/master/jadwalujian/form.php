<!-- Modal -->
<div class="modal fade" id="jadwal-modal" tabindex="-1" role="dialog" aria-labelledby="jadwal-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="jadwal-modal-label">Form Jadwal Ujian</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form id="jadwal-form">
					<input type="hidden" name="id" id="id">
					<div class="form-group">
						<label for="matapelajaran_id">Mata Pelajaran</label>
						<select name="matapelajaran_id" id="matapelajaran_id" class="form-control" required style="width: 100%;">
							<!-- Options will be populated by JS -->
						</select>
					</div>
					<div class="form-group">
						<label for="kelasrombel_id">Kelas Rombel</label>
						<select name="kelasrombel_id" id="kelasrombel_id" class="form-control" required style="width: 100%;">
							<!-- Options will be populated by JS -->
						</select>
					</div>
					<div class="form-group">
						<label for="tanggal_ujian">Tanggal Ujian</label>
						<input type="date" class="form-control" id="tanggal_ujian" name="tanggal_ujian" required>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="jam_mulai">Jam Mulai</label>
								<input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="jam_selesai">Jam Selesai</label>
								<input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="lama_ujian">Lama Ujian (menit)</label>
						<input type="number" class="form-control" id="lama_ujian" name="lama_ujian" required>
					</div>
					<div class="form-group">
						<label for="jenis_ujian">Jenis Ujian</label>
						<select name="jenis_ujian" id="jenis_ujian" class="form-control" required>
							<option value="">Pilih Jenis Ujian</option>
							<option value="Ujian">Ujian</option>
							<option value="Remedial">Remedial</option>
							<option value="Lainnya">Lainnya</option>
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-primary" id="save-button">Simpan</button>
			</div>
		</div>
	</div>
</div>
