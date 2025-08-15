<div class="main-sidebar">
	<aside id="sidebar-wrapper">

		<div class="sidebar-brand" style="padding: 24px 10px 10px 10px; margin-bottom: 10px; text-align: center;">
			<a href="<?= base_url() ?>home" style="display: inline-block; margin-bottom: 8px;">
				<img src="<?= base_url('assets/logo.png') ?>" alt="Logo" style="max-width: 75px; max-height: 75px;">
			</a>
			<div style="font-size: 1.05em; color: #222; font-weight: bold; line-height: 1.3; margin-top: 3px;">
				Sistem Ujian Siswa
				<br>
				<span style="font-size: 0.95em; color: #555; font-weight: normal; white-space: nowrap;">
					Pondok Pesantren Riyadhus Sholihin
				</span>
			</div>
		</div>

		<div class="sidebar-brand sidebar-brand-sm" style="text-align: center; padding: 10px 0;">
			<a href="<?= base_url() ?>home">
				<img src="<?= base_url('assets/logo.png') ?>" alt="Logo" style="max-width: 30px; max-height: 30px;">
			</a>
		</div>


		<ul class="sidebar-menu">
			<li class="<?php if ($link == 'home') { ?>active<?php } ?>"><a class="nav-link" href="<?= base_url() ?>home"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>


			<?php
			$rule = $this->session->userdata('rule');
			if (
				$rule == 'admin' ||
				$rule == 'kepala sekolah' ||
				$rule == 'operator' ||
				$rule == 'guru'
			) { ?>

				<li class="menu-header">Master Data</li>
				<li class="<?= $link == 'Admin/profile' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/profile"><i class="fas fa-user"></i> <span>Profile</span></a></li>

				<?php
				if (
					$rule == 'admin' ||
					$rule == 'kepala sekolah'
				) { ?>
					<!-- pegawai -->
					<li class="nav-item dropdown <?=
													$link == 'Admin/Pegawai/Index' ||
														$link == 'Admin/Pegawai/Index/admin' ||
														$link == 'Admin/Pegawai/Index/guru' ||
														$link == 'Admin/Pegawai/Index/kepala-sekolah' ||
														$link == 'Admin/Pegawai/Index/operator'
														? 'active' : '' ?>">
						<a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>SDM</span></a>
						<ul class="dropdown-menu">
							<li class="<?= $link == 'Admin/Pegawai/Index' ? 'active' : '' ?>">
								<a class="nav-link" href="<?= base_url() ?>Admin/Pegawai/Index">Semua SDM</a>
							</li>
							<li class="<?= $link == 'Admin/Pegawai/Index/kepala-sekolah' ? 'active' : '' ?>">
								<a class="nav-link" href="<?= base_url() ?>Admin/Pegawai/Index/kepala-sekolah">Kepala Sekolah</a>
							</li>
							<li class="<?= $link == 'Admin/Pegawai/Index/admin' ? 'active' : '' ?>">
								<a class="nav-link" href="<?= base_url() ?>Admin/Pegawai/Index/admin">Admin</a>
							</li>
							<li class="<?= $link == 'Admin/Pegawai/Index/guru' ? 'active' : '' ?>">
								<a class="nav-link" href="<?= base_url() ?>Admin/Pegawai/Index/guru">Guru</a>
							</li>
							<li class="<?= $link == 'Admin/Pegawai/Index/operator' ? 'active' : '' ?>">
								<a class="nav-link" href="<?= base_url() ?>Admin/Pegawai/Index/operator">Pengawas</a>
							</li>
						</ul>
					</li>

					<!-- master -->
					<li class="nav-item dropdown <?=
													$link == 'Admin/Kelas/Index' ||
														$link == 'Admin/Siswa/Index' || $link == 'Admin/Tahunakademik/Index' ||
														$link == 'Admin/Ruangan/Index' || $link == 'Admin/Matapelajaran/Index'
														? 'active' : '' ?>">
						<a href="#" class="nav-link has-dropdown"><i class="fas fa-star"></i> <span>Data Master</span></a>
						<ul class="dropdown-menu">
							<li class="<?= $link == 'Admin/Siswa/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Siswa/Index">Siswa</a></li>
							<li class="<?= $link == 'Admin/Kelas/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Kelas/Index">Kelas</a></li>
							<li class="<?= $link == 'Admin/Tahunakademik/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Tahunakademik/Index">Tahun Akademik</a></li>
							<li class="<?= $link == 'Admin/Ruangan/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Ruangan/Index">Ruangan</a></li>
							<li class="<?= $link == 'Admin/Matapelajaran/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Matapelajaran/Index">Mata Pelajaran</a></li>
						</ul>
					</li>
				<?php } ?>

				<?php
				if (
					$rule == 'admin' ||
					$rule == 'kepala sekolah' ||
					$rule == 'guru'
				) { ?>
					<li class="nav-item dropdown <?=
													$link == 'Admin/Kelassiswa/Index' || $link == 'Admin/Kelasrombel/Index' ||
														$link == 'Admin/Gurumatapelajaran/Index' || $link == 'Admin/Jadwalujian'
														? 'active' : '' ?>">
						<a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i> <span>Pengaturan</span></a>
						<ul class="dropdown-menu">
							<?php if ($rule == 'admin' || $rule == 'kepala sekolah') { ?>
								<li class="<?= $link == 'Admin/Kelasrombel/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Kelasrombel/Index">Kelas Rombel</a></li>
								<li class="<?= $link == 'Admin/Gurumatapelajaran/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Gurumatapelajaran/Index">Guru Mata Pelajaran</a></li>
							<?php } ?>
							<li class="<?= $link == 'Admin/Jadwalujian' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Jadwalujian">Jadwal Ujian</a></li>
						</ul>
					</li>
				<?php } ?>

				<?php
				if (
					$rule == 'admin' ||
					$rule == 'kepala sekolah' ||
					$rule == 'guru'
				) { ?>
					<li class="menu-header">Data Ujian</li>
					<li class="<?= $link == 'banksoal' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>banksoal"><i class="fas fa-book"></i> <span>Bank Soal</span></a></li>
					<li class="<?= $link == 'Admin/Assignsoal' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Assignsoal"><i class="fas fa-tasks"></i> <span>Assign Soal</span></a></li>
				<?php } ?>

				<?php
				if (
					$rule == 'admin' ||
					$rule == 'kepala sekolah' ||
					$rule == 'operator' ||
					$rule == 'guru'
				) { ?>
					<li class="<?= $link == 'ujianonline' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Ujianonline"><i class="fas fa-pencil-alt"></i> <span>Ujian Online</span></a></li>

					<?php
					if (
						$rule == 'guru' ||
						$rule == 'kepala sekolah'
					) { ?>
						<li class="menu-header">Data Guru</li>
						<?php if ($rule == 'guru') { ?>
							<li class="<?= $link == 'guru/kelas' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Guru/kelas"><i class="fas fa-archway"></i> <span>Wali Kelas</span></a></li>
						<?php } ?>
						<li class="<?= $link == 'guru/hasil_ujian' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Guru/hasil_ujian"><i class="fas fa-table"></i> <span>Hasil Ujian</span></a></li>
						<li class="<?= $link == 'guru/presensi_ujian' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Guru/presensi_ujian"><i class="fas fa-user-check"></i> <span>Presensi Ujian</span></a></li>
					<?php } ?>
				<?php } ?>

			<?php } ?>

			<?php if ($this->session->userdata('rule') == 'siswa') { ?>
				<li class="menu-header">Siswa</li>
				<li class="<?= $link == 'siswa/profile' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>User/profile"><i class="fas fa-user"></i> <span>Profile</span></a></li>
				<li class="<?= $link == 'siswa/kelas' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>User/kelas"><i class="fas fa-users"></i> <span>Kelas</span></a></li>
				<li class="<?= $link == 'siswa/ujianonline' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>User/ujianonline"><i class="fas fa-pencil-alt"></i> <span>Ujian Online</span></a></li>
				<li class="<?= $link == 'siswa/laporan_hasil_ujian' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>User/laporan_hasil_ujian"><i class="fas fa-window-restore"></i> <span>Laporan Hasil Ujian</span></a></li>
			<?php } ?>
		</ul>

		<div class="mt-4 mb-4 p-3 hide-sidebar-mini">
			<?php if (empty($this->session->userdata('logged_in'))) { ?>
				<a href="<?= base_url() ?>login" class="btn btn-primary btn-lg btn-block btn-icon-split">
					<i class="fas fa-sign-in-alt"></i> Login
				</a>
			<?php } else { ?>
				<a href="<?= base_url() ?>home/logout" class="btn btn-primary btn-lg btn-block btn-icon-split">
					<i class="fas fa-sign-in-alt"></i> Logout
				</a>
			<?php } ?>
		</div>

	</aside>
</div>
