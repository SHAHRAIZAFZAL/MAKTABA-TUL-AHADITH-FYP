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
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Search Text page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Text - مكتبة الأحاديث</title>
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
                    <img src="<?php echo BASE_URL ?>images/search-text-background.png" alt="Search Icon" height="600"
                        width="600" title="Search Text Section">
                    <h2 class="langDiv langDiv-en">Search Text</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">الفاظ تلاش کریں</h2>
                    <img src="<?php echo BASE_URL ?>images/search-text-background.png" alt="Search Icon" height="600"
                        width="600" title="Search Text Section">
                </article>

                <form action="<?php echo BASE_URL . htmlspecialchars('search-text-results.php') ?>" method="get"
                    class="search-text-form flex-column" id="search-text-form">
                    <div class="search-text-form__text-field search-bar">
                        <input type="search" id="search-text-field" autocomplete="off" name="q"
                            placeholder="Enter text to search..." required>
                        <button type="submit" aria-label="Search Text Button">
                            <svg class="svg-hero-search" width="30" height="30" viewBox="0 0 256 256">
                                <path
                                    d="m229.66 218.34l-50.07-50.06a88.11 88.11 0 1 0-11.31 11.31l50.06 50.07a8 8 0 0 0 11.32-11.32ZM40 112a72 72 0 1 1 72 72a72.08 72.08 0 0 1-72-72Z" />
                            </svg>
                        </button>
                    </div>
                    <div class="search-text-form__location-language">
                        <div class="search-text-form__location flex-row">
                            <label for="search-location">
                                <span class="langDiv langDiv-en fontDiv fontDiv-m">Search In : &nbsp;</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">سرچ کی جگہ :
                                    &nbsp;</span>
                            </label>
                            <select id="search-location" name="location" class="fontDiv fontDiv-m">
                                <option value="quran" selected>Quran</option>
                                <option value="hadith">Hadith</option>
                                <option value="books">Books</option>
                            </select>
                        </div>
                        <div class="search-text-form__language flex-row">
                            <label for="search-language">
                                <span class="langDiv langDiv-en fontDiv fontDiv-m">Search Language : &nbsp;</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">سرچ کی زبان :
                                    &nbsp;</span>
                            </label>
                            <select id="search-language" name="lang" class="fontDiv fontDiv-m">
                                <option value="arabic">Arabic</option>
                                <option value="english" selected>English</option>
                                <option value="urdu">Urdu</option>
                            </select>
                        </div>
                    </div>
                    <button class="search-text-form__btn button-type-1 hover-effect" type="submit">
                        <span class="langDiv langDiv-en fontDiv fontDiv-m">Search</span>
                        <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml line-height-1">تلاش
                            کریں</span>
                    </button>
                </form>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>