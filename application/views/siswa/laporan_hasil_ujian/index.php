<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-wrap">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Laporan Hasil Ujian</h4>
                            </div>

                            <div class="card-body">
                                <div class="alert alert-info">
                                    Menampilkan laporan hasil ujian yang sudah anda kerjakan, silahkan pilih terlebih dahulu kelas
                                </div>
                                <form action="<?= base_url('user/laporan_hasil_ujian/cetak_pdf') ?>" method="post" target="_blank">
                                    <div class="form-group">
                                        <label for="">Kelas Anda:</label>
                                        <select name="kelasrombel_id" id="" class="form-control" required>
                                            <option value="">--Pilih--</option>
                                            <?php foreach ($kelas_list as $kelas) { ?>
                                                <option value="<?= $kelas->kelasrombel_id ?>"><?= $kelas->nama_kelas ?> - <?= $kelas->tahun ?> - <?= $kelas->wali_kelas ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-file-pdf"></i> Cetak PDF
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>