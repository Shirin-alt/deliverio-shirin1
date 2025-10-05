<?php $username = isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>
<?php $role = isset($_SESSION['role']) ? $_SESSION['role'] : ''; ?>

<h1>Welcome, <?= htmlspecialchars($username) ?>!</h1>
<p>Role: <?= htmlspecialchars($role) ?></p>

<?php if ($role === 'admin'): ?>
    <a href="<?= site_url('auth/admin_dashboard') ?>">Go to Admin Panel</a><br>
<?php endif; ?>

<a href="<?= site_url('auth/logout') ?>">Logout</a>
