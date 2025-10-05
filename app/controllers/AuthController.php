<?php
class AuthController extends Controller
{
    public function register()
    {
        $this->call->library('auth');
        $auth = load_class('auth', 'libraries');

        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');
            $role     = $this->io->post('role') ?? 'user';

            if ($auth->register($username, $password, $role)) {
                redirect('auth/login');
            } else {
                echo "Registration failed!";
            }
        }

        $this->call->view('auth/register');
    }

    public function login()
    {
        $this->call->library('auth');
        $auth = load_class('auth', 'libraries');

        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            if ($auth->login($username, $password)) {
                redirect('auth/dashboard');
            } else {
                echo "Login failed!";
            }
        }

        $this->call->view('auth/login');
    }

    public function dashboard()
    {
        $this->call->library('auth');
        $auth = load_class('auth', 'libraries');

        if (!$auth->is_logged_in()) {
            redirect('auth/login');
        }

        $this->call->view('auth/dashboard');
    }

    public function admin_dashboard()
    {
        $this->call->library('auth');
        $auth = load_class('auth', 'libraries');

        if (!$auth->is_logged_in()) {
            redirect('auth/login');
        }

        if (!$auth->has_role('admin')) {
            echo "Access denied!";
            exit;
        }

        echo "<h1>Admin Panel</h1>";
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    echo "<p>Welcome, " . $username . "</p>";
        echo "<a href='".site_url('auth/logout')."'>Logout</a>";
    }

    public function logout()
    {
        $this->call->library('auth');
        $auth = load_class('auth', 'libraries');
        $auth->logout();
        redirect('auth/login');
    }
}
