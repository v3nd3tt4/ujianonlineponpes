<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables-example').DataTable();

        // Initialize QR Scanner when modal is shown
        $('#scanModal').on('shown.bs.modal', function () {
            const html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", { fps: 10, qrbox: 250 }
            );

            html5QrcodeScanner.render(onScanSuccess);
        });

        // Clean up scanner when modal is hidden
        $('#scanModal').on('hidden.bs.modal', function () {
            const html5QrcodeScanner = Html5QrcodeScanner.getScanner();
            if (html5QrcodeScanner) {
                html5QrcodeScanner.clear();
            }
            $('#reader').empty();
        });

        // Handle successful scan
        function onScanSuccess(qrCodeMessage) {
            try {
                const data = JSON.parse(qrCodeMessage);
                console.log(qrCodeMessage);
                // Validate QR data
                if (!data.id || !data.nis) {
                    throw new Error('QR Code tidak valid!' + data);
                }

                // Send to server
                $.ajax({
                    url: '<?= base_url('ujianonline/presensi') ?>',
                    type: 'POST',
                    data: {
                        jadwal_id: '<?= $jadwal->id ?>',
                        siswa_id: data.id,
                        nis: data.nis
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Update table row
                            const row = $(`#siswa-${data.id}`);
                            row.find('td:eq(4)').html('<span class="label label-success">Hadir</span>');
                            row.find('td:eq(5)').text(response.waktu_hadir);
                            
                            // Show success message
                            alert('Presensi berhasil dicatat!');
                            
                            // Close modal
                            $('#scanModal').modal('hide');
                            location.reload();
                        } else {
                            alert(response.message || 'Terjadi kesalahan!');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan sistem!');
                    }
                });

            } catch (error) {
                alert(error.message || 'QR Code tidak valid!');
            }
        }
    });
</script> 