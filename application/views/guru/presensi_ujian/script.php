<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#matapelajaran_id').change(function() {
        var matapelajaran_id = $(this).val();
        $('#kelas_id').html('<option value=\"\">-Pilih--</option>'); // Reset

        if(matapelajaran_id != '') {
            // Tampilkan loading SweetAlert
            Swal.fire({
                title: 'Memuat data kelas...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            $.ajax({
                url: '<?= base_url("guru/presensi_ujian/get_kelas_by_mapel") ?>',
                type: 'POST',
                data: {matapelajaran_id: matapelajaran_id},
                dataType: 'json',
                success: function(data) {
                    Swal.close(); // Tutup loading
                    $.each(data, function(i, item) {
                        var tahun_akademik = item.tahun;
                        var wali_kelas = item.wali_kelas;
                        var text = item.nama_kelas + ' - ' + tahun_akademik + ' - ' + wali_kelas;
                        $('#kelas_id').append('<option value=\"'+item.id+'\">'+text+'</option>');
                    });
                },
                error: function() {
                    Swal.close();
                    Swal.fire('Gagal', 'Terjadi kesalahan saat mengambil data kelas.', 'error');
                }
            });
        }
    });
});
</script>