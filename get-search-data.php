<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';

if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    $query = '%' . $_GET['q'] . '%';
    $stmt = $conn->prepare("SELECT 'hadithbook_list' AS source, hadithbook_id, hadithbook_name_en, hadithbook_name_ur,
            hadithbook_dashed FROM hadithbook_list WHERE hadithbook_name_en LIKE ? OR hadithbook_name_ur LIKE ?
            OR hadithbook_author_en LIKE ? OR hadithbook_author_ur LIKE ? LIMIT 10");
    $stmt->bind_param("ssss", $query, $query, $query, $query);
    $stmt->execute();
    $result1 = $stmt->get_result();
    $stmt->close();

    $stmt = $conn->prepare("SELECT 'book_list' AS source, book_id, book_name_en, book_name_ur, book_dashed FROM book_list
            WHERE book_name_en LIKE ? OR book_name_ur LIKE ? OR book_author_en LIKE ? OR book_author_ur LIKE ? LIMIT 10");
    $stmt->bind_param("ssss", $query, $query, $query, $query);
    $stmt->execute();
    $result2 = $stmt->get_result();
    $stmt->close();

    $results = array_merge($result1->fetch_all(MYSQLI_ASSOC), $result2->fetch_all(MYSQLI_ASSOC));
    if (count($results) === 0) {
        echo '<ul><li><a>No results found.</a></li></ul>';
    } else {
        echo '<ul>';
        foreach (array_slice($results, 0, 10) as $row) {
            if ($row['source'] == 'book_list') {
                echo '<li><a href="' . BASE_URL . 'books/islamic-book.php?bookID=' . htmlspecialchars($row['book_id'])
                    . '&bookName=' . htmlspecialchars($row['book_dashed']) . '" class="hover-effect">' . htmlspecialchars($row['book_name_en'])
                    . ' - <span class="urdu-text">' . htmlspecialchars($row['book_name_ur']) . '</span></a></li>';
            } else if ($row['source'] == 'hadithbook_list') {
                echo '<li><a href="' . BASE_URL . 'hadith/hadith-book.php?hadithBookID=' . htmlspecialchars($row['hadithbook_id'])
                    . '&hadithBookName=' . htmlspecialchars($row['hadithbook_dashed']) . '" class="hover-effect">' . htmlspecialchars($row['hadithbook_name_en'])
                    . ' - <span class="urdu-text">' . htmlspecialchars($row['hadithbook_name_ur']) . '</span></a></li>';
            }
        }
        echo '</ul>';
    }
}