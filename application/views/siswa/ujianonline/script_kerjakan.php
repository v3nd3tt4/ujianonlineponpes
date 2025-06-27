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
			radios.forEach(function(r) {
				if (r.checked) answered = true;
			});
			card.classList.remove('active', 'answered', 'unanswered');
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
					var radio = document.querySelector('input[name="jawaban[' + soalId + ']"][value="' + val + '"]');
					if (radio) radio.checked = true;
				});
			} catch (e) {}
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
