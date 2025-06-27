<script>
	let isEditMode = false;
	let originalData = {};

	function toggleEditMode() {
		isEditMode = true;
		saveOriginalData();
		// Editable fields for pegawai
		const editableFields = ['nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_telepon', 'alamat', 'password'];
		editableFields.forEach(field => {
			const element = document.getElementById(field);
			if (element) {
				if (element.tagName === 'SELECT') {
					element.disabled = false;
				} else {
					element.readOnly = false;
				}
				element.classList.add('form-control-edit');
			}
		});
		document.getElementById('btn-edit').style.display = 'none';
		document.getElementById('btn-cancel').style.display = 'inline-block';
		document.getElementById('save-group').style.display = 'block';
		document.getElementById('security-group').style.display = 'block';
		document.querySelectorAll('.form-control-edit').forEach(el => {
			el.style.borderColor = '#007bff';
			el.style.backgroundColor = '#f8f9ff';
		});
		showNotification('Mode edit diaktifkan. Field yang dapat diubah telah ditandai dengan warna biru.', 'info');
	}

	function cancelEdit() {
		if (confirm('Apakah Anda yakin ingin membatalkan perubahan?')) {
			isEditMode = false;
			restoreOriginalData();
			const allFields = ['nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'no_telepon', 'alamat', 'password'];
			allFields.forEach(field => {
				const element = document.getElementById(field);
				if (element) {
					if (element.tagName === 'SELECT') {
						element.disabled = true;
					} else {
						element.readOnly = true;
					}
					element.classList.remove('form-control-edit');
					element.classList.remove('is-invalid');
					element.style.borderColor = '';
					element.style.backgroundColor = '';
				}
			});
			document.getElementById('password').value = '';
			clearErrorMessages();
			document.getElementById('btn-edit').style.display = 'inline-block';
			document.getElementById('btn-cancel').style.display = 'none';
			document.getElementById('save-group').style.display = 'none';
			document.getElementById('security-group').style.display = 'none';
			showNotification('Perubahan dibatalkan', 'warning');
		}
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
			showNotification('Silakan periksa kembali data yang Anda masukkan', 'error');
			return;
		}
		if (confirm('Apakah Anda yakin ingin menyimpan perubahan data profil?')) {
			const saveBtn = document.querySelector('#save-group button');
			const originalText = saveBtn.innerHTML;
			saveBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Menyimpan...';
			saveBtn.disabled = true;
			setTimeout(() => {
				document.getElementById('form-profile').submit();
			}, 500);
		}
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

	function showNotification(message, type) {
		const alertClass = type === 'error' ? 'alert-danger' :
			type === 'warning' ? 'alert-warning' :
			type === 'info' ? 'alert-info' : 'alert-success';
		const icon = type === 'error' ? 'fa-exclamation-circle' :
			type === 'warning' ? 'fa-exclamation-triangle' :
			type === 'info' ? 'fa-info-circle' : 'fa-check-circle';
		const alertHtml = `
            <div class="alert ${alertClass} alert-dismissible show fade notification-alert">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                    <i class="fa ${icon}"></i> ${message}
                </div>
            </div>
        `;
		document.querySelectorAll('.notification-alert').forEach(el => el.remove());
		const cardBody = document.querySelector('.card-body');
		cardBody.insertAdjacentHTML('afterbegin', alertHtml);
		setTimeout(() => {
			const alert = document.querySelector('.notification-alert');
			if (alert) {
				alert.remove();
			}
		}, 5000);
	}

	// Handle form validation errors if any
	<?php if (validation_errors()): ?>
		document.addEventListener('DOMContentLoaded', function() {
			setTimeout(() => {
				toggleEditMode();
			}, 500);
		});
	<?php endif; ?>

	// Auto dismiss alerts after 5 seconds
	document.addEventListener('DOMContentLoaded', function() {
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
	});
</script>
