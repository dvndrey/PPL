<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) 
    session_start();

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = "Kamu berhasil join server 'CIHUY GRUB' 🎉";
    $messageType = "success";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Discord Invite</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            text-align: center;
        }
        h2 {
            margin-bottom: 15px;
        }
        .invite-box {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            background: #f9f9f9;
        }
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
        button {
            width: 100%;
            padding: 12px;
            background-color: #5865F2;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            opacity: 0.9;
        }
        .server-info {
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <h2>Discord Invite</h2>

    <?php if ($message): ?>
        <div class="message <?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="invite-box">
        <p><b>gilangdafa_ (gilangdafa_09)</b> invited you to join</p>
        <div class="server-info">
            <h3>🌌 CIHUY GRUB</h3>
            <p>🟢 6 Online &nbsp;&nbsp; ⚫ 8 Members</p>
        </div>

        <form method="POST" action="">
            <button type="submit">Accept Invite</button>
        </form>
    </div>
</body>
</html>
