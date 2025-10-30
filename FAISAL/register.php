<?php
session_start();

function register($email, $displayName, $username, $password, $dob, $optInMarketing = false) {
    // Dummy data simulasi database
    $registeredEmails = ['metodiusbudiono@gmail.com'];

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format";
    }

    // Validasi panjang password
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters";
    }

    // Validasi umur minimal 13 tahun
    $birthDate = new DateTime($dob);
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;
    if ($age < 13) {
        return "You must be at least 13 years old";
    }

    // Cek email sudah terdaftar
    if (in_array($email, $registeredEmails)) {
        return "Email already registered";
    }

    // Jika semua validasi lolos
    $_SESSION['registered'] = [
        'email' => $email,
        'displayName' => $displayName,
        'username' => $username,
        'optInMarketing' => $optInMarketing
    ];

    return "Registration success";
}
?>
