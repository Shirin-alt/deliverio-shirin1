<?php
class Auth
{
    protected $db;
    protected $session;

    public function __construct()
    {
        $lava = lava_instance();
        $lava->call->database();
        $lava->call->library('session');

        $this->db = $lava->db;
        $this->session = $lava->session;
    }

    public function register($username, $password, $role = 'user')
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        // Insert using the 'password_hash' column (your DB uses this schema)
        $data = [
            'username'      => $username,
            'password_hash' => $hash,
            'role'          => $role,
            'created_at'    => date('Y-m-d H:i:s')
        ];

        return $this->db->table('users')->insert($data);
    }

    public function login($username, $password)
    {
        $user = $this->db->table('users')
                         ->where('username', $username)
                         ->get();

        // Support either 'password' or 'password_hash' column names (some installs use one or the other)
        $storedHash = null;
        if (is_array($user)) {
            if (array_key_exists('password', $user)) {
                $storedHash = $user['password'];
            } elseif (array_key_exists('password_hash', $user)) {
                $storedHash = $user['password_hash'];
            }
        }

        if ($user && $storedHash && password_verify($password, $storedHash)) {
            $this->session->set_userdata([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role'],
                'logged_in' => true
            ]);
            return true;
        }
        return false;
    }

    public function is_logged_in()
    {
        return (bool) $this->session->userdata('logged_in');
    }

    public function has_role($role)
    {
        return $this->session->userdata('role') === $role;
    }

    public function logout()
    {
        $this->session->unset_userdata(['user_id','username','role','logged_in']);
    }
}
