<?php
session_start();

function validateAndStoreData($f_name, $l_name, $age, $pin) {
    if (empty($pin)) {
        return "PIN is required.";
    }

    if (empty($age)) {
        return "Age is required.";
    }

    if (!is_numeric($age)) {
        return "Age should be a number.";
    } elseif ($age < 0) {
        return "Age cannot be below 0.";
    } elseif ($age > 150) {
        return "Age cannot exceed 150.";
    }

    // If all validations pass, store data in session and proceed
    $_SESSION['new-acc'] = true;
    $_SESSION['first'] = $f_name;
    $_SESSION['last'] = $l_name;
    $_SESSION['age'] = $age;
    $_SESSION['pass-pin'] = $pin; // Storing the pin in session

    return "success"; // Validation successful
}

if (isset($_POST['pass'])) {
    $pin = $_POST['pass'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['age'];

    $validationResult = validateAndStoreData($f_name, $l_name, $age, $pin);

    if ($validationResult === "success") {
        header("Location: proceed-to-q.php");
    } else {
        header("Location: new-acc.php?error=" . $validationResult);
    }
}

if (isset($_POST['cancel'])) {
    header("Location: login-page.php");
}
?>
