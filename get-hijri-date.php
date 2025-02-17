<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/hijri-class.php';

if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    $modifier = $_GET['modifier'];
    $timeZone = $_GET['timezone'];
    $calendar = new hijri\Calendar();
    $clientTimeZone = new DateTimeZone($timeZone);
    $hijriDate = new hijri\datetime('now', $clientTimeZone, 'en', $calendar);
    $hijriDate->modify($modifier);
    echo $hijriDate->format('_d _F _Y') . ' AH';
}