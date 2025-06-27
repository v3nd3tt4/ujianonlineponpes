<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	$(document).ready(function() {
		// Initialize select2
		$('#matapelajaran_id, #kelasrombel_id').select2({
			dropdownParent: $('#jadwal-modal')
		});

		var table = $('#jadwal-table').DataTable({
			"ajax": {
				"url": "<?= site_url('Admin/Jadwalujian/get_all_data') ?>",
				"type": "GET",
				"dataSrc": ""
			},
			"columns": [{
					"data": null,
					"orderable": false,
					"searchable": false,
					"render": function(data, type, row, meta) {
						return meta.row + 1;
					}
				},
				{
					"data": "kode_matapelajaran"
				},
				{
					"data": "nama_matapelajaran"
				},
				{
					"data": null,
					"render": function(data, type, row) {
						return `${row.nama_kelas} - ${row.tahun} - ${row.nama_walikelas}`;
					}
				},
				{
					"data": "tanggal_ujian"
				},
				{
					"data": "jam_mulai"
				},
				{
					"data": "jenis_ujian"
				},
				{
					"data": null,
					"render": function(data, type, row) {
						return `
                        <button class="btn btn-sm btn-warning edit-button" data-id="${row.id}"><i class="fa fa-edit"></i> Edit</button>
                        <button class="btn btn-sm btn-danger delete-button" data-id="${row.id}"><i class="fa fa-trash"></i> Delete</button>
                    `;
					}
				}
			]
		});

		function loadDropdowns(callback) {
			$.ajax({
				url: "<?= site_url('Admin/Jadwalujian/get_data_for_form') ?>",
				type: 'GET',
				dataType: 'json',
				success: function(data) {
					$('#matapelajaran_id').empty().append('<option value="">Pilih Mata Pelajaran</option>');
					$.each(data.matapelajaran, function(key, value) {
						$('#matapelajaran_id').append('<option value="' + value.id + '">' + value.kode_matapelajaran + " - " + value.nama_matapelajaran + '</option>');
					});

					$('#kelasrombel_id').empty().append('<option value="">Pilih Kelas Rombel</option>');
					$.each(data.kelasrombel, function(key, value) {
						$('#kelasrombel_id').append('<option value="' + value.id + '">' + value.nama_kelas_rombel + ' - ' + value.tahun + ' - ' + value.nama + '</option>');
					});

					// If a callback function was provided, execute it now
					if (typeof callback === 'function') {
						callback();
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					Swal.fire({
						icon: 'error',
						title: 'Gagal Memuat Data',
						text: 'Tidak dapat memuat data untuk form. Silahkan coba lagi.'
					});
				}
			});
		}

		$('#add-button').on('click', function() {
			$('#jadwal-form')[0].reset();
			$('#id').val('');
			$('.modal-title').text('Tambah Jadwal Ujian');
			$('#matapelajaran_id').val(null).trigger('change');
			$('#kelasrombel_id').val(null).trigger('change');
			loadDropdowns();
			$('#jadwal-modal').modal('show');
		});

		$('#jadwal-table tbody').on('click', '.edit-button', function() {
			var id = $(this).data('id');
			$.ajax({
				url: "<?= site_url('Admin/Jadwalujian/get_by_id/') ?>" + id,
				type: 'GET',
				dataType: 'json',
				success: function(data) {
					$('#jadwal-form')[0].reset();
					$('.modal-title').text('Edit Jadwal Ujian');

					// Load dropdowns and then set the values in the callback
					loadDropdowns(function() {
						$('#id').val(data.id);
						$('#matapelajaran_id').val(data.matapelajaran_id).trigger('change');
						$('#kelasrombel_id').val(data.kelasrombel_id).trigger('change');
						$('#tanggal_ujian').val(data.tanggal_ujian);
						$('#jam_mulai').val(data.jam_mulai);
						$('#jam_selesai').val(data.jam_selesai);
						$('#lama_ujian').val(data.lama_ujian);
						$('#jenis_ujian').val(data.jenis_ujian);

						$('#jadwal-modal').modal('show');
					});
				},
				error: function() {
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: 'Gagal mengambil data untuk diedit.'
					});
				}
			});
		});

		$('#save-button').on('click', function() {
			var formData = $('#jadwal-form').serialize();
			$.ajax({
				url: "<?= site_url('Admin/Jadwalujian/store') ?>",
				type: 'POST',
				data: formData,
				dataType: 'json',
				success: function(response) {
					$('#jadwal-modal').modal('hide');
					if (response.status) {
						Swal.fire({
							icon: 'success',
							title: 'Sukses!',
							text: response.message,
							timer: 2000,
							showConfirmButton: false
						});
						table.ajax.reload();
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							html: response.message
						});
					}
				},
				error: function() {
					Swal.fire({
						icon: 'error',
						title: 'Error!',
						text: 'Terjadi kesalahan, silahkan coba lagi.'
					});
				}
			});
		});

		$('#jadwal-table tbody').on('click', '.delete-button', function() {
			var id = $(this).data('id');
			Swal.fire({
				title: 'Yakin hapus data ini?',
				text: "Data yang sudah dihapus tidak bisa dikembalikan!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya, hapus!'
			}).then((result) => {
				if (result.isConfirmed) {
					$.ajax({
						url: "<?= site_url('Admin/Jadwalujian/destroy/') ?>" + id,
						type: 'POST',
						dataType: 'json',
						success: function(response) {
							if (response.status) {
								Swal.fire(
									'Dihapus!',
									response.message,
									'success'
								);
								table.ajax.reload();
							}
						}
					});
				}
			});
		});
	});
</script>
