<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';

if (isset($_POST['ajax']) && $_POST['ajax'] === 'true') {
    $email = htmlspecialchars(trim($_POST['email-reset']));

    if (empty($email)) {
        $_SESSION['message'] = "Fields are empty!";
        $_SESSION['messageClass'] = "red";
    } else {
        $stmt = $conn->prepare("SELECT user_id, user_password FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userID = htmlspecialchars($row['user_id']);
            $passwordHash = $row['user_password'];

            /* TO BE CONTINUED HERE ... */

        } else {
            $_SESSION['message'] = "No account on this email exists!";
            $_SESSION['messageClass'] = "red";
        }
    }
}