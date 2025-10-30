<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $invite_link = $_POST['invite_link'] ?? '';

    if ($invite_link === 'https://discord.gg/CIHUY') {
        echo "Kamu berhasil join server 'CIHUY GRUB' 🎉";
    } else {
        echo "Link undangan tidak valid atau sudah kadaluarsa ❌";
    }
} else {
    echo ""; // tidak ada pesan saat pertama kali GET
}
