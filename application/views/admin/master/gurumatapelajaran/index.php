<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2>Data Guru Mata Pelajaran</h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?= site_url('Admin/Gurumatapelajaran/Index/create') ?>" class="btn btn-primary mb-3"> <i class="fa fa-plus"></i> Tambah Guru Mata Pelajaran</a>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="padding-bottom:50px;">
                <?php if ($this->session->flashdata('success')): ?>
                    <div id="flash-success" data-message="<?= $this->session->flashdata('success'); ?>"></div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('error')): ?>
                    <div id="flash-error" data-message="<?= $this->session->flashdata('error'); ?>"></div>
                <?php endif; ?>
                <table class="table table-bordered dt-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Guru</th>
                            <th>Mata Pelajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($gurumatapelajaran as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row->nama_pegawai); ?></td>
                                <td><?= htmlspecialchars($row->nama_matapelajaran); ?></td>
                                <td>
                                    <a href="<?= site_url('Admin/Gurumatapelajaran/Index/edit/' . $row->id) ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $row->id ?>">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 