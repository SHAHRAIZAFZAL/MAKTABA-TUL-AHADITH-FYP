<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';

if (isset($_POST['ajax']) && $_POST['ajax'] === 'true') {
    unset($_COOKIE['cookieUsername']);
    setcookie('cookieUsername', '', time() - 3600, '/');
}