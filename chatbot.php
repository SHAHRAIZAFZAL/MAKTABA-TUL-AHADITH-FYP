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
    <meta name="description" content="AI Chatbot page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Chatbot - مكتبة الأحاديث</title>
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
            <div class="main flex-column">
                <!-- <article class="container container-major">
                    <img src="images/ai-chatbot-background.png" alt="Chatbot Icon" height="600"
                        width="600" title="AI Chatbot Section">
                    <h2 class="langDiv langDiv-en">AI Chatbot</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">چیٹ بوٹ</h2>
                    <img src="images/ai-chatbot-background.png" alt="Chatbot Icon" height="600"
                        width="600" title="AI Chatbot Section">
                </article> -->

                <article class="container container-without-pad-bg chatbot-container flex-column">
                    <iframe title="Chatbot Iframe" frameborder="0" class="chatbot-iframe"
                        src="<?php echo BASE_URL ?>chatbot-iframe.php">
                    </iframe>
                </article>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
    <!-- <script src="script-chatbot.js"></script> -->
</body>

</html>