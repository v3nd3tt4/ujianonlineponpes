<?php if (isset(
    $detail->nama_matapelajaran
) && isset($detail->nama_kelas) && isset($detail->wali_kelas) && isset($detail->tahun) && isset($detail->semester)) : ?>
    <style>
		body {
			font-family: Arial, sans-serif;
			margin: 20px;
		}

		.header {
			text-align: center;
			margin-bottom: 10px;
		}

		.header h2 {
			margin: 0;
			font-size: 28px;
			font-weight: bold;
			letter-spacing: 1px;
		}

		.desc {
			margin-bottom: 50px;
			font-size: 16px;
			text-align: center;
		}

		.info {
			margin-bottom: 20px;
			font-size: 14px;
			text-align: right;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
			font-size: 13px;
		}

		th,
		td {
			border: 1px solid #333;
			padding: 7px 5px;
			text-align: left;
		}

		th {
			background: #f2f2f2;
			font-weight: bold;
			text-align: center;
		}

		.footer {
			text-align: right;
			font-size: 13px;
			margin-top: 10px;
		}
	</style>
    <div class="header">
        <h2><?= strtoupper("Laporan Nilai Ujian Siswa") ?> <hr></h2>
    </div>

    <table style="margin-bottom:20px;">
        <tr>
            <td><b>Mata Pelajaran</b></td>
            <td>:</td>
            <td><?= $detail->nama_matapelajaran ?></td>
        </tr>
        <tr>
            <td><b>Kelas</b></td>
            <td>:</td>
            <td><?= $detail->nama_kelas ?></td>
        </tr>
        <tr>
            <td><b>Wali Kelas</b></td>
            <td>:</td>
            <td><?= $detail->wali_kelas ?></td>
        </tr>
        <tr>
            <td><b>Tahun Akademik</b></td>
            <td>:</td>
            <td><?= $detail->tahun ?> (<?= $detail->semester ?>)</td>
        </tr>
    </table>
<?php endif; ?>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Nilai Akhir</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($hasil_ujian as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row->nis ?></td>
                <td><?= $row->nama_siswa ?></td>
                <td><?= $row->nilai_akhir ?></td>
                <td><?= $row->status ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>