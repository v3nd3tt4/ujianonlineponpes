<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Sistem Pondok Pesantren - Login</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- Template CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets_stisla/css/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets_stisla/css/components.css">

	<style>
		/* Fullscreen background animation */
		body {
			margin: 0;
			padding: 0;
			height: 100%;
			background: linear-gradient(135deg, #FFF103 0%, #04ADEF 100%);
			background-size: cover;
		}

		.card {
			background: rgba(255, 255, 255, 0.7);
			backdrop-filter: blur(10px);
			border-radius: 15px;
			animation: fadeIn 1s ease-in-out;
		}

		.card-header {
			text-align: center;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
		}


		@keyframes fadeIn {
			from {
				opacity: 0;
				transform: translateY(20px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}
	</style>
</head>

<body>
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row">
					<div class="col-12 col-sm-8 col-md-6 col-lg-6 mx-auto">
						<div class="login-brand">
						</div>

						<div class="card card-primary">
							<div class="card-header">
								<!-- logo -->
								<div class="text-center">
									<img src="<?= base_url() ?>assets/logo.png" alt="logo" width="100">
									<hr style="background-color: white; width: 50%; padding: 1px; margin-top: 5px;">
								</div>
								<div class="text-center">
									<h5 class="">SISTEM PONDOK PESANTREN</h5>
									<p>Pondok Pesantren Riyadhus Sholihin</p>
								</div>
							</div>

							<div class="card-body">

								<?php if ($this->session->flashdata('error')): ?>
									<div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
								<?php endif; ?>

								<form method="POST" action="<?= base_url() ?>auth/login">

									<div class="form-group">
										<label for="email">Email</label>
										<input id="email" type="text" class="form-control" name="email" tabindex="1" required autofocus>
										<div class="invalid-feedback">Please fill in your email</div>
									</div>

									<div class="form-group">
										<div class="d-block">
											<label for="password" class="control-label">Password</label>
										</div>
										<div class="input-group">
											<input id="password" type="password" class="form-control" name="password" tabindex="2" required>
											<div class="input-group-append">
												<button type="button" class="btn btn-outline-secondary toggle-password" tabindex="3">
													<i class="fas fa-eye"></i>
												</button>
											</div>
										</div>
										<div class="invalid-feedback">please fill in your password</div>
									</div>
									<div class="form-group">
										<label for="role">Role</label>
										<select class="form-control" name="role" id="role" required>
											<option value="">-- Pilih Role --</option>
											<option value="admin">Admin</option>
											<option value="operator">Operator</option>
											<option value="guru">Guru</option>
											<option value="kepala sekolah">Kepala Sekolah</option>
											<option value="siswa">Siswa</option>
										</select>
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">Login</button>
									</div>
								</form>

								<div class="text-center mt-4 mb-3">
									Version 1.0.0
									<br>
									Copyright &copy; 2025 Sistem Pondok Pesantren. All Rights Reserved.
								</div>

							</div>
						</div>
						<div class="simple-footer">
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- General JS Scripts -->
	<script src="<?= base_url() ?>assets_stisla/jquery.min.js"></script>
	<script src="<?= base_url() ?>assets/popper.min.js"></script>
	<script src="<?= base_url() ?>assets/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>assets/jquery.nicescroll.min.js"></script>
	<script src="<?= base_url() ?>assets/moment.min.js"></script>
	<script src="<?= base_url() ?>assets_stisla/js/stisla.js"></script>

	<!-- JS Libraies -->
	<!-- Template JS File -->
	<script src="<?= base_url() ?>assets_stisla/js/scripts.js"></script>
	<script src="<?= base_url() ?>assets_stisla/js/custom.js"></script>

	<!-- Page Specific JS File -->
	<script>
		document.querySelector('.toggle-password').addEventListener('click', function() {
			const passwordField = document.getElementById('password');
			const icon = this.querySelector('i');
			if (passwordField.type === 'password') {
				passwordField.type = 'text';
				icon.classList.remove('fa-eye');
				icon.classList.add('fa-eye-slash');
			} else {
				passwordField.type = 'password';
				icon.classList.remove('fa-eye-slash');
				icon.classList.add('fa-eye');
			}
		});
	</script>
</body>

</html>
