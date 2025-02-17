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
    <meta name="description" content="Search Text results page of the Islamic website Maktaba tul Ahadith">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Text Results - مكتبة الأحاديث</title>
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
                    <img src="<?php echo BASE_URL ?>images/search-text-background.png" alt="Search Icon" height="600"
                        width="600" title="Search Text Section">
                    <h2 class="langDiv langDiv-en">Search Text Results</h2>
                    <h2 class="langDiv langDiv-ur urdu-text hide-imp">الفاظ تلاش کے نتائج</h2>
                    <img src="<?php echo BASE_URL ?>images/search-text-background.png" alt="Search Icon" height="600"
                        width="600" title="Search Text Section">
                </article>

                <?php
                function createPagination($query, $searchLoc, $searchLang, $totalPages, $currentPage) {
                    if ($totalPages > 1) {
                        echo '<article class="container container-without-pad-bg"> <div class="pagination-container"> <div class="pagination">';
                        if ($currentPage > 1) {
                            echo '<a href="?q=' . $query . '&location=' . $searchLoc . '&lang=' .
                                $searchLang . '&page=' . $currentPage - 1 . '">&laquo;</a>';
                        }
                        if ($currentPage > 3) {
                            echo '<a href="?q=' . $query . '&location=' . $searchLoc . '&lang=' .
                                $searchLang . '&page=1">1</a>';
                            if ($currentPage > 4) {
                                echo '<a class="dots">...</a>';
                            }
                        }
                        if ($currentPage - 2 > 0) {
                            echo '<a href="?q=' . $query . '&location=' . $searchLoc . '&lang=' . $searchLang .
                                '&page=' . $currentPage - 2 . '">' . $currentPage - 2 . '</a>';
                        }
                        if ($currentPage - 1 > 0) {
                            echo '<a href="?q=' . $query . '&location=' . $searchLoc . '&lang=' . $searchLang .
                                '&page=' . $currentPage - 1 . '">' . $currentPage - 1 . '</a>';
                        }
                        echo '<a class="active" href="?q=' . $query . '&location=' . $searchLoc . '&lang=' .
                            $searchLang . '&page=' . $currentPage . '">' . $currentPage . '</a>';
                        if ($currentPage + 1 < $totalPages + 1) {
                            echo '<a href="?q=' . $query . '&location=' . $searchLoc . '&lang=' . $searchLang .
                                '&page=' . $currentPage + 1 . '">' . $currentPage + 1 . '</a>';
                        }
                        if ($currentPage + 2 < $totalPages + 1) {
                            echo '<a href="?q=' . $query . '&location=' . $searchLoc . '&lang=' . $searchLang .
                                '&page=' . $currentPage + 2 . '">' . $currentPage + 2 . '</a>';
                        }
                        if ($currentPage < $totalPages - 2) {
                            if ($currentPage < $totalPages - 3) {
                                echo '<a class="dots">...</a>';
                            }
                            echo '<a href="?q=' . $query . '&location=' . $searchLoc . '&lang=' .
                                $searchLang . '&page=' . $totalPages . '">' . $totalPages . '</a>';
                        }
                        if ($currentPage < $totalPages) {
                            echo '<a href="?q=' . $query . '&location=' . $searchLoc . '&lang=' .
                                $searchLang . '&page=' . $currentPage + 1 . '">&raquo;</a>';
                        }
                        echo '</div> </div> </article>';
                    }
                }

                $recordsPerPage = 10;
                if (isset($_GET['page'])) {
                    $currentPage = $_GET['page'];
                } else {
                    $currentPage = 1;
                }
                $startFrom = ($currentPage - 1) * $recordsPerPage;

                if (isset($_GET['q'])) {
                    $query = $_GET['q'];
                    $searchQuery = '%' . ($_GET['q']) . '%';
                    $searchLoc = htmlspecialchars($_GET['location']);
                    $searchLang = htmlspecialchars($_GET['lang']);

                    // 1. SEARCHING "ARABIC" IN "QURAN"
                    if ($searchLoc == 'quran' && $searchLang == 'arabic') {
                        $stmt = $conn->prepare("SELECT surah_num, ayah_num_surah, ayah_ar_simple FROM quran WHERE
                            ayah_ar_simple LIKE ?");
                        $stmt->bind_param("s", $searchQuery);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $totalRecords = $result->num_rows;
                        $totalPages = ceil($totalRecords / $recordsPerPage);
                        $stmt->close();

                        createPagination($query, $searchLoc, $searchLang, $totalPages, $currentPage);
                        $stmt = $conn->prepare("SELECT surah_num, ayah_num_surah, ayah_ar_simple FROM quran WHERE
                            ayah_ar_simple LIKE ? LIMIT ?, ?");
                        $stmt->bind_param("sii", $searchQuery, $startFrom, $recordsPerPage);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();

                        echo '<article class="container search-results-container fontDiv fontDiv-m">';
                        if ($result->num_rows > 0) {
                            $counter = ($currentPage * 10) - 9;
                            while ($row = $result->fetch_assoc()) {
                                $text = htmlspecialchars($row['ayah_ar_simple']);
                                $surahNum = htmlspecialchars($row['surah_num']);
                                $ayahNum = htmlspecialchars($row['ayah_num_surah']);
                                $position = stripos($text, $query);
                                $start = max($position - 200, 0);
                                $end = min($position + strlen($query) + 200, strlen($text));
                                $displayText = substr($text, $start, $end - $start);
                                if ($start > 0) {
                                    $displayText = '...' . $displayText;
                                }
                                if ($end < strlen($text)) {
                                    $displayText = $displayText . '...';
                                }
                                $highlightedText = str_ireplace($query, '<span class="highlight">' . $query . '</span>', $displayText);
                                echo '<a target="_blank" href="' . BASE_URL . 'quran/surah.php?surahID=' . $surahNum . '#' . $ayahNum .
                                    '" class="search-results-link quran-text"><span class="hover-color">' . $counter . ': </span>' .
                                    $highlightedText . ' (' . $surahNum . ': ' . $ayahNum . ')</a>';
                                ++$counter;
                            }
                        } else {
                            echo '<p>No results found!</p>';
                        }
                        echo '</article>';
                    }
                    // 2. SEARCHING "ENGLISH" IN "QURAN"
                    else if ($searchLoc == 'quran' && $searchLang == 'english') {
                        $stmt = $conn->prepare("SELECT surah_num, ayah_num_surah, en_saheeh FROM quran WHERE
                            en_saheeh LIKE ?");
                        $stmt->bind_param("s", $searchQuery);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $totalRecords = $result->num_rows;
                        $totalPages = ceil($totalRecords / $recordsPerPage);
                        $stmt->close();

                        createPagination($query, $searchLoc, $searchLang, $totalPages, $currentPage);
                        $stmt = $conn->prepare("SELECT surah_num, ayah_num_surah, en_saheeh FROM quran WHERE
                            en_saheeh LIKE ? LIMIT ?, ?");
                        $stmt->bind_param("sii", $searchQuery, $startFrom, $recordsPerPage);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();

                        echo '<article class="container search-results-container fontDiv fontDiv-m">';
                        if ($result->num_rows > 0) {
                            $counter = ($currentPage * 10) - 9;
                            while ($row = $result->fetch_assoc()) {
                                $text = htmlspecialchars($row['en_saheeh']);
                                $surahNum = htmlspecialchars($row['surah_num']);
                                $ayahNum = htmlspecialchars($row['ayah_num_surah']);
                                $position = stripos($text, $query);
                                $start = max($position - 200, 0);
                                $end = min($position + strlen($query) + 200, strlen($text));
                                $displayText = substr($text, $start, $end - $start);
                                if ($start > 0) {
                                    $displayText = '...' . $displayText;
                                }
                                if ($end < strlen($text)) {
                                    $displayText = $displayText . '...';
                                }
                                $highlightedText = str_ireplace($query, '<span class="highlight">' . $query . '</span>', $displayText);
                                echo '<a target="_blank" href="' . BASE_URL . 'quran/surah.php?surahID=' . $surahNum . '#' . $ayahNum .
                                    '" class="search-results-link english-text"><span class="hover-color">' . $counter . ': </span>' .
                                    $highlightedText . ' (' . $surahNum . ': ' . $ayahNum . ')</a>';
                                ++$counter;
                            }
                        } else {
                            echo '<p class="langDiv langDiv-en">No results found!</p>';
                            echo '<p class="langDiv langDiv-ur urdu-text hide-imp">کوئی نتائج نہیں مل سکے!</p>';
                        }
                        echo '</article>';
                    }
                    // 3. SEARCHING "URDU" IN "QURAN"
                    else if ($searchLoc == 'quran' && $searchLang == 'urdu') {
                        $stmt = $conn->prepare("SELECT surah_num, ayah_num_surah, ur_junagarhi FROM quran WHERE
                            ur_junagarhi LIKE ?");
                        $stmt->bind_param("s", $searchQuery);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $totalRecords = $result->num_rows;
                        $totalPages = ceil($totalRecords / $recordsPerPage);
                        $stmt->close();

                        createPagination($query, $searchLoc, $searchLang, $totalPages, $currentPage);
                        $stmt = $conn->prepare("SELECT surah_num, ayah_num_surah, ur_junagarhi FROM quran WHERE
                            ur_junagarhi LIKE ? LIMIT ?, ?");
                        $stmt->bind_param("sii", $searchQuery, $startFrom, $recordsPerPage);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();

                        echo '<article class="container search-results-container fontDiv fontDiv-m">';
                        if ($result->num_rows > 0) {
                            $counter = ($currentPage * 10) - 9;
                            while ($row = $result->fetch_assoc()) {
                                $text = htmlspecialchars($row['ur_junagarhi']);
                                $surahNum = htmlspecialchars($row['surah_num']);
                                $ayahNum = htmlspecialchars($row['ayah_num_surah']);
                                $position = stripos($text, $query);
                                $start = max($position - 200, 0);
                                $end = min($position + strlen($query) + 200, strlen($text));
                                $displayText = substr($text, $start, $end - $start);
                                if ($start > 0) {
                                    $displayText = '...' . $displayText;
                                }
                                if ($end < strlen($text)) {
                                    $displayText = $displayText . '...';
                                }
                                $highlightedText = str_ireplace($query, '<span class="highlight">' . $query . '</span>', $displayText);
                                echo '<a target="_blank" href="' . BASE_URL . 'quran/surah.php?surahID=' . $surahNum . '#' . $ayahNum .
                                    '" class="search-results-link urdu-text"><span class="hover-color">' . $counter . ': </span>' .
                                    $highlightedText . ' (' . $surahNum . ': ' . $ayahNum . ')</a>';
                                ++$counter;
                            }
                        } else {
                            echo '<p>No results found!</p>';
                        }
                        echo '</article>';
                    }
                    // 4. SEARCHING "ARABIC" IN "HADITH"
                    else if ($searchLoc == 'hadith' && $searchLang == 'arabic') {
                        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'maktaba_tul_ahadith'
                    AND TABLE_NAME LIKE 'hadith_%' AND TABLE_NAME NOT LIKE '%_index' AND TABLE_NAME NOT LIKE '%_list'";
                        $tableResult = $conn->query($sql);

                        if ($tableResult->num_rows > 0) {
                            $sql = "";
                            while ($tableRow = $tableResult->fetch_assoc()) {
                                $tableName = $tableRow['TABLE_NAME'];
                                $sql = $sql . "SELECT hadith_id, hadith_ar_simple FROM $tableName WHERE
                                hadith_ar_simple LIKE ? UNION ALL ";
                            }
                            $sql = rtrim($sql, "UNION ALL ");
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $searchQuery);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $totalRecords = $result->num_rows;
                            $totalPages = ceil($totalRecords / $recordsPerPage);
                            $stmt->close();

                            $tableResult->data_seek(0);
                            createPagination($query, $searchLoc, $searchLang, $totalPages, $currentPage);
                            $sql = "";
                            while ($tableRow = $tableResult->fetch_assoc()) {
                                $tableName = $tableRow['TABLE_NAME'];
                                $sql = $sql . "SELECT '$tableName' AS source, hadith_id, hadith_ar_simple FROM $tableName WHERE
                                hadith_ar_simple LIKE ? LIMIT ?, ? UNION ALL ";
                            }
                            $sql = rtrim($sql, "UNION ALL ");
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sii", $searchQuery, $startFrom, $recordsPerPage);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $stmt->close();

                            echo '<article class="container search-results-container fontDiv fontDiv-m">';
                            if ($result->num_rows > 0) {
                                $counter = ($currentPage * 10) - 9;
                                while ($row = $result->fetch_assoc()) {
                                    $text = htmlspecialchars($row['hadith_ar_simple']);
                                    $hadithID = htmlspecialchars($row['hadith_id']);
                                    $bookLink = htmlspecialchars($row['source']);
                                    $bookLink = substr($bookLink, 7);
                                    $bookLink = str_replace("_", "-", $bookLink);
                                    $bookName = str_replace("-", " ", $bookLink);
                                    $bookName = ucwords($bookName);
                                    $position = stripos($text, $query);
                                    $start = max($position - 200, 0);
                                    $end = min($position + strlen($query) + 200, strlen($text));
                                    $displayText = substr($text, $start, $end - $start);
                                    if ($start > 0) {
                                        $displayText = '...' . $displayText;
                                    }
                                    if ($end < strlen($text)) {
                                        $displayText = $displayText . '...';
                                    }
                                    $highlightedText = str_ireplace($query, '<span class="highlight">' . $query . '</span>', $displayText);
                                    echo '<a target="_blank" href="' . BASE_URL . 'hadith/hadith-book-content-single.php?hadithBookName=' . $bookLink .
                                        '&hadithNumber=' . $hadithID . '" class="search-results-link arabic-text"><span class="hover-color">' .
                                        $counter . ': </span>' . $highlightedText . ' (' . $bookName . ': ' . $hadithID . ')</a>';
                                    ++$counter;
                                }
                            } else {
                                echo '<p>No results found!</p>';
                            }
                            echo '</article>';
                        }
                    }
                    // 5. SEARCHING "ENGLISH" IN "HADITH"
                    else if ($searchLoc == 'hadith' && $searchLang == 'english') {
                        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'maktaba_tul_ahadith'
                        AND TABLE_NAME LIKE 'hadith_%' AND TABLE_NAME NOT LIKE '%_index' AND TABLE_NAME NOT LIKE '%_list'";
                        $tableResult = $conn->query($sql);

                        if ($tableResult->num_rows > 0) {
                            $sql = "";
                            while ($tableRow = $tableResult->fetch_assoc()) {
                                $tableName = $tableRow['TABLE_NAME'];
                                $sqlColumn = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName'
                                        AND COLUMN_NAME LIKE 'en_%' ORDER BY ORDINAL_POSITION LIMIT 1";
                                $result = $conn->query($sqlColumn);
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $firstColumn = $row['COLUMN_NAME'];
                                    $sql = $sql . "SELECT hadith_id, $firstColumn FROM $tableName WHERE
                                    $firstColumn LIKE ? UNION ALL ";
                                }
                            }
                            $sql = rtrim($sql, "UNION ALL ");
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $searchQuery);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $totalRecords = $result->num_rows;
                            $totalPages = ceil($totalRecords / $recordsPerPage);
                            $stmt->close();

                            $tableResult->data_seek(0);
                            createPagination($query, $searchLoc, $searchLang, $totalPages, $currentPage);
                            $sql = "";
                            while ($tableRow = $tableResult->fetch_assoc()) {
                                $tableName = $tableRow['TABLE_NAME'];
                                $sqlColumn = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName'
                                        AND COLUMN_NAME LIKE 'en_%' ORDER BY ORDINAL_POSITION LIMIT 1";
                                $result = $conn->query($sqlColumn);
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $firstColumn = $row['COLUMN_NAME'];
                                    $sql = $sql . "SELECT '$firstColumn' AS column_name, '$tableName' AS source, hadith_id,
                                        $firstColumn FROM $tableName WHERE $firstColumn LIKE ? LIMIT ?, ? UNION ALL ";
                                }
                            }
                            $sql = rtrim($sql, "UNION ALL ");
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sii", $searchQuery, $startFrom, $recordsPerPage);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $stmt->close();

                            echo '<article class="container search-results-container fontDiv fontDiv-m">';
                            if ($result->num_rows > 0) {
                                $counter = ($currentPage * 10) - 9;
                                while ($row = $result->fetch_assoc()) {
                                    $columnName = htmlspecialchars($row['column_name']);
                                    $text = htmlspecialchars($row[$columnName]);
                                    $hadithID = htmlspecialchars($row['hadith_id']);
                                    $bookLink = htmlspecialchars($row['source']);
                                    $bookLink = substr($bookLink, 7);
                                    $bookLink = str_replace("_", "-", $bookLink);
                                    $bookName = str_replace("-", " ", $bookLink);
                                    $bookName = ucwords($bookName);
                                    $position = stripos($text, $query);
                                    $start = max($position - 200, 0);
                                    $end = min($position + strlen($query) + 200, strlen($text));
                                    $displayText = substr($text, $start, $end - $start);
                                    if ($start > 0) {
                                        $displayText = '...' . $displayText;
                                    }
                                    if ($end < strlen($text)) {
                                        $displayText = $displayText . '...';
                                    }
                                    $highlightedText = str_ireplace($query, '<span class="highlight">' . $query . '</span>', $displayText);
                                    echo '<a target="_blank" href="' . BASE_URL . 'hadith/hadith-book-content-single.php?hadithBookName=' . $bookLink .
                                        '&hadithNumber=' . $hadithID . '" class="search-results-link english-text"><span class="hover-color">' .
                                        $counter . ': </span>' . $highlightedText . ' (' . $bookName . ': ' . $hadithID . ')</a>';
                                    ++$counter;
                                }
                            } else {
                                echo '<p>No results found!</p>';
                            }
                            echo '</article>';
                        }
                    }
                    // 6. SEARCHING "URDU" IN "HADITH"
                    else if ($searchLoc == 'hadith' && $searchLang == 'urdu') {
                        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'maktaba_tul_ahadith'
                        AND TABLE_NAME LIKE 'hadith_%' AND TABLE_NAME NOT LIKE '%_index' AND TABLE_NAME NOT LIKE '%_list'";
                        $tableResult = $conn->query($sql);

                        if ($tableResult->num_rows > 0) {
                            $sql = "";
                            while ($tableRow = $tableResult->fetch_assoc()) {
                                $tableName = $tableRow['TABLE_NAME'];
                                $sqlColumn = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName'
                                        AND COLUMN_NAME LIKE 'ur_%' ORDER BY ORDINAL_POSITION LIMIT 1";
                                $result = $conn->query($sqlColumn);
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $firstColumn = $row['COLUMN_NAME'];
                                    $sql = $sql . "SELECT hadith_id, $firstColumn FROM $tableName WHERE
                                    $firstColumn LIKE ? UNION ALL ";
                                }
                            }
                            $sql = rtrim($sql, "UNION ALL ");
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $searchQuery);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $totalRecords = $result->num_rows;
                            $totalPages = ceil($totalRecords / $recordsPerPage);
                            $stmt->close();

                            $tableResult->data_seek(0);
                            createPagination($query, $searchLoc, $searchLang, $totalPages, $currentPage);
                            $sql = "";
                            while ($tableRow = $tableResult->fetch_assoc()) {
                                $tableName = $tableRow['TABLE_NAME'];
                                $sqlColumn = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName'
                                        AND COLUMN_NAME LIKE 'ur_%' ORDER BY ORDINAL_POSITION LIMIT 1";
                                $result = $conn->query($sqlColumn);
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $firstColumn = $row['COLUMN_NAME'];
                                    $sql = $sql . "SELECT '$firstColumn' AS column_name, '$tableName' AS source, hadith_id,
                                        $firstColumn FROM $tableName WHERE $firstColumn LIKE ? LIMIT ?, ? UNION ALL ";
                                }
                            }
                            $sql = rtrim($sql, "UNION ALL ");
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("sii", $searchQuery, $startFrom, $recordsPerPage);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $stmt->close();

                            echo '<article class="container search-results-container fontDiv fontDiv-m">';
                            if ($result->num_rows > 0) {
                                $counter = ($currentPage * 10) - 9;
                                while ($row = $result->fetch_assoc()) {
                                    $columnName = htmlspecialchars($row['column_name']);
                                    $text = htmlspecialchars($row[$columnName]);
                                    $hadithID = htmlspecialchars($row['hadith_id']);
                                    $bookLink = htmlspecialchars($row['source']);
                                    $bookLink = substr($bookLink, 7);
                                    $bookLink = str_replace("_", "-", $bookLink);
                                    $bookName = str_replace("-", " ", $bookLink);
                                    $bookName = ucwords($bookName);
                                    $position = stripos($text, $query);
                                    $start = max($position - 200, 0);
                                    $end = min($position + strlen($query) + 200, strlen($text));
                                    $displayText = substr($text, $start, $end - $start);
                                    if ($start > 0) {
                                        $displayText = '...' . $displayText;
                                    }
                                    if ($end < strlen($text)) {
                                        $displayText = $displayText . '...';
                                    }
                                    $highlightedText = str_ireplace($query, '<span class="highlight">' . $query . '</span>', $displayText);
                                    echo '<a target="_blank" href="' . BASE_URL . 'hadith/hadith-book-content-single.php?hadithBookName=' . $bookLink .
                                        '&hadithNumber=' . $hadithID . '" class="search-results-link urdu-text"><span class="hover-color">' .
                                        $counter . ': </span>' . $highlightedText . ' (' . $bookName . ': ' . $hadithID . ')</a>';
                                    ++$counter;
                                }
                            } else {
                                echo '<p>No results found!</p>';
                            }
                            echo '</article>';
                        }
                    }
                    // 7. 8. 9. SEARCHING "ARABIC/ENGLISH/URDU" IN "BOOKS"
                    else if (($searchLoc == 'books' && $searchLang == 'arabic') || ($searchLoc == 'books' && $searchLang == 'english') ||
                        ($searchLoc == 'books' && $searchLang == 'urdu')) {
                        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'maktaba_tul_ahadith'
                        AND TABLE_NAME LIKE 'book_%' AND TABLE_NAME NOT LIKE '%_list'";
                        $tableResult = $conn->query($sql);

                        if ($tableResult->num_rows > 0) {
                            $sql = "";
                            $params = [];
                            while ($tableRow = $tableResult->fetch_assoc()) {
                                $tableName = $tableRow['TABLE_NAME'];
                                $sql = $sql . "SELECT page_id, page_content FROM $tableName WHERE
                                    page_content LIKE ? UNION ALL ";
                                $params[] = '%' . $searchQuery . '%';
                            }
                            $sql = rtrim($sql, "UNION ALL ");

                            if (count($params) > 0) {
                                $stmt = $conn->prepare($sql);
                                $types = str_repeat('s', count($params));
                                $bind_name = [];
                                $bind_names[] = $types;
                                for ($i = 0; $i < count($params); $i++) {
                                    $bind_name = 'bind' . $i;
                                    $$bind_name = $params[$i];
                                    $bind_names[] = &$$bind_name;
                                }
                                call_user_func_array([$stmt, 'bind_param'], $bind_names);
                            } else {
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $searchQuery);
                            }
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $totalRecords = $result->num_rows;
                            $totalPages = ceil($totalRecords / $recordsPerPage);
                            $stmt->close();

                            $tableResult->data_seek(0);
                            createPagination($query, $searchLoc, $searchLang, $totalPages, $currentPage);
                            $sql = "";
                            $params = [];
                            while ($tableRow = $tableResult->fetch_assoc()) {
                                $tableName = $tableRow['TABLE_NAME'];
                                $sql = $sql . "SELECT '$tableName' AS source, page_id, page_content FROM $tableName WHERE
                                    page_content LIKE ? UNION ALL ";
                                $params[] = '%' . $searchQuery . '%'; // Placeholder for LIKE
                            }
                            $sql = rtrim($sql, "UNION ALL ");
                            $sql = "SELECT * FROM ($sql) AS combined_results LIMIT ?, ?";
                            $params[] = $startFrom; // Placeholder for LIMIT offset
                            $params[] = $recordsPerPage; // Placeholder for LIMIT count
                
                            if (count($params) > 0) {
                                $stmt = $conn->prepare($sql);
                                $types = str_repeat('s', count($params) - 2) . 'ii';
                                $stmt->bind_param($types, ...$params);
                            } else {
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("sii", $searchQuery, $startFrom, $recordsPerPage);
                            }
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $stmt->close();

                            echo '<article class="container search-results-container fontDiv fontDiv-m">';
                            if ($result->num_rows > 0) {
                                $counter = ($currentPage * 10) - 9;
                                while ($row = $result->fetch_assoc()) {
                                    $text = htmlspecialchars($row['page_content']);
                                    $pageID = htmlspecialchars($row['page_id']);
                                    $bookLink = htmlspecialchars($row['source']);
                                    $bookLink = substr($bookLink, 5);
                                    $bookLink = str_replace("_", "-", $bookLink);
                                    $bookName = str_replace("-", " ", $bookLink);
                                    $bookName = ucwords($bookName);
                                    $position = stripos($text, $query);
                                    $start = max($position - 200, 0);
                                    $end = min($position + strlen($query) + 200, strlen($text));
                                    $displayText = substr($text, $start, $end - $start);
                                    if ($start > 0) {
                                        $displayText = '...' . $displayText;
                                    }
                                    if ($end < strlen($text)) {
                                        $displayText = $displayText . '...';
                                    }
                                    $highlightedText = str_ireplace($query, '<span class="highlight">' . $query . '</span>', $displayText);
                                    echo '<a target="_blank" href="' . BASE_URL . 'books/islamic-book-content.php?bookName=' . $bookLink .
                                        '&pageNumber=' . $pageID . '" class="search-results-link arabic-text"><span class="hover-color">' .
                                        $counter . ': </span>' . $highlightedText . ' (' . $bookName . ': ' . $pageID . ')</a>';
                                    ++$counter;
                                }
                            } else {
                                echo '<p>No results found!</p>';
                            }
                            echo '</article>';
                        }
                    }
                }
                ?>
            </div>
        </main>
        <?php include SITE_PATH . '/footer.php' ?>
    </div>
    <script src="<?php echo BASE_URL ?>script.js"></script>
</body>

</html>