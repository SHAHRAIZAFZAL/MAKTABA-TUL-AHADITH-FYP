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
    <meta name="description"
        content="Arabic Learning Course - Semester 3 page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arabic Course Semester 3 - مكتبة الأحاديث</title>
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
                    <h2 class="langDiv langDiv-en">Semester 3</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">سمیسٹر 3</h2>
                    <img src="<?php echo BASE_URL ?>images/arabic-course-background.png" alt="Arabic Course Icon"
                        height="600" width="600" title="Arabic Course Section">
                </article>

                <article class="container container-without-pad-bg">
                    <a href="<?php echo BASE_URL ?>download.php?file=pdfs/Semester-3-Syllabus.pdf"
                        class="button-type-1 hover-effect button-download"
                        aria-label="Button link to start semester 3 course material download">
                        <span class="langDiv langDiv-en fontDiv fontDiv-s">Download Course Material</span>
                        <span class="langDiv langDiv-ur urdu-text hide-imp line-height-1 fontDiv fontDiv-m">کورس کا مواد
                            ڈاون لوڈ کریں</span>
                    </a>
                </article>

                <article class="container arabic-course-semester">

                    <details class="accordion ">
                        <summary class="accordion__heading">
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">Lecture 1</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp line-height-1 fontDiv fontDiv-ml">لیکچر
                                1</span>
                        </summary>
                        <div class="accordion__content">
                            <div class="video-wrapper">
                                <iframe width="850" height="480" title="Semester 3 Lecture 1"
                                    src="https://www.youtube.com/embed/OxSyzfwfUos?si=zSHGcykAjL7GiK4T" allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </details>
                    <details class="accordion">
                        <summary class="accordion__heading">
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">Lecture 2</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp line-height-1 fontDiv fontDiv-ml">لیکچر
                                2</span>
                        </summary>
                        <div class="accordion__content">
                            <div class="video-wrapper">
                                <iframe width="850" height="480" title="Semester 3 Lecture 2"
                                    src="https://www.youtube.com/embed/OxSyzfwfUos?si=zSHGcykAjL7GiK4T" allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </details>
                    <details class="accordion">
                        <summary class="accordion__heading">
                            <span class="langDiv langDiv-en fontDiv fontDiv-m">Lecture 3</span>
                            <span class="langDiv langDiv-ur urdu-text hide-imp line-height-1 fontDiv fontDiv-ml">لیکچر
                                3</span>
                        </summary>
                        <div class="accordion__content">
                            <div class="video-wrapper">
                                <iframe width="850" height="480" title="Semester 3 Lecture 3"
                                    src="https://www.youtube.com/embed/OxSyzfwfUos?si=zSHGcykAjL7GiK4T" allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    </details>
                </article>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>