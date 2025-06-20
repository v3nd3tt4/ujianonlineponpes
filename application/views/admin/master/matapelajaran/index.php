<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2>Data Mata Pelajaran</h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?= site_url('Admin/Matapelajaran/Index/create') ?>" class="btn btn-primary mb-3"> <i class="fa fa-plus"></i> Tambah Mata Pelajaran</a>
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
                            <th>Kode Mata Pelajaran</th>
                            <th>Nama Mata Pelajaran</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($matapelajaran as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row->kode_matapelajaran); ?></td>
                                <td><?= htmlspecialchars($row->nama_matapelajaran); ?></td>
                                <td><?= htmlspecialchars($row->keterangan); ?></td>
                                <td>
                                    <a href="<?= site_url('Admin/Matapelajaran/Index/edit/' . $row->id) ?>" class="btn btn-warning btn-sm">Edit</a>
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