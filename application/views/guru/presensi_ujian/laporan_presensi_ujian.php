<?php if (isset($detail->nama_matapelajaran)): ?>
    <h2 style="text-align:center;">Laporan Presensi Ujian Siswa</h2>
    <table style="margin-bottom:20px;">
        <tr><td><b>Mata Pelajaran</b></td><td>:</td><td><?= $detail->nama_matapelajaran ?></td></tr>
        <tr><td><b>Kelas</b></td><td>:</td><td><?= $detail->nama_kelas ?></td></tr>
        <tr><td><b>Wali Kelas</b></td><td>:</td><td><?= $detail->wali_kelas ?></td></tr>
        <tr><td><b>Tahun Akademik</b></td><td>:</td><td><?= $detail->tahun ?> (<?= $detail->semester ?>)</td></tr>
    </table>
<?php endif; ?>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Status Presensi</th>
            <th>Waktu Hadir</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach($presensi_ujian as $row): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row->nis ?></td>
            <td><?= $row->nama_siswa ?></td>
            <td>Hadir</td>
            <td><?= $row->waktu_hadir ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>