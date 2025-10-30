<?php
session_start();
require 'functions.php';

// Simulasikan "login" jika belum punya ID
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = generateUserId();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['boost'])) {
    if (addBooster($user_id = $_SESSION['user_id'])) {
        $message = '<p style="color:green;">✅ Boost berhasil! Level server sekarang: ' . getServerData()['level'] . '</p>';
    } else {
        $message = '<p style="color:orange;">ℹ️ Kamu sudah pernah boost sebelumnya.</p>';
    }
}

$server = getServerData();
// $isBooster = isBooster();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Server Kami</title>
</head>

<body>
    <h1>🌟 Server Komunitas Keren</h1>
    <p><strong>Level Server:</strong> <?= $server['level'] ?></p>
    <p><strong>Total Boost:</strong> <?= $server['total_boosts'] ?></p>

    <form method="POST">
        <button type="submit" name="boost">✨ Boost Server Ini!</button>
    </form>

    <?php if ($server['total_boosts'] > 0): ?>
        <p>🎉 Terima kasih telah mendukung server ini!</p>
    <?php endif; ?>

    <?= $message ?>
</body>

</html>