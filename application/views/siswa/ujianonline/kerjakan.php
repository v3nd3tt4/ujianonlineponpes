<div id="content">
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Mengerjakan Ujian: <?= htmlspecialchars($jadwal->nama_matapelajaran ?? '-') ?></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2 col-sm-3" id="soal-nav-col">
                            <div id="soal-nav">
                                <?php if (!empty($soal)): ?>
                                    <?php $no=1; $jawaban_lama = $jawaban_ujian ? json_decode($jawaban_ujian->jawaban, true) : []; ?>
                                    <?php foreach ($soal as $idx => $s): ?>
                                        <span class="soal-card" data-no="<?= $idx ?>" id="card-<?= $idx ?>">
                                            <?= $no++ ?>
                                        </span>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-10 col-sm-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr><th>Mata Pelajaran</th><td><?= htmlspecialchars($jadwal->nama_matapelajaran ?? '-') ?></td></tr>
                                        <tr><th>Kelas</th><td><?= htmlspecialchars($jadwal->nama_kelas ?? '-') ?></td></tr>
                                        <tr><th>Tanggal Ujian</th><td><?= htmlspecialchars($jadwal->tanggal_ujian ?? '-') ?></td></tr>
                                        <tr><th>Lama Ujian</th><td><?= htmlspecialchars($jadwal->lama_ujian ?? '-') ?> Menit</td></tr>
                                        <tr><th>Jenis Ujian</th><td><?= htmlspecialchars($jadwal->jenis_ujian ?? '-') ?></td></tr>
                                        <tr><th>Jumlah Soal</th><td><?= isset($soal) ? count($soal) : 0 ?></td></tr>
                                    </table>
                                </div>
                            </div>
                            <div class="alert alert-info">Waktu Tersisa: <span id="timer"></span></div>
                            <?php if (!empty($soal)): ?>
                            
                            <?php endif; ?>
                            <form method="post" action="<?= base_url('user/ujianonline/submit_jawaban/'.$jadwal->id) ?>" id="form-ujian">
                                <input type="hidden" name="banksoal_id" value="<?= $jadwal->banksoal_id ?>">
                                <?php if (empty($soal)): ?>
                                    <div class="alert alert-warning">Soal belum tersedia.</div>
                                <?php else: ?>
                                    <?php foreach ($soal as $idx => $s): ?>
                                        <div class="form-group soal-item" id="soal-<?= $idx ?>" style="display:<?= $idx==0?'block':'none' ?>;">
                                            <label><b><?= ($idx+1) ?>. <?= htmlspecialchars($s->soal) ?></b></label>
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
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-success">Selesai &amp; Simpan Jawaban</button>
                                    </div>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .soal-card {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        border-radius: 8px;
        background: #eee;
        margin: 0 4px 8px 0;
        font-weight: bold;
        cursor: pointer;
        border: 2px solid #ccc;
        transition: 0.2s;
    }
    .soal-card.active { background: orange; color: #fff; border-color: orange; }
    .soal-card.answered { background: #4caf50; color: #fff; border-color: #4caf50; }
    .soal-card.unanswered { background: #eee; color: #888; border-color: #ccc; }
</style>
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

    // Navigasi soal
    var totalSoal = <?= isset($soal) ? count($soal) : 0 ?>;
    var current = 0;
    function updateCardStatus() {
        for (let i = 0; i < totalSoal; i++) {
            let card = document.getElementById('card-' + i);
            let soalDiv = document.getElementById('soal-' + i);
            let radios = soalDiv.querySelectorAll('input[type=radio]');
            let answered = false;
            radios.forEach(function(r) { if (r.checked) answered = true; });
            card.classList.remove('active','answered','unanswered');
            if (i === current) card.classList.add('active');
            else if (answered) card.classList.add('answered');
            else card.classList.add('unanswered');
        }
    }
    document.querySelectorAll('.soal-card').forEach(function(card, idx) {
        card.addEventListener('click', function() {
            document.getElementById('soal-' + current).style.display = 'none';
            current = idx;
            document.getElementById('soal-' + current).style.display = 'block';
            updateCardStatus();
        });
    });

    // === LOCAL STORAGE JAWABAN ===
    var jadwalId = "<?= $jadwal->id ?>";
    var siswaId = "<?= $this->session->userdata('id_user') ?>";
    var storageKey = 'ujian_jawaban_' + jadwalId + '_' + siswaId;

    // Load jawaban dari localStorage saat halaman dimuat
    function loadJawabanLocal() {
        var data = localStorage.getItem(storageKey);
        if (data) {
            try {
                var jawaban = JSON.parse(data);
                Object.keys(jawaban).forEach(function(soalId) {
                    var val = jawaban[soalId];
                    var radio = document.querySelector('input[name="jawaban['+soalId+']"][value="'+val+'"]');
                    if (radio) radio.checked = true;
                });
            } catch(e) {}
        }
    }
    // Simpan jawaban ke localStorage setiap kali radio dipilih
    function saveJawabanLocal() {
        var jawaban = {};
        document.querySelectorAll('.soal-item input[type=radio]:checked').forEach(function(radio) {
            var name = radio.name; // jawaban[123]
            var soalId = name.match(/\[(\d+)\]/)[1];
            jawaban[soalId] = radio.value;
        });
        localStorage.setItem(storageKey, JSON.stringify(jawaban));
    }
    document.querySelectorAll('.soal-item input[type=radio]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            updateCardStatus();
            saveJawabanLocal();
        });
    });
    // Saat submit, hapus localStorage agar tidak mengganggu ujian berikutnya
    document.getElementById('form-ujian').addEventListener('submit', function() {
        localStorage.removeItem(storageKey);
    });
    // Inisialisasi status awal dan load jawaban
    loadJawabanLocal();
    updateCardStatus();
</script> 
</script> 