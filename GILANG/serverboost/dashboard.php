<?php
session_start();
require 'functions.php';

if (!isBooster($user_id = $_SESSION['user_id'])) {
    die('<h2>🚫 Akses ditolak!</h2><p>Hanya untuk booster. <a href="index.php">Kembali</a></p>');
}

$server = getServerData();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Area Booster</title>
</head>

<body>
    <h1>💎 Selamat Datang di Area Eksklusif!</h1>
    <p>Level server saat ini: <strong><?= $server['level'] ?></strong></p>
    <p>Total boost: <strong><?= $server['total_boosts'] ?></strong></p>
    <p><a href="index.php">Kembali ke beranda</a></p>
</body>

</html>