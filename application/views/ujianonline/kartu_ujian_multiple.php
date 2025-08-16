<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Kartu Ujian Siswa</title>
	<style>
		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
			border: 0;
		}

		body {
			font-family: Arial, sans-serif;
			font-size: 9px;
			margin: 0;
			padding: 0;
			background: #f9f9f9;
		}

		.page-container {
			width: 100%;
		}

		.kartu-wrapper {
			width: 47%;
			/* setengah halaman */
			float: left;
			padding: 5px;
		}

		.kartu-ujian {
			width: 95mm;
			height: 35mm;
			border: 1px solid #0066cc;
			border-radius: 3px;
			padding: 2mm;
			box-sizing: border-box;
			background: #fff;
			position: relative;
			overflow: hidden;
		}

		.header {
			text-align: center;
			margin-bottom: 2mm;
			border-bottom: 1px solid #0066cc;
			padding-bottom: 1mm;
		}

		.title {
			font-size: 11px;
			font-weight: bold;
			color: #0066cc;
			margin: 0;
		}

		.subtitle {
			font-size: 7px;
			color: #666;
			margin: 0;
		}

		.content {
			width: 100%;
			overflow: hidden;
			margin-top: 2mm;
		}

		.left-section {
			width: 64.5%;
			float: left;
		}

		.right-section {
			width: 34.5%;
			display: flex;
			text-align: center;
			flex-direction: column;
			align-items: center;
			justify-content: center;
		}

		.info-table {
			width: 100%;
			font-size: 10px;
		}

		.info-label {
			font-weight: bold;
			color: #333;
			width: 20mm;
			white-space: nowrap;
			font-size: 9px;
		}

		.info-colon {
			width: 3mm;
			color: #333;
			text-align: center;
			font-weight: normal;
			font-size: 9px;
		}

		.info-value {
			color: #000;
			white-space: nowrap;
			font-size: 9px;
		}

		.qr-text {
			font-size: 4px;
			margin-top: 1mm;
			color: #666;
			font-style: italic;
		}

		.footer {
			font-size: 6px;
			color: #666;
			text-align: center;
			border-top: 1px solid #ddd;
			padding-top: 1mm;
			margin-top: 2mm;
		}

		/* Biar wrapper tidak tabrakan float */
		.clearfix::after {
			content: "";
			display: table;
			clear: both;
		}
	</style>
</head>

<body>
	<div class="page-container clearfix">
		<?php foreach ($siswa_data as $data): ?>
			<div class="kartu-wrapper">
				<?= $this->load->view('ujianonline/partial_kartu', $data, true); ?>
			</div>
		<?php endforeach; ?>
	</div>
</body>

</html>
