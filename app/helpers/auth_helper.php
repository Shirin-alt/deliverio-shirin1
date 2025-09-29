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
