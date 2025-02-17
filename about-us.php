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
    <meta name="description" content="About Us page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - مكتبة الأحاديث</title>
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
                    <h2 class="langDiv langDiv-en">About Us</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">ہمارے بارے میں</h2>
                    <img src="<?php echo BASE_URL ?>images/generic.png" alt="Generic Icon" height="600" width="600"
                        title="Maktaba-tul-Ahadith">
                </article>

                <article class="container content-div">
                    <p class="english-text fontDiv fontDiv-m">
                        Welcome to Maktaba-tul-Ahadith, your premier digital platform dedicated to enriching your
                        understanding of Islamic teachings. Our mission is to provide a comprehensive and accessible
                        repository of authentic Islamic literature, including the Quran, Hadith collections, scholarly
                        articles, and more.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        At Maktaba-tul-Ahadith, we believe in the importance of preserving and disseminating the
                        profound wisdom found in Islamic scriptures. Whether you are a scholar, student, or simply
                        curious about Islam, our platform offers a wealth of resources tailored to meet your needs.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        Explore our diverse features:
                        - Quran Tools: Access various translations, interpretations, and recitations of the Holy Quran.
                        - Hadith Collections: Browse through authenticated Hadith compilations, categorized for ease of
                        reference.
                        - Educational Articles: Delve into articles on Islamic history, jurisprudence, and contemporary
                        issues.
                        - Prayer Times: Stay updated with accurate prayer timings based on your location.
                        - Biographies: Learn about the lives of prominent Islamic figures and scholars.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        Our user-friendly interface ensures seamless navigation, while our commitment to accuracy and
                        authenticity guarantees a reliable source of knowledge. Join us in discovering the beauty and
                        depth of Islamic teachings at Maktaba-tul-Ahadith.
                    </p>
                    <p class="english-text fontDiv fontDiv-m">
                        For inquiries, collaborations, or feedback, please reach out to us. Thank you for choosing
                        Maktaba-tul-Ahadith as your trusted resource for Islamic learning.
                    </p>
                </article>

            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>