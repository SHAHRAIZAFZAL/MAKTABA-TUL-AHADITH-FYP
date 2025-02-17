<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Shahraiz Afzal">
    <meta name="description" content="Main/Home page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maktaba tul Ahadith - مكتبة الأحاديث</title>
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
            <div class="hero flex-column">
                <div class="hero__title">
                    <h1 class="langDiv langDiv-en fontDiv fontDiv-xl">Maktaba tul Ahadith</h1>
                    <h1 class="langDiv langDiv-ur arabic-text hide-imp fontDiv fontDiv-xxl">مكتبة الأحاديث</h1>
                </div>
                <div class="hero__text">
                    <p class="langDiv langDiv-en fontDiv fontDiv-s">
                        A comprehensive library of Islamic texts with modern features and utilities.
                    </p>
                    <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">
                        جدید خصوصیات اور افادیت کے ساتھ اسلامی نصوص کی ایک جامع لائبریری
                    </p>
                </div>
                <form action="<?php echo BASE_URL . htmlspecialchars('book-search-results.php') ?>"
                    class="hero__search-bar search-bar">
                    <input type="search" name="q" id="hero-book-search-input" autocomplete="off"
                        placeholder="Search book/author ...">
                    <button type="submit" aria-label="Hero Section Search Button">
                        <svg class="svg-hero-search" width="30" height="30" viewBox="0 0 256 256">
                            <path
                                d="m229.66 218.34l-50.07-50.06a88.11 88.11 0 1 0-11.31 11.31l50.06 50.07a8 8 0 0 0 11.32-11.32ZM40 112a72 72 0 1 1 72 72a72.08 72.08 0 0 1-72-72Z" />
                        </svg>
                    </button>
                    <div class="hero__search-results hide fontDiv fontDiv-s" id="ajax-search-results"></div>
                </form>
            </div>

            <div class="main">
                <article class="container">
                    <h3 class="langDiv langDiv-en fontDiv fontDiv-l">Ayat of the Day</h3>
                    <h3 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">آج کی آیت</h3>
                    <div class="container__divider">
                        <?php
                        $stmt = "SELECT MAX(ayah_id) AS max_id FROM quran";
                        $result = $conn->query($stmt);
                        $row = $result->fetch_assoc();
                        $maxID = $row['max_id'];
                        $randomNum = rand(1, $maxID);

                        $stmt = "SELECT surah_num, ayah_num_surah, ayah_ar, en_saheeh, ur_junagarhi FROM quran WHERE ayah_id = $randomNum";
                        $result = $conn->query($stmt);
                        $row = $result->fetch_assoc();
                        $surahNum = htmlspecialchars($row['surah_num']);
                        $ayahNum = htmlspecialchars($row['ayah_num_surah']);
                        function arabic_w2e($str) {
                            $arabic_eastern = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
                            $arabic_western = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
                            return str_replace($arabic_western, $arabic_eastern, $str);
                        }
                        ?>
                        <p class="quran-text fontDiv fontDiv-ml">
                            <?php
                            $ayahIDArabic = arabic_w2e($ayahNum);
                            echo htmlspecialchars($row['ayah_ar']);
                            echo "<span class=\"ayah-symbol\">" . $ayahIDArabic . "</span>";
                            ?>
                        </p>
                        <p class="langDiv langDiv-en english-text fontDiv fontDiv-m">
                            <?php echo htmlspecialchars($row['en_saheeh']) ?>
                        </p>
                        <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">
                            <?php echo htmlspecialchars($row['ur_junagarhi']) . ' ۔' ?>
                        </p>
                    </div>
                    <div class="container__references arabic-text fontDiv fontDiv-m">
                        <?php
                        $stmt = "SELECT surah_name_ar FROM surah_list WHERE surah_id = $surahNum";
                        $result = $conn->query($stmt);
                        $row = $result->fetch_assoc();
                        echo 'سورۃ ' . htmlspecialchars($row['surah_name_ar']) . ' - ' . $surahNum . ': ' . $ayahNum;
                        ?>
                    </div>
                </article>
                <article class="container">
                    <h3 class="langDiv langDiv-en fontDiv fontDiv-l">Hadith of the Day</h3>
                    <h3 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">آج کی حدیث</h3>
                    <div class="container__divider">
                        <?php
                        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'maktaba_tul_ahadith'
                    AND TABLE_NAME LIKE 'hadith_%' AND TABLE_NAME NOT LIKE '%_index' AND TABLE_NAME NOT LIKE '%_list'";
                        $tableResult = $conn->query($sql);
                        $tables = [];
                        while ($tableRow = $tableResult->fetch_assoc()) {
                            $tables[] = $tableRow['TABLE_NAME'];
                        }
                        $randomTable = $tables[array_rand($tables)];
                        $tableLink = substr($randomTable, 7);
                        $tableLink = str_replace('_', '-', $tableLink);

                        $stmt = "SELECT MAX(hadith_id) AS max_id FROM $randomTable";
                        $result = $conn->query($stmt);
                        $row = $result->fetch_assoc();
                        $maxID = $row['max_id'];
                        $randomNum = rand(1, $maxID);

                        $enColumn = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$randomTable'
                                AND COLUMN_NAME LIKE 'en_%' ORDER BY ORDINAL_POSITION LIMIT 1";
                        $result = $conn->query($enColumn);
                        $row = $result->fetch_assoc();
                        $enColumn = $row['COLUMN_NAME'];
                        $urColumn = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$randomTable'
                                AND COLUMN_NAME LIKE 'ur_%' ORDER BY ORDINAL_POSITION LIMIT 1";
                        $result = $conn->query($urColumn);
                        $row = $result->fetch_assoc();
                        $urColumn = $row['COLUMN_NAME'];

                        $stmt = "SELECT index_id, hadith_ar, $enColumn, $urColumn FROM $randomTable WHERE hadith_id = $randomNum";
                        $result = $conn->query($stmt);
                        $row = $result->fetch_assoc();
                        $indexID = htmlspecialchars($row['index_id']);
                        ?>
                        <p class="arabic-text fontDiv fontDiv-ml">
                            <?php echo htmlspecialchars($row['hadith_ar']) ?>
                        </p>
                        <p class="langDiv langDiv-en english-text fontDiv fontDiv-m">
                            <?php echo htmlspecialchars($row[$enColumn]) ?>
                        </p>
                        <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">
                            <?php echo htmlspecialchars($row[$urColumn]) ?>
                        </p>
                    </div>
                    <div class="container__references arabic-text fontDiv fontDiv-m">‌
                        <?php
                        $stmt = "SELECT hadithbook_name_ur FROM hadithbook_list WHERE hadithbook_dashed = '$tableLink'";
                        $result = $conn->query($stmt);
                        $row = $result->fetch_assoc();
                        $bookName = htmlspecialchars($row['hadithbook_name_ur']);

                        $randomTableIndex = $randomTable . '_index';
                        $stmt = "SELECT kitab_ar, baab_ar FROM $randomTableIndex WHERE index_id = $indexID";
                        $result = $conn->query($stmt);
                        $row = $result->fetch_assoc();
                        $kitab = htmlspecialchars($row['kitab_ar']);
                        $baab = htmlspecialchars($row['baab_ar']);
                        echo $bookName . ': ' . $kitab . ' (' . $baab . ') ح: ' . $randomNum;
                        ?>
                    </div>
                </article>
                <!-- <article class="container">
                <h3>Islamic Event</h3>
                <p class="english-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam
                    perferendis
                    voluptas ex soluta
                    saepe
                    dolores nisi consequatur fuga provident facere, pariatur possimus earum ab sit ipsa ea quam
                    necessitatibus nemo?</p>
                <p class="urdu-text hide-imp">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aperiam
                    perferendis
                    voluptas ex soluta
                    saepe
                    dolores nisi consequatur fuga provident facere, pariatur possimus earum ab sit ipsa ea quam
                    necessitatibus nemo?</p>
            </article> -->
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
    <script src="<?php echo BASE_URL ?>script-ajax-search.js"></script>
</body>

</html>