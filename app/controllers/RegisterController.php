<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class RegisterController extends Controller {
    protected $auth;

    public function __construct() {
        parent::__construct();
        // Properly load the Auth library via the framework invoker
        $this->call->library('auth');
        $this->auth = load_class('auth', 'libraries');
    }

    public function show_form() {
        $this->call->view('register_view');
    }

    public function submit() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $role     = $_POST['role'] ?? 'user';

        if (empty($username) || empty($password)) {
            $error = 'Username and password are required.';
            $this->call->view('register_view', compact('error'));
            return;
        }

        $success = $this->auth->register($username, $password, $role);

        if ($success) {
            redirect('/login');
            return;
        }

        $error = 'Registration failed. The username might already exist.';
        $this->call->view('register_view', compact('error'));
    }
}
