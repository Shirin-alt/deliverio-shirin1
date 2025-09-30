<?php
// Copied from scheme/helpers/url_helper.php to ensure autoloading works

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

if (!function_exists('base_url')) {
    function base_url()
    {
        return rtrim(filter_var(BASE_URL, FILTER_SANITIZE_URL), '/');
    }
}

if (!function_exists('site_url')) {
    function site_url($url = '')
    {
        $base_url = rtrim(filter_var(BASE_URL, FILTER_SANITIZE_URL), '/');
        $index_page = trim(config_item('index_page'), '/');
        $url = ltrim($url, '/');

        if (!empty($index_page) && strpos($url, $index_page) === 0) {
            $url = substr($url, strlen($index_page));
            $url = ltrim($url, '/');
        }

        if (!empty($index_page)) {
            return "{$base_url}/{$index_page}/{$url}";
        }

        return "{$base_url}/{$url}";
    }
}

if (!function_exists('redirect')) {
    function redirect($uri = '', $permanent = false, $exit = true)
    {
        if (!preg_match('#^(\w+:)?//#i', $uri)) {
            $uri = site_url($uri);
        }
        if (headers_sent() === false) {
            header('Location: ' . $uri, true, ($permanent === true) ? 301 : 302);
        }
        if ($exit === true) exit();
    }
}
