<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/hijri-class.php';

if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    $year = $_GET['year'];
    $month = $_GET['month'];
    $date = $_GET['date'];
    $method = $_GET['method'];

    $new = new hijri\datetime('now', null, 'en', null);
    if ($method == 'hijri') {
        $new->setDateHijri($year, $month, $date);
        echo $new->format('d F, Y, l');
    } else if ($method == 'grego') {
        $new->setDate($year, $month, $date);
        echo $new->format('_j _F, _Y, l');
    }
}