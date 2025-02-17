<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/hijri-class.php';
if (isset($_GET['month']) && isset($_GET['year'])) {
    $tmonth = (int) $_GET['month'];
    $tyear = (int) $_GET['year'];
    if ($tmonth > 0 && $tmonth < 13) {
        $month = $tmonth;
        $year = $tyear;
    }
} else {
    $month = date('m');
    $year = date('Y');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Hijri Calendar page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hijri Calendar - مكتبة الأحاديث</title>
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
                    <img src="<?php echo BASE_URL ?>images/hijri-calendar-background.png" alt="Hijri Calendar Icon"
                        height="600" width="600" title="Hijri Calendar Section">
                    <h2 class="langDiv langDiv-en">Hijri Calendar</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">ہجری کیلنڈر</h2>
                    <img src="<?php echo BASE_URL ?>images/hijri-calendar-background.png" alt="Hijri Calendar Icon"
                        height="600" width="600" title="Hijri Calendar Section">
                </article>

                <article class="container">
                    <div class="hijri-dates flex-row fontDiv fontDiv-m">
                        <div id="gregorian-date">
                            <?php echo date('d F, Y') . ' AD' ?>
                        </div>
                        <div id="hijri-date">
                            <?php
                            $calendar = new hijri\Calendar();
                            $hijriDate = new hijri\datetime('now', null, 'en', $calendar);
                            echo $hijriDate->format('_d _F _Y') . ' AH';
                            ?>
                        </div>
                    </div>
                    <!-- <div class="hijri-event-today">
                        <p class="langDiv langDiv-en fontDiv fontDiv-m">On this day, something happened.</p>
                        <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">آج کے دن</p>
                    </div> -->
                </article>

                <article class="container container-without-pad-bg">
                    <button type="button" aria-label="Button to change Hijri date settings" aria-expanded="false"
                        class="button-links book-details__settings" id="hijri-settings-button">
                        <span class="langDiv langDiv-en fontDiv fontDiv-m">Change Hijri Date Settings</span>
                        <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">ہجری تاریخ سیٹنگز
                            بدلیں</span>
                    </button>
                    <div class="settings-sidebar no-opacity">
                        <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Hijri Date Settings</h4>
                        <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">ہجری تاریخ سیٹنگز</h4>
                        <button id="hijri-settings-close-button" class="settings-sidebar-close-button" type="button"
                            aria-label="Button to close prayer timing calculation settings">
                            <svg width="30" height="30" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22" />
                            </svg>
                        </button>
                        <form action="" class="prayer-calculation-form">
                            <div class="prayer-calculation-form__method">
                                <label for="hijri-date-adjustment">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">Hijri Date Adjustment</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">ہجری تاریخ کی
                                        تصحیح</span>
                                </label>
                                <select id="hijri-date-adjustment" name="hijri-date-adjustment"
                                    class="fontDiv fontDiv-m">
                                    <option value="-5 days">-5 Days</option>
                                    <option value="-4 days">-4 Days</option>
                                    <option value="-3 days">-3 Days</option>
                                    <option value="-2 days">-2 Days</option>
                                    <option value="-1 day">-1 Day</option>
                                    <option value="0 day" selected>0 Day</option>
                                    <option value="+1 day">+1 Day</option>
                                    <option value="+2 days">+2 Days</option>
                                    <option value="+3 days">+3 Days</option>
                                    <option value="+4 days">+4 Days</option>
                                    <option value="+5 days">+5 Days</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </article>

                <?php
                $gregDate = new hijri\datetime('now', null, 'en', $calendar);
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
                ?>

                <article class="container">
                    <h4 class="fontDiv fontDiv-ml">Monthly Calendar -
                        <?php echo $title ?>
                    </h4>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>"
                        class="monthly-calendar flex-row">
                        <div>
                            <a href="<?php echo BASE_URL . 'hijri-calendar.php?month=' . $b_month . '&year=' . $b_year ?>"
                                class="button-links flex-row" title="Get Previous Month Calendar">
                                <svg class="disable-clicks" width="30" height="30" viewBox="0 0 24 24">
                                    <path class="disable-clicks" fill="currentColor"
                                        d="m10.8 12l3.9 3.9q.275.275.275.7t-.275.7q-.275.275-.7.275t-.7-.275l-4.6-4.6q-.15-.15-.212-.325T8.425 12q0-.2.063-.375T8.7 11.3l4.6-4.6q.275-.275.7-.275t.7.275q.275.275.275.7t-.275.7z" />
                                </svg>
                            </a>
                        </div>
                        <div class="timetable-form flex-row">
                            <select id="hijri-calendar-month" name="month" title="Choose Month"
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
                            <input class="hijri-converter-year" type="number" min="623" max="3000" name="year"
                                id="hijri-calendar-year" title="Choose Year" value="<?php echo date('Y') ?>">
                            <button type="submit" class="button-type-1 hover-effect">
                                <span class="langDiv langDiv-en fontDiv fontDiv-m">Generate</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">جاری کریں</span>
                            </button>
                        </div>
                        <div>
                            <a href="<?php echo BASE_URL . 'hijri-calendar.php?month=' . $a_month . '&year=' . $a_year ?>"
                                class="button-links flex-row" title="Get Next Month Calendar">
                                <svg class="disable-clicks" width="30" height="30" viewBox="0 0 24 24">
                                    <path class="disable-clicks" fill="currentColor"
                                        d="M12.6 12L8.7 8.1q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l4.6 4.6q.15.15.213.325t.062.375q0 .2-.062.375t-.213.325l-4.6 4.6q-.275.275-.7.275t-.7-.275q-.275-.275-.275-.7t.275-.7z" />
                                </svg>
                            </a>
                        </div>
                    </form>
                    <input type="hidden" id="hiddenMonth" name="hiddenMonth" value="<?php echo $month ?>">
                    <input type="hidden" id="hiddenYear" name="hiddenYear" value="<?php echo $year ?>">
                    <table class="calendar timetable">
                        <thead>
                            <tr>
                                <th class="langDiv langDiv-en">Mon</th>
                                <th class="langDiv langDiv-ur urdu-text hide-imp">پیر</th>
                                <th class="langDiv langDiv-en">Tue</th>
                                <th class="langDiv langDiv-ur urdu-text hide-imp">منگل</th>
                                <th class="langDiv langDiv-en">Wed</th>
                                <th class="langDiv langDiv-ur urdu-text hide-imp">بدھ</th>
                                <th class="langDiv langDiv-en">Thu</th>
                                <th class="langDiv langDiv-ur urdu-text hide-imp">جمعرات</th>
                                <th class="langDiv langDiv-en">Fri</th>
                                <th class="langDiv langDiv-ur urdu-text hide-imp">جمعہ</th>
                                <th class="langDiv langDiv-en">Sat</th>
                                <th class="langDiv langDiv-ur urdu-text hide-imp">ہفتہ</th>
                                <th class="langDiv langDiv-en">Sun</th>
                                <th class="langDiv langDiv-ur urdu-text hide-imp">اتوار</th>
                            </tr>
                        </thead>
                        <tbody id="monthly-calendar">
                            <?php
                            $dayw = 0;
                            /* $gregDate->modify('-1 day'); MODIFYING HERE BY AJAX */
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
                            ?>
                        </tbody>
                    </table>
                </article>

                <article class="container container-without-pad">
                    <div class="tab">
                        <input class="tab__input" type="radio" name="tab-date-converter" id="tab-1" checked="checked" />
                        <label class="tab__label" for="tab-1">
                            <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Hijri to Gregorian Converter</h4>
                            <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">ہجری سے گریگورین تاریخ
                            </h4>
                        </label>
                        <div class="tab__content date-converter">
                            <div>
                                <p class="langDiv langDiv-en fontDiv fontDiv-m">Select a Date</p>
                                <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">تاریخ منتخب کریں</p>
                            </div>
                            <form action="#" class="timetable-form flex-row" id="hijri-to-gregorian-form">
                                <div>
                                    <select id="hijri-converter-date" name="hijriDate" title="Choose Date"
                                        class="fontDiv fontDiv-m">
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                    </select>
                                </div>
                                <div>
                                    <select id="hijri-converter-month" name="hijriMonth" title="Choose Month"
                                        class="fontDiv fontDiv-m">
                                        <option value="1" selected>Muharram</option>
                                        <option value="2">Safar</option>
                                        <option value="3">Rabi Al Awwal</option>
                                        <option value="4">Rabi Al Thani</option>
                                        <option value="5">Jumada Al Oula</option>
                                        <option value="6">Jumada Al Akhira</option>
                                        <option value="7">Rajab</option>
                                        <option value="8">Shaban</option>
                                        <option value="9">Ramadan</option>
                                        <option value="10">Shawwal</option>
                                        <option value="11">Dhul Qidah</option>
                                        <option value="12">Dhul Hijjah</option>
                                    </select>
                                </div>
                                <div>
                                    <input class="hijri-converter-year fontDiv fontDiv-m" type="number" name="hijriYear"
                                        id="hijri-converter-year" title="Choose Year" value="1445">
                                </div>
                            </form>
                            <div class="converted-date fontDiv fontDiv-m" id="hijri-date-output">
                                <?php
                                $new = new hijri\datetime('now', null, 'en', null);
                                $new->setDateHijri(1445, 1, 1);
                                echo $new->format('d F, Y, l');
                                ?>
                            </div>
                            <p class="langDiv langDiv-en">* Probability of 1 day error</p>
                            <p class="langDiv langDiv-ur urdu-text hide-imp">* ایک دن کی غلطی کا امکان</p>
                        </div>

                        <input class="tab__input" type="radio" name="tab-date-converter" id="tab-2" />
                        <label class="tab__label" for="tab-2">
                            <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Gregorian to Hijri Converter</h4>
                            <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">گریگورین سے ہجری تاریخ
                            </h4>
                        </label>
                        <div class="tab__content date-converter">
                            <div>
                                <p class="langDiv langDiv-en fontDiv fontDiv-m">Select a Date</p>
                                <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">تاریخ منتخب کریں</p>
                            </div>
                            <form action="#" class="timetable-form flex-row" id="gregorian-to-hijri-form">
                                <div>
                                    <select id="gregorian-converter-date" name="gregorianDate" title="Choose Date"
                                        class="fontDiv fontDiv-m">
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                </div>
                                <div>
                                    <select id="gregorian-converter-month" name="gregorianMonth" title="Choose Month"
                                        class="fontDiv fontDiv-m">
                                        <option value="1" selected>January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div>
                                    <input class="hijri-converter-year fontDiv fontDiv-m" type="number"
                                        name="gregorianYear" id="gregorian-converter-year" title="Choose Year"
                                        value="<?php echo date('Y') ?>">
                                </div>
                            </form>
                            <div class="converted-date fontDiv fontDiv-m" id="grego-date-output">
                                <?php
                                $new = new hijri\datetime('now', null, 'en', null);
                                $new->setDate(2024, 1, 1);
                                echo $new->format('_j _F, _Y, l');
                                ?>
                            </div>
                            <p class="langDiv langDiv-en">* Probability of 1 day error</p>
                            <p class="langDiv langDiv-ur urdu-text hide-imp">* ایک دن کی غلطی کا امکان</p>
                        </div>
                    </div>
                </article>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
    <script src="<?php echo BASE_URL ?>script-hijri-calendar.js"></script>
</body>

</html>