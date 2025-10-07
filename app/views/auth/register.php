<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #fdfcfb;
    background-image: linear-gradient(to bottom right, #ffe5ec, #dff1f9);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  .register-container {
    background: #fff;
    padding: 40px 50px;
    border-radius: 25px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 350px;
    transition: all 0.3s ease-in-out;
  }

  .register-container:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
  }

  h2 {
    color: #333;
    margin-bottom: 25px;
    font-size: 28px;
    font-weight: 600;
  }

  input {
    width: 100%;
    padding: 12px 15px;
    margin: 10px 0;
    border-radius: 12px;
    border: 1px solid #ccc;
    background-color: #fafafa;
    font-size: 15px;
    transition: 0.3s;
  }

  input:focus {
    border-color: #ffb6c1;
    outline: none;
    background-color: #fff;
    box-shadow: 0 0 5px #ffd5dc;
  }

  button {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(135deg, #ff9eb5, #ffb6c1);
    color: white;
    font-weight: 600;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
    transition: 0.3s;
  }

  button:hover {
    background: linear-gradient(135deg, #ff7a9c, #ffa9bc);
    transform: translateY(-2px);
  }

  a {
    display: inline-block;
    margin-top: 15px;
    color: #777;
    text-decoration: none;
    font-size: 14px;
    transition: 0.3s;
  }

  a:hover {
    color: #ff7a9c;
  }
</style>
</head>
<body>
  <div class="register-container">
    <h2>Register</h2>
    <form method="post">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Register</button>
    </form>
    <a href="<?= site_url('auth/login') ?>">Already have an account? Login</a>
  </div>
</body>
</html>
