<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';

if (isset($_POST['ajax']) && $_POST['ajax'] === 'true') {
    $username = htmlspecialchars(trim($_POST['username-login']));
    $password = htmlspecialchars(trim($_POST['password-login']));

    if (empty($username) || empty($password)) {
        $_SESSION['message'] = "Fields are empty!";
        $_SESSION['messageClass'] = "red";
    } else {
        $stmt = $conn->prepare("SELECT user_id, user_password FROM users WHERE user_name = ? OR user_email = ?");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userID = htmlspecialchars($row['user_id']);
            $passwordHash = $row['user_password'];
            if (password_verify($password, $passwordHash)) {
                setcookie('cookieUsername', $username, time() + (86400 * 30), '/');
            } else {
                echo 'Incorrect password!';
            }
        } else {
            $_SESSION['message'] = "Username/Email is not registered!";
            $_SESSION['messageClass'] = "red";
        }
    }
}