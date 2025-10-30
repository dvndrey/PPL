<?php
session_start();

// Ambil pesan dari session jika ada
$message = $_SESSION['message'] ?? '';
$messageType = $_SESSION['messageType'] ?? '';
unset($_SESSION['message'], $_SESSION['messageType']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $confirm = isset($_POST['confirm']) ? true : false;

    if (!$confirm) {
        $_SESSION['message'] = "Anda harus menyetujui sebelum mentransfer ownership!";
        $_SESSION['messageType'] = "error";
    } else {
        $_SESSION['message'] = "Ownership berhasil ditransfer ke user cowk3837.";
        $_SESSION['messageType'] = "success";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Transfer Ownership</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f6f6;
        }
        .container {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 15px;
        }
        p {
            font-size: 14px;
            color: #444;
            margin-bottom: 15px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-size: 14px;
        }
        input[type="checkbox"] {
            margin-right: 8px;
        }
        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        button {
            width: 48%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
        }
        .btn-cancel {
            background: #999;
            color: #fff;
        }
        .btn-transfer {
            background: #d83c3e;
            color: #fff;
        }
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
        }
        .success {
            background: #d4edda;
            color: #155724;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Transfer Ownership</h2>
        <p>
            This will transfer ownership of <b>Yamete</b> to <b>cowk3837</b>. <br>
            This cannot be undone!
        </p>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label>
                    <input type="checkbox" name="confirm">
                    I acknowledge that by transferring ownership of this server to cowk3837, it officially belongs to them.
                </label>
            </div>

            <div class="btn-group">
                <button type="button" class="btn-cancel" onclick="window.location.href='dashboard.php'">Cancel</button>
                <button type="submit" class="btn-transfer">Transfer Ownership</button>
            </div>
        </form>
    </div>
</body>
</html>
