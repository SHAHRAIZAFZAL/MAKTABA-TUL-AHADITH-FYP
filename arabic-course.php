<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Arabic Learning Course page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arabic Course - مكتبة الأحاديث</title>
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
                    <img src="<?php echo BASE_URL ?>images/arabic-course-background.png" alt="Arabic Course Icon"
                        height="600" width="600" title="Arabic Course Section">
                    <h2 class="langDiv langDiv-en">Arabic Course</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">عربی کورس</h2>
                    <img src="<?php echo BASE_URL ?>images/arabic-course-background.png" alt="Arabic Course Icon"
                        height="600" width="600" title="Arabic Course Section">
                </article>

                <article class="container arabic-course">
                    <a href="<?php echo BASE_URL ?>arabic-course/semester-1.php">
                        <span class="langDiv langDiv-en fontDiv fontDiv-m">Semester 1</span>
                        <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">سمیسٹر 1</span>
                    </a>
                    <a href="<?php echo BASE_URL ?>arabic-course/semester-2.php">
                        <span class="langDiv langDiv-en fontDiv fontDiv-m">Semester 2</span>
                        <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">سمیسٹر 2</span>
                    </a>
                    <a href="<?php echo BASE_URL ?>arabic-course/semester-3.php">
                        <span class="langDiv langDiv-en fontDiv fontDiv-m">Semester 3</span>
                        <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">سمیسٹر 3</span>
                    </a>
                </article>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>