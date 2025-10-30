<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$message = '';
$messageType = '';

// Pastikan $_POST sudah diset sebelum diakses
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($requestMethod === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $reason   = isset($_POST['reason']) ? trim($_POST['reason']) : '';

    if ($username === '' || $reason === '') {
        $message = "Username dan alasan wajib diisi!";
        $messageType = "error";
    } else {
        // Simulasi proses "kick"
        // Misalnya simpan ke log atau database (disimulasikan saja)
        $safeUsername = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
        $safeReason   = htmlspecialchars($reason, ENT_QUOTES, 'UTF-8');
        $message = "User '$safeUsername' berhasil di-kick dengan alasan: $safeReason";
        $messageType = "success";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kick User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            text-align: center;
        }
        h2 { margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; text-align: left; }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 48%;
            padding: 12px;
            background-color: #5865F2;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button.cancel { background-color: #555; }
        button:hover { opacity: 0.9; }
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 3px;
        }
        .success {
            background: #d4edda;
            color: #155724;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
        }
        .btn-group {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <h2>Kick User</h2>

    <?php if (!empty($message)): ?>
        <div class="message <?= $messageType ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" placeholder="cth: dvndrey_54295" required>
        </div>

        <div class="form-group">
            <label>Reason for Kick:</label>
            <textarea name="reason" rows="3" maxlength="500" required></textarea>
        </div>

        <div class="btn-group">
            <button type="button" class="cancel" onclick="window.location.href='dashboard.php'">Cancel</button>
            <button type="submit">Kick</button>
        </div>
    </form>
</body>
</html>
