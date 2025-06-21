<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        
        // Modal trigger untuk tambah
        $(document).on('click', '.btn-buat-bank-soal', function(e){
            $('#modalBuatBankSoal').modal();
            // Reset form
            $('#formBuatBankSoal')[0].reset();
        });

        // Modal trigger untuk edit
        $(document).on('click', '.btn-edit-bank-soal', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            
            // Ambil data bank soal via AJAX
            $.ajax({
                url: '<?= site_url("banksoal/get_by_id/") ?>' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Data tidak ditemukan!'
                        });
                        return;
                    }
                    
                    // Isi form dengan data yang ada
                    $('#edit_id').val(response.id);
                    $('#edit_keterangan').val(response.keterangan);
                    $('#edit_matapelajaran_id').val(response.matapelajaran_id);
                    
                    // Tampilkan modal
                    $('#modalEditBankSoal').modal();
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat mengambil data!'
                    });
                }
            });
        });

        // SweetAlert untuk konfirmasi delete
        $(document).on('click', '.btn-delete-bank-soal', function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
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

        // Flash message notification dengan SweetAlert
        if($('#flash-success').length > 0) {
            var message = $('#flash-success').data('message');
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: message,
                timer: 3000,
                showConfirmButton: false
            });
        }

        if($('#flash-error').length > 0) {
            var message = $('#flash-error').data('message');
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: message,
                timer: 3000,
                showConfirmButton: false
            });
        }

        // Form validation untuk tambah
        $('#formBuatBankSoal').on('submit', function(e) {
            var keterangan = $('#keterangan').val();
            var matapelajaran_id = $('#matapelajaran_id').val();
            
            if (!keterangan.trim()) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: 'Keterangan harus diisi!'
                });
                return false;
            }
            
            if (!matapelajaran_id) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: 'Mata pelajaran harus dipilih!'
                });
                return false;
            }
        });

        // Form validation untuk edit
        $('#formEditBankSoal').on('submit', function(e) {
            var keterangan = $('#edit_keterangan').val();
            var matapelajaran_id = $('#edit_matapelajaran_id').val();
            
            if (!keterangan.trim()) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: 'Keterangan harus diisi!'
                });
                return false;
            }
            
            if (!matapelajaran_id) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan!',
                    text: 'Mata pelajaran harus dipilih!'
                });
                return false;
            }
        });
    });
</script>