<div id="content">
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Daftar Kelas Anda</h3>
                </div>
                <div class="panel-body">                    
                    <?php if (!empty($kelas_list)): ?>
                        <div class="responsive-table">
                            <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="15%">Nama Kelas</th>
                                        <th width="20%">Tahun Akademik</th>
                                        <th width="20%">Wali Kelas</th>
                                        <th width="25%">Keterangan</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($kelas_list as $kelas): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= htmlspecialchars($kelas->nama_kelas) ?></td>
                                            <td><?= htmlspecialchars($kelas->tahun) ?> - <?= htmlspecialchars($kelas->semester) ?></td>
                                            <td><?= htmlspecialchars($kelas->wali_kelas) ?></td>
                                            <td><?= htmlspecialchars($kelas->keterangan) ?></td>
                                            <td>
                                                <!-- <button class="btn btn-info btn-sm" onclick="showSiswaKelas(<?= $kelas->kelasrombel_id ?>, '<?= htmlspecialchars($kelas->nama_kelas) ?>')">
                                                    <i class="fa fa-users"></i> Lihat Siswa
                                                </button> -->
                                                <button class="btn btn-warning btn-sm" onclick="showQRCode('<?= $this->session->userdata('nis') ?>', '<?= $this->session->userdata('id_user') ?>')">
                                                    <i class="fa fa-qrcode"></i> QR Code
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <strong>Peringatan!</strong> Anda belum terdaftar di kelas manapun.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Daftar Siswa Kelas -->
<div class="modal fade" id="siswaKelasModal" tabindex="-1" role="dialog" aria-labelledby="siswaKelasModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="siswaKelasModalLabel">Daftar Siswa Kelas</h4>
            </div>
            <div class="modal-body" id="siswaKelasContent">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Biodata -->
<div class="modal fade" id="biodataModal" tabindex="-1" role="dialog" aria-labelledby="biodataModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="biodataModalLabel">Biodata Siswa</h4>
            </div>
            <div class="modal-body" id="biodataContent">
                <!-- Content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal QR Code -->
<div class="modal fade" id="qrCodeModal" tabindex="-1" role="dialog" aria-labelledby="qrCodeModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="qrCodeModalLabel">QR Code Siswa</h4>
            </div>
            <div class="modal-body text-center">
                <div id="qrcode"></div>
                <br>
                <!-- <small class="text-muted" id="qrCodeData"></small> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>