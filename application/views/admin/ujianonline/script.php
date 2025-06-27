<script src="https://unpkg.com/html5-qrcode"></script>

<script type="text/javascript">
	$(document).ready(function() {

		<?php if (!empty($jadwal->id)): ?>

			// Clean up scanner when modal is hidden
			let html5QrcodeScannerInstance = null;

			$('#scanModal').on('shown.bs.modal', function() {
				html5QrcodeScannerInstance = new Html5QrcodeScanner(
					"reader", {
						fps: 10,
						qrbox: 250
					}
				);

				html5QrcodeScannerInstance.render(onScanSuccess);
			});

			$('#scanModal').on('hidden.bs.modal', function() {
				if (html5QrcodeScannerInstance) {
					html5QrcodeScannerInstance.clear();
					html5QrcodeScannerInstance = null;
				}
				$('#reader').empty();
				// Clear flash messages when modal is closed
				$('#flashMessage').html('').hide();

				clearIntervalsAndTimeouts();

			});

			function clearIntervalsAndTimeouts() {
				// Clear any active countdown intervals and flash message timeouts
				if (window.countdownInterval) {
					clearInterval(window.countdownInterval);
					window.countdownInterval = null;
				}
				if (window.flashMessageTimeout) {
					clearTimeout(window.flashMessageTimeout);
					window.flashMessageTimeout = null;
				}
			}

			// Function to show flash message in modal
			function showFlashMessage(type, message) {
				let alertClass, iconClass;

				switch (type) {
					case 'success':
						alertClass = 'alert-success';
						iconClass = 'fa-check-circle';
						break;
					case 'error':
						alertClass = 'alert-danger';
						iconClass = 'fa-exclamation-triangle';
						break;
					case 'info':
						alertClass = 'alert-info';
						iconClass = 'fa-info-circle';
						break;
					default:
						alertClass = 'alert-info';
						iconClass = 'fa-info-circle';
				}

				const flashHtml = `
		<div class="alert ${alertClass} alert-dismissible fade show" role="alert">
			<i class="fa ${iconClass}"></i> ${message}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	`;

				$('#flashMessage').html(flashHtml).show();

				// Clear existing timeout before setting a new one
				if (window.flashMessageTimeout) {
					clearTimeout(window.flashMessageTimeout);
				}

				window.flashMessageTimeout = setTimeout(function() {
					$('#flashMessage .alert').fadeOut(function() {
						$('#flashMessage').html('').hide();
					});
					window.flashMessageTimeout = null;
				}, 5000);
			}


			// Handle successful scan
			function onScanSuccess(qrCodeMessage) {
				try {
					// Clear any previous intervals/timeouts to prevent repeated flash messages
					clearIntervalsAndTimeouts();
					const data = JSON.parse(qrCodeMessage);
					console.log(qrCodeMessage);

					// Validate QR data
					if (!data.id || !data.nis) {
						throw new Error('QR Code tidak valid! Data tidak lengkap.');
					}

					// Show QR scan result first
					showFlashMessage('info', `QR Code berhasil dibaca!<br>NIS: ${data.nis}<br>Nama: ${data.nama || '-'}<br>Memproses presensi dalam <span id="countdown">3</span> detik...`);

					// Start countdown
					let countdown = 3;
					window.countdownInterval = setInterval(function() {
						countdown--;
						const countdownElement = $('#countdown');
						if (countdownElement.length) {
							countdownElement.text(countdown);
						}

						if (countdown <= 0) {
							clearInterval(window.countdownInterval);
							window.countdownInterval = null;
							processAttendance(data);
						}
					}, 1000);

				} catch (error) {
					showFlashMessage('error', error.message || 'QR Code tidak valid! Format data salah.');
				}
			}

			// Process attendance after countdown
			function processAttendance(data) {
				// Show processing message
				showFlashMessage('info', 'Sedang memproses presensi...');

				// Send to server
				$.ajax({
					url: '<?= base_url('ujianonline/presensi') ?>',
					type: 'POST',
					data: {
						jadwal_id: '<?= $jadwal->id ?>',
						siswa_id: data.id,
						nis: data.nis
					},
					dataType: 'json',
					success: function(response) {
						if (response.status === 'success') {
							// Update table row
							const row = $(`#siswa-${data.id}`);
							row.find('td:eq(4)').html('<span class="label label-success">Hadir</span>');
							row.find('td:eq(5)').text(response.waktu_hadir);

							// Show success message
							showFlashMessage('success', `Presensi berhasil dicatat!<br>Siswa: ${response.nama_siswa || data.nis}<br>Waktu: ${response.waktu_hadir || 'Sekarang'}`);

							// Auto close modal after 3 seconds
							setTimeout(function() {
								$('#scanModal').modal('hide');
								// Optional: reload page to refresh data
								// location.reload();
							}, 3000);

						} else {
							showFlashMessage('error', response.message || 'Terjadi kesalahan saat mencatat presensi!');
						}
					},
					error: function(xhr, status, error) {
						let errorMessage = 'Terjadi kesalahan sistem!';
						if (xhr.responseJSON && xhr.responseJSON.message) {
							errorMessage = xhr.responseJSON.message;
						}
						showFlashMessage('error', errorMessage);
					}
				});
			}
		<?php endif; ?>
	});
</script>
