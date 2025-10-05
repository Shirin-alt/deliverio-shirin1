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

        // Debug logging helper
        $logDir = ROOT_DIR . 'runtime' . DIRECTORY_SEPARATOR . 'logs';
        if (!is_dir($logDir)) {
            @mkdir($logDir, 0755, true);
        }
        $logFile = $logDir . DIRECTORY_SEPARATOR . 'auth_debug.log';

        // Attempt insert and log result/exception for debugging when registration does not persist
        try {
            $result = $this->db->table('users')->insert($data);
            $msg = date('c') . " - REGISTER SUCCESS: username={$username} id_or_rowcount=" . var_export($result, true) . PHP_EOL;
            @file_put_contents($logFile, $msg, FILE_APPEND);
            return $result;
        } catch (Exception $e) {
            $err = date('c') . " - REGISTER FAILED: username={$username} data=" . json_encode($data) . " error=" . $e->getMessage() . PHP_EOL;
            @file_put_contents($logFile, $err, FILE_APPEND);
            return false;
        }
    }

    public function login($username, $password)
    {
        $user = $this->db->table('users')
                         ->where('username', $username)
                         ->get();

        // Prepare log file
        $logDir = ROOT_DIR . 'runtime' . DIRECTORY_SEPARATOR . 'logs';
        if (!is_dir($logDir)) {
            @mkdir($logDir, 0755, true);
        }
        $logFile = $logDir . DIRECTORY_SEPARATOR . 'auth_debug.log';

        // Support either 'password' or 'password_hash' column names (some installs use one or the other)
        $storedHash = null;
        if (is_array($user)) {
            if (array_key_exists('password', $user)) {
                $storedHash = $user['password'];
            } elseif (array_key_exists('password_hash', $user)) {
                $storedHash = $user['password_hash'];
            }
        }

        $verify = false;
        if ($user && $storedHash) {
            $verify = password_verify($password, $storedHash);
        }

        // Log attempt
        $logEntry = date('c') . " - LOGIN ATTEMPT: username={$username} found=" . ($user ? 'yes' : 'no') . " has_hash=" . ($storedHash ? 'yes' : 'no') . " verify=" . ($verify ? 'true' : 'false') . PHP_EOL;
        @file_put_contents($logFile, $logEntry, FILE_APPEND);

        if ($verify) {
            $this->session->set_userdata([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role'],
                'logged_in' => true
            ]);
            @file_put_contents($logFile, date('c') . " - LOGIN SUCCESS: username={$username} user_id={$user['id']}" . PHP_EOL, FILE_APPEND);
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
