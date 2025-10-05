<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?= lava_instance()->session->userdata('username') ?>!</h1>
    <p>Role: <?= lava_instance()->session->userdata('role') ?></p>
    <a href="<?= site_url('auth/logout') ?>">Logout</a>
</body>
</html>
