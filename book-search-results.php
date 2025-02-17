<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Books page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Search Results - مكتبة الأحاديث</title>
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
                    <h2 class="langDiv langDiv-en">Book Search Results</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">کتاب سرچ کے نتائج</h2>
                    <img src="<?php echo BASE_URL ?>images/books-background.png" alt="Islamic Books Image/Icon"
                        height="465" width="465" title="Islamic Books Section">
                </article>

                <article class="container container-without-pad-bg articles-container">
                    <form action="<?php echo BASE_URL . htmlspecialchars('book-search-results.php') ?>"
                        id="book-search-form" class="search-bar search-results-bar">
                        <input type="search" id="hero-book-search-input" autocomplete="off" name="q"
                            placeholder="Search book/author ...">
                        <button type="submit" aria-label="Hero Section Search Button">
                            <svg class="svg-hero-search" width="30" height="30" viewBox="0 0 256 256">
                                <path
                                    d="m229.66 218.34l-50.07-50.06a88.11 88.11 0 1 0-11.31 11.31l50.06 50.07a8 8 0 0 0 11.32-11.32ZM40 112a72 72 0 1 1 72 72a72.08 72.08 0 0 1-72-72Z" />
                            </svg>
                        </button>
                        <div class="hero__search-results hide" id="ajax-search-results"></div>
                    </form>
                </article>

                <?php
                $query = '%' . $_GET['q'] . '%';
                $stmt = $conn->prepare("SELECT *, 'hadithbook_list' AS source FROM hadithbook_list WHERE hadithbook_name_en LIKE ?
                    OR hadithbook_name_ur LIKE ? OR hadithbook_author_en LIKE ? OR hadithbook_author_ur LIKE ?");
                $stmt->bind_param("ssss", $query, $query, $query, $query);
                $stmt->execute();
                $result1 = $stmt->get_result();
                $stmt->close();

                $stmt = $conn->prepare("SELECT *, 'book_list' AS source FROM book_list WHERE book_name_en LIKE ?
                    OR book_name_ur LIKE ? OR book_author_en LIKE ? OR book_author_ur LIKE ?");
                $stmt->bind_param("ssss", $query, $query, $query, $query);
                $stmt->execute();
                $result2 = $stmt->get_result();
                $stmt->close();

                $results = array_merge($result1->fetch_all(MYSQLI_ASSOC), $result2->fetch_all(MYSQLI_ASSOC));
                ?>

                <article class="book-list">
                    <?php
                    if (count($results) === 0) {
                        echo '<div class="center">No results found!</div>';
                    } else {
                        foreach ($results as $row) {
                            echo '<div class="book-div flex-column"> <a href="' . BASE_URL;
                            if ($row['source'] == 'book_list') {
                                $bookID = htmlspecialchars($row['book_id']);
                                $bookNameEn = htmlspecialchars($row['book_name_en']);
                                $bookNameUr = htmlspecialchars($row['book_name_ur']);
                                $bookAuthorEn = htmlspecialchars($row['book_author_en']);
                                $bookAuthorUr = htmlspecialchars($row['book_author_ur']);
                                $bookLang = htmlspecialchars($row['book_lang']);
                                $bookLink = htmlspecialchars($row['book_dashed']);
                                echo 'books/islamic-book.php?bookID=' . $bookID . "&bookName=" . $bookLink . '" class="book-div__link flex-column">';
                                echo '<img class="book-div__image" src="' . BASE_URL . 'images/books-images/' . $bookLink . '.webp" ';
                                echo 'alt="' . $bookNameEn . ' Image" height="270" width="200" title="' . $bookNameEn . ' - ' . $bookNameUr . '">';
                                if ($bookLang == 'en') {
                                    echo '<div class="book-div__name-english fontDiv fontDiv-m">' . $bookNameEn . '</div> </a>';
                                    echo '<div class="book-div__author-english fontDiv fontDiv-s">' . $bookAuthorEn . '</div>';
                                } else if ($bookLang == 'ur') {
                                    echo '<div class="book-div__name-urdu urdu-text fontDiv fontDiv-ml">' . $bookNameUr . '</div> </a>';
                                    echo '<div class="book-div__author-urdu urdu-text fontDiv fontDiv-m">' . $bookAuthorUr . '</div>';
                                }
                            } else if ($row['source'] == 'hadithbook_list') {
                                $bookID = htmlspecialchars($row['hadithbook_id']);
                                $bookNameEn = htmlspecialchars($row['hadithbook_name_en']);
                                $bookNameUr = htmlspecialchars($row['hadithbook_name_ur']);
                                $bookAuthorEn = htmlspecialchars($row['hadithbook_author_en']);
                                $bookAuthorUr = htmlspecialchars($row['hadithbook_author_ur']);
                                $bookLink = htmlspecialchars($row['hadithbook_dashed']);
                                echo 'hadith/hadith-book.php?hadithBookID=' . $bookID . "&hadithBookName=" . $bookLink . '" class="book-div__link flex-column">';
                                echo '<img class="book-div__image" src="' . BASE_URL . 'images/ahadith-images/' . $bookLink . '.webp" ';
                                echo 'alt="' . $bookNameEn . ' Image" height="270" width="200" title="' . $bookNameEn . ' - ' . $bookNameUr . '">';
                                echo '<div class="book-div__name-english langDiv langDiv-en fontDiv fontDiv-m">' . $bookNameEn . '</div>';
                                echo '<div class="book-div__name-urdu langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">' . $bookNameUr . '</div> </a>';
                                echo '<div class="book-div__author-english langDiv langDiv-en fontDiv fontDiv-s">' . $bookAuthorEn . '</div>';
                                echo '<div class="book-div__author-urdu langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">' . $bookAuthorUr . '</div>';
                            }
                            echo '</div>';
                        }
                    }
                    ?>
                </article>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
    <script src="<?php echo BASE_URL ?>script-ajax-search.js"></script>
</body>

</html>