<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- start: Content -->
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Ujian Online</h3>
                <p class="animated fadeInDown">
                    Ujian Online <span class="fa-angle-right fa"></span> List Data
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Data Jadwal Ujian</h3>
                </div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Tahun Akademik</th>
                                    <th>Tanggal Ujian</th>
                                    <th>Waktu</th>
                                    <th>Durasi</th>
                                    <th>Jenis Ujian</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach($jadwal_ujian as $row): 
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row->nama_matapelajaran ?></td>
                                    <td><?= $row->nama_kelas ?></td>
                                    <td><?= $row->tahun ?> - <?= $row->semester ?></td>
                                    <td><?= date('d/m/Y', strtotime($row->tanggal_ujian)) ?></td>
                                    <td><?= date('H:i', strtotime($row->jam_mulai)) ?> - <?= date('H:i', strtotime($row->jam_selesai)) ?></td>
                                    <td><?= $row->lama_ujian ?> Menit</td>
                                    <td><?= $row->jenis_ujian ?></td>
                                    <td>
                                        <a href="<?= base_url('ujianonline/absensi/'.$row->id) ?>" class="btn btn-primary btn-sm">
                                            <i class="fa fa-users"></i> Absensi
                                        </a>
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
