<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';

$bookID = htmlspecialchars($_GET["bookID"]);
$bookLink = htmlspecialchars($_GET["bookName"]);
$stmt = $conn->prepare("SELECT * FROM book_list WHERE book_id = ?");
$stmt->bind_param("i", $bookID);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$row = $result->fetch_assoc();

$bookLanguage = htmlspecialchars($row['book_lang']);
if ($bookLanguage == 'en') {
    $bookName = htmlspecialchars($row['book_name_en']);
    $bookDescription = htmlspecialchars($row['book_desc_en']);
} else if ($bookLanguage == 'ur') {
    $bookName = htmlspecialchars($row['book_name_ur']);
    $bookDescription = htmlspecialchars($row['book_desc_ur']);
}
$bookAuthorEn = htmlspecialchars($row['book_author_en']);
$bookAuthorUr = htmlspecialchars($row['book_author_ur']);
$bookRangeStart = htmlspecialchars($row['book_range_start']);
$bookRangeEnd = htmlspecialchars($row['book_range_end']);
$bookPublisherEn = htmlspecialchars($row['book_publisher_en']);
$bookPublisherUr = htmlspecialchars($row['book_publisher_ur']);
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
                $tableExists = true;
                $tableName = str_replace("-", "_", $bookLink);
                $fullTableName = 'book_' . $tableName;
                try {
                    $stmt = "SELECT DISTINCT index_id, index_heading, index_start_page FROM $fullTableName";
                    $result = $conn->query($stmt);
                } catch (Exception $e) {
                    echo '<p> Book to be added yet! </p>';
                    $tableExists = false;
                }
                if ($tableExists) {
                    ?>

                    <article class="container container-without-pad-bg book-details">
                        <p class="langDiv langDiv-en fontDiv fontDiv-m"><span>Author: </span>
                            <?php echo $bookAuthorEn ?>
                        </p>
                        <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml"><span>مصنف: </span>
                            <?php echo $bookAuthorUr ?>
                        </p>
                        <p class="langDiv langDiv-en fontDiv fontDiv-m"><span>Publisher: </span>
                            <?php echo $bookPublisherEn ?>
                        </p>
                        <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml"><span>پبلشر: </span>
                            <?php echo $bookPublisherUr ?>
                        </p>
                        <p class="langDiv langDiv-en fontDiv fontDiv-m"><span>Language: </span>
                            English
                        </p>
                        <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml"><span>زبان: </span>
                            اردو
                        </p>
                        <p class="langDiv langDiv-en fontDiv fontDiv-m"><span>Total Pages: </span>
                            <?php echo $bookRangeEnd ?>
                        </p>
                        <p class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml"><span>کل صفحات: </span>
                            <?php echo $bookRangeEnd ?>
                        </p>
                        <div class="book-description-download">
                            <details class="accordion book-description"
                                aria-label="Accordion to open/close book description">
                                <summary class="accordion__heading book-description__heading">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-m">Book Description</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-ml">کتاب کے بارے
                                        میں</span>
                                </summary>
                                <div class="accordion__content book-description__content less-width">
                                    <?php
                                    if ($bookLanguage == 'ur')
                                        echo '<p class="urdu-text fontDiv fontDiv-ml">' . nl2br($bookDescription) . '</p>';
                                    else
                                        echo '<p class="english-text fontDiv fontDiv-m">' . nl2br($bookDescription) . '</p>';
                                    ?>
                                </div>
                            </details>
                            <a href="<?php echo BASE_URL ?>download.php?file=pdfs/<?php echo $bookLink ?>.pdf"
                                class="button-type-1 hover-effect button-download book-page-download"
                                aria-label="Button link to start book PDF download">
                                <span class="langDiv langDiv-en fontDiv fontDiv-s">Download Book PDF</span>
                                <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">کتاب ڈاؤن لوڈ
                                    کریں</span></a>
                        </div>
                        <div>
                            <div class="book-details__input flex-row">
                                <label class="book-details__input-label" for="pageNumber">
                                    <span class="langDiv langDiv-en fontDiv fontDiv-s">ؑEnter Page Number:</span>
                                    <span class="langDiv langDiv-ur urdu-text hide-imp fontDiv fontDiv-m">صفحہ نمبر
                                        ڈالیں:</span>
                                </label>
                                <form action="<?php echo BASE_URL . htmlspecialchars('books/islamic-book-content.php') ?>"
                                    class="book-details__input-form search-bar">
                                    <input type="hidden" name="bookName" value="<?php echo $bookLink ?>">
                                    <input type="number" min="<?php echo $bookRangeStart ?>"
                                        max="<?php echo $bookRangeEnd ?>"
                                        placeholder="<?php echo $bookRangeStart ?> to <?php echo $bookRangeEnd ?>"
                                        id="pageNumber" name="pageNumber">
                                    <button type="submit" aria-label="Book Page Search Button">
                                        <svg class="svg-hero-search" width="30" height="30" viewBox="0 0 256 256">
                                            <path
                                                d="m229.66 218.34l-50.07-50.06a88.11 88.11 0 1 0-11.31 11.31l50.06 50.07a8 8 0 0 0 11.32-11.32ZM40 112a72 72 0 1 1 72 72a72.08 72.08 0 0 1-72-72Z" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </article>

                    <article class="container">
                        <table class="timetable book-table">
                            <thead>
                                <tr>
                                    <th class="langDiv langDiv-en">Index Num.</th>
                                    <th class="langDiv langDiv-ur urdu-text hide-imp">انڈیکس نمبر</th>
                                    <th class="langDiv langDiv-en">Section Heading</th>
                                    <th class="langDiv langDiv-ur urdu-text hide-imp">سیکشن کا عنوان</th>
                                    <th class="langDiv langDiv-en">Page #</th>
                                    <th class="langDiv langDiv-ur urdu-text hide-imp">صفحہ #</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) {
                                    $indexID = htmlspecialchars($row['index_id']);
                                    $indexHeading = htmlspecialchars($row['index_heading']);
                                    $indexStartPage = htmlspecialchars($row['index_start_page']);
                                    echo '<tr> <td>' . $indexID . '. </td>';
                                    if ($bookLanguage == 'ur')
                                        echo '<td class="urdu-text fontDiv fontDiv-ml">';
                                    else
                                        echo '<td class="fontDiv fontDiv-m">';
                                    echo '<a href="' . BASE_URL . 'books/islamic-book-content.php?bookName='
                                        . $bookLink . '&pageNumber=' . $indexStartPage . '">' . $indexHeading . '</a> </td>';
                                    echo '<td>' . $indexStartPage . '</td> </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </article>

                <?php } ?>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>