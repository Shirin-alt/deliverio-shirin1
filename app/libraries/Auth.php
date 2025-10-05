<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth
{
    protected $_lava;
    protected $db;
    protected $session;

    public function __construct()
    {
        $this->_lava = lava_instance();
        // Ensure database and session libraries are available
        $this->_lava->call->database();
        $this->_lava->call->library('session');

        // Shortcuts
        $this->db = $this->_lava->db;
        $this->session = $this->_lava->session;
    }

    /**
     * Register a new user
     */
    public function register($username, $password, $role = 'user')
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $this->db->table('users')->insert([
            'username' => $username,
            // docs expect a `password` column containing the hashed password
            'password' => $hash,
            'role' => $role,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Login user
     */
    public function login($username, $password)
    {
        $user = $this->db->table('users')
                         ->where('username', $username)
                         ->get();

        // docs use `password` column for the hashed password
        if ($user && password_verify($password, $user['password'] ?? null)) {
            $this->session->set_userdata([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'] ?? 'user',
                'logged_in' => true
            ]);
            return true;
        }

        return false;
    }

    /**
     * Check if user is logged in
     */
    public function is_logged_in()
    {
        return (bool) $this->session->userdata('logged_in');
    }

    /**
     * Check user role
     */
    public function has_role($role)
    {
        return $this->session->userdata('role') === $role;
    }

    /**
     * Logout user
     */
    public function logout()
    {
        $this->session->unset_userdata(['user_id','username','role','logged_in']);
    }
}
