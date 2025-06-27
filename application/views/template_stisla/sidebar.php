<div class="main-sidebar">
	<aside id="sidebar-wrapper">

		<div class="sidebar-brand">
			<a href="<?= base_url() ?>home">
				<div style="font-size: 70%;">PONPES</div>
			</a>
		</div>

		<div class="sidebar-brand sidebar-brand-sm">
			<a href="<?= base_url() ?>home">SP</a>
		</div>

		<ul class="sidebar-menu">
			<li class="<?php if ($link == 'home') { ?>active<?php } ?>"><a class="nav-link" href="<?= base_url() ?>home"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
			<?php if ($this->session->userdata('rule') == 'admin') { ?>
				<li class="menu-header">Master Data</li>
				<li class="nav-item dropdown <?=
												$link == 'Admin/Pegawai/Index' || $link == 'Admin/Kelas/Index' ||
													$link == 'Admin/Siswa/Index' || $link == 'Admin/Tahunakademik/Index' ||
													$link == 'Admin/Ruangan/Index' || $link == 'Admin/Matapelajaran/Index'
													? 'active' : '' ?>">
					<a href="#" class="nav-link has-dropdown"><i class="fas fa-star"></i> <span>Data Master</span></a>
					<ul class="dropdown-menu">
						<li class="<?= $link == 'Admin/Pegawai/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Pegawai/Index">Pegawai</a></li>
						<li class="<?= $link == 'Admin/Siswa/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Siswa/Index">Siswa</a></li>
						<li class="<?= $link == 'Admin/Kelas/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Kelas/Index">Kelas</a></li>
						<li class="<?= $link == 'Admin/Tahunakademik/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Tahunakademik/Index">Tahun Akademik</a></li>
						<li class="<?= $link == 'Admin/Ruangan/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Ruangan/Index">Ruangan</a></li>
						<li class="<?= $link == 'Admin/Matapelajaran/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Matapelajaran/Index">Mata Pelajaran</a></li>
					</ul>
				</li>

				<li class="nav-item dropdown <?=
												$link == 'Admin/Kelassiswa/Index' || $link == 'Admin/Kelasrombel/Index' ||
													$link == 'Admin/Gurumatapelajaran/Index' || $link == 'Admin/Jadwalujian'
													? 'active' : '' ?>">
					<a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i> <span>Pengaturan</span></a>
					<ul class="dropdown-menu">
						<li class="<?= $link == 'Admin/Kelasrombel/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Kelasrombel/Index">Kelas Rombel</a></li>
						<li class="<?= $link == 'Admin/Gurumatapelajaran/Index' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Gurumatapelajaran/Index">Guru Mata Pelajaran</a></li>
						<li class="<?= $link == 'Admin/Jadwalujian' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Jadwalujian">Jadwal Ujian</a></li>
					</ul>
				</li>

				<li class="<?= $link == 'banksoal' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>banksoal"><i class="fas fa-book"></i> <span>Bank Soal</span></a></li>
				<li class="<?= $link == 'Admin/Assignsoal' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Admin/Assignsoal"><i class="fas fa-tasks"></i> <span>Assign Soal</span></a></li>
				<li class="<?= $link == 'ujianonline' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>Ujianonline"><i class="fas fa-pencil-alt"></i> <span>Ujian Online</span></a></li>
			<?php } ?>

			<?php if ($this->session->userdata('rule') == 'siswa') { ?>
				<li class="menu-header">Siswa</li>
				<li class="<?= $link == 'siswa/profile' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>User/profile"><i class="fas fa-user"></i> <span>Profile</span></a></li>
				<li class="<?= $link == 'siswa/kelas' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>User/kelas"><i class="fas fa-users"></i> <span>Kelas</span></a></li>
				<li class="<?= $link == 'siswa/ujianonline' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url() ?>User/ujianonline"><i class="fas fa-pencil-alt"></i> <span>Ujian Online</span></a></li>
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
