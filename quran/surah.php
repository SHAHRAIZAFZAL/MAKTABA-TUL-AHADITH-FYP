<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';

$surahID = htmlspecialchars($_GET['surahID']);
$stmt = $conn->prepare("SELECT * FROM surah_list WHERE surah_id = ?");
$stmt->bind_param("i", $surahID);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$row = $result->fetch_assoc();

$surahIDZeros = htmlspecialchars($row['surah_id_zeros']);
$surahNameAr = htmlspecialchars($row['surah_name_ar']);
$surahNameEn = htmlspecialchars($row['surah_name_en']);
$surahAyahs = htmlspecialchars($row['surah_ayahs']);
$surahRukuhs = htmlspecialchars($row['surah_rukuhs']);
$surahRevelation = htmlspecialchars($row['surah_revelation']);
$ayatRangeStart = htmlspecialchars($row['ayat_range_start']);
$ayatRangeEnd = htmlspecialchars($row['ayat_range_end']);
$surahInfoNameEn = htmlspecialchars($row['surah_info_name_en']);
$surahInfoPeriodEn = htmlspecialchars($row['surah_info_period_en']);
$surahInfoThemeEn = htmlspecialchars($row['surah_info_theme_en']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Surah Al-Fatiha, Quran in Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo 'Surah ' . $surahNameEn . ' - ' . ' مكتبة الأحاديث - ' . $surahNameAr ?>
    </title>
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
                    <img src="<?php echo BASE_URL ?>images/surah-images/<?php echo $surahID ?>.svg"
                        alt="Surah <?php echo $surahNameEn ?> Calligraphy" height="480" width="480"
                        title="Surah <?php echo $surahNameEn ?>">
                    <h2 class="langDiv langDiv-en">
                        Surah
                        <?php echo $surahNameEn ?>
                    </h2>
                    <h2 class="langDiv langDiv-ur arabic-text hide-imp">
                        سورۃ
                        <?php echo $surahNameAr ?>
                    </h2>
                    <img src="<?php echo BASE_URL ?>images/surah-images/<?php echo $surahID ?>.svg"
                        alt="Surah <?php echo $surahNameEn ?> Calligraphy" height="480" width="480"
                        title="Surah <?php echo $surahNameEn ?>">
                </article>

                <div class="container container-without-pad-bg surah-details">
                    <div class="surah-details__left">
                        <p>
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">Translation by:</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">:ترجمہ</span>
                        </p>
                        <p id="translator-info" class="fontDiv fontDiv-m"></p>
                        <button type="button" aria-label="Button to change Quran Settings" id="quran-settings-button"
                            class="button-links surah-details__left--change">
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">Quran Settings</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">قرآن سیٹنگز</span>
                        </button>
                    </div>
                    <div class="settings-sidebar no-opacity">
                        <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Quran Translations</h4>
                        <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">قرآن کے تراجم</h4>
                        <button id="quran-settings-close-button" class="settings-sidebar-close-button" type="button"
                            aria-label="Button to close Quran settings">
                            <svg width="30" height="30" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22" />
                            </svg>
                        </button>
                        <form action="" class="quran-settings-form flex-column">
                            <p>
                                <span class="langDiv langDiv-en fontDiv fontDiv-m">English</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">انگریزی</span>
                            </p>
                            <label for="en_mustafa_khattab" class="fontDiv fontDiv-m">
                                <input checked type="checkbox" value="en_mustafa_khattab" id="en_mustafa_khattab">
                                Dr. Mustafa Khattab, the Clear Quran
                            </label>
                            <label for="en_hilali_muhsin" class="fontDiv fontDiv-m">
                                <input type="checkbox" value="en_hilali_muhsin" id="en_hilali_muhsin">
                                Taqi-ud-Din al-Hilali & Muhsin Khan, the Noble Quran
                            </label>
                            <label for="en_saheeh" class="fontDiv fontDiv-m">
                                <input type="checkbox" value="en_saheeh" id="en_saheeh">
                                Saheeh International
                            </label>
                            <label for="en_maududi" class="fontDiv fontDiv-m">
                                <input type="checkbox" value="en_maududi" id="en_maududi">
                                Abul Ala Maududi, Tafheem-ul-Quran
                            </label>
                            <label for="en_mubarakpuri" class="fontDiv fontDiv-m">
                                <input type="checkbox" value="en_mubarakpuri" id="en_mubarakpuri">
                                Safiur Rahman Mubarakpuri
                            </label>
                            <label for="en_yusuf_ali" class="fontDiv fontDiv-m">
                                <input type="checkbox" value="en_yusuf_ali" id="en_yusuf_ali">
                                Abdullah Yusuf Ali
                            </label>
                            <p>
                                <span class="langDiv langDiv-en fontDiv fontDiv-m">Urdu</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">اردو</span>
                            </p>
                            <label for="ur_maududi" class="fontDiv fontDiv-m">
                                <input type="checkbox" value="ur_maududi" id="ur_maududi">
                                Abul Ala Maududi, Tafheem-ul-Quran
                            </label>
                            <label for="ur_junagarhi" class="fontDiv fontDiv-m">
                                <input type="checkbox" value="ur_junagarhi" id="ur_junagarhi">
                                Muhammad ibn Ibrahim Junagarhi
                            </label>
                            <label for="ur_jalandhry" class="fontDiv fontDiv-m">
                                <input type="checkbox" value="ur_jalandhry" id="ur_jalandhry">
                                Fateh Muhammad Jalandhry
                            </label>
                        </form>
                    </div>
                    <div class="surah-details__right flex-column">
                        <button class="button-links hover-effect flex-row" type="button"
                            aria-label="Surah Info Link Button" id="surah-info-button" aria-expanded="false">
                            <svg width="30" height="30" viewBox="0 0 48 48">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M44 24c0 11.046-8.954 20-20 20S4 35.046 4 24S12.954 4 24 4s20 8.954 20 20M22 35a2 2 0 1 0 4 0V21a2 2 0 1 0-4 0zm2-20a2 2 0 1 1 0-4a2 2 0 0 1 0 4"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">Surah Info</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">سورۃ کی
                                معلومات</span>
                        </button>
                        <div class="surah-info-menu surah-popup-menu pop-up-menu less-width no-opacity">
                            <button id="surah-info-close-button" class="settings-sidebar-close-button" type="button"
                                aria-label="Button to close Quran Surah info menu">
                                <svg width="30" height="30" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22" />
                                </svg>
                            </button>
                            <h3 class="langDiv langDiv-en fontDiv fontDiv-l">
                                Surah
                                <?php echo $surahNameEn ?>
                            </h3>
                            <h3 class="langDiv langDiv-ur arabic-text hide-imp fontDiv fontDiv-l">
                                سورۃ
                                <?php echo $surahNameAr ?>
                            </h3>
                            <div class="surah-insights">
                                <p class="langDiv langDiv-en fontDiv fontDiv-m">Ayahs:
                                    <?php echo $surahAyahs ?>
                                </p>
                                <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">آیات:
                                    <?php echo $surahAyahs ?>
                                </p>
                                <p class="langDiv langDiv-en fontDiv fontDiv-m">Revelation Place:
                                    <?php echo $surahRevelation ?>
                                </p>
                                <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">نزول کی جگہ:
                                    <?php
                                    if ($surahRevelation == 'Mecca') {
                                        echo 'مکہ';
                                    } else if ($surahRevelation == 'Medina') {
                                        echo 'مدینہ';
                                    }
                                    ?>
                                </p>
                                <p class="langDiv langDiv-en fontDiv fontDiv-m">Rukus:
                                    <?php echo $surahRukuhs ?>
                                </p>
                                <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">رکوع:
                                    <?php echo $surahRukuhs ?>
                                </p>
                            </div>
                            <h4 class="langDiv langDiv-en fontDiv fontDiv-m">Name</h4>
                            <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">نام</h4>
                            <p class="english-text fontDiv fontDiv-m">
                                <?php echo nl2br($surahInfoNameEn) ?>
                            </p>
                            <h4 class="langDiv langDiv-en fontDiv fontDiv-m">Period of Revelation</h4>
                            <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">شانِ نزول</h4>
                            <p class="english-text fontDiv fontDiv-m">
                                <?php echo nl2br($surahInfoPeriodEn) ?>
                            </p>
                            <h4 class="langDiv langDiv-en fontDiv fontDiv-m">Theme</h4>
                            <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">مضامین</h4>
                            <p class="english-text fontDiv fontDiv-m">
                                <?php echo nl2br($surahInfoThemeEn) ?>
                            </p>
                        </div>
                        <button class="button-links hover-effect flex-row" type="button"
                            aria-label="Play Surah Audio Button" id="play-audio-button">
                            <svg width="30" height="30" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m9.5 16.5l7-4.5l-7-4.5zM12 22q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22" />
                            </svg>
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">Play Audio</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">آڈیو چلائیں</span>
                        </button>
                        <div id="surah-audio-player" class="surah-audio-player flex-row no-opacity">
                            <audio preload="metadata">
                                <source type="audio/mpeg" id="audio-mishari"
                                    src="https://download.quranicaudio.com/quran/mishaari_raashid_al_3afaasee/<?php echo $surahIDZeros ?>.mp3">
                                <source type="audio/mpeg" id="audio-sudais"
                                    src="https://download.quranicaudio.com/quran/abdurrahmaan_as-sudays/<?php echo $surahIDZeros ?>.mp3">
                                <source type="audio/mpeg" id="audio-abdulbasit-mujawwad"
                                    src="https://download.quranicaudio.com/quran/abdulbaset_mujawwad/<?php echo $surahIDZeros ?>.mp3">
                                <source type="audio/mpeg" id="audio-abdulbasit-murattal"
                                    src="https://download.quranicaudio.com/quran/abdul_basit_murattal/<?php echo $surahIDZeros ?>.mp3">
                                <source type="audio/mpeg" id="audio-shuraim"
                                    src="https://download.quranicaudio.com/quran/sa3ood_al-shuraym/<?php echo $surahIDZeros ?>.mp3">
                                <source type="audio/mpeg" id="audio-hussary"
                                    src="https://download.quranicaudio.com/quran/mahmood_khaleel_al-husaree_iza3a/<?php echo $surahIDZeros ?>.mp3">
                                Your browser does not support the audio tag.
                            </audio>
                            <input type="range" id="audio-slider" title="Seek Audio" max="100" value="0">
                            <div id="audio-current-time" class="fontDiv fontDiv-m">00:00</div>
                            <div class="audio-controls flex-row" id="audio-controls">
                                <button id="audio-more" class="button-links tooltip" type="button"
                                    title="Button for more audio options">
                                    <svg width="30" height="30" viewBox="0 0 256 256">
                                        <path fill="currentColor"
                                            d="M144 128a16 16 0 1 1-16-16a16 16 0 0 1 16 16m-84-16a16 16 0 1 0 16 16a16 16 0 0 0-16-16m136 0a16 16 0 1 0 16 16a16 16 0 0 0-16-16" />
                                    </svg>
                                    <span class="tooltip-text langDiv langDiv-en">More Options</span>
                                    <span class="tooltip-text langDiv langDiv-ur urdu-text hide-imp">مزید آپشنز</span>
                                </button>
                                <div id="audio-more-menu" class="no-opacity">
                                    <button id="audio-auto-repeat" class="button-links" type="button">
                                        <svg width="30" height="30" viewBox="0 0 32 32">
                                            <path fill="currentColor"
                                                d="M26 4H6a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2M6 26V6h20v20Z" />
                                            <path id="audio-auto-repeat-check" class="hide" fill="currentColor"
                                                d="M26 4H6a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2M14 21.5l-5-4.957L10.59 15L14 18.346L21.409 11L23 12.577Z" />
                                        </svg>
                                        <span class="tooltip-text langDiv langDiv-en fontDiv fontDiv-s">Auto
                                            Repeat?</span>
                                        <span
                                            class="tooltip-text langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">دوبارہ
                                            چلائیں؟</span>
                                    </button>
                                    <!-- <button id="audio-auto-scroll" class="button-links" type="button">
                                        <svg width="30" height="30" viewBox="0 0 32 32">
                                            <path fill="currentColor"
                                                d="M26 4H6a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2M6 26V6h20v20Z" />
                                            <path id="audio-auto-scroll-check" class="hide" fill="currentColor"
                                                d="M26 4H6a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2M14 21.5l-5-4.957L10.59 15L14 18.346L21.409 11L23 12.577Z" />
                                        </svg>
                                        <span class="tooltip-text langDiv langDiv-en fontDiv fontDiv-s">Auto
                                            Scroll?</span>
                                        <span
                                            class="tooltip-text langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">آٹو
                                            سکرول</span>
                                    </button> -->
                                    <button id="audio-download" class="button-links" type="button">
                                        <svg width="30" height="30" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="m12 16l-5-5l1.4-1.45l2.6 2.6V4h2v8.15l2.6-2.6L17 11zm-6 4q-.825 0-1.412-.587T4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413T18 20z" />
                                        </svg>
                                        <span class="tooltip-text langDiv langDiv-en fontDiv fontDiv-s">Download</span>
                                        <span
                                            class="tooltip-text langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">ڈاؤن
                                            لوڈ</span>
                                    </button>
                                    <button id="audio-play-speed" class="button-links" type="button">
                                        <svg width="30" height="30" viewBox="0 0 24 24">
                                            <path class="hide" fill="currentColor"
                                                d="M15 17q-.425 0-.712-.288T14 16q0-.425.288-.712T15 15h3v-2h-3q-.425 0-.712-.288T14 12V8q0-.425.288-.712T15 7h4q.425 0 .713.288T20 8q0 .425-.288.713T19 9h-3v2h2q.825 0 1.413.588T20 13v2q0 .825-.587 1.413T18 17zm-3 0H8q-.425 0-.712-.288T7 16v-3q0-.825.588-1.412T9 11h2V9H8q-.425 0-.712-.288T7 8q0-.425.288-.712T8 7h3q.825 0 1.413.588T13 9v2q0 .825-.587 1.413T11 13H9v2h3q.425 0 .713.288T13 16q0 .425-.288.713T12 17m-7 0q-.425 0-.712-.288T4 16q0-.425.288-.712T5 15q.425 0 .713.288T6 16q0 .425-.288.713T5 17" />
                                            <path class="hide" fill="currentColor"
                                                d="M11 17q-.425 0-.712-.288T10 16q0-.425.288-.712T11 15h3v-2h-3q-.425 0-.712-.288T10 12V8q0-.425.288-.712T11 7h4q.425 0 .713.288T16 8q0 .425-.288.713T15 9h-3v2h2q.825 0 1.413.588T16 13v2q0 .825-.587 1.413T14 17zm-3 0q-.425 0-.712-.288T7 16q0-.425.288-.712T8 15q.425 0 .713.288T9 16q0 .425-.288.713T8 17" />
                                            <path class="hide" fill="currentColor"
                                                d="M15 17q-.425 0-.712-.288T14 16q0-.425.288-.712T15 15h3v-2h-3q-.425 0-.712-.288T14 12V8q0-.425.288-.712T15 7h4q.425 0 .713.288T20 8q0 .425-.288.713T19 9h-3v2h2q.825 0 1.413.588T20 13v2q0 .825-.587 1.413T18 17zm-4-8H8q-.425 0-.712-.288T7 8q0-.425.288-.712T8 7h3.25q.725 0 1.238.538T13 8.8l-.05.45l-1.775 7.025q-.075.325-.325.525t-.6.2q-.475 0-.775-.375T9.3 15.8zm-5 8q-.425 0-.712-.288T5 16q0-.425.288-.712T6 15q.425 0 .713.288T7 16q0 .425-.288.713T6 17" />
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M9 16V8l-2 2m6 6l4-4m0 4l-4-4" />
                                            <path class="hide" fill="currentColor"
                                                d="M17.5 17q-.425 0-.712-.288T16.5 16q0-.425.288-.712T17.5 15h3v-2h-3q-.425 0-.712-.288T16.5 12V8q0-.425.288-.712T17.5 7h4q.425 0 .713.288T22.5 8q0 .425-.288.713T21.5 9h-3v2h2q.825 0 1.413.588T22.5 13v2q0 .825-.587 1.413T20.5 17zm-3 0h-4q-.425 0-.712-.288T9.5 16v-3q0-.825.588-1.412T11.5 11h2V9h-3q-.425 0-.712-.288T9.5 8q0-.425.288-.712T10.5 7h3q.825 0 1.413.588T15.5 9v2q0 .825-.587 1.413T13.5 13h-2v2h3q.425 0 .713.288T15.5 16q0 .425-.288.713T14.5 17m-7 0q-.425 0-.712-.288T6.5 16q0-.425.288-.712T7.5 15q.425 0 .713.288T8.5 16q0 .425-.288.713T7.5 17m-4-8h-1q-.425 0-.712-.288T1.5 8q0-.425.288-.712T2.5 7h2q.425 0 .713.288T5.5 8v8q0 .425-.288.713T4.5 17q-.425 0-.712-.288T3.5 16z" />
                                            <path class="hide" fill="currentColor"
                                                d="M8 17q-.425 0-.712-.288T7 16V9H6q-.425 0-.712-.288T5 8q0-.425.288-.712T6 7h1q.825 0 1.413.588T9 9v7q0 .425-.288.713T8 17m6 0q-.425 0-.712-.288T13 16q0-.425.288-.712T14 15h3v-2h-2q-.825 0-1.412-.587T13 11V9q0-.825.588-1.412T15 7h3q.425 0 .713.288T19 8q0 .425-.288.713T18 9h-3v2h2q.825 0 1.413.588T19 13v2q0 .825-.587 1.413T17 17zm-3 0q-.425 0-.712-.288T10 16q0-.425.288-.712T11 15q.425 0 .713.288T12 16q0 .425-.288.713T11 17" />
                                            <path class="hide" fill="currentColor"
                                                d="M17 17q-.425 0-.712-.288T16 16q0-.425.288-.712T17 15h3v-2h-3q-.425 0-.712-.288T16 12V8q0-.425.288-.712T17 7h4q.425 0 .713.288T22 8q0 .425-.288.713T21 9h-3v2h2q.825 0 1.413.588T22 13v2q0 .825-.587 1.413T20 17zm-4-8h-3q-.425 0-.712-.288T9 8q0-.425.288-.712T10 7h3.25q.725 0 1.238.538T15 8.8l-.05.45l-1.775 7.025q-.075.325-.325.525t-.6.2q-.475 0-.775-.375T11.3 15.8zm-5 8q-.425 0-.712-.288T7 16q0-.425.288-.712T8 15q.425 0 .713.288T9 16q0 .425-.288.713T8 17M4 9H3q-.425 0-.712-.288T2 8q0-.425.288-.712T3 7h2q.425 0 .713.288T6 8v8q0 .425-.288.713T5 17q-.425 0-.712-.288T4 16z" />
                                            <path class="hide" fill="currentColor"
                                                d="M10 17H7q-.825 0-1.412-.587T5 15v-2q0-.825.588-1.412T7 11h2V9H6q-.425 0-.712-.288T5 8q0-.425.288-.712T6 7h3q.825 0 1.413.588T11 9v2q0 .825-.587 1.413T9 13H7v2h3q.425 0 .713.288T11 16q0 .425-.288.713T10 17m6-3.325l-1.75 2.9q-.125.2-.312.313t-.413.112q-.5 0-.763-.437t.013-.863L15 12l-2.225-3.7q-.275-.425-.012-.862T13.525 7q.225 0 .413.113t.312.312l1.75 2.9l1.75-2.9q.125-.2.313-.312T18.475 7q.5 0 .763.438t-.013.862L17 12l2.225 3.7q.275.425.013.863t-.763.437q-.225 0-.413-.112t-.312-.313z" />
                                        </svg><span class="tooltip-text langDiv langDiv-en fontDiv fontDiv-s">Playback
                                            Speed</span>
                                        <span
                                            class="tooltip-text langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">آڈیو
                                            کی
                                            رفتار</span>&nbsp;&nbsp;
                                        <svg class="svg-submenu" width="30" height="30" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M12.6 12L8.7 8.1q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l4.6 4.6q.15.15.213.325t.062.375q0 .2-.062.375t-.213.325l-4.6 4.6q-.275.275-.7.275t-.7-.275q-.275-.275-.275-.7t.275-.7z" />
                                        </svg>
                                    </button>
                                    <button id="audio-reciter" class="button-links" type="button">
                                        <svg width="30" height="30" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4m0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4" />
                                        </svg><span class="tooltip-text langDiv langDiv-en fontDiv fontDiv-s">Change
                                            Reciter</span>
                                        <span
                                            class="tooltip-text langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">قاری
                                            بدلیں</span>&nbsp;&nbsp;
                                        <svg class="svg-submenu" width="30" height="30" viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="M12.6 12L8.7 8.1q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l4.6 4.6q.15.15.213.325t.062.375q0 .2-.062.375t-.213.325l-4.6 4.6q-.275.275-.7.275t-.7-.275q-.275-.275-.275-.7t.275-.7z" />
                                        </svg>
                                    </button>
                                    <div class="volume-div flex-row">
                                        <input type="range" id="volume-slider" title="Audio Volume" max="100"
                                            value="100">
                                        <div class="volume-details fontDiv fontDiv-s" id="volume-value">100</div>
                                        <div class="volume-details">
                                            <span
                                                class="tooltip-text langDiv langDiv-en fontDiv fontDiv-s">Volume</span>
                                            <span
                                                class="tooltip-text langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">آواز</span>
                                        </div>
                                        <div class="volume-details">
                                            <button class="button-links" id="volume-mute" type="button"
                                                title="Mute Audio">
                                                <svg width="30" height="30" viewBox="0 0 24 24">
                                                    <path id="volume-sound-path" fill="currentColor"
                                                        d="M19 11.975q0-2.075-1.1-3.787t-2.95-2.563q-.375-.175-.55-.537t-.05-.738q.15-.4.538-.575t.787 0Q18.1 4.85 19.55 7.063T21 11.974q0 2.7-1.45 4.913t-3.875 3.287q-.4.175-.788 0t-.537-.575q-.125-.375.05-.737t.55-.538q1.85-.85 2.95-2.562t1.1-3.788M7 15H4q-.425 0-.712-.288T3 14v-4q0-.425.288-.712T4 9h3l3.3-3.3q.475-.475 1.088-.213t.612.938v11.15q0 .675-.612.938T10.3 18.3zm9.5-3q0 1.05-.475 1.988t-1.25 1.537q-.25.15-.513.013T14 15.1V8.85q0-.3.263-.437t.512.012q.775.625 1.25 1.575t.475 2" />
                                                    <path id="volume-mute-path" class="hide" fill="currentColor"
                                                        d="M16.775 19.575q-.275.175-.55.325t-.575.275q-.375.175-.762 0t-.538-.575q-.15-.375.038-.737t.562-.538q.175-.075.325-.162t.3-.188L12 14.8v2.775q0 .675-.612.938T10.3 18.3L7 15H4q-.425 0-.712-.288T3 14v-4q0-.425.288-.712T4 9h2.2L2.1 4.9q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l17 17q.275.275.275.7t-.275.7q-.275.275-.7.275t-.7-.275zM19.6 16.8l-1.45-1.45q.425-.775.638-1.625t.212-1.75q0-2.075-1.1-3.787t-2.95-2.563q-.375-.175-.55-.537t-.05-.738q.15-.4.538-.575t.787 0Q18.1 4.85 19.55 7.05T21 11.975q0 1.325-.363 2.55T19.6 16.8m-3.35-3.35L14 11.2V8.85q0-.3.263-.437t.512.012Q15.6 8.95 16.05 10t.45 2q0 .375-.063.738t-.187.712M12 9.2L9.4 6.6l.9-.9q.475-.475 1.088-.213t.612.938z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- <button id="audio-prev-ayah" class="button-links tooltip" type="button"
                                    title="Button to play previous ayah">
                                    <svg width="30" height="30" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="m20.341 4.247l-8 7a1 1 0 0 0 0 1.506l8 7c.647.565 1.659.106 1.659-.753V5c0-.86-1.012-1.318-1.659-.753m-11 0l-8 7a1 1 0 0 0 0 1.506l8 7C9.988 20.318 11 19.859 11 19V5c0-.86-1.012-1.318-1.659-.753" />
                                    </svg>
                                    <span class="tooltip-text langDiv langDiv-en">Previous Ayah</span>
                                    <span class="tooltip-text langDiv langDiv-ur urdu-text hide-imp">پچھلی آیت</span>
                                </button> -->
                                <button id="audio-play-pause" class="button-links tooltip" type="button"
                                    title="Button to play or pause audio">
                                    <svg width="30" height="30" viewBox="0 0 24 24">
                                        <path id="audio-play-path" fill="currentColor"
                                            d="M6 4v16a1 1 0 0 0 1.524.852l13-8a1 1 0 0 0 0-1.704l-13-8A1 1 0 0 0 6 4" />
                                        <path id="audio-pause-path" class="hide" fill="currentColor"
                                            d="M9 4H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2m8 0h-2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2" />
                                    </svg>
                                    <span class="tooltip-text langDiv langDiv-en">Play/Pause</span>
                                    <span class="tooltip-text langDiv langDiv-ur urdu-text hide-imp">چلائیں/روکیں</span>
                                </button>
                                <!-- <button id="audio-next-ayah" class="button-links tooltip" type="button"
                                    title="Button to play next ayah">
                                    <svg width="30" height="30" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M2 5v14c0 .86 1.012 1.318 1.659.753l8-7a1 1 0 0 0 0-1.506l-8-7C3.012 3.682 2 4.141 2 5m11 0v14c0 .86 1.012 1.318 1.659.753l8-7a1 1 0 0 0 0-1.506l-8-7C14.012 3.682 13 4.141 13 5" />
                                    </svg>
                                    <span class="tooltip-text langDiv langDiv-en">Next Ayah</span>
                                    <span class="tooltip-text langDiv langDiv-ur urdu-text hide-imp">اگلی آیت</span>
                                </button> -->
                                <button id="audio-close" class="button-links tooltip" type="button"
                                    title="Button to close audio player">
                                    <svg width="30" height="30" viewBox="0 0 1024 1024">
                                        <path fill="currentColor"
                                            d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504L738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512L828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496L285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512L195.2 285.696a64 64 0 0 1 0-90.496" />
                                    </svg>
                                    <span class="tooltip-text langDiv langDiv-en">Close Player</span>
                                    <span class="tooltip-text langDiv langDiv-ur urdu-text hide-imp">آڈیو پلیئر بند
                                        کریں</span>
                                </button>
                                <div class="audio-more-submenu no-opacity" id="audio-play-speed-menu">
                                    <button value="0.25" class="button-links" type="button">
                                        <span class="fontDiv fontDiv-s">0.25x</span>
                                    </button>
                                    <button value="0.5" class="button-links" type="button">
                                        <span class="fontDiv fontDiv-s">0.5x</span>
                                    </button>
                                    <button value="0.75" class="button-links" type="button">
                                        <span class="fontDiv fontDiv-s">0.75x</span>
                                    </button>
                                    <button value="1" class="button-links" type="button">
                                        <span class="audio-more-submenu__checked fontDiv fontDiv-s">Normal</span>
                                    </button>
                                    <button value="1.25" class="button-links" type="button">
                                        <span class="fontDiv fontDiv-s">1.25x</span>
                                    </button>
                                    <button value="1.5" class="button-links" type="button">
                                        <span class="fontDiv fontDiv-s">1.5x</span>
                                    </button>
                                    <button value="1.75" class="button-links" type="button">
                                        <span class="fontDiv fontDiv-s">1.75x</span>
                                    </button>
                                    <button value="2" class="button-links" type="button">
                                        <span class="fontDiv fontDiv-s">2x</span>
                                    </button>
                                </div>
                                <div class="audio-more-submenu no-opacity" id="audio-reciter-menu">
                                    <button value="audio-mishari" class="button-links" type="button">
                                        <span class="audio-more-submenu__checked fontDiv fontDiv-s">Mishari Rashid
                                            al-Afasy</span>
                                    </button>
                                    <button value="audio-sudais" class="button-links" type="button">
                                        <span class="fontDiv fontDiv-s">Abdul Rahman as-Sudais</span>
                                    </button>
                                    <button value="audio-abdulbasit-mujawwad" class="button-links" type="button">
                                        <span class="fontDiv fontDiv-s">Abdul Basit Abdus-Samad (Mujawwad)</span>
                                    </button>
                                    <button value="audio-abdulbasit-murattal" class="button-links" type="button">
                                        <span class="fontDiv fontDiv-s">Abdul Basit Abdus-Samad (Murattal)</span>
                                    </button>
                                    <button value="audio-shuraim" class="button-links" type="button">
                                        <span class="fontDiv fontDiv-s">Saud al-Shuraim</span>
                                    </button>
                                    <button value="audio-hussary" class="button-links" type="button">
                                        <span class="fontDiv fontDiv-s">Mahmoud Khalil al-Hussary</span>
                                    </button>
                                </div>
                            </div>
                            <div id="audio-total-time" class="fontDiv fontDiv-m">00:00</div>
                        </div>
                    </div>
                </div>

                <?php
                $stmt = $conn->prepare("SELECT * FROM quran WHERE surah_num = ?");
                $stmt->bind_param("i", $surahID);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                ?>

                <div class="tab container container-without-pad-bg quran-surah-tabs">
                    <input class="tab__input" type="radio" name="tab-quran-surah" id="tab-surah-arabic" />
                    <label class="tab__label" for="tab-surah-arabic">
                        <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Arabic</h4>
                        <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">عربی</h4>
                    </label>
                    <div class="tab__content">
                        <article class="container less-width lesser-width">
                            <p class="quran-text justify fontDiv fontDiv-ml">
                                <?php
                                function arabic_w2e($str) {
                                    $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
                                    $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                                    return str_replace($arabic_western, $arabic_eastern, $str);
                                }
                                $previousRow = null;
                                $row = $result->fetch_assoc();
                                $counter = htmlspecialchars($row['page_num']);
                                $result->data_seek(0);
                                while ($row = $result->fetch_assoc()) {
                                    $ayahID = htmlspecialchars($row['ayah_num_surah']);
                                    $ayahArabic = htmlspecialchars($row['ayah_ar']);
                                    $pageNumber = htmlspecialchars($row['page_num']);
                                    $sajdah = htmlspecialchars($row['sajdah_ayah']);
                                    $ayahIDArabic = arabic_w2e($ayahID);
                                    if ($counter != $pageNumber) {
                                        $manzil = $previousRow['manzil_num'];
                                        $juz = $previousRow['juz_num'];
                                        echo "</p> <div class=\"surah-numberings flex-row fontDiv fontDiv-m\">";
                                        echo "<p>منزل " . $manzil . "</p> <p>" . $counter . "</p> <p>جز " . $juz . "</p>";
                                        echo "</div> </article> <article class=\"container less-width lesser-width\">";
                                        echo "<p class=\"quran-text justify\">";
                                        $counter++;
                                    }
                                    echo $ayahArabic;
                                    if ($sajdah == 1) {
                                        echo "<span class=\"ayah-sajdah\"></span>";
                                    }
                                    echo "<span class=\"ayah-symbol\">" . $ayahIDArabic . "</span>";
                                    $previousRow = $row;
                                }
                                $manzil = $previousRow['manzil_num'];
                                $juz = $previousRow['juz_num'];
                                echo "</p> <div class=\"surah-numberings flex-row fontDiv fontDiv-m\">";
                                echo "<p>منزل " . $manzil . "</p> <p>" . $counter . "</p> <p>جز " . $juz . "</p> </div>";
                                $result->data_seek(0);
                                ?>
                            </p>
                        </article>
                    </div>

                    <input class="tab__input" type="radio" name="tab-quran-surah" id="tab-surah-classic"
                        checked="checked" />
                    <label class="tab__label" for="tab-surah-classic">
                        <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Classic</h4>
                        <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">کلاسک</h4>
                    </label>
                    <div class="tab__content">
                        <div class="flex-column">
                            <?php while ($row = $result->fetch_assoc()):
                                $ayahID = htmlspecialchars($row['ayah_num_surah']);
                                $ayahArabic = htmlspecialchars($row['ayah_ar']);
                                $sajdah = htmlspecialchars($row['sajdah_ayah']);
                                $enMustafaKhattab = htmlspecialchars($row['en_mustafa_khattab']);
                                $enHilaliMuhsin = htmlspecialchars($row['en_hilali_muhsin']);
                                $enMaududi = htmlspecialchars($row['en_maududi']);
                                $enMubarakpuri = htmlspecialchars($row['en_mubarakpuri']);
                                $enSaheeh = htmlspecialchars($row['en_saheeh']);
                                $enYusufAli = htmlspecialchars($row['en_yusuf_ali']);
                                $urMaududi = htmlspecialchars($row['ur_maududi']);
                                $urJunagarhi = htmlspecialchars($row['ur_junagarhi']);
                                $urJalandhry = htmlspecialchars($row['ur_jalandhry']);
                                $ayahIDArabic = arabic_w2e($ayahID);
                                ?>
                                <article class="container scrollable-element" id="<?php echo $ayahID ?>">
                                    <div class="surah-container-classic">
                                        <p class="quran-text fontDiv fontDiv-ml">
                                            <?php echo $ayahArabic ?>
                                            <?php
                                            if ($sajdah == 1) {
                                                echo "<span class=\"ayah-sajdah\"></span>";
                                            } ?>
                                            <span class="ayah-symbol">
                                                <?php echo $ayahIDArabic ?>
                                            </span>
                                        </p>
                                        <p class="english-text en_mustafa_khattab hide fontDiv fontDiv-m">
                                            <?php echo $enMustafaKhattab ?>
                                            <span>- Dr. Mustafa Khattab, the Clear Quran</span>
                                        </p>
                                        <p class="english-text en_hilali_muhsin hide fontDiv fontDiv-m">
                                            <?php echo $enHilaliMuhsin ?>
                                            <span>- Taqi-ud-Din al-Hilali & Muhsin Khan, the Noble Quran</span>
                                        </p>
                                        <p class="english-text en_saheeh hide fontDiv fontDiv-m">
                                            <?php echo $enSaheeh ?>
                                            <span>- Saheeh International</span>
                                        </p>
                                        <p class="english-text en_maududi hide fontDiv fontDiv-m">
                                            <?php echo $enMaududi ?>
                                            <span>- Abul Ala Maududi, Tafheem-ul-Quran</span>
                                        </p>
                                        <p class="english-text en_mubarakpuri hide fontDiv fontDiv-m">
                                            <?php echo $enMubarakpuri ?>
                                            <span>- Safiur Rahman Mubarakpuri</span>
                                        </p>
                                        <p class="english-text en_yusuf_ali hide fontDiv fontDiv-m">
                                            <?php echo $enYusufAli ?>
                                            <span>- Abdullah Yusuf Ali</span>
                                        </p>
                                        <p class="urdu-text ur_maududi hide fontDiv fontDiv-ml">
                                            <?php echo $urMaududi ?> ۔
                                            <span>- ابوالاعلیٰ مودودی، تفہیم القرآن</span>
                                        </p>
                                        <p class="urdu-text ur_junagarhi hide fontDiv fontDiv-ml">
                                            <?php echo $urJunagarhi ?> ۔
                                            <span>- محمد جوناگڑھی</span>
                                        </p>
                                        <p class="urdu-text ur_jalandhry hide fontDiv fontDiv-ml">
                                            <?php echo $urJalandhry ?> ۔
                                            <span>- فتح محمد جالندہری</span>
                                        </p>
                                    </div>
                                    <div class="container__icons flex-row">
                                        <div class="container__icons-left flex-row">
                                            <span>
                                                <?php echo $surahID . ":" . $ayahID ?>
                                            </span>
                                            <!-- <button class="button-links flex-row tooltip" type="button"
                                                aria-label="Play Ayat as Audio Button">
                                                <svg width="30" height="30" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="m9.5 16.5l7-4.5l-7-4.5zM12 22q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22" />
                                                </svg>
                                                <span class="tooltip-text langDiv langDiv-en">Play Ayah Audio</span>
                                                <span class="tooltip-text langDiv langDiv-ur urdu-text hide-imp">آیت آڈیو
                                                    میں
                                                    چلائیں</span>
                                            </button> -->
                                            <button class="ayat-tafseer-button button-links flex-row tooltip" type="button"
                                                aria-label="See Tafseer of Ayat Button" aria-expanded="false">
                                                <svg class="disable-clicks" width="30" height="30" viewBox="0 0 256 256">
                                                    <path class="disable-clicks" fill="currentColor"
                                                        d="M224 48h-56a32 32 0 0 0-32 32v88a8 8 0 0 1-16 0V80a32 32 0 0 0-32-32H32a16 16 0 0 0-16 16v128a16 16 0 0 0 16 16h64a24 24 0 0 1 24 24a8 8 0 0 0 16 0a24 24 0 0 1 24-24h64a16 16 0 0 0 16-16V64a16 16 0 0 0-16-16m-16 120h-40a8 8 0 0 1 0-16h40a8 8 0 0 1 0 16m0-32h-40a8 8 0 0 1 0-16h40a8 8 0 0 1 0 16m0-32h-40a8 8 0 0 1 0-16h40a8 8 0 0 1 0 16" />
                                                </svg>
                                                <span class="tooltip-text langDiv langDiv-en">See Ayat Tafseer</span>
                                                <span class="tooltip-text langDiv langDiv-ur urdu-text hide-imp">آیت کی
                                                    تفسیر
                                                    دیکھیں</span>
                                            </button>
                                            <div
                                                class="ayat-tafseer-menu surah-popup-menu pop-up-menu less-width no-opacity">
                                                <button class="ayat-tafseer-close-button settings-sidebar-close-button"
                                                    type="button" aria-label="Button to close Quran Surah tafseer menu">
                                                    <svg width="30" height="30" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                            d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22" />
                                                    </svg>
                                                </button>
                                                <input type="hidden" value="<?php echo $ayahID ?>">
                                                <input type="hidden" value="<?php echo $surahID ?>">
                                                <h3 class="langDiv langDiv-en fontDiv fontDiv-l">
                                                    <?php echo $surahNameEn . " " . $surahID . ":" . $ayahID ?>
                                                </h3>
                                                <h3 class="langDiv langDiv-ur arabic-text hide-imp fontDiv fontDiv-l">
                                                    <?php echo $surahNameAr . " " . $ayahID . ":" . $surahID ?>
                                                </h3>
                                                <div class="tafseer-selection">
                                                    <label class="tafseer-selection__label"
                                                        for="tafseer-selection-<?php echo $ayahID ?>">
                                                        <span class="langDiv langDiv-en fontDiv fontDiv-m">Selected
                                                            Tafseer:</span>
                                                        <span
                                                            class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">منتخب
                                                            شدہ تفسیر:</span></label>
                                                    <select class="tafseer-selection__select fontDiv fontDiv-m"
                                                        id="tafseer-selection-<?php echo $ayahID ?>"
                                                        name="tafseer-selection-<?php echo $ayahID ?>">
                                                        <option value="en_tafseer_test_1">Tafseer ibn Kathir</option>
                                                        <option value="en_tafseer_test_2">Tafsir Maarif ul Quran</option>
                                                        <option value="ur_tafseer_test_1">تفسیر ابن کثیر</option>
                                                        <option value="video_tafseer_test_1">Video Tafseer</option>
                                                    </select>
                                                </div>
                                                <div id="ayah-<?php echo $ayahID ?>-tafseer-output"
                                                    class="fontDiv fontDiv-m">
                                                </div>
                                            </div>
                                        </div>
                                        <button class="container__icons-right button-links flex-row tooltip" type="button"
                                            aria-label="Other Ayah Options Button">
                                            <svg width="30" height="30" viewBox="0 0 256 256">
                                                <path fill="currentColor"
                                                    d="M144 128a16 16 0 1 1-16-16a16 16 0 0 1 16 16m-84-16a16 16 0 1 0 16 16a16 16 0 0 0-16-16m136 0a16 16 0 1 0 16 16a16 16 0 0 0-16-16" />
                                            </svg>
                                            <span class="tooltip-text tooltip-text-side langDiv langDiv-en">Other
                                                Options</span>
                                            <span
                                                class="tooltip-text tooltip-text-side langDiv langDiv-ur urdu-text hide-imp">مزید
                                                آپشنز</span>
                                        </button>
                                    </div>
                                </article>
                            <?php endwhile;
                            $result->data_seek(0);
                            ?>
                        </div>
                    </div>

                    <input class="tab__input" type="radio" name="tab-quran-surah" id="tab-surah-translation" />
                    <label class="tab__label" for="tab-surah-translation">
                        <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Translation</h4>
                        <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">ترجمہ</h4>
                    </label>
                    <div class="tab__content">
                        <article class="container less-width surah-container-translation english-text justify">
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                $ayahID = htmlspecialchars($row['ayah_num_surah']);
                                $enMustafaKhattab = htmlspecialchars($row['en_mustafa_khattab']);
                                $enHilaliMuhsin = htmlspecialchars($row['en_hilali_muhsin']);
                                $enSaheeh = htmlspecialchars($row['en_saheeh']);
                                $enMaududi = htmlspecialchars($row['en_maududi']);
                                $enMubarakpuri = htmlspecialchars($row['en_mubarakpuri']);
                                $enYusufAli = htmlspecialchars($row['en_yusuf_ali']);
                                $urMaududi = htmlspecialchars($row['ur_maududi']);
                                $urJunagarhi = htmlspecialchars($row['ur_junagarhi']);
                                $urJalandhry = htmlspecialchars($row['ur_jalandhry']);
                                echo "<p class=\"tr-en_mustafa_khattab english-text hide fontDiv fontDiv-m\"><span class=\"hover-color\">" . $ayahID . ": </span>" . $enMustafaKhattab . "</p>";
                                echo "<p class=\"tr-en_hilali_muhsin english-text hide fontDiv fontDiv-m\"><span class=\"hover-color\">" . $ayahID . ": </span>" . $enHilaliMuhsin . "</p>";
                                echo "<p class=\"tr-en_saheeh english-text hide fontDiv fontDiv-m\"><span class=\"hover-color\">" . $ayahID . ": </span>" . $enSaheeh . "</p>";
                                echo "<p class=\"tr-en_maududi english-text hide fontDiv fontDiv-m\"><span class=\"hover-color\">" . $ayahID . ": </span>" . $enMaududi . "</p>";
                                echo "<p class=\"tr-en_mubarakpuri english-text hide fontDiv fontDiv-m\"><span class=\"hover-color\">" . $ayahID . ": </span>" . $enMubarakpuri . "</p>";
                                echo "<p class=\"tr-en_yusuf_ali english-text hide fontDiv fontDiv-m\"><span class=\"hover-color\">" . $ayahID . ": </span>" . $enYusufAli . "</p>";
                                echo "<p class=\"tr-ur_maududi urdu-text hide fontDiv fontDiv-ml\"><span class=\"hover-color\">" . $ayahID . ": </span>" . $urMaududi . " ۔</p>";
                                echo "<p class=\"tr-ur_junagarhi urdu-text hide fontDiv fontDiv-ml\"><span class=\"hover-color\">" . $ayahID . ": </span>" . $urJunagarhi . " ۔</p>";
                                echo "<p class=\"tr-ur_jalandhry urdu-text hide fontDiv fontDiv-ml\"><span class=\"hover-color\">" . $ayahID . ": </span>" . $urJalandhry . " ۔</p>";
                            }
                            ?>
                        </article>
                    </div>
                    <?php
                    $prevSurah = $surahID - 1;
                    $nextSurah = $surahID + 1;
                    ?>
                    <article class="container container-without-pad-bg">
                        <form action="" method="get" class="quran-list prev-next" id="surah-next-prev-form-1">
                            <a href="<?php echo BASE_URL . "quran/surah.php?surahID=" . $prevSurah ?>" class="quran-surah
                        <?php if ($prevSurah == 0)
                            echo "disable-clicks less-opacity\" tabindex=\"-1" ?>">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-s">Previous Surah</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">پچھلی
                                        سورۃ</span></a>
                                <a href="<?php echo BASE_URL . "quran/surah.php?surahID=" . $nextSurah ?>" class="quran-surah
                        <?php if ($nextSurah == 115)
                            echo "disable-clicks less-opacity\" tabindex=\"-1" ?>">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-s">Next Surah</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">اگلی
                                        سورۃ</span></a>
                            </form>
                        </article>
                    </div>
                    <article class="container container-without-pad-bg">
                        <form action="" method="get" class="quran-list prev-next" id="surah-next-prev-form-2">
                            <a href="<?php echo BASE_URL . "quran/surah.php?surahID=" . $prevSurah ?>" class="quran-surah
                    <?php if ($prevSurah == 0)
                        echo "disable-clicks less-opacity\" tabindex=\"-1" ?>">
                                <span class="langDiv langDiv-en fontDiv fontDiv-s">Previous Surah</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">پچھلی سورۃ</span></a>
                            <a href="<?php echo BASE_URL . "quran/surah.php?surahID=" . $nextSurah ?>" class="quran-surah
                    <?php if ($nextSurah == 115)
                        echo "disable-clicks less-opacity\" tabindex=\"-1" ?>">
                                <span class="langDiv langDiv-en fontDiv fontDiv-s">Next Surah</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">اگلی سورۃ</span></a>
                        </form>
                    </article>
                </div>
            </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
    <script src="<?php echo BASE_URL ?>script-quran.js"></script>
</body>

</html>