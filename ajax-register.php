<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';

if (isset($_POST['ajax']) && $_POST['ajax'] === 'true') {
    $username = htmlspecialchars(trim($_POST['username-reg']));
    $email = htmlspecialchars(trim($_POST['email-reg']));
    $password = htmlspecialchars(trim($_POST['password-reg']));
    $passwordRepeat = htmlspecialchars(trim($_POST['password-repeat-reg']));

    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        $_SESSION['message'] = "Fields are empty!";
        $_SESSION['messageClass'] = "red";
    } else if (strlen($username) > 24) {
        $_SESSION['message'] = "Username cannot be more than 24 characters long!";
        $_SESSION['messageClass'] = "red";
    } else if (strlen($username) < 4) {
        $_SESSION['message'] = "Username must be at least 4 characters long!";
        $_SESSION['messageClass'] = "red";
    } else if (!preg_match('/^[a-zA-Z0-9_-]+$/', $username)) {
        $_SESSION['message'] = "Username can only contain alphabets, numbers, underscores, or hyphens!";
        $_SESSION['messageClass'] = "red";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format!";
        $_SESSION['messageClass'] = "red";
    } else if (strlen($password) < 8) {
        $_SESSION['message'] = "Password must be at least 8 characters long!";
        $_SESSION['messageClass'] = "red";
    } else if ($password !== $passwordRepeat) {
        $_SESSION['message'] = "Passwords do not match!";
        $_SESSION['messageClass'] = "red";
    } else {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            $_SESSION['message'] = "This username is already taken!";
            $_SESSION['messageClass'] = "red";
        } else {
            $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if ($result->num_rows > 0) {
                $_SESSION['message'] = "An account on this email already exists!";
                $_SESSION['messageClass'] = "red";
            } else {
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $email, $passwordHash);
                $stmt->execute();
                $stmt->close();
                $_SESSION['message'] = "Account Registered Successfully!";
                $_SESSION['messageClass'] = "green";
                if (isset($_COOKIE['cookieUsername'])) {
                    unset($_COOKIE['cookieUsername']);
                    setcookie('cookieUsername', '', time() - 3600, '/');
                }
                setcookie('cookieUsername', $username, time() + (86400 * 30), '/');
            }
        }
    }
}