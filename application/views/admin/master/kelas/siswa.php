<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2>Siswa Kelas: <?= htmlspecialchars($kelas->nama_kelas); ?></h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?= site_url('Admin/Kelassiswa/Index/create') ?>" class="btn btn-primary mb-3"> <i class="fa fa-plus"></i> Tambah Siswa ke Kelas</a>
                        <a href="<?= site_url('Admin/Kelas/Index') ?>" class="btn btn-secondary mb-3"> <i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="padding-bottom:50px;">
                <?php if ($this->session->flashdata('success')): ?>
                    <div id="flash-success" data-message="<?= $this->session->flashdata('success'); ?>"></div>
                <?php endif; ?>
                <table class="table table-bordered dt-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($siswa_kelas)): ?>
                            <tr>
                                <td colspan="4" class="text-center">Belum ada siswa di kelas ini</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($siswa_kelas as $row): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row->nama_siswa); ?></td>
                                    <td><?= htmlspecialchars($row->nis); ?></td>
                                    <td>
                                        <a href="<?= site_url('Admin/Kelassiswa/Index/edit/' . $row->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row->id ?>">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 