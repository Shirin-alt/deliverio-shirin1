<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" action="/login">
        <label>Username:
            <input type="text" name="username" required>
        </label><br><br>
        <label>Password:
            <input type="password" name="password" required>
        </label><br><br>
        <button type="submit">Log In</button>
    </form>
</body>
</html>
