<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	$(document).ready(function() {
		$('.js-example-basic-single').select2();

		// Notifikasi sukses
		var flashSuccess = $('#flash-success').data('message');
		if (flashSuccess) {
			Swal.fire({
				icon: 'success',
				title: 'Sukses',
				text: flashSuccess,
				timer: 2000,
				showConfirmButton: false
			});
		}

		// Notifikasi error
		var flashError = $('#flash-error').data('message');
		if (flashError) {
			Swal.fire({
				icon: 'error',
				title: 'Error',
				text: flashError,
				timer: 3000,
				showConfirmButton: false
			});
		}

		// Konfirmasi hapus
		$('.btn-delete').on('click', function(e) {
			e.preventDefault();
			var id = $(this).data('id');
			Swal.fire({
				title: 'Yakin hapus data ini?',
				text: 'Data kelas rombel yang dihapus tidak bisa dikembalikan!',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Ya, hapus!'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = '<?= site_url('Admin/Kelasrombel/Index/delete/') ?>' + id;
				}
			});
		});

		// Konfirmasi hapus siswa
		$('.btn-hapus-siswa').on('click', function(e) {
			e.preventDefault();
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			Swal.fire({
				title: 'Yakin hapus siswa ini?',
				text: 'Siswa ' + nama + ' akan dihapus dari kelas!',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Ya, hapus!'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = '<?= site_url('Admin/Kelasrombel/Index/hapusSiswa/') ?>' + id;
				}
			});
		});

	});
</script>
