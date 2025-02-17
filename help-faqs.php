<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/hijri-class.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Help/FAQs page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help/FAQs - مكتبة الأحاديث</title>
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
                    <img src="<?php echo BASE_URL ?>images/generic.png" alt="Generic Icon" height="600" width="600"
                        title="Maktaba-tul-Ahadith">
                    <h2 class="langDiv langDiv-en">Help/FAQs</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">اکژر پوچھے جانے والے سوال</h2>
                    <img src="<?php echo BASE_URL ?>images/generic.png" alt="Generic Icon" height="600" width="600"
                        title="Maktaba-tul-Ahadith">
                </article>

                <article class="container content-div">
                    <p class="english-text fontDiv fontDiv-m">
                        1. Accessing the Website
                        • Open your web browser.
                        • Enter the URL of the Maktaba-tul-Ahadith website (www.maktabatulahadith.com).
                        • The home page will load, displaying the main features and navigation menu.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        2. Changing Language
                        • Click on the settings icon on the main horizontal navigation bar.
                        • On the pop-up menu, click on your preferred language (Urdu or English).
                        • The website will display all content in the selected language.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        3. Changing Font Size
                        • Click on the settings icon on the main horizontal navigation bar.
                        • On the pop-up menu, click on your preferred font size (Small, Medium, Large).
                        • The website will display all content in the selected font size.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        4. Changing Colour Theme
                        • Click on the settings icon on the main horizontal navigation bar.
                        • On the pop-up menu, click on your preferred colour theme (e.g. black, red, green, white, etc).
                        • The website will display all content in the selected colour theme.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        5. Reading Quran Surahs
                        • Click on the Quran tab from the main horizontal navigation bar.
                        • Quran with a list of Surahs will be displayed.
                        • Click on the Surah you want to read.
                        • The entire Surah will be displayed for you to read.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        6. Playing Surah Audio
                        • After the Surah is displayed, click on the Play Audio option on the right side.
                        • Audio for the Surah will start playing.
                        • Other settings can be changed for the Surah through its ‘More Options’ sub-menu which contains
                        playback speed, change reciter, as well as downloading audio file.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        7. Reading Hadith
                        • Click on the Hadith tab from the main horizontal navigation bar.
                        • Various Hadith books will be displayed.
                        • Click on the Hadith book you want to read.
                        • The Hadith book will be displayed with its information and index.
                        • You can read a specific Hadith by entering its number, or read all Ahadith of a specific Kitab
                        & Baab (chapter & heading).
                    </p>
                </article>

            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>