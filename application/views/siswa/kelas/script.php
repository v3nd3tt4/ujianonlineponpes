<script src="<?= base_url() ?>assets_miminium/js/plugins/qrcode.min.js"></script>
<script>
	$(document).ready(function() {
		// Initialize DataTable
		$('#datatables-example').DataTable({
			"responsive": true,
			"autoWidth": false,
			"language": {
				"url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
			}
		});
	});

	// Function to show QR Code modal
	function showQRCode(nis, id, nama) {
		// Clear previous QR code
		$('#qrcode').empty();

		// Create QR code data
		var qrData = JSON.stringify({
			"nis": nis,
			"id": id,
			"nama": nama
		});

		// Show the data text
		$('#qrCodeData').text(qrData);

		// Generate QR code
		var qrcode = new QRCode(document.getElementById("qrcode"), {
			text: qrData,
			width: 200,
			height: 200,
			colorDark: "#000000",
			colorLight: "#ffffff",
			correctLevel: QRCode.CorrectLevel.H
		});

		// Show modal
		$('#qrCodeModal').modal('show');
	}

	// Function to show siswa kelas modal
	function showSiswaKelas(kelasrombelId, namaKelas) {
		// Show loading in modal
		$('#siswaKelasContent').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><br>Memuat data...</div>');
		$('#siswaKelasModalLabel').text('Daftar Siswa Kelas: ' + namaKelas);
		$('#siswaKelasModal').modal('show');

		// Load siswa kelas content via AJAX
		$.ajax({
			url: '<?= base_url('user/kelas/siswa_kelas/') ?>' + kelasrombelId,
			type: 'GET',
			dataType: 'html',
			success: function(response) {
				$('#siswaKelasContent').html(response);
			},
			error: function(xhr, status, error) {
				$('#siswaKelasContent').html('<div class="alert alert-danger">Gagal memuat data siswa. Silakan coba lagi.</div>');
				console.error('AJAX Error:', error);
			}
		});
	}

	// Function to show biodata modal
	function showBiodata(siswaId) {
		// Show loading in modal
		$('#biodataContent').html('<div class="text-center"><i class="fa fa-spinner fa-spin fa-2x"></i><br>Memuat data...</div>');
		$('#biodataModal').modal('show');

		// Load biodata content via AJAX
		$.ajax({
			url: '<?= base_url('user/kelas/biodata/') ?>' + siswaId,
			type: 'GET',
			dataType: 'html',
			success: function(response) {
				$('#biodataContent').html(response);
			},
			error: function(xhr, status, error) {
				$('#biodataContent').html('<div class="alert alert-danger">Gagal memuat data biodata. Silakan coba lagi.</div>');
				console.error('AJAX Error:', error);
			}
		});
	}

	// Close modal when clicking outside
	$(document).on('click', '.modal-backdrop', function() {
		$('#siswaKelasModal').modal('hide');
		$('#biodataModal').modal('hide');
		$('#qrCodeModal').modal('hide');
	});
</script>
