<?php
session_start();

function register($email, $displayName, $username, $password, $dob, $optInMarketing = false) {
    $registeredEmails = ['metodiusbudiono@gmail.com'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format";
    }

    if (strlen($password) < 8) {
        return "Password must be at least 8 characters";
    }

    $birthDate = new DateTime($dob);
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;
    if ($age < 13) {
        return "You must be at least 13 years old";
    }

    if (in_array($email, $registeredEmails)) {
        return "Email already registered";
    }

    $_SESSION['registered'] = [
        'email' => $email,
        'displayName' => $displayName,
        'username' => $username,
        'optInMarketing' => $optInMarketing
    ];

    return "Registration success";
}
?>
