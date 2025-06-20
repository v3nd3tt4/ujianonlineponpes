<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
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

    // Konfirmasi hapus
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'Yakin hapus data ini?',
            text: 'Data yang dihapus tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= site_url('Admin/Ruangan/Index/delete/') ?>' + id;
            }
        });
    });
});
</script> 