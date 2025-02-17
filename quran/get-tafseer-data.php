<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';

if (isset($_GET['ajax']) && $_GET['ajax'] === 'true') {
    $ayahID = htmlspecialchars($_GET['ayahID']);
    $surahID = htmlspecialchars($_GET['surahID']);
    $stmt = $conn->prepare("SELECT * FROM quran_tafseer WHERE ayah_num_surah = ? AND surah_num = ?");
    $stmt->bind_param("ii", $ayahID, $surahID);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $row = $result->fetch_assoc();
    $enTafseerTest1 = htmlspecialchars($row['en_tafseer_test_1']);
    $enTafseerTest2 = htmlspecialchars($row['en_tafseer_test_2']);
    $urTafseerTest1 = htmlspecialchars($row['ur_tafseer_test_1']);
    $url = filter_var($row['video_tafseer_test_1'], FILTER_SANITIZE_URL);

    echo "<p class=\"en_tafseer_test_1 tafseer hide english-text justify\">" . nl2br($enTafseerTest1) . "</p>";
    echo "<p class=\"en_tafseer_test_2 tafseer hide english-text justify\">" . nl2br($enTafseerTest2) . "</p>";
    echo "<p class=\"ur_tafseer_test_1 tafseer hide urdu-text justify\">" . nl2br($urTafseerTest1) . "</p>";
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        echo "<div class=\"video_tafseer_test_1 tafseer video-wrapper hide\"> <iframe width=\"750\" height=\"420\"
        title=\"Video Tafseer\" src=\"" . $url . "\" allowfullscreen frameborder=\"0\" id=\"tafseer-iframe-" . $ayahID . "\">
        </iframe> </div>";
    } else {
        echo "<p class=\"video_tafseer_test_1 tafseer hide english-text\">Invalid URL!</p>";
    }
}