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

        // Query the user
            $user = $this->db->table('users')->where('username', $username)->get();

        if ($user && password_verify($password, $user->password_hash)) {
            // store in session
            $_SESSION['user_id'] = $user->id;
            $_SESSION['role']    = $user->role;
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
