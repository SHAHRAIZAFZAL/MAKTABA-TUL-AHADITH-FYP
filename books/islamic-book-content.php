<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';

$bookLink = htmlspecialchars($_GET["bookName"]);
$pageID = htmlspecialchars($_GET["pageNumber"]);
$stmt = $conn->prepare("SELECT * FROM book_list WHERE book_dashed = ?");
$stmt->bind_param("s", $bookLink);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$row = $result->fetch_assoc();

$bookLanguage = htmlspecialchars($row['book_lang']);
if ($bookLanguage == 'en') {
    $bookName = htmlspecialchars($row['book_name_en']);
} else if ($bookLanguage == 'ur') {
    $bookName = htmlspecialchars($row['book_name_ur']);
}
$bookRangeStart = htmlspecialchars($row['book_range_start']);
$bookRangeEnd = htmlspecialchars($row['book_range_end']);

$prevPage = $pageID - 1;
$nextPage = $pageID + 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Fraz Aslam">
    <meta name="description" content="Islamic book <?php echo $bookNameEn ?> in Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $bookName ?> - مكتبة الأحاديث
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
                    <img class="container-major__book-img"
                        src="<?php echo BASE_URL ?>images/books-images/<?php echo $bookLink ?>.webp"
                        alt="<?php echo $bookName ?> Book Image" height="480" width="480"
                        title="<?php echo $bookName ?>">
                    <?php
                    if ($bookLanguage == 'ur')
                        echo '<h2 class="urdu-text">' . $bookName . '</h2>';
                    else
                        echo '<h2>' . $bookName . '</h2>';
                    ?>
                    <img class="container-major__book-img"
                        src="<?php echo BASE_URL ?>images/books-images/<?php echo $bookLink ?>.webp"
                        alt="<?php echo $bookName ?> Book Image" height="480" width="480"
                        title="<?php echo $bookName ?>">
                </article>

                <?php
                $tableName = str_replace("-", "_", $bookLink);
                $fullTableName = 'book_' . $tableName;
                $stmt = $conn->prepare("SELECT page_content, page_references, index_heading FROM $fullTableName WHERE page_id = ?");
                $stmt->bind_param("i", $pageID);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                $row = $result->fetch_assoc();
                $pageContent = htmlspecialchars($row['page_content']);
                $pageReferences = htmlspecialchars($row['page_references']);
                $indexHeading = htmlspecialchars($row['index_heading']);
                ?>

                <article class="container less-width">
                    <?php
                    if ($bookLanguage == 'ur') {
                        echo '<p class="urdu-text fontDiv fontDiv-ml">' . nl2br($pageContent) . '</p>';
                        if ($pageReferences != null) {
                            echo '<p class="book-references urdu-text fontDiv fontDiv-m">' . nl2br($pageReferences) . '</p>';
                        }
                    } else {
                        echo '<p class="english-text fontDiv fontDiv-m">' . nl2br($pageContent) . '</p>';
                        if ($pageReferences != null) {
                            echo '<p class="book-references english-text fontDiv fontDiv-s">' . nl2br($pageReferences) . '</p>';
                        }
                    }
                    ?>
                    <div class="surah-numberings flex-row fontDiv fontDiv-m">
                        <div>
                            <?php echo $indexHeading ?>
                        </div>
                        <div>
                            <?php echo $pageID ?>
                        </div>
                    </div>
                </article>

                <article class="container container-without-pad-bg">
                    <form action="" method="get" class="quran-list prev-next">
                        <a href="<?php echo BASE_URL . "books/islamic-book-content.php?bookName=" . $bookLink . "&pageNumber=" . $prevPage ?>"
                            class="quran-surah
                    <?php if ($prevPage < $bookRangeStart)
                        echo "disable-clicks less-opacity\" tabindex=\"-1" ?>">
                                <span class="langDiv langDiv-en fontDiv fontDiv-s">Prev. Page</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">پچھلا صفحہ</span></a>
                            <a href="<?php echo BASE_URL . "books/islamic-book-content.php?bookName=" . $bookLink . "&pageNumber=" . $nextPage ?>"
                            class="quran-surah
                    <?php if ($nextPage > $bookRangeEnd)
                        echo "disable-clicks less-opacity\" tabindex=\"-1" ?>">
                                <span class="langDiv langDiv-en fontDiv fontDiv-s">Next Page</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">اگلا صفحہ</span></a>
                        </form>
                    </article>

                </div>
            </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>