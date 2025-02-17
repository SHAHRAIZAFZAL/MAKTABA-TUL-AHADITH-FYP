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
    $month = $_GET['month'];
    $year = $_GET['year'];
    $calendar = new hijri\Calendar();
    $clientTimeZone = new DateTimeZone($timeZone);

    $hijriDate = new hijri\datetime('now', $clientTimeZone, 'en', $calendar);
    $gregDate = new hijri\datetime('now', $clientTimeZone, 'en', $calendar);
    list($cday, $cmonth, $cyear) = explode('-', $hijriDate->format('j-n-Y'));
    $month_length = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $hijriDate->setDate($year, $month, $month_length);
    $gregDate->setDate($year, $month, $month_length);
    list($gm2, $gy2) = explode('-', $hijriDate->format("_F-_Y"));
    $hijriDate->setDate($year, $month, 1);
    $gregDate->setDate($year, $month, 1);
    list($start_wd, $month_name, $gm1, $gy1) = explode('-', $hijriDate->format("w-F-_F-_Y"));
    $title = $month_name . " " . $year . " (" . $gm1 . (($gy2 != $gy1) ? " " . $gy1 : '') . (($gm2 != $gm1) ? " - " . $gm2 : '') . " " . $gy2 . " AH)";

    $wd = array(0 => 6, 0, 1, 2, 3, 4, 5);
    $b_month = $month - 1;
    $b_year = $year;
    if ($b_month == 0) {
        $b_month = 12;
        $b_year--;
    }
    $a_month = $month + 1;
    $a_year = $year;
    if ($a_month == 13) {
        $a_month = 1;
        $a_year++;
    }
    if ($wd[$start_wd] > 0) {
        $hijriDate->modify("-" . $wd[$start_wd] . " day");
        $gregDate->modify("-" . $wd[$start_wd] . " day");
    }

    $dayw = 0;
    $gregDate->modify($modifier);
    do {
        list($hd, $hm, $hy) = explode('-', $hijriDate->format("j-n-Y"));
        list($gd, $gm, $gy) = explode('-', $gregDate->format("_j-_n-_Y"));
        if ($dayw == 0) {
            echo "<tr>";
        }
        $class = 'not-date';
        if ($cday == $hd && $cmonth == $hm && $cyear == $hy) {
            $class = "today-date";
        } elseif ($hm == $month) {
            $class = "month-date";
        }
        echo "<td class='$class'><div>$hd</div><div>$gd</div></td>";
        if ($dayw == 6) {
            echo "</tr>";
            $dayw = 0;
            if (($hm > $month) || ($hy > $year) || ($hm == $month && $hd == $month_length)) {
                break;
            }
        } else {
            $dayw++;
        }
        $hijriDate->modify("+1 day");
        $gregDate->modify("+1 day");
    } while (TRUE);
    echo '</td></tr>';
}