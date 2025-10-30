<?php
session_start();

function login($username, $password) {
    // Dummy credentials for testing
    $validUsername = 'user@example.com';
    $validPassword = 'password123';

    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['logged_in'] = true;
        return true;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (login($username, $password)) {
        echo "Login berhasil!";
    } else {
        echo "Login gagal!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Shopee</title>
</head>
<body>
    <h2>Log in</h2>
    login.php
        <label>No. Handphone/Username/Email:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">LOG IN</button>
    </form>
</body>
</html>