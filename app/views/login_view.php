<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", Roboto, sans-serif;
    }

    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #d6e6d1, #f2ebe3);
      color: #2f3e2f;
    }

    .login-card {
      background: #ffffffcc;
      backdrop-filter: blur(8px);
      border-radius: 20px;
      padding: 2rem;
      width: 320px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.15);
      text-align: center;
      border: 1px solid #d9d9d9;
    }

    .login-card h2 {
      margin-bottom: 1rem;
      font-size: 1.8rem;
      color: #3a4d39;
    }

    .form-group {
      margin-bottom: 1.2rem;
      text-align: left;
    }

    label {
      font-weight: 600;
      font-size: 0.9rem;
      color: #4d5a4d;
      display: block;
      margin-bottom: 0.3rem;
    }

    input {
      width: 100%;
      padding: 0.7rem;
      border-radius: 12px;
      border: 1px solid #bbb;
      outline: none;
      font-size: 1rem;
      transition: 0.3s;
    }

    input:focus {
      border-color: #6a9c89;
      box-shadow: 0 0 5px rgba(106,156,137,0.5);
    }

    button {
      width: 100%;
      padding: 0.8rem;
      border: none;
      border-radius: 12px;
      font-size: 1rem;
      font-weight: bold;
      background: linear-gradient(135deg, #6a9c89, #3a4d39);
      color: white;
      cursor: pointer;
      transition: transform 0.2s ease, background 0.3s;
    }

    button:hover {
      transform: translateY(-2px);
      background: linear-gradient(135deg, #7cb9a4, #2f3e2f);
    }

    p.error {
      color: #b23b3b;
      margin-bottom: 1rem;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h2>Welcome Back</h2>

    <?php if (!empty($error)): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" action="/login">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>

      <button type="submit">Log In</button>
    </form>
  </div>
</body>
</html>
