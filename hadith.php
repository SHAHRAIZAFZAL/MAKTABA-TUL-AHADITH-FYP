<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';
$stmt = "SELECT * FROM hadithbook_list";
$result = $conn->query($stmt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Hadith page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hadith - مكتبة الأحاديث</title>
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
        <?php include SITE_PATH . '/header-aside.php'; ?>
        <main>
            <div class="main">
                <article class="container container-major quran-background">
                    <img src="<?php echo BASE_URL ?>images/hadith-background.png" alt="Hadith Calligraphy" height="465"
                        width="465" title="Ahadith of the Prophet Muhammad ﷺ">
                    <h2 class="langDiv langDiv-en">Hadith</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">حدیث</h2>
                    <img src="<?php echo BASE_URL ?>images/hadith-background.png" alt="Hadith Calligraphy" height="465"
                        width="465" title="Ahadith of the Prophet Muhammad ﷺ">
                </article>

                <article class="book-list">
                    <form action="" method="get" class="book-list" id="hadith-form">

                        <?php while ($row = $result->fetch_assoc()):
                            $hadithBookID = htmlspecialchars($row['hadithbook_id']);
                            $hadithBookNameEn = htmlspecialchars($row['hadithbook_name_en']);
                            $hadithBookNameUr = htmlspecialchars($row['hadithbook_name_ur']);
                            $hadithBookAuthorEn = htmlspecialchars($row['hadithbook_author_en']);
                            $hadithBookAuthorUr = htmlspecialchars($row['hadithbook_author_ur']);
                            $hadithBookLink = htmlspecialchars($row['hadithbook_dashed']);
                            ?>
                            <div class="book-div flex-column">
                                <a href="<?php echo BASE_URL . "hadith/hadith-book.php?hadithBookID=" . $hadithBookID . "&hadithBookName=" . $hadithBookLink ?>"
                                    class="book-div__link flex-column">
                                    <img class="book-div__image"
                                        src="<?php echo BASE_URL . "images/ahadith-images/" . $hadithBookLink ?>.webp"
                                        alt="<?php echo $hadithBookNameEn ?> Image" height="270" width="200"
                                        title="<?php echo $hadithBookNameEn . " - " . $hadithBookNameUr ?>">
                                    <div>
                                        <p class="book-div__name-english langDiv langDiv-en fontDiv fontDiv-m">
                                            <?php echo $hadithBookNameEn ?>
                                        </p>
                                        <p
                                            class="book-div__name-urdu langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">
                                            <?php echo $hadithBookNameUr ?>
                                        </p>
                                    </div>
                                </a>
                                <div>
                                    <p class="book-div__author-english langDiv langDiv-en fontDiv fontDiv-s">
                                        <?php echo $hadithBookAuthorEn ?>
                                    </p>
                                    <p
                                        class="book-div__author-urdu langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">
                                        <?php echo $hadithBookAuthorUr ?>
                                    </p>
                                </div>
                            </div>
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