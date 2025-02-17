<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';

$bookID = htmlspecialchars($_GET["hadithBookID"]);
$bookLink = htmlspecialchars($_GET["hadithBookName"]);
$stmt = $conn->prepare("SELECT * FROM hadithbook_list WHERE hadithbook_id = ?");
$stmt->bind_param("i", $bookID);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$row = $result->fetch_assoc();

$bookNameEn = htmlspecialchars($row['hadithbook_name_en']);
$bookNameUr = htmlspecialchars($row['hadithbook_name_ur']);
$bookAuthorEn = htmlspecialchars($row['hadithbook_author_en']);
$bookAuthorUr = htmlspecialchars($row['hadithbook_author_ur']);
$bookTranslators = htmlspecialchars($row['hadithbook_translators']);
$bookCount = htmlspecialchars($row['hadithbook_count']);
$bookPublisher = htmlspecialchars($row['hadithbook_publisher']);
$bookDescriptionEn = htmlspecialchars($row['hadithbook_desc_en']);
$bookDescriptionUr = htmlspecialchars($row['hadithbook_desc_ur']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Hadith book <?php echo $bookNameEn ?> in Maktaba tul Ahadith">
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

                <?php
                $tableExists = true;
                $tableName = str_replace("-", "_", $bookLink);
                $fullTableName = "hadith_" . $tableName . "_index";
                try {
                    $stmt = "SELECT * FROM $fullTableName";
                    $result = $conn->query($stmt);
                } catch (Exception $e) {
                    echo '<p> Book to be added yet! </p>';
                    $tableExists = false;
                }
                if ($tableExists) {
                    $row = $result->fetch_assoc();
                    $indexID = htmlspecialchars($row['index_id']);
                    $kitabID = htmlspecialchars($row['kitab_id']);
                    $baabID = htmlspecialchars($row['baab_id']);
                    $kitabAr = htmlspecialchars($row['kitab_ar']);
                    $kitabEn = htmlspecialchars($row['kitab_en']);
                    $kitabUr = htmlspecialchars($row['kitab_ur']);
                    $baabAr = htmlspecialchars($row['baab_ar']);
                    $kitabRangeUp = htmlspecialchars($row['kitab_range_up']);
                    $kitabRangeDown = htmlspecialchars($row['kitab_range_down']);
                    $baabRangeUp = htmlspecialchars($row['baab_range_up']);
                    $baabRangeDown = htmlspecialchars($row['baab_range_down']);
                    ?>

                    <article class="container container-without-pad-bg book-details">
                        <p class="langDiv langDiv-en fontDiv fontDiv-m"><span>Author: </span>
                            <?php echo $bookAuthorEn ?>
                        </p>
                        <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml"><span>مصنف: </span>
                            <?php echo $bookAuthorUr ?>
                        </p>
                        <p>
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">Translation: </span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">ترجمہ: </span>
                            <span id="translator-info" class="fontDiv fontDiv-m"></span>
                        </p>
                        <p>
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">Total Ahadith: </span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">کل احادیث: </span>
                            <span class="fontDiv fontDiv-m">
                                <?php echo $bookCount ?>
                            </span>
                        </p>
                        <div class="book-description-download">
                            <details class="accordion book-description"
                                aria-label="Accordion to open/close book description">
                                <summary class="accordion__heading book-description__heading">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">Book Description</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">کتاب کے بارے
                                        میں</span>
                                </summary>
                                <div class="accordion__content book-description__content less-width">
                                    <p class="langDiv langDiv-en english-text fontDiv fontDiv-m">
                                        <?php echo nl2br($bookDescriptionEn) ?>
                                    </p>
                                    <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">
                                        <?php echo nl2br($bookDescriptionUr) ?>
                                    </p>
                                </div>
                            </details>
                            <a href="<?php echo BASE_URL ?>download.php?file=pdfs/<?php echo $bookLink ?>.zip"
                                class="button-type-1 hover-effect button-download"
                                aria-label="Button link to start book PDF download">
                                <span class="langDiv langDiv-en fontDiv fontDiv-s">Download Book PDF</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">کتاب ڈاؤن لوڈ
                                    کریں</span></a>
                        </div>
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
                            <div class="book-details__input flex-row">
                                <label class="book-details__input-label" for="hadithNumber">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-s">ؑEnter Hadith Number:</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">حدیث نمبر
                                        ڈالیں:</span>
                                </label>
                                <form
                                    action="<?php echo BASE_URL . htmlspecialchars('hadith/hadith-book-content-single.php') ?>"
                                    class="book-details__input-form search-bar">
                                    <input type="hidden" name="hadithBookName" value="<?php echo $bookLink ?>">
                                    <input type="number" min="1" max="520<?php /* echo $bookCount */ ?>"
                                        placeholder="1 to <?php echo $bookCount ?>" id="hadithNumber" name="hadithNumber">
                                    <button type="submit" aria-label="Hadith Number Search Button">
                                        <svg class="svg-hero-search" width="30" height="30" viewBox="0 0 256 256">
                                            <path
                                                d="m229.66 218.34l-50.07-50.06a88.11 88.11 0 1 0-11.31 11.31l50.06 50.07a8 8 0 0 0 11.32-11.32ZM40 112a72 72 0 1 1 72 72a72.08 72.08 0 0 1-72-72Z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>

                    <div class="hadith-index-language">
                        <span class="langDiv langDiv-en fontDiv fontDiv-m">ٰIndex Language</span>
                        <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">انڈیکس کی زبان</span>
                        <label for="en">
                            <input type="radio" name="index-language" id="en">
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">English</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">انگریزی</span>
                        </label>
                        <label for="ur">
                            <input type="radio" name="index-language" id="ur">
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">Urdu</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">اردو</span>
                        </label>
                    </div>

                    <article class="container">

                        <details class="accordion book-index"
                            aria-label="<?php echo $bookNameEn ?> Kitab/Book 1 and its Baab/Chapters">
                            <summary class="accordion__heading book-index__kitab">
                                <div class="book-index__kitab-number fontDiv fontDiv-m">
                                    <?php echo $kitabID ?>
                                </div>
                                <div class="book-index__kitab-arabic arabic-text fontDiv fontDiv-ml">
                                    <?php echo $kitabAr ?>
                                </div>
                                <div class="book-index__kitab-eng fontDiv fontDiv-m">
                                    <?php echo $kitabEn ?>
                                </div>
                                <div class="book-index__kitab-urdu urdu-text fontDiv fontDiv-ml">
                                    <?php echo $kitabUr ?>
                                </div>
                                <div class="book-index__kitab-range hide fontDiv fontDiv-m">
                                    <?php echo $kitabRangeUp ?> to
                                    <?php echo $kitabRangeDown ?>
                                </div>
                            </summary>
                            <div class="accordion__content book-index__baab">
                                <a href="<?php echo BASE_URL ?>/hadith/hadith-book-content-chapter.php?hadithBookName=<?php echo $bookLink ?>&indexID=<?php echo $indexID ?>"
                                    class="book-index__baab-container">
                                    <div class="book-index__baab-number fontDiv fontDiv-m">
                                        <?php echo $baabID ?>.
                                    </div>
                                    <div class="book-index__baab-arabic arabic-text fontDiv fontDiv-ml">
                                        <?php echo $baabAr ?>
                                    </div>
                                    <div class="book-index__baab-range hide fontDiv fontDiv-m">
                                        <?php
                                        if ($baabRangeUp == 0) {
                                            echo "-";
                                        } else {
                                            echo $baabRangeUp . " to " . $baabRangeDown;
                                        } ?>
                                    </div>
                                </a>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    $indexID = htmlspecialchars($row['index_id']);
                                    $kitabID = htmlspecialchars($row['kitab_id']);
                                    $baabID = htmlspecialchars($row['baab_id']);
                                    $kitabAr = htmlspecialchars($row['kitab_ar']);
                                    $kitabEn = htmlspecialchars($row['kitab_en']);
                                    $kitabUr = htmlspecialchars($row['kitab_ur']);
                                    $baabAr = htmlspecialchars($row['baab_ar']);
                                    $kitabRangeUp = htmlspecialchars($row['kitab_range_up']);
                                    $kitabRangeDown = htmlspecialchars($row['kitab_range_down']);
                                    $baabRangeUp = htmlspecialchars($row['baab_range_up']);
                                    $baabRangeDown = htmlspecialchars($row['baab_range_down']);
                                    if ($baabID == '1') {
                                        echo "</div> </details> <details class=\"accordion book-index\" aria-label=\"" . $bookNameEn;
                                        echo " Kitab/Book " . $kitabID . " and its Baab/Chapters\">";
                                        echo "<summary class=\"accordion__heading book-index__kitab\">";
                                        echo "<div class=\"book-index__kitab-number fontDiv fontDiv-m\">" . $kitabID . "</div>";
                                        echo "<div class=\"book-index__kitab-arabic arabic-text fontDiv fontDiv-ml\">" . $kitabAr . "</div>";
                                        echo "<div class=\"book-index__kitab-eng fontDiv fontDiv-m\">" . $kitabEn . "</div>";
                                        echo "<div class=\"book-index__kitab-urdu urdu-text fontDiv fontDiv-ml\">" . $kitabUr . "</div>";
                                        echo "<div class=\"book-index__kitab-range hide fontDiv fontDiv-m\">" . $kitabRangeUp . " to " . $kitabRangeDown . "</div>";
                                        echo "</summary> <div class=\"accordion__content book-index__baab\">";
                                        echo "<a href=\"" . BASE_URL . "/hadith/hadith-book-content-chapter.php?hadithBookName=" . $bookLink . "&indexID=" . $indexID;
                                        echo "\" class=\"book-index__baab-container\">";
                                        echo "<div class=\"book-index__baab-number fontDiv fontDiv-m\">" . $baabID . ".</div>";
                                        echo "<div class=\"book-index__baab-arabic arabic-text fontDiv fontDiv-ml\">" . $baabAr . "</div>";
                                        if ($baabRangeUp == 0) {
                                            echo "<div class=\"book-index__baab-range hide fontDiv fontDiv-m\">-</div> </a>";
                                        } else {
                                            echo "<div class=\"book-index__baab-range hide fontDiv fontDiv-m\">" . $baabRangeUp . " to " . $baabRangeDown . "</div> </a>";
                                        }
                                    } else {
                                        echo "<a href=\"" . BASE_URL . "/hadith/hadith-book-content-chapter.php?hadithBookName=" . $bookLink . "&indexID=" . $indexID;
                                        echo "\" class=\"book-index__baab-container\">";
                                        echo "<div class=\"book-index__baab-number fontDiv fontDiv-m\">" . $baabID . ".</div>";
                                        echo "<div class=\"book-index__baab-arabic arabic-text fontDiv fontDiv-ml\">" . $baabAr . "</div>";
                                        if ($baabRangeUp == 0) {
                                            echo "<div class=\"book-index__baab-range hide fontDiv fontDiv-m\">-</div> </a>";
                                        } else {
                                            echo "<div class=\"book-index__baab-range hide fontDiv fontDiv-m\">" . $baabRangeUp . " to " . $baabRangeDown . "</div> </a>";
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </details>

                    </article>

                <?php } ?>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
    <script src="<?php echo BASE_URL ?>script-hadith.js"></script>
</body>

</html>