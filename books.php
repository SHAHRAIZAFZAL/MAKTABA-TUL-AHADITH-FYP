<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';
$stmt = "SELECT * FROM book_list";
$result = $conn->query($stmt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Books page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books - مكتبة الأحاديث</title>
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
        <?php include SITE_PATH . '/header-aside.php'; ?>
        <main>
            <div class="main">
                <article class="container container-major">
                    <img src="<?php echo BASE_URL ?>images/books-background.png" alt="Islamic Books Image/Icon"
                        height="465" width="465" title="Islamic Books Section">
                    <h2 class="langDiv langDiv-en">Books</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">کتابیں</h2>
                    <img src="<?php echo BASE_URL ?>images/books-background.png" alt="Islamic Books Image/Icon"
                        height="465" width="465" title="Islamic Books Section">
                </article>

                <!-- <article class="container container-without-pad-bg articles-container">
                <form action="#" id="book-search-form" class="search-bar">
                    <input type="text" id="book-search-input" placeholder="Search book/author ...">
                    <button type="submit" aria-label="Hero Section Search Button">
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

                <article class="book-list">
                    <form action="" method="get" class="book-list" id="book-form">

                        <?php while ($row = $result->fetch_assoc()):
                            $bookID = htmlspecialchars($row['book_id']);
                            $bookNameEn = htmlspecialchars($row['book_name_en']);
                            $bookNameUr = htmlspecialchars($row['book_name_ur']);
                            $bookAuthorEn = htmlspecialchars($row['book_author_en']);
                            $bookAuthorUr = htmlspecialchars($row['book_author_ur']);
                            $bookLang = htmlspecialchars($row['book_lang']);
                            $bookLink = htmlspecialchars($row['book_dashed']);
                            ?>
                            <div class="book-div flex-column">
                                <a href="<?php echo BASE_URL . "books/islamic-book.php?bookID=" . $bookID . "&bookName=" . $bookLink ?>"
                                    class="book-div__link flex-column">
                                    <img class="book-div__image"
                                        src="<?php echo BASE_URL . "images/books-images/" . $bookLink ?>.webp"
                                        alt="<?php echo $bookNameEn ?> Image" height="270" width="200"
                                        title="<?php echo $bookNameEn . " - " . $bookNameUr ?>">
                                    <?php
                                    if ($bookLang == 'en') {
                                        echo '<div class="book-div__name-english fontDiv fontDiv-m">' . $bookNameEn . '</div> </a>';
                                        echo '<div class="book-div__author-english fontDiv fontDiv-s">' . $bookAuthorEn . '</div>';
                                    } else if ($bookLang == 'ur') {
                                        echo '<div class="book-div__name-urdu urdu-text fontDiv fontDiv-ml">' . $bookNameUr . '</div> </a>';
                                        echo '<div class="book-div__author-urdu urdu-text fontDiv fontDiv-m">' . $bookAuthorUr . '</div>';
                                    }
                                    ?>
                            </div>
                        <?php endwhile ?>

                    </form>
                </article>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>