<div id="content">
    <!-- <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Absensi Ujian Online</h3>
                <p class="animated fadeInDown">
                    Ujian Online <span class="fa-angle-right fa"></span> Absensi <span class="fa-angle-right fa"></span> <?= $jadwal->nama_matapelajaran ?>
                </p>
            </div>
        </div>
    </div> -->

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Data Peserta Ujian</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#scanModal">
                                <i class="fa fa-qrcode"></i> Scan QR Code
                            </button>
                        </div>
                    </div>
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
                                    <th width="15%">Waktu Hadir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($siswa as $row):
                                ?>
                                    <tr id="siswa-<?= $row->id ?>">
                                        <td><?= $no++ ?></td>
                                        <td><?= $row->nis ?></td>
                                        <td><?= $row->nama ?></td>
                                        <td><?= $row->jenis_kelamin ?></td>
                                        <td>
                                            <?php if ($row->waktu_hadir): ?>
                                                <span class="label label-success">Hadir</span>
                                            <?php else: ?>
                                                <span class="label label-warning">Belum Hadir</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($row->waktu_hadir): ?>
                                                <?= date('d/m/Y H:i', strtotime($row->waktu_hadir)) ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
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

<!-- Modal QR Scanner -->
<div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-labelledby="scanModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="scanModalLabel">Scan QR Code</h4>
            </div>
            <div class="modal-body">
                <div id="reader"></div>
                <div class="alert alert-info">
                    <p>Silakan scan QR Code pada kartu ujian siswa.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>