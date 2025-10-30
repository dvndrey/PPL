<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $reason = $_POST['reason'] ?? '';

    if (empty($username) || empty($reason)) {
        $message = "Username dan alasan wajib diisi!";
        $messageType = "error";
    } else {
        // Simulasi proses "ban"
        // Misal simpan ke log atau database
        $message = "User '$username' berhasil di-ban dengan alasan: " . htmlspecialchars($reason);
        $messageType = "success";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ban User</title>
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
        label { font-weight: bold; display: block; margin-bottom: 5px; }
        input[type="text"], textarea {
            width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;
        }
        button {
            width: 48%; padding: 12px; background-color: #d9534f; color: white;
            border: none; border-radius: 4px; font-size: 16px; cursor: pointer;
        }
        button.cancel { background-color: #555; }
        button:hover { opacity: 0.9; }
        .message { padding: 10px; margin-bottom: 15px; border-radius: 3px; }
        .success { background: #d4edda; color: #155724; }
        .error { background: #f8d7da; color: #721c24; }
        .btn-group { display: flex; justify-content: space-between; }
    </style>
</head>
<body>
    <h2>Ban User</h2>

    <?php if ($message): ?>
        <div class="message <?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" placeholder="cth: dvndrey_54295" required>
        </div>

        <div class="form-group">
            <label>Reason for Ban:</label>
            <textarea name="reason" rows="3" maxlength="500" required></textarea>
        </div>

        <div class="btn-group">
            <button type="button" class="cancel" onclick="window.location.href='dashboard.php'">Cancel</button>
            <button type="submit">Ban</button>
        </div>
    </form>
</body>
</html>
