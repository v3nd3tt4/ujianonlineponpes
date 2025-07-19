<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	let isEditMode = false;
	let originalData = {};

	function toggleEditMode() {
		isEditMode = true;
		saveOriginalData();
		
		// Enable semua input
		$('#form-profile input:not([readonly])').prop('readonly', false);
		$('#form-profile select').prop('disabled', false);
		$('#form-profile textarea').prop('readonly', false);
		
		// Tampilkan tombol upload foto
		$('#btn-upload-foto').show();
		
		// Tampilkan grup security
		$('#security-group').show();
		
		// Tampilkan tombol save dan sembunyikan tombol edit
		$('#save-group').show();
		$('#btn-edit').hide();
		$('#btn-cancel').show();
		
		// Tambahkan styling untuk field yang bisa diedit
		$('.form-control:not([readonly]), select:not([disabled]), textarea:not([readonly])').addClass('form-control-edit');
		$('.form-control-edit').css({
			'border-color': '#007bff',
			'background-color': '#f8f9ff'
		});
		
		Swal.fire({
			title: 'Mode Edit Diaktifkan!',
			text: 'Field yang dapat diubah telah ditandai dengan warna biru.',
			icon: 'info',
			timer: 2000,
			showConfirmButton: false,
			toast: true,
			position: 'top-end'
		});
	}

	function cancelEdit() {
		Swal.fire({
			title: 'Batalkan Perubahan?',
			text: 'Semua perubahan yang belum disimpan akan hilang.',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Ya, Batalkan!',
			cancelButtonText: 'Lanjutkan Edit'
		}).then((result) => {
			if (result.isConfirmed) {
				isEditMode = false;
				restoreOriginalData();
				
				// Disable semua input
				$('#form-profile input').prop('readonly', true);
				$('#form-profile select').prop('disabled', true);
				$('#form-profile textarea').prop('readonly', true);
				
				// Sembunyikan tombol upload foto
				$('#btn-upload-foto').hide();
				
				// Sembunyikan grup security
				$('#security-group').hide();
				
				// Sembunyikan tombol save dan tampilkan tombol edit
				$('#save-group').hide();
				$('#btn-edit').show();
				$('#btn-cancel').hide();
				
				// Reset form
				$('#form-profile')[0].reset();
				
				// Reset preview foto
				const defaultFoto = $('#preview-foto').data('default');
				if (defaultFoto) {
					$('#preview-foto').attr('src', defaultFoto);
				}
				
				// Hapus styling edit
				$('.form-control').removeClass('form-control-edit is-invalid');
				$('.form-control').css({
					'border-color': '',
					'background-color': ''
				});
				
				clearErrorMessages();
				
				Swal.fire({
					title: 'Dibatalkan!',
					text: 'Perubahan telah dibatalkan.',
					icon: 'success',
					timer: 1500,
					showConfirmButton: false
				});
			}
		});
	}

	function saveOriginalData() {
		const fields = ['nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_telepon', 'alamat'];
		fields.forEach(field => {
			const element = document.getElementById(field);
			if (element) {
				originalData[field] = element.value;
			}
		});
	}

	function restoreOriginalData() {
		Object.keys(originalData).forEach(field => {
			const element = document.getElementById(field);
			if (element) {
				element.value = originalData[field];
			}
		});
	}

	function previewImage(input) {
		if (input.files && input.files[0]) {
			const file = input.files[0];
			
			// Validasi ukuran file (max 2MB)
			if (file.size > 2 * 1024 * 1024) {
				Swal.fire({
					title: 'Ukuran File Terlalu Besar!',
					text: 'Ukuran foto maksimal 2MB',
					icon: 'error',
					confirmButtonColor: '#3085d6'
				});
				input.value = '';
				return;
			}
			
			// Validasi tipe file
			const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
			if (!allowedTypes.includes(file.type)) {
				Swal.fire({
					title: 'Format File Tidak Didukung!',
					text: 'Tipe file harus JPG, JPEG atau PNG',
					icon: 'error',
					confirmButtonColor: '#3085d6'
				});
				input.value = '';
				return;
			}
			
			const reader = new FileReader();
			reader.onload = function(e) {
				$('#preview-foto').attr('src', e.target.result);
				
				Swal.fire({
					title: 'Foto Berhasil Dipilih!',
					text: 'Foto akan disimpan saat Anda menekan tombol Simpan.',
					icon: 'success',
					timer: 2000,
					showConfirmButton: false,
					toast: true,
					position: 'top-end'
				});
			}
			reader.readAsDataURL(file);
		}
	}

	function confirmSave() {
		let isValid = true;
		const requiredFields = [{
				id: 'nama',
				label: 'Nama Lengkap'
			},
			{
				id: 'tempat_lahir',
				label: 'Tempat Lahir'
			},
			{
				id: 'tanggal_lahir',
				label: 'Tanggal Lahir'
			},
			{
				id: 'jenis_kelamin',
				label: 'Jenis Kelamin'
			}
		];
		
		clearErrorMessages();
		
		requiredFields.forEach(field => {
			const element = document.getElementById(field.id);
			if (!element.value.trim()) {
				showFieldError(field.id, field.label + ' tidak boleh kosong');
				isValid = false;
			}
		});
		
		const passwordField = document.getElementById('password');
		if (passwordField.value && passwordField.value.length < 6) {
			showFieldError('password', 'Password minimal 6 karakter');
			isValid = false;
		}
		
		const phoneField = document.getElementById('no_telepon');
		if (phoneField.value && !/^\d+$/.test(phoneField.value)) {
			showFieldError('no_telepon', 'No Telepon hanya boleh berisi angka');
			isValid = false;
		}
		
		if (!isValid) {
			Swal.fire({
				title: 'Validasi Gagal!',
				text: 'Silakan periksa kembali data yang Anda masukkan',
				icon: 'error',
				confirmButtonColor: '#3085d6'
			});
			return;
		}
		
		Swal.fire({
			title: 'Simpan Perubahan?',
			text: 'Apakah Anda yakin ingin menyimpan perubahan data profil?',
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#28a745',
			cancelButtonColor: '#6c757d',
			confirmButtonText: 'Ya, Simpan!',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				// Show loading state
				Swal.fire({
					title: 'Menyimpan...',
					text: 'Mohon tunggu sebentar',
					allowOutsideClick: false,
					allowEscapeKey: false,
					showConfirmButton: false,
					didOpen: () => {
						Swal.showLoading();
					}
				});
				
				// Submit form
				setTimeout(() => {
					document.getElementById('form-profile').submit();
				}, 500);
			}
		});
	}

	function showFieldError(fieldId, message) {
		const field = document.getElementById(fieldId);
		const errorDiv = document.getElementById('error-' + fieldId);
		field.classList.add('is-invalid');
		if (errorDiv) {
			errorDiv.textContent = message;
		}
	}

	function clearErrorMessages() {
		document.querySelectorAll('.invalid-feedback').forEach(el => {
			el.textContent = '';
		});
		document.querySelectorAll('.form-control').forEach(el => {
			el.classList.remove('is-invalid');
		});
	}

	// Initialize when document is ready
	$(document).ready(function() {
		// Set default foto untuk reset
		const currentFoto = $('#preview-foto').attr('src');
		$('#preview-foto').data('default', currentFoto);
		
		// Auto dismiss alerts after 5 seconds
		setTimeout(() => {
			document.querySelectorAll('.alert').forEach(alert => {
				if (alert.classList.contains('alert-dismissible')) {
					const closeButton = alert.querySelector('.close');
					if (closeButton) {
						closeButton.click();
					}
				}
			});
		}, 5000);
		
		// Handle flash messages with SweetAlert
		<?php if ($this->session->flashdata('success')): ?>
			Swal.fire({
				title: 'Berhasil!',
				text: '<?= $this->session->flashdata('success') ?>',
				icon: 'success',
				confirmButtonColor: '#28a745'
			});
		<?php endif; ?>
		
		<?php if ($this->session->flashdata('error')): ?>
			Swal.fire({
				title: 'Gagal!',
				text: '<?= $this->session->flashdata('error') ?>',
				icon: 'error',
				confirmButtonColor: '#dc3545'
			});
		<?php endif; ?>
	});

	// Handle form validation errors if any
	<?php if (validation_errors()): ?>
		document.addEventListener('DOMContentLoaded', function() {
			setTimeout(() => {
				toggleEditMode();
			}, 500);
		});
	<?php endif; ?>
</script>

