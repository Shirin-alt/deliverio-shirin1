<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class LoginController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function show_form() {
        $this->call->view('login_view');
    }

    public function authenticate() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Use the Auth library (handles password column name differences)
        $this->call->library('auth');
        $auth = load_class('auth', 'libraries');

        if ($auth->login($username, $password)) {
            redirect('/students');
        } else {
            echo "Invalid login";
        }
    }

    public function logout() {
        session_destroy();
        redirect('/login');
    }
}
