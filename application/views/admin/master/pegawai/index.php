<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 text-left">
                        <h2>Data Pegawai</h2>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                        <a href="<?= site_url('Admin/Pegawai/Index/create') ?>" class="btn btn-primary mb-3"> <i class="fa fa-plus"></i> Tambah Pegawai</a>
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
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pegawai as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row->nama); ?></td>
                                <td><?= htmlspecialchars($row->tempat_lahir); ?></td>
                                <td><?= htmlspecialchars($row->tanggal_lahir); ?></td>
                                <td><?= $row->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                                <td><?= htmlspecialchars($row->alamat); ?></td>
                                <td><?= htmlspecialchars($row->no_telepon); ?></td>
                                <td><?= htmlspecialchars($row->email); ?></td>
                                <td><?= htmlspecialchars($row->role); ?></td>
                                <td>
                                    <a href="<?= site_url('Admin/Pegawai/Index/edit/' . $row->id) ?>" class="btn btn-warning btn-sm">Edit</a>
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