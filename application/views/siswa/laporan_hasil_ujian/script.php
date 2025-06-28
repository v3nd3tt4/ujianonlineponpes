<script>
$(document).ready(function() {
    // Form validation
    $('form').on('submit', function(e) {
        var kelasrombel_id = $('select[name="kelasrombel_id"]').val();
        
        if (!kelasrombel_id) {
            e.preventDefault();
            alert('Silahkan pilih kelas terlebih dahulu!');
            return false;
        }
    });

    // Show loading state when form is submitted
    $('form').on('submit', function() {
        var btn = $(this).find('button[type="submit"]');
        var originalText = btn.html();
        
        btn.html('<i class="fas fa-spinner fa-spin"></i> Memproses...');
        btn.prop('disabled', true);
        
        // Re-enable button after 3 seconds in case of error
        setTimeout(function() {
            btn.html(originalText);
            btn.prop('disabled', false);
        }, 3000);
    });
});
</script>
