<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';
$stmt = "SELECT * FROM articles";
$result = $conn->query($stmt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Articles page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles - مكتبة الأحاديث</title>
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

                <!-- <article class="container container-without-pad-bg articles-container">
                <form action="#" id="article-search-form" class="search-bar">
                    <input type="search" id="article-search-input" placeholder="Search article ...">
                    <button type="submit" aria-label="Articles Section Search Button">
                        <svg class="svg-hero-search" width="30" height="30" viewBox="0 0 256 256">
                            <path
                                d="m229.66 218.34l-50.07-50.06a88.11 88.11 0 1 0-11.31 11.31l50.06 50.07a8 8 0 0 0 11.32-11.32ZM40 112a72 72 0 1 1 72 72a72.08 72.08 0 0 1-72-72Z" />
                        </svg>
                        <svg class="svg-hero-close hide" width="30" height="30" viewBox="0 0 24 24">
                            <path
                                d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6L6.4 19Z" />
                        </svg>
                    </button>
                </form>
            </article> -->

                <article class="container">
                    <h4 class="langDiv langDiv-en fontDiv fontDiv-ml">Articles List</h4>
                    <h4 class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-l">مضامین کی فہرست</h4>
                    <table class="timetable article-table">
                        <thead>
                            <tr>
                                <th class="langDiv langDiv-en">Article</th>
                                <th class="langDiv langDiv-ur urdu-text hide-imp">مضمون</th>
                                <th class="langDiv langDiv-en">Author</th>
                                <th class="langDiv langDiv-ur urdu-text hide-imp">مصنف</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="" method="get" id="article-form">
                                <?php while ($row = $result->fetch_assoc()):
                                    $articleID = htmlspecialchars($row['article_id']);
                                    $articleName = htmlspecialchars($row['article_name']);
                                    $articleLang = htmlspecialchars($row['article_lang']);
                                    $articleAuthor = htmlspecialchars($row['article_author']);
                                    $articleNameDashed = str_replace(" ", "-", $articleName);
                                    ?>
                                    <tr>
                                        <?php if ($articleLang === 'en') {
                                            echo "<td class=\"english-text\">";
                                        } elseif ($articleLang === 'ur') {
                                            echo "<td class=\"urdu-text\">";
                                        }
                                        ?>
                                        <a
                                            href="<?php echo BASE_URL . "articles/article.php?articleID=" . $articleID . "&articleName=" . $articleNameDashed ?>">
                                            <?php echo $articleName ?>
                                        </a>
                                        </td>
                                        <?php if ($articleLang === 'en') {
                                            echo "<td class=\"english-text\">" . $articleAuthor;
                                        } elseif ($articleLang === 'ur') {
                                            echo "<td class=\"urdu-text\">" . $articleAuthor;
                                        }
                                        ?>
                                        </td>
                                    </tr>
                                <?php endwhile ?>
                            </form>
                        </tbody>
                    </table>
                </article>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>