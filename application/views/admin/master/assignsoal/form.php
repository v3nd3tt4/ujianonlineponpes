<!-- Modal -->
<div class="modal fade" id="assign-modal" tabindex="-1" role="dialog" aria-labelledby="assign-modal-label">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="assign-modal-label">Tetapkan Bank Soal</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="alert alert-warning">
					<i class="fa fa-exclamation-triangle"></i>
					Pastikan bank soal yang dipilih sudah sesuai dengan mata pelajaran dan kelas yang ditetapkan.
				</p>
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover">
						<tbody>
							<tr>
								<th width="40%">Mata Pelajaran</th>
								<td><span id="modal-mapel"></span></td>
							</tr>
							<tr>
								<th>Kelas</th>
								<td><span id="modal-kelas"></span></td>
							</tr>
						</tbody>
					</table>
				</div>
				<form id="assign-form">
					<input type="hidden" name="jadwal_id" id="jadwal_id">
					<div class="form-group">
						<label for="banksoal_id"><strong>Pilih Bank Soal</strong></label>
						<select name="banksoal_id" id="banksoal_id" class="form-control" required style="width: 100%;">
						</select>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">
					<i class="fa fa-times"></i> Tutup
				</button>
				<button type="button" class="btn btn-primary" id="save-assignment-button">
					<i class="fa fa-save"></i> Simpan Penetapan
				</button>
			</div>
		</div>
	</div>
</div>
