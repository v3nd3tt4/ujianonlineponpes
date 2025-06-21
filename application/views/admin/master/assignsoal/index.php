<div id="content">
    <div class="col-md-12 card-wrap" style="padding:20px;">
        <div class="panel">
            <div class="panel-heading bg-white border-none" style="padding:20px;">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <h2>Penetapan Soal Ujian</h2>
                        <p>Pilih jadwal ujian dan tetapkan bank soal yang akan digunakan.</p>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="padding-bottom:50px;">
                <table id="assign-table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Tanggal Ujian</th>
                            <th>Bank Soal Terpasang</th>
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

<?php $this->load->view('admin/master/assignsoal/form'); ?> 