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
    <meta name="description" content="Terms of Use page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Use - مكتبة الأحاديث</title>
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
                    <h2 class="langDiv langDiv-en">Terms of Use</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">استعمال کی شرائط</h2>
                    <img src="<?php echo BASE_URL ?>images/generic.png" alt="Generic Icon" height="600" width="600"
                        title="Maktaba-tul-Ahadith">
                </article>

                <article class="container content-div">
                    <p class="english-text fontDiv fontDiv-m">
                        By using our website, you agree to the following terms and conditions:
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        - Use of Content: The content on this website is for personal and educational use only.
                        Unauthorized commercial use is prohibited.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        - User Conduct: Users must not engage in any activity that disrupts or damages the website's
                        functionality.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        - Intellectual Property: All content, including text, graphics, and software, is the property of
                        Maktaba-tul-Ahadith and protected by intellectual property laws.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        - Modifications: We reserve the right to modify these terms at any time. Users are encouraged to
                        review the terms periodically.
                    </p>
                </article>

            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>