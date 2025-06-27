<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$(document).ready(function() {


		// Flash message notification dengan SweetAlert
		if ($('#flash-success').length > 0) {
			var message = $('#flash-success').data('message');
			Swal.fire({
				icon: 'success',
				title: 'Berhasil!',
				text: message,
				timer: 3000,
				showConfirmButton: false
			});
		}

		if ($('#flash-error').length > 0) {
			var message = $('#flash-error').data('message');
			Swal.fire({
				icon: 'error',
				title: 'Gagal!',
				text: message,
				timer: 3000,
				showConfirmButton: false
			});
		}

		// Edit Soal Modal Trigger
		$('.btn-edit-soal').on('click', function(e) {
			e.preventDefault();
			var soal_id = $(this).data('id');

			$.ajax({
				url: '<?= site_url("banksoal/get_soal_by_id/") ?>' + soal_id,
				type: 'GET',
				dataType: 'json',
				success: function(response) {
					if (response.error) {
						Swal.fire('Error!', response.error, 'error');
					} else {
						$('#edit_soal_id').val(response.id);
						$('#edit_soal').val(response.soal);
						$('#edit_pilihan_a').val(response.pilihan_a);
						$('#edit_pilihan_b').val(response.pilihan_b);
						$('#edit_pilihan_c').val(response.pilihan_c);
						$('#edit_pilihan_d').val(response.pilihan_d);
						$('#edit_kunci_jawaban').val(response.kunci_jawaban);
						$('#modalEditSoal').modal('show');
					}
				},
				error: function() {
					Swal.fire('Error!', 'Gagal mengambil data soal.', 'error');
				}
			});
		});

		// Delete Soal Confirmation
		$('.btn-delete-soal').on('click', function(e) {
			e.preventDefault();
			var url = $(this).attr('href');

			Swal.fire({
				title: 'Apakah Anda yakin?',
				text: "Soal ini akan dihapus secara permanen!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Ya, hapus!',
				cancelButtonText: 'Batal'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = url;
				}
			});
		});

		// Import Soal
		$('#formImportSoal').on('submit', function(e) {
			e.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: '<?= site_url("banksoal/preview_excel") ?>',
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				success: function(response) {
					$('#preview-area').html(response);

					if ($.fn.DataTable.isDataTable('#previewTable')) {
						$('#previewTable').DataTable().destroy();
					}

					// Inisialisasi DataTables setelah tabel ditambahkan
					$('#previewTable').DataTable({
						paging: true,
						searching: true,
						info: true,
						lengthChange: true,
						pageLength: 10
					});
					$('#modalImportSoal').modal('hide');
					$('#modalPreviewSoal').modal('show');
				},
				error: function() {
					Swal.fire('Error!', 'Gagal mengupload file.', 'error');
				}
			});
		});
	});
</script>
