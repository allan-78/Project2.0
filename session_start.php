<?php
session_start();

// Session security settings
ini_set('session.cookie_httponly', 1); // Prevent JavaScript access to session cookies
ini_set('session.cookie_secure', isset($_SERVER['HTTPS'])); // Only allow cookies over HTTPS
ini_set('session.use_strict_mode', 1); // Prevent session fixation

// Set session cookie parameters with SameSite attribute
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict'
]);
