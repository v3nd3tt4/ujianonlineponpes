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
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSiswa">
    <i class="fa fa-plus"></i> Tambah Siswa
</a>
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
                                <th>Aksi</th>
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
                                    <td>
                                        <button class="btn btn-danger btn-sm btn-hapus-siswa" 
                                                data-id="<?= $siswa->id; ?>" 
                                                data-nama="<?= htmlspecialchars($siswa->nama); ?>">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div> 

<!-- Modal Tambah Siswa -->
<div class="modal fade" id="modalTambahSiswa" tabindex="-1" role="dialog" aria-labelledby="modalTambahSiswaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="<?= site_url('Admin/Kelasrombel/index/simpanSiswa'); ?>" id="formTambahSiswa">
      <input type="hidden" name="id_kelasrombel" value="<?= $kelasrombel->id; ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahSiswaLabel">Tambah Siswa ke Kelas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="id_siswa">Pilih Siswa</label>
            <select name="id_siswa" id="id_siswa" class="form-control js-example-basic-single" required style="width: 100%;">
              <option value="">-- Pilih Siswa --</option>
              <?php foreach ($siswa_list as $siswa): ?>
                <option value="<?= $siswa->id; ?>"><?= htmlspecialchars($siswa->nama); ?> (<?= htmlspecialchars($siswa->nis); ?>)</option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Tambah</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>