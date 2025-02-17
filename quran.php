<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';
$stmt = "SELECT * FROM surah_list";
$result = $conn->query($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Quran page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quran - مكتبة الأحاديث</title>
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
                    <img src="<?php echo BASE_URL ?>images/quran-background.png" alt="Quran Calligraphy" height="600"
                        width="600" title="The Holy Quran">
                    <h2 class="langDiv langDiv-en">The Holy Quran</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">قرآن مجید</h2>
                    <img src="<?php echo BASE_URL ?>images/quran-background.png" alt="Quran Calligraphy" height="600"
                        width="600" title="The Holy Quran">
                </article>

                <article class="quran-list">
                    <form action="<?php echo BASE_URL . htmlspecialchars('quran/surah.php') ?>" method="get"
                        class="quran-list" id="quran-form">

                        <?php while ($row = $result->fetch_assoc()):
                            $surahID = htmlspecialchars($row['surah_id']);
                            $surahNameAr = htmlspecialchars($row['surah_name_ar']);
                            $surahNameEn = htmlspecialchars($row['surah_name_en']);
                            $surahMeaningEn = htmlspecialchars($row['surah_meaning_en']);
                            $surahMeaningUr = htmlspecialchars($row['surah_meaning_ur']);
                            $surahAyahs = htmlspecialchars($row['surah_ayahs']);
                            ?>
                            <a href="<?php echo BASE_URL . "quran/surah.php?surahID=" . $surahID ?>" class="quran-surah">
                                <div class="quran-surah__number">
                                    <div>
                                        <?php echo $surahID ?>
                                    </div>
                                </div>
                                <div class="quran-surah__name">
                                    <div class="quran-surah__name--english fontDiv fontDiv-m">
                                        <?php echo $surahNameEn ?>
                                    </div>
                                    <div class="quran-surah__name--meaning fontDiv fontDiv-s">
                                        <span class="langDiv langDiv-en">
                                            <?php echo $surahMeaningEn ?>
                                        </span>
                                        <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-s">
                                            <?php echo $surahMeaningUr ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="quran-surah__detail">
                                    <div class="quran-surah__detail--arabic fontDiv fontDiv-m">
                                        <?php echo $surahNameAr ?>
                                    </div>
                                    <div class="quran-surah__detail--ayahs fontDiv fontDiv-s">
                                        <?php echo $surahAyahs . " Ayahs" ?>
                                    </div>
                                </div>
                            </a>
                        <?php endwhile ?>

                    </form>
                </article>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>