<?php
session_start();
if ($_SERVER['HTTP_HOST'] == "localhost") {
    include $_SERVER['DOCUMENT_ROOT'] . '/Maktaba-tul-Ahadith/base-url.php';
} else {
    include $_SERVER['DOCUMENT_ROOT'] . '/base-url.php';
}
include SITE_PATH . '/db-connection.php';

if (isset($_POST['ajax']) && $_POST['ajax'] === 'true') {
    $type = $_POST['type'];
    if ($type === 'reg') {
        if (isset($_POST['username'])) {
            $query = $_POST['username'];
            $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_name = ?");
        } else if (isset($_POST['email'])) {
            $query = $_POST['email'];
            $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_email = ?");
        }
        $stmt->bind_param("s", $query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            if (isset($_POST['username']))
                echo 'This username is already taken!';
            else if (isset($_POST['email']))
                echo 'An account on this email already exists!';
        } else {
            echo '';
        }
    } else if ($type === 'login') {
        $query = $_POST['username'];
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_name = ? OR user_email = ?");
        $stmt->bind_param("ss", $query, $query);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            echo '';
        } else {
            echo 'This username/email does not exist!';
        }
    } else if ($type === 'reset') {
        $email = $_POST['email'];
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            echo '';
        } else {
            echo 'No account on this email exists!';
        }
    }
}