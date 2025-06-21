<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-6 text-left">
                        <h2>Data Jadwal Ujian</h2>
                    </div>
                    <div class="col-md-6 text-right">
                        <button class="btn btn-primary" id="add-button"><i class="fa fa-plus"></i> Tambah Jadwal Ujian</button>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="padding-bottom:50px;">
                <table id="jadwal-table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Tanggal Ujian</th>
                            <th>Jam Mulai</th>
                            <th>Jenis Ujian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/master/jadwalujian/form'); ?> 