<div id="content">
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Mengerjakan Ujian: <?= htmlspecialchars($jadwal->nama_matapelajaran ?? '-') ?></h3>
                </div>
                <div class="panel-body">
                    <div class="alert alert-info">Waktu Tersisa: <span id="timer"></span></div>
                    <form method="post" action="<?= base_url('user/ujianonline/submit_jawaban/'.$jadwal->id) ?>" id="form-ujian">
                        <input type="hidden" name="banksoal_id" value="<?= $jadwal->banksoal_id ?>">
                        <?php if (empty($soal)): ?>
                            <div class="alert alert-warning">Soal belum tersedia.</div>
                        <?php else: ?>
                            <?php $no=1; $jawaban_lama = $jawaban_ujian ? json_decode($jawaban_ujian->jawaban, true) : []; ?>
                            <?php foreach ($soal as $s): ?>
                                <div class="form-group">
                                    <label><b><?= $no++ ?>. <?= htmlspecialchars($s->soal) ?></b></label>
                                    <div>
                                        <?php foreach(['A','B','C','D'] as $opt): ?>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="jawaban[<?= $s->id ?>]" value="<?= $opt ?>" <?= (isset($jawaban_lama[$s->id]) && $jawaban_lama[$s->id]==$opt) ? 'checked' : '' ?>>
                                                    <?= htmlspecialchars($s->{'pilihan_'.strtolower($opt)}) ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <button type="submit" class="btn btn-success">Selesai &amp; Simpan Jawaban</button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Timer
    var menit = <?= (int)($jadwal->lama_ujian ?? 0) ?>;
    var detik = 0;
    var timerInterval = setInterval(function() {
        if (detik === 0) {
            if (menit === 0) {
                clearInterval(timerInterval);
                document.getElementById('form-ujian').submit();
                return;
            }
            menit--;
            detik = 59;
        } else {
            detik--;
        }
        document.getElementById('timer').innerText = (menit < 10 ? '0' : '') + menit + ':' + (detik < 10 ? '0' : '') + detik;
    }, 1000);
</script> 