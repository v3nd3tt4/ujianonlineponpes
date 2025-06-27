<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	$(document).ready(function() {
		$('#banksoal_id').select2({
			dropdownParent: $('#assign-modal')
		});

		var table = $('#assign-table').DataTable({
			"ajax": {
				"url": "<?= site_url('Admin/Assignsoal/get_all_jadwal') ?>",
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
					"data": null,
					"render": function(data, type, row) {
						return `${row.kode_matapelajaran} - ${row.nama_matapelajaran}`;
					}
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
					"data": "nama_banksoal",
					"render": function(data, type, row) {
						if (row.nama_banksoal) {
							return `${row.kode_matapelajaran} - ${row.nama_banksoal} (Oleh: ${row.pembuat_soal})`;
						} else {
							return '<span class="badge badge-danger">Belum Diatur</span>';
						}
					}
				},
				{
					"data": null,
					"render": function(data, type, row) {
						return `<button class="btn btn-sm btn-info assign-button" data-id="${row.id}" data-mapel-id="${row.matapelajaran_id}" data-mapel-text="${row.kode_matapelajaran} - ${row.nama_matapelajaran}" data-kelas-text="${row.nama_kelas} - ${row.tahun}"><i class="fa fa-cogs"></i> Atur Soal</button>`;
					}
				}
			]
		});

		$('#assign-table tbody').on('click', '.assign-button', function() {
			var jadwalId = $(this).data('id');
			var mapelId = $(this).data('mapel-id');
			var mapelText = $(this).data('mapel-text');
			var kelasText = $(this).data('kelas-text');

			$('#jadwal_id').val(jadwalId);
			$('#modal-mapel').text(mapelText);
			$('#modal-kelas').text(kelasText);
			console.log(`Jadwal ID: ${jadwalId}, Mapel ID: ${mapelId}`);

			// Load bank soal options for the specific subject
			$.ajax({
				url: "<?= site_url('Admin/Assignsoal/get_bank_soal_by_mapel/') ?>" + mapelId,
				type: 'GET',
				dataType: 'json',
				success: function(data) {
					var banksoalSelect = $('#banksoal_id');
					banksoalSelect.empty().append('<option value="">Pilih Bank Soal</option>');
					$.each(data, function(key, value) {
						var optionText = `${value.kode_matapelajaran} - ${value.keterangan} (Oleh: ${value.pembuat_soal})`;
						banksoalSelect.append(`<option value="${value.id}">${optionText}</option>`);
					});
					$('#assign-modal').modal('show');
				},
				error: function() {
					Swal.fire('Error', 'Gagal memuat data bank soal.', 'error');
				}
			});
		});

		$('#save-assignment-button').on('click', function() {
			var formData = $('#assign-form').serialize();
			$.ajax({
				url: "<?= site_url('Admin/Assignsoal/save_assignment') ?>",
				type: 'POST',
				data: formData,
				dataType: 'json',
				success: function(response) {
					$('#assign-modal').modal('hide');
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
							text: response.message
						});
					}
				},
				error: function() {
					Swal.fire('Error', 'Terjadi kesalahan, silahkan coba lagi.', 'error');
				}
			});
		});
	});
</script>
