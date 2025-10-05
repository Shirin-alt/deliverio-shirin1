Auth library — usage

This file shows how to use the `Auth` library that lives at `app/libraries/Auth.php`.

Overview
- The `Auth` class uses `lava_instance()` to ensure the `database` and `session` libraries are available.
- It supports `register()`, `login()`, `is_logged_in()`, `has_role()`, and `logout()`.
- It expects a `users` table. By default it reads `password_hash` but will fall back to a `password` column if present.

Examples

1) Simple login in a Controller

```php
<?php
class LoginController extends Controller {
    protected $auth;

    public function __construct() {
        parent::__construct();
        $this->auth = new Auth();
    }

    public function authenticate() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($this->auth->login($username, $password)) {
            // success
            redirect('/students');
        } else {
            $error = 'Invalid login';
            $this->call->view('login_view', compact('error'));
        }
    }
}
```

2) Protecting controller methods (authorization)

```php
<?php
class StudentsController extends Controller {
    protected $auth;

    public function __construct() {
        parent::__construct();
        $this->auth = new Auth();
        // require login for every method in this controller
        if (! $this->auth->is_logged_in()) {
            redirect('/login');
            exit;
        }
    }

    public function index() {
        // safe to proceed
    }
}
```

3) Checking role inside a method

```php
if (! $this->auth->has_role('admin')) {
    echo "Unauthorized"; // or redirect
    exit;
}
```

4) Using your `UserModel` together with `Auth`

Your `UserModel` (example) 

```php
class UserModel extends Model {
    protected $table = 'users';

    public function get_user_by_id($id) {
        return $this->db->table($this->table)->where('id', $id)->get();
    }

    public function get_all_users() {
        return $this->db->table($this->table)->get_all();
    }
}
```

If you need to access user data after login:

```php
$lava = lava_instance();
$lava->call->model('UserModel', 'user_model');
$user = $lava->user_model->get_user_by_id($lava->session->userdata('user_id'));
```

Notes and Tips
- Column names: Auth uses `password_hash` by default. If your table uses a different column name (e.g. `password`), the library will attempt to read that as a fallback.
- Password hashing: use `password_hash()` when creating users.
- Sessions: `index.php` must call `session_start()` (already added earlier).

Quick CLI helper (generate hash)

Create a tiny script `tools/hash.php` (run with CLI `php tools/hash.php`) to generate a password hash:

```php
<?php
if ($argv[1] ?? false) {
    echo password_hash($argv[1], PASSWORD_DEFAULT) . PHP_EOL;
} else {
    echo "Usage: php tools/hash.php your_password\n";
}
```

Git
- After editing files, commit them:

```powershell
git add app/libraries/Auth.php app/libraries/Auth.md
git commit -m "Add Auth library and usage docs"
git push
```
