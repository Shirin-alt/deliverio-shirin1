<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" action="/register/submit">
        <label>Username:
            <input type="text" name="username" required>
        </label><br><br>
        <label>Password:
            <input type="password" name="password" required>
        </label><br><br>
        <label>Role:
            <select name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </label><br><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
