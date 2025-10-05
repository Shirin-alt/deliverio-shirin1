<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class DebugController extends Controller
{
    public function session()
    {
        header('Content-Type: application/json');
        $data = [
            'php_session_active' => session_status() === PHP_SESSION_ACTIVE,
            'session_array' => isset($_SESSION) ? $_SESSION : null,
            'is_logged_in_helper' => function_exists('is_logged_in') ? is_logged_in() : null,
        ];
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}
