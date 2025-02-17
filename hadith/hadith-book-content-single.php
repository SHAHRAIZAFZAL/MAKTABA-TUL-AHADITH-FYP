<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';

$bookLink = htmlspecialchars($_GET["hadithBookName"]);
$hadithID = htmlspecialchars($_GET["hadithNumber"]);

$stmt = $conn->prepare("SELECT * FROM hadithbook_list WHERE hadithbook_dashed = ?");
$stmt->bind_param("s", $bookLink);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$row = $result->fetch_assoc();
$bookNameEn = htmlspecialchars($row['hadithbook_name_en']);
$bookNameUr = htmlspecialchars($row['hadithbook_name_ur']);
$bookTranslators = htmlspecialchars($row['hadithbook_translators']);
$bookCount = htmlspecialchars($row['hadithbook_count']);

$tableName = str_replace("-", "_", $bookLink);
$fullTableName = "hadith_" . $tableName;
$stmt = $conn->prepare("SELECT * FROM $fullTableName WHERE hadith_id = ?");
$stmt->bind_param("i", $hadithID);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$hadithRow = $result->fetch_assoc();
$indexID = htmlspecialchars($hadithRow['index_id']);

$newTableName = $fullTableName . '_index';
$stmt = $conn->prepare("SELECT * FROM $newTableName WHERE index_id = ?");
$stmt->bind_param("i", $indexID);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$row = $result->fetch_assoc();
$kitabAr = htmlspecialchars($row['kitab_ar']);
$kitabEn = htmlspecialchars($row['kitab_en']);
$kitabUr = htmlspecialchars($row['kitab_ur']);
$baabAr = htmlspecialchars($row['baab_ar']);
$baabEn = htmlspecialchars($row['baab_en']);
$baabUr = htmlspecialchars($row['baab_ur']);

$result = $conn->query("SELECT MAX(hadith_id) as max_id FROM $fullTableName");
$row = $result->fetch_assoc();
$hadithCount = $row["max_id"];
$prevHadith = $hadithID - 1;
$nextHadith = $hadithID + 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Hadith/Ahadith content of <?php echo $bookNameEn ?>, in Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $bookNameEn ?> - مكتبة الأحاديث -
        <?php echo $bookNameUr ?>
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
                    <img class="container-major__book-img"
                        src="<?php echo BASE_URL ?>images/ahadith-images/<?php echo $bookLink ?>.webp"
                        alt="<?php echo $bookNameEn ?> Book Image" height="480" width="480"
                        title="<?php echo $bookNameEn ?> - <?php echo $bookNameUr ?>">
                    <h2 class="langDiv langDiv-en">
                        <?php echo $bookNameEn ?>
                    </h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">
                        <?php echo $bookNameUr ?>
                    </h2>
                    <img class="container-major__book-img"
                        src="<?php echo BASE_URL ?>images/ahadith-images/<?php echo $bookLink ?>.webp"
                        alt="<?php echo $bookNameEn ?> Book Image" height="480" width="480"
                        title="<?php echo $bookNameEn ?> - <?php echo $bookNameUr ?>">
                </article>

                <article class="container container-without-pad-bg">
                    <div>
                        <button type="button" aria-label="Button to change Hadith Settings" id="hadith-settings-button"
                            class="button-links book-details__settings">
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">Hadith Book Settings</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">حدیث کتاب کی
                                سیٹنگز</span>
                        </button>
                        <div class="settings-sidebar no-opacity">
                            <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Hadith Book Settings</h4>
                            <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">حدیث کتاب کی سیٹنگز</h4>
                            <button id="hadith-settings-close-button" class="settings-sidebar-close-button"
                                type="button" aria-label="Button to close Hadith settings">
                                <svg width="30" height="30" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                        d="m8.4 17l3.6-3.6l3.6 3.6l1.4-1.4l-3.6-3.6L17 8.4L15.6 7L12 10.6L8.4 7L7 8.4l3.6 3.6L7 15.6zm3.6 5q-2.075 0-3.9-.788t-3.175-2.137q-1.35-1.35-2.137-3.175T2 12q0-2.075.788-3.9t2.137-3.175q1.35-1.35 3.175-2.137T12 2q2.075 0 3.9.788t3.175 2.137q1.35 1.35 2.138 3.175T22 12q0 2.075-.788 3.9t-2.137 3.175q-1.35 1.35-3.175 2.138T12 22" />
                                </svg>
                            </button>
                            <form action="" class="quran-settings-form flex-column">
                                <p class="langDiv langDiv-en fontDiv fontDiv-m">
                                    <?php echo $bookNameEn ?> Translations
                                </p>
                                <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">
                                    <?php echo $bookNameUr ?> کے تراجم
                                </p>
                                <?php
                                $translatorArray = explode(", ", $bookTranslators);
                                $count = 0;
                                foreach ($translatorArray as $element) {
                                    $t = explode(": ", $element);
                                    $tName = $t[0];
                                    $tColumn = $t[1];
                                    echo '<label for="' . $tColumn . '" class="fontDiv fontDiv-m"> <input type="radio"';
                                    if ($count == 0) {
                                        echo " checked ";
                                    }
                                    echo 'value="' . $tColumn . '" id="' . $tColumn . '" name="translator">' . $tName . '</label>';
                                    ++$count;
                                }
                                ?>
                                <input type="hidden" name="<?php echo $bookLink ?>" value="<?php echo $count ?>">
                            </form>
                        </div>
                    </div>
                </article>

                <article class="container kitab-baab-detail">
                    <div class="arabic-text fontDiv fontDiv-ml">
                        <?php echo $kitabAr ?>&nbsp;-&nbsp;
                        <?php echo $baabAr ?>
                    </div>
                    <div class="chapterToShowHide english-text hide fontDiv fontDiv-m">
                        <?php echo $kitabEn ?>&nbsp;-&nbsp;
                        <?php echo $baabEn ?>
                    </div>
                    <div class="chapterToShowHide urdu-text hide fontDiv fontDiv-ml">
                        <?php echo $kitabUr ?>&nbsp;-&nbsp;
                        <?php echo $baabUr ?>
                    </div>
                </article>

                <article class="container container-without-pad-bg">
                    <form action="" method="get" class="quran-list prev-next">
                        <a href="<?php echo BASE_URL . "hadith/hadith-book-content-single.php?hadithBookName=" . $bookLink . "&hadithNumber=" . $prevHadith ?>"
                            class="quran-surah
                    <?php if ($prevHadith == 0)
                        echo "disable-clicks less-opacity\" tabindex=\"-1" ?>">
                                <span class="langDiv langDiv-en fontDiv fontDiv-s">Prev. Hadith</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">پچھلی حدیث</span></a>
                            <a href="<?php echo BASE_URL . "hadith/hadith-book-content-single.php?hadithBookName=" . $bookLink . "&hadithNumber=" . $nextHadith ?>"
                            class="quran-surah
                    <?php if ($nextHadith > $hadithCount)
                        echo "disable-clicks less-opacity\" tabindex=\"-1" ?>">
                                <span class="langDiv langDiv-en fontDiv fontDiv-s">Next Hadith</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">اگلی حدیث</span></a>
                        </form>
                    </article>

                    <?php
                    $hadithGrade = htmlspecialchars($hadithRow['hadith_grade']);
                    $hadithGradeNotes = htmlspecialchars($hadithRow['hadith_grade_notes']);
                    $hadithTakhreej = htmlspecialchars($hadithRow['hadith_takhreej']);
                    $hadithAr = htmlspecialchars($hadithRow['hadith_ar']);
                    $hadithTranslations = array();
                    echo '<article class="container"> <div class="container__divider">';
                    echo '<p class="arabic-text fontDiv fontDiv-ml"> <span class="hover-color numbering">' . $hadithID . ' - </span>' . nl2br($hadithAr) . '</p>';
                    foreach ($translatorArray as $element) {
                        $t = explode(": ", $element);
                        $hadithTranslations[$t[1]] = htmlspecialchars(($hadithRow[$t[1]]));
                        $firstTwoLetters = substr($t[1], 0, 2);
                        echo '<p class="divsToShowHide hide ' . $t[1];
                        if ($firstTwoLetters == 'en') {
                            echo ' english-text fontDiv fontDiv-m">';
                        } elseif ($firstTwoLetters == 'ur') {
                            echo ' urdu-text fontDiv fontDiv-ml">';
                        }
                        echo '<span class="hover-color numbering">' . $hadithID . ' - </span>' . nl2br($hadithTranslations[$t[1]]) . '</p>';
                    }
                    echo '</div> <div class="container__references arabic-text fontDiv fontDiv-m"> <details class="accordion container__references-takhreej">';
                    echo '<summary class="accordion__heading takhreej-heading">التخریج :</summary>';
                    echo '<div class="accordion__content takhreej-content">';
                    if ($hadithTakhreej) {
                        $takhreejArray = explode(", ", $hadithTakhreej);
                        foreach ($takhreejArray as $takhreej) {
                            $x = explode(": ", $takhreej);
                            echo '<a href="' . BASE_URL . 'hadith/hadith-book-content-single.php?hadithBookName=' . $x[2] . '&hadithNumber=' . $x[1];
                            echo '" target="_blank">' . $x[0] . " : " . $x[1] . '</a> - ';
                        }
                    }
                    echo '</div> </details> <details class="accordion container__references-takhreej">';
                    echo '<summary class="accordion__heading takhreej-heading">الحکم علی الحدیث : <span>' . $hadithGrade;
                    echo '</span> </summary> <div class="accordion__content takhreej-content">' . nl2br($hadithGradeNotes) . '</div> </details> </div> </article>';
                    ?>

                <article class="container container-without-pad-bg">
                    <form action="" method="get" class="quran-list prev-next">
                        <a href="<?php echo BASE_URL . "hadith/hadith-book-content-single.php?hadithBookName=" . $bookLink . "&hadithNumber=" . $prevHadith ?>"
                            class="quran-surah
                    <?php if ($prevHadith == 0)
                        echo "disable-clicks less-opacity\" tabindex=\"-1" ?>">
                                <span class="langDiv langDiv-en fontDiv fontDiv-s">Prev. Hadith</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">پچھلی حدیث</span></a>
                            <a href="<?php echo BASE_URL . "hadith/hadith-book-content-single.php?hadithBookName=" . $bookLink . "&hadithNumber=" . $nextHadith ?>"
                            class="quran-surah
                    <?php if ($nextHadith > $hadithCount)
                        echo "disable-clicks less-opacity\" tabindex=\"-1" ?>">
                                <span class="langDiv langDiv-en fontDiv fontDiv-s">Next Hadith</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">اگلی حدیث</span></a>
                        </form>
                    </article>

                </div>
            </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
    <script src="<?php echo BASE_URL ?>script-hadith.js"></script>
</body>

</html>