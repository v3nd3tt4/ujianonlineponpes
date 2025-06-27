<!-- Main Content -->
<div class="main-content">

	<section class="section">
		<div class="section-header">
			<b>Selamat Datang, <?= $this->session->userdata('nama') ?></b>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item"><a href="#">Dashboard</a></div>
				<div class="breadcrumb-item active"><a href="#">Welcome</a></div>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="section-body">

			<div class="card">
				<div class="card-wrap">
					<div class="card-header">
						<h4>Dashboard</h4>
					</div>
					<div class="card-body bg-whitesmoke">
						<p>
							Pondok Pesantren Yatim Piatu Dan Dhuafa Penghafal Al-Qur'an Riyadhus Sholihin adalah sebuah lembaga pendidikan agama yang di dirikan pada tanggal 22 Desember 2005, Memilili Visi terbentuknya manusia yang hafal Al Quran, berakhlak mulia, berakidah yang lurus, memahami Islam dengan benar, mampu mengamalkan dan mendakwahkannya dengan sabar, tabah, dan tegar dalam menghadapi tantangan, serta membentuk manusia yang memiliki keterampilan hidup yang mumpuni.
						</p>
					</div>
				</div>
			</div>

			<div class="row">

				<!-- stakeholder -->
				<div class="col-lg-4 col-md-6 col-sm-6 col-12">
					<div class="card card-statistic-1">
						<?php if ($this->session->userdata('rule') != 'siswa'): ?>
							<a href="<?= site_url('Admin/Pegawai/Index') ?>" class="position-absolute eye-statistik">
								<i class="far fa-eye"></i>
							</a>
						<?php endif; ?>
						<div class="card-icon bg-primary">
							<i class="fas fa-users"></i>
						</div>
						<div class="card-wrap">
							<div class="card-header">
								<h4>Total Guru</h4>
							</div>
							<div class="card-body">
								<?= number_format($total_guru) ?>

							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-12">
					<div class="card card-statistic-1 position-relative">
						<?php if ($this->session->userdata('rule') != 'siswa'): ?>
							<a href="<?= site_url('Admin/Siswa/Index') ?>" class="position-absolute eye-statistik">
								<i class="far fa-eye"></i>
							</a>
						<?php endif; ?>
						<div class="card-icon bg-success">
							<i class="fas fa-user-graduate"></i>
						</div>
						<div class="card-wrap">
							<div class="card-header">
								<h4>Total Siswa</h4>
							</div>
							<div class="card-body">
								<?= number_format($total_siswa) ?>

							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-12">
					<div class="card card-statistic-1 position-relative">
						<?php if ($this->session->userdata('rule') != 'siswa'): ?>
							<a href="<?= site_url('Admin/TahunAkademik/Index') ?>" class="position-absolute eye-statistik">
								<i class="far fa-eye"></i>
							</a>
						<?php endif; ?>

						<div class="card-icon bg-warning">
							<i class="fas fa-school"></i>
						</div>
						<div class="card-wrap">
							<div class="card-header">
								<h4>Tahun Ajaran</h4>
							</div>
							<div class="card-body">
								<?= $tahun_ajaran ?>

							</div>
						</div>
					</div>
				</div>

			</div>

		</div>
	</section>
</div>

<style>
	.eye-statistik {
		top: 10px;
		right: 10px;
		background-color: #fff;
		padding: 5px;
		border-radius: 50%;
	}
</style>
