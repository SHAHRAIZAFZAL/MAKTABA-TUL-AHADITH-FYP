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
    <meta name="description" content="Privacy Policy page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - مكتبة الأحاديث</title>
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
                    <h2 class="langDiv langDiv-en">Privacy Policy</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">رازداری پالیسی</h2>
                    <img src="<?php echo BASE_URL ?>images/generic.png" alt="Generic Icon" height="600" width="600"
                        title="Maktaba-tul-Ahadith">
                </article>

                <article class="container content-div">
                    <p class="english-text fontDiv fontDiv-m">
                        At Maktaba-tul-Ahadith, we are committed to protecting your privacy. This policy outlines how we
                        collect, use, and safeguard your personal information.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        - Information Collection: We collect personal information when you register, contact us, or use
                        our services.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        - Use of Information: Your information is used to provide and improve our services, process
                        transactions, and communicate with you.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        - Data Protection: We implement security measures to protect your information from unauthorized
                        access.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        - Third-Party Sharing: We do not share your personal information with third parties, except as
                        required by law.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        - Cookies: Our website uses cookies to enhance your browsing experience.
                    </p>
                </article>

            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>