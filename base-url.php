<?php
if ($_SERVER['HTTP_HOST'] == "localhost") {
    define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/Maktaba-tul-Ahadith' . '/');
    define('SITE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith');
} else {
    define('BASE_URL', "http://" . $_SERVER['HTTP_HOST'] . '/');
    define('SITE_PATH', $_SERVER['DOCUMENT_ROOT']);
}