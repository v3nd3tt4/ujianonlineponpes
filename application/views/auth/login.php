<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo base_url('assets_miminium/css/bootstrap.min.css'); ?>">
    <style>
        body { background: #f5f5f5; }
        .login-box { max-width: 400px; margin: 80px auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
    </style>
</head>
<body>
<div class="login-box">
    <h3 class="text-center">Login Ujian Online</h3>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
    <?php endif; ?>
    <form method="post" action="<?php echo site_url('auth/login'); ?>">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
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
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
</div>
</body>
</html> 