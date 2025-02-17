<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';

$articleID = htmlspecialchars($_GET["articleID"]);
$articleNameDashed = htmlspecialchars($_GET["articleName"]);
$stmt = $conn->prepare("SELECT * FROM articles WHERE article_id = ?");
$stmt->bind_param("i", $articleID);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$row = $result->fetch_assoc();
$articleLang = htmlspecialchars($row['article_lang']);
$articleName = htmlspecialchars($row['article_name']);
$articleAuthor = htmlspecialchars($row['article_author']);
$articleContent = htmlspecialchars($row['article_content']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="An article page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $articleName ?> - مكتبة الأحاديث
    </title>
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
                    <img src="<?php echo BASE_URL ?>images/articles-background.png" alt="Articles Icon" height="600"
                        width="600" title="Articles Section">
                    <h2 class="langDiv langDiv-en">Articles</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">مضامین</h2>
                    <img src="<?php echo BASE_URL ?>images/articles-background.png" alt="Articles Icon" height="600"
                        width="600" title="Articles Section">
                </article>

                <article class="article-heading container flex-row">
                    <div <?php if ($articleLang === 'ur')
                        echo 'class="urdu-text fontDiv fontDiv-ml"';
                    else if ($articleLang === 'en')
                        echo 'class="fontDiv fontDiv-m"';
                    ?>>
                        <?php echo $articleName ?>
                    </div>
                    <div <?php if ($articleLang === 'ur')
                        echo 'class="urdu-text fontDiv fontDiv-ml"';
                    else if ($articleLang === 'en')
                        echo 'class="fontDiv fontDiv-m"';
                    ?>>
                    <?php echo $articleAuthor ?>
                    </div>
                </article>

                <article class="container less-width justify
            <?php
            if ($articleLang === 'ur')
                echo 'urdu-text fontDiv fontDiv-ml';
            else
                echo 'english-text fontDiv fontDiv-m' ?>">
                    <?php echo nl2br($articleContent) ?>
                </article>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>