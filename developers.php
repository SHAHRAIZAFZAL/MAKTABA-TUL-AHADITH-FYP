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
    <meta name="description" content="Developers page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Developers - مكتبة الأحاديث</title>
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
                    <h2 class="langDiv langDiv-en">Developers</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">ڈیویلپرز</h2>
                    <img src="<?php echo BASE_URL ?>images/generic.png" alt="Generic Icon" height="600" width="600"
                        title="Maktaba-tul-Ahadith">
                </article>

                <article class="container content-div">
                    <h3>Fraz Aslam</h3>
                    <p class="english-text fontDiv fontDiv-m">
                        Front-end & Back-end Developer
                    </p>
                    <h3>Abdul Wahid</h3>
                    <p class="english-text fontDiv fontDiv-m">
                        Content Curator & Analyst
                    </p>
                    <h3>Shahraiz</h3>
                    <p class="english-text fontDiv fontDiv-m">
                        Database Manager & Tester
                    </p>
                </article>

            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>