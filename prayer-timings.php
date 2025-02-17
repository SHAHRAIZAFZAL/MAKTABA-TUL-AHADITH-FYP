<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.geoapify.com/v1/ipinfo?&apiKey=53724dbe584c4214a528dc861754a0ff',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));
$response = curl_exec($curl);
curl_close($curl);
$data = json_decode($response, true);
$location = $data['location'];
$latitude = $location['latitude'];
$longitude = $location['longitude'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Prayer Timings page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prayer Timings - مكتبة الأحاديث</title>
    <link rel="icon" href="<?php echo BASE_URL ?>images/logo-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>style.css">
    <noscript>
        <style>
            .page-container {
                display: none;
            }
        </style>
        <div class="no-javascript-div">
            You don't have javascript enabled. Please enable to continue with the website.
        </div>
    </noscript>
</head>

<body>
    <div class="page-container">
        <?php include SITE_PATH . '/header-aside.php' ?>
        <main>
            <div class="main">
                <article class="container container-major">
                    <img src="<?php echo BASE_URL ?>images/prayer-timings-background.png" alt="Prayer Timings Icon"
                        height="600" width="600" title="Prayer Timings Section">
                    <h2 class="langDiv langDiv-en">Prayer Timings</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">نماز کے اوقات</h2>
                    <img src="<?php echo BASE_URL ?>images/prayer-timings-background.png" alt="Prayer Timings Icon"
                        height="600" width="600" title="Prayer Timings Section">
                </article>

                <input type="hidden" id="latitudeIP" value="<?php echo $latitude ?>">
                <input type="hidden" id="longitudeIP" value="<?php echo $longitude ?>">

                <article class="container">
                    <div class="prayer-timings-location-date fontDiv fontDiv-m">
                        <p id="current-date-time">
                            <?php echo date('d F Y, D - h:i:s A') ?>
                        </p>
                        <p id="current-location"></p>
                    </div>
                    <form action="" class="prayer-timings-form">
                        <button class="button-type-1 hover-effect" type="button" id="auto-locate-button"
                            aria-label="Button to auto locate user">
                            <span class="langDiv langDiv-en fontDiv fontDiv-s">Auto Locate</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">خودکار لوکیشن</span>
                        </button>
                        <span class="langDiv langDiv-en">&nbsp;&nbsp;or&nbsp;&nbsp;</span>
                        <span
                            class="langDiv langDiv-ur urdu-text hide-imp">&nbsp;&nbsp;&nbsp;یا&nbsp;&nbsp;&nbsp;</span>
                        <div class="autocomplete-container prayer-timings-form__search" id="autocomplete-container">
                        </div>
                    </form>
                </article>

                <article class="container prayer-times-container">
                    <div class="prayer-timings-sunrise-sunset flex-row">
                        <div>
                            <p>
                                <span class="langDiv langDiv-en fontDiv fontDiv-m">Sunrise at</span>
                                <span id="sunrise" class="fontDiv fontDiv-m">00:00 AM</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">طلوع آفتاب
                                </span>
                            </p>
                        </div>
                        <div>
                            <p>
                                <span class="langDiv langDiv-en fontDiv fontDiv-m">Sunset at</span>
                                <span id="sunset" class="fontDiv fontDiv-m">00:00 PM</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">غروب آفتاب </span>
                            </p>
                        </div>
                    </div>
                    <div class="prayer-timings-container">
                        <div class="prayer-time-div">
                            <p class="langDiv langDiv-en fontDiv fontDiv-m">Fajr</p>
                            <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">فجر</p>
                            <p id="fajr" class="fontDiv fontDiv-m">00:00</p>
                        </div>
                        <div class="prayer-time-div">
                            <p class="langDiv langDiv-en fontDiv fontDiv-m">Dhuhr</p>
                            <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">ظہر</p>
                            <p id="dhuhr" class="fontDiv fontDiv-m">00:00</p>
                        </div>
                        <div class="prayer-time-div">
                            <p class="langDiv langDiv-en fontDiv fontDiv-m">Asr</p>
                            <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">عصر</p>
                            <p id="asr" class="fontDiv fontDiv-m">00:00</p>
                        </div>
                        <div class="prayer-time-div">
                            <p class="langDiv langDiv-en fontDiv fontDiv-m">Maghrib</p>
                            <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">مغرب</p>
                            <p id="maghrib" class="fontDiv fontDiv-m">00:00</p>
                        </div>
                        <div class="prayer-time-div">
                            <p class="langDiv langDiv-en fontDiv fontDiv-m">Isha</p>
                            <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">عشاء</p>
                            <p id="isha" class="fontDiv fontDiv-m">00:00</p>
                        </div>
                        <div class="prayer-time-div midnight">
                            <p class="langDiv langDiv-en fontDiv fontDiv-m">Midnight</p>
                            <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">آدھی رات</p>
                            <p id="midnight" class="fontDiv fontDiv-m">00:00</p>
                        </div>
                        <div class="prayer-time-div lastthird">
                            <p class="langDiv langDiv-en fontDiv fontDiv-m">Last 3rd</p>
                            <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">آخری تہائی</p>
                            <p id="lastthird" class="fontDiv fontDiv-m">00:00</p>
                        </div>
                    </div>
                    <div class="prayer-timings-calculation flex-row">
                        <button type="button" aria-label="Button to change Prayer Time Calculation Settings"
                            aria-expanded="false" class="button-links book-details__settings"
                            id="prayer-calculation-button">
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">Change Calculation Settings</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">کیلکولیشن سیٹنگز
                                بدلیں</span>
                        </button>
                        <p class="fontDiv fontDiv-s"><span id="calcMethodOutput"></span> - Fajr <span
                                id="fajrAngleOutput"></span>&deg; - Isha <span id="ishaAngleOutput"></span>&deg; - Asr:
                            <span id="asrMethodOutput"></span>
                        </p>
                    </div>
                    <div class="settings-sidebar no-opacity">
                        <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Prayer Times Settings</h4>
                        <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">اوقاتِ نماز کی سیٹنگز</h4>
                        <button id="prayer-calculation-close-button" class="settings-sidebar-close-button" type="button"
                            aria-label="Button to close prayer timing calculation settings">
                            <svg width="30" height="30" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22" />
                            </svg>
                        </button>
                        <form action="" class="prayer-calculation-form">
                            <div class="prayer-calculation-form__method">
                                <label for="calc-method">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">Calculation Method</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">کیلکولیشن کا
                                        طریقہ</span>
                                </label>
                                <select id="calc-method" name="calc-method" class="fontDiv fontDiv-m">
                                    <option name="Umm al-Qura University, Mecca" value="UmmAlQura" selected>Umm al-Qura
                                        University, Mecca</option>
                                    <option name="University of Islamic Sciences, Karachi" value="Karachi">University of
                                        Islamic Sciences, Karachi</option>
                                    <option name="Muslim World League" value="MuslimWorldLeague">Muslim World League
                                    </option>
                                    <option name="Egyptian General Authority of Survey" value="Egyptian">Egyptian
                                        General
                                        Authority of Survey</option>
                                    <option name="Moonsighting Committee Worldwide" value="MoonsightingCommittee">
                                        Moonsighting Committee Worldwide</option>
                                    <option name="Islamic Society of North America" value="NorthAmerica">Islamic Society
                                        of
                                        North America</option>
                                    <option name="Institute of Geophysics, Tehran" value="Tehran">Institute of
                                        Geophysics,
                                        Tehran</option>
                                    <option name="Singapore, Malaysia, Indonesia" value="Singapore">Singapore, Malaysia,
                                        Indonesia</option>
                                    <option name="Diyanet Method, Turkey" value="Turkey">Diyanet Method, Turkey</option>
                                    <option name="Dubai, UAE" value="Dubai">Dubai UAE</option>
                                    <option name="Qatar" value="Qatar">Qatar</option>
                                    <option name="Kuwait" value="Kuwait">Kuwait</option>
                                    <option name="Custom" value="Other">Custom</option>
                                </select>
                            </div>
                            <div class="prayer-calculation-form__angles">
                                <div class="prayer-calculation-form__angles-fajr">
                                    <label for="fajr-angle">
                                        <span class="langDiv langDiv-en fontDiv fontDiv-m">Fajr Angle</span>
                                        <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">فجر کا
                                            زاویہ</span>
                                    </label>
                                    <select id="fajr-angle" name="fajr-angle" class="fontDiv fontDiv-m">
                                        <?php
                                        $value = 0;
                                        for ($i = 1; $i <= 51; $i++) {
                                            echo '<option value="' . $value . '"';
                                            if ($i == 1) {
                                                echo ' selected';
                                            }
                                            echo '>' . $value . '</option>';
                                            $value += 0.5;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="prayer-calculation-form__angles-isha">
                                    <label for="isha-angle">
                                        <span class="langDiv langDiv-en fontDiv fontDiv-m">Isha Angle</span>
                                        <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">عشاء کا
                                            زاویہ</span>
                                    </label>
                                    <select id="isha-angle" name="isha-angle" class="fontDiv fontDiv-m">
                                        <?php
                                        $value = 0;
                                        for ($i = 1; $i <= 51; $i++) {
                                            echo '<option value="' . $value . '"';
                                            if ($i == 1) {
                                                echo ' selected';
                                            }
                                            echo '>' . $value . '</option>';
                                            $value += 0.5;
                                        }
                                        ?>
                                        <option value="90 Minutes">90 Minutes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="prayer-calculation-form__asr">
                                <label for="asr-method">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">Asr Time Method</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">عصر کے وقت کا
                                        طریقہ</span>
                                </label>
                                <select id="asr-method" name="asr-method" class="fontDiv fontDiv-m">
                                    <option value="Shafi" selected>Standard (Shafi'i, Hanbali, Maliki)</option>
                                    <option value="Hanafi">Hanafi</option>
                                </select>
                            </div>
                            <div class="prayer-calculation-form__high-latitude-rule">
                                <label for="high-latitude-rule">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">High Latitude Rule</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">اعلیٰ عرض بلد
                                        کا
                                        اصول</span>
                                </label>
                                <select id="high-latitude-rule" name="high-latitude-rule" class="fontDiv fontDiv-m">
                                    <option value="MiddleOfTheNight" selected>Middle of the Night</option>
                                    <option value="SeventhOfTheNight">Seventh of the Night</option>
                                    <option value="TwilightAngle">Twilight Angle</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="prayer-extra-times flex-column">
                        <label for="show_midnight">
                            <input type="checkbox" value="show_midnight" id="show_midnight" checked>
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">Show Midnight Time</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">آدھی رات کا وقت
                                دیکھیں</span>
                        </label>
                        <label for="show_lastthird">
                            <input type="checkbox" value="show_lastthird" id="show_lastthird" checked>
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">Show Last Third of Night Time</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">تہائی رات کا وقت
                                دیکھیں</span>
                        </label>
                    </div>
                </article>

                <article class="container">
                    <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Prayer Timetable</h4>
                    <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">اوقاتِ نماز کا ٹائم ٹیبل</h4>
                    <form action="" method="post" class="timetable-form flex-row">
                        <div>
                            <select id="prayer-timetable-month" name="prayer-timetable-month" title="Choose Month"
                                class="fontDiv fontDiv-m">
                                <?php
                                $currentMonth = date('m');
                                for ($i = 1; $i <= 12; $i++) {
                                    $dateObj = DateTime::createFromFormat('!m', $i);
                                    $monthName = $dateObj->format('F');
                                    echo '<option value="' . $i . '"';
                                    if ($currentMonth == $i) {
                                        echo ' selected';
                                    }
                                    echo '>' . $monthName . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <select id="prayer-timetable-year" name="prayer-timetable-year" title="Choose Year"
                                class="fontDiv fontDiv-m">
                                <?php
                                $currentYear = date('Y');
                                for ($i = 2000; $i <= 2100; $i++) {
                                    $dateObj = DateTime::createFromFormat('!Y', $i);
                                    $yearName = $dateObj->format('Y');
                                    echo '<option value="' . $i . '"';
                                    if ($currentYear == $i) {
                                        echo ' selected';
                                    }
                                    echo '>' . $yearName . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                    <table class="timetable" id="prayer-timetable-output"></table>
                </article>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
    <script src="<?php echo BASE_URL ?>script-adhan.umd.min.js"></script>
    <script src="<?php echo BASE_URL ?>script-prayer-timings.js"></script>
</body>

</html>