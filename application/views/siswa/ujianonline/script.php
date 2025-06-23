<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        <?php if (empty($jadwal)): ?>
        Swal.fire({
            icon: 'info',
            title: 'Tidak ada data!',
            text: "Anda belum melakukan presensi pada ujian manapun.",
            timer: 2000,
            button: "OK"
        });
        <?php endif; ?>
    });
</script>