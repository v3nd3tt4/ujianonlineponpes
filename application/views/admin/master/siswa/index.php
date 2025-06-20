<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2>Data Siswa</h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?= site_url('Admin/Siswa/Index/create') ?>" class="btn btn-primary mb-3"> <i class="fa fa-plus"></i> Tambah Siswa</a>
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
                            <th>NIS</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Nama Ibu</th>
                            <th>Nama Ayah</th>
                            <th>Pekerjaan Ibu</th>
                            <th>Pekerjaan Ayah</th>
                            <th>Tahun Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($siswa as $row): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row->nama); ?></td>
                                <td><?= htmlspecialchars($row->nis); ?></td>
                                <td><?= htmlspecialchars($row->tempat_lahir); ?></td>
                                <td><?= htmlspecialchars($row->tanggal_lahir); ?></td>
                                <td><?= $row->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                                <td><?= htmlspecialchars($row->alamat); ?></td>
                                <td><?= htmlspecialchars($row->email); ?></td>
                                <td><?= htmlspecialchars($row->no_hp); ?></td>
                                <td><?= htmlspecialchars($row->nama_ibu); ?></td>
                                <td><?= htmlspecialchars($row->nama_ayah); ?></td>
                                <td><?= htmlspecialchars($row->pekerjaan_ibu); ?></td>
                                <td><?= htmlspecialchars($row->pekerjaan_ayah); ?></td>
                                <td><?= htmlspecialchars($row->tahun_masuk); ?></td>
                                <td>
                                    <a href="<?= site_url('Admin/Siswa/Index/edit/' . $row->id) ?>" class="btn btn-warning btn-sm">Edit</a>
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
