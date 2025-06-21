<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2>Daftar Siswa Kelas <?= htmlspecialchars($kelas->nama_kelas); ?></h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?= site_url('Admin/Kelasrombel/Index') ?>" class="btn btn-secondary mb-3"> <i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="padding-bottom:50px;">
                <?php if ($this->session->flashdata('success')): ?>
                    <div id="flash-success" data-message="<?= $this->session->flashdata('success'); ?>"></div>
                <?php endif; ?>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td width="150"><strong>Kelas</strong></td>
                                <td>: <?= htmlspecialchars($kelas->nama_kelas); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Tahun Akademik</strong></td>
                                <td>: <?= htmlspecialchars($kelasrombel->tahun); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Wali Kelas</strong></td>
                                <td>: <?= htmlspecialchars($kelasrombel->nama); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <?php if (empty($siswa_kelas)): ?>
                    <div class="alert alert-info">
                        <i class="fa fa-info-circle"></i> Belum ada siswa yang terdaftar dalam kelas ini.
                    </div>
                <?php else: ?>
                    <table class="table table-bordered dt-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Email</th>
                                <th>No. HP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($siswa_kelas as $siswa): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($siswa->nis); ?></td>
                                    <td><?= htmlspecialchars($siswa->nama); ?></td>
                                    <td><?= htmlspecialchars($siswa->email); ?></td>
                                    <td><?= htmlspecialchars($siswa->no_hp); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div> 