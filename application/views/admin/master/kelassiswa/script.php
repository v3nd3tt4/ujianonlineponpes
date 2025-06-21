<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // DataTable initialization
    // $('.dt-table').DataTable({
    //     "responsive": true,
    //     "autoWidth": false,
    // });

    // Select2 initialization
    $('.js-example-basic-single').select2();

    // Success message
    var successMessage = $('#flash-success').data('message');
    if (successMessage) {
        Swal.fire({
            title: 'Berhasil!',
            text: successMessage,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }

    // Error message
    var errorMessage = $('#flash-error').data('message');
    if (errorMessage) {
        Swal.fire({
            title: 'Error!',
            text: errorMessage,
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }

    // Delete confirmation
    $('.btn-delete').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        
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
                window.location.href = '<?= site_url('Admin/Kelassiswa/Index/delete/') ?>' + id;
            }
        });
    });
});
</script> 