<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}

if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    $timeZone = $_GET['timezone'];
    $month = $_GET['month'];
    $year = $_GET['year'];
    $clientTimeZone = new DateTimeZone($timeZone);
    $currentDate = new DateTime("$year-$month-01", $clientTimeZone);
    $monthHeading = $currentDate->format('M Y');
    $date = $currentDate->format('d D');
    $number_of_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    echo '<thead> <tr> <th>' . $monthHeading . '</th> <th>Fajr</th> <th>Sunrise</th>';
    echo '<th>Dhuhr</th> <th>Asr</th> <th>Maghrib</th> <th>Isha</th> </tr> </thead> <tbody>';

    for ($day = 1; $day <= $number_of_days; $day++) {
        echo '<tr> <td id="' . $day . '">' . $date . '</td> <td>00:00</td>';
        echo '<td>00:00</td> <td>00:00</td> <td>00:00</td> <td>00:00</td> <td>00:00</td> </tr>';
        $currentDate->modify('+1 day');
        $date = $currentDate->format('d D');
    }
    echo '</tbody>';
}