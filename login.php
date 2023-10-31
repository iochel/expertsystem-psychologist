<?php
session_start();
require $_SERVER["DOCUMENT_ROOT"] . '/expertsystem-psychologist/config/database.php';

function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkUserExists($conn, $email) {
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) === 1;
}

if (isset($_POST['email'])) {
    $email = validateInput($_POST['email']);

    if (empty($email)) {
        header("Location: login-page.php?error=Username is required");
    } else {
        $_SESSION['email'] = $email;
        if (checkUserExists($conn, $email)) {
            header("Location: used-acc.php");
        } else {
            header("Location: new-acc.php");
        }
    }
} else {
    header("Location: login-page.php");
    exit();
}
?>
