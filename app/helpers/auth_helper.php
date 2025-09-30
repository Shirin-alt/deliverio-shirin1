if (!function_exists('redirect')) {
    function redirect($uri = '', $permanent = false, $exit = true)
    {
        if (!preg_match('#^(\w+:)?//#i', $uri)) {
            $uri = $uri;
        }
        if (headers_sent() === false) {
            header('Location: ' . $uri, true, ($permanent === true) ? 301 : 302);
        }
        if ($exit === true) exit();
    }
}
<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function require_login() {
    if (!is_logged_in()) {
        redirect('/login');
        exit;
    }
}
