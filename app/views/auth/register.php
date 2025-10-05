<h2>Register</h2>
<form method="post">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
    <!-- Role selection removed from public form to prevent privilege escalation -->
</form>
<a href="<?= site_url('auth/login') ?>">Login</a>
