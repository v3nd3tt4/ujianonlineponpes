<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$(document).ready(function() {
		<?php if (empty($jadwal)): ?>
			// Show flash message if no jadwal
			showFlashMessage('info', 'Anda belum melakukan presensi pada ujian manapun.');
		<?php endif; ?>
	});

	// Simple flash message function
	function showFlashMessage(type, message) {
		let alertClass;
		switch (type) {
			case 'success':
				alertClass = 'alert-success';
				break;
			case 'error':
				alertClass = 'alert-danger';
				break;
			case 'info':
			default:
				alertClass = 'alert-info';
				break;
		}
		const flashHtml = `<div class="alert ${alertClass} alert-dismissible fade show" role="alert">
			${message}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>`;
		$('#flashMessage').html(flashHtml).show();
		setTimeout(function() {
			$('#flashMessage .alert').fadeOut(function() {
				$('#flashMessage').html('').hide();
			});
		}, 3000);
	}
</script>
