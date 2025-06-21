<!-- Modal -->
<div class="modal fade" id="assign-modal" tabindex="-1" role="dialog" aria-labelledby="assign-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="assign-modal-label">Tetapkan Bank Soal</h4>
      </div>
      <div class="modal-body">
        <p>Anda akan menetapkan bank soal untuk jadwal:</p>
        <p><strong>Mata Pelajaran:</strong> <span id="modal-mapel"></span></p>
        <p><strong>Kelas:</strong> <span id="modal-kelas"></span></p>
        <hr>
        <form id="assign-form">
            <input type="hidden" name="jadwal_id" id="jadwal_id">
            <div class="form-group">
                <label for="banksoal_id">Pilih Bank Soal</label>
                <select name="banksoal_id" id="banksoal_id" class="form-control" required style="width: 100%;">
                    <!-- Options will be populated by JS -->
                </select>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="save-assignment-button">Simpan</button>
      </div>
    </div>
  </div>
</div> 