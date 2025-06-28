<script>
	// Timer
	var menit = <?= (int)($jadwal->lama_ujian ?? 0) ?>;
	var detik = 0;
	var timerInterval;
	var jadwalId = "<?= $jadwal->id ?>";
	var siswaId = "<?= $this->session->userdata('id_user') ?>";
	var timerStorageKey = 'ujian_timer_' + jadwalId + '_' + siswaId;
	var startTimeStorageKey = 'ujian_start_time_' + jadwalId + '_' + siswaId;

	// Load timer dari localStorage atau mulai dari awal
	function loadTimer() {
		var savedTime = localStorage.getItem(timerStorageKey);
		var startTime = localStorage.getItem(startTimeStorageKey);
		
		if (savedTime && startTime) {
			// Hitung waktu yang sudah berlalu
			var now = new Date().getTime();
			var start = parseInt(startTime);
			var elapsedMinutes = Math.floor((now - start) / (1000 * 60));
			var elapsedSeconds = Math.floor(((now - start) / 1000) % 60);
			
			// Hitung waktu tersisa
			var totalElapsedSeconds = elapsedMinutes * 60 + elapsedSeconds;
			var totalRemainingSeconds = (menit * 60) - totalElapsedSeconds;
			
			if (totalRemainingSeconds > 0) {
				menit = Math.floor(totalRemainingSeconds / 60);
				detik = totalRemainingSeconds % 60;
			} else {
				// Waktu sudah habis, submit otomatis
				alert('Waktu ujian telah habis! Jawaban akan disimpan otomatis.');
				localStorage.removeItem(timerStorageKey);
				localStorage.removeItem(startTimeStorageKey);
				document.getElementById('form-ujian').submit();
				return;
			}
		} else {
			// Pertama kali, simpan waktu mulai
			localStorage.setItem(startTimeStorageKey, new Date().getTime().toString());
		}
		
		// Update tampilan timer
		updateTimerDisplay();
	}

	// Update tampilan timer
	function updateTimerDisplay() {
		var timerElement = document.getElementById('timer');
		timerElement.innerText = (menit < 10 ? '0' : '') + menit + ':' + (detik < 10 ? '0' : '') + detik;
		
		// Warning when time is running low (less than 5 minutes)
		if (menit < 5 && menit >= 0) {
			timerElement.style.color = '#ff6b6b';
			timerElement.style.fontWeight = 'bold';
		} else {
			timerElement.style.color = 'inherit';
			timerElement.style.fontWeight = 'normal';
		}
	}

	// Simpan timer ke localStorage
	function saveTimer() {
		var totalSeconds = menit * 60 + detik;
		localStorage.setItem(timerStorageKey, totalSeconds.toString());
	}

	// Mulai timer
	function startTimer() {
		timerInterval = setInterval(function() {
			if (detik === 0) {
				if (menit === 0) {
					clearInterval(timerInterval);
					alert('Waktu ujian telah habis! Jawaban akan disimpan otomatis.');
					// Hapus timer dari localStorage
					localStorage.removeItem(timerStorageKey);
					localStorage.removeItem(startTimeStorageKey);
					document.getElementById('form-ujian').submit();
					return;
				}
				menit--;
				detik = 59;
			} else {
				detik--;
			}
			
			// Update tampilan dan simpan ke localStorage
			updateTimerDisplay();
			saveTimer();
		}, 1000);

		// Backup save setiap 30 detik
		setInterval(function() {
			if (timerInterval) {
				saveTimer();
			}
		}, 30000);
	}

	// Load timer saat halaman dimuat
	loadTimer();
	startTimer();

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

	function updateNavigationButtons() {
		const btnSebelumnya = document.getElementById('btn-sebelumnya');
		const btnSelanjutnya = document.getElementById('btn-selanjutnya');
		const btnSelesai = document.getElementById('btn-selesai');

		// Sembunyikan semua tombol terlebih dahulu
		btnSebelumnya.style.display = 'none';
		btnSelanjutnya.style.display = 'none';
		btnSelesai.style.display = 'none';

		// Tampilkan tombol berdasarkan posisi soal
		if (current === 0) {
			// Soal pertama - hanya tampilkan tombol selanjutnya
			btnSelanjutnya.style.display = 'inline-block';
		} else if (current === totalSoal - 1) {
			// Soal terakhir - hanya tampilkan tombol sebelumnya dan selesai
			btnSebelumnya.style.display = 'inline-block';
			btnSelesai.style.display = 'inline-block';
		} else {
			// Soal di tengah - tampilkan tombol sebelumnya dan selanjutnya
			btnSebelumnya.style.display = 'inline-block';
			btnSelanjutnya.style.display = 'inline-block';
		}
	}

	function showSoal(index) {
		// Validasi index
		if (index < 0 || index >= totalSoal) {
			console.error('Index soal tidak valid:', index);
			return;
		}

		// Sembunyikan soal yang sedang aktif
		document.getElementById('soal-' + current).style.display = 'none';
		
		// Tampilkan soal yang dipilih
		current = index;
		document.getElementById('soal-' + current).style.display = 'block';
		
		// Update status kartu dan tombol navigasi
		updateCardStatus();
		updateNavigationButtons();
		
		// Scroll ke atas halaman untuk memastikan soal terlihat
		window.scrollTo({ top: 0, behavior: 'smooth' });
	}

	// Event listener untuk kartu soal
	document.querySelectorAll('.soal-card').forEach(function(card, idx) {
		card.addEventListener('click', function() {
			showSoal(idx);
		});
	});

	// Event listener untuk tombol navigasi
	document.getElementById('btn-sebelumnya').addEventListener('click', function() {
		if (current > 0) {
			showSoal(current - 1);
		}
	});

	document.getElementById('btn-selanjutnya').addEventListener('click', function() {
		if (current < totalSoal - 1) {
			showSoal(current + 1);
		}
	});

	// Event listener untuk tombol akhiri ujian
	document.getElementById('btn-akhiri-ujian').addEventListener('click', function() {
		if (confirm('Apakah Anda yakin ingin mengakhiri ujian? Jawaban yang sudah diisi akan disimpan.')) {
			// Hentikan timer
			clearInterval(timerInterval);
			// Hapus data timer dari localStorage
			localStorage.removeItem(timerStorageKey);
			localStorage.removeItem(startTimeStorageKey);
			document.getElementById('form-ujian').submit();
		}
	});

	// Event listener untuk tombol selesai
	document.getElementById('btn-selesai').addEventListener('click', function() {
		if (confirm('Apakah Anda yakin ingin menyelesaikan ujian? Pastikan semua jawaban sudah diisi dengan benar.')) {
			// Hentikan timer
			clearInterval(timerInterval);
			// Hapus data timer dari localStorage
			localStorage.removeItem(timerStorageKey);
			localStorage.removeItem(startTimeStorageKey);
			document.getElementById('form-ujian').submit();
		}
	});

	// Keyboard navigation
	document.addEventListener('keydown', function(e) {
		// Left arrow key atau A key untuk soal sebelumnya
		if ((e.key === 'ArrowLeft' || e.key === 'a' || e.key === 'A') && current > 0) {
			e.preventDefault();
			showSoal(current - 1);
		}
		// Right arrow key atau D key untuk soal selanjutnya
		else if ((e.key === 'ArrowRight' || e.key === 'd' || e.key === 'D') && current < totalSoal - 1) {
			e.preventDefault();
			showSoal(current + 1);
		}
		// Enter key untuk submit (hanya di soal terakhir)
		else if (e.key === 'Enter' && current === totalSoal - 1) {
			e.preventDefault();
			document.getElementById('btn-selesai').click();
		}
	});

	// === LOCAL STORAGE JAWABAN ===
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
			} catch (e) {
				console.error('Error loading jawaban from localStorage:', e);
			}
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
		localStorage.removeItem(timerStorageKey);
		localStorage.removeItem(startTimeStorageKey);
	});

	// Warning sebelum meninggalkan halaman
	window.addEventListener('beforeunload', function(e) {
		if (timerInterval) {
			e.preventDefault();
			e.returnValue = 'Anda sedang dalam ujian. Jika Anda meninggalkan halaman ini, ujian akan berakhir.';
			return e.returnValue;
		}
	});

	// Inisialisasi status awal dan load jawaban
	loadJawabanLocal();
	updateCardStatus();
	updateNavigationButtons();

	// Accordion functionality
	$(document).ready(function() {
		// Handle accordion collapse/expand
		$('.card.akordion .card-header button').on('click', function() {
			var $icon = $(this).find('.fa-chevron-down');
			var $button = $(this);
			
			// Toggle icon rotation
			if ($button.hasClass('collapsed')) {
				$icon.css('transform', 'rotate(0deg)');
			} else {
				$icon.css('transform', 'rotate(180deg)');
			}
		});

		// Auto-collapse accordion after 5 seconds if not interacted with
		setTimeout(function() {
			if (!$('.card.akordion .card-header button').hasClass('collapsed')) {
				$('.card.akordion .collapse').collapse('hide');
				$('.card.akordion .card-header button .fa-chevron-down').css('transform', 'rotate(0deg)');
			}
		}, 5000);
	});
</script>
