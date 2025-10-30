<?php
session_start();

// Ambil pesan dari session jika ada
$message = $_SESSION['message'] ?? '';
$messageType = $_SESSION['messageType'] ?? '';

// Hapus pesan dari session setelah diambil (supaya tidak muncul lagi setelah refresh)
unset($_SESSION['message'], $_SESSION['messageType']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serverName = $_POST['server_name'] ?? '';
    $icon = $_FILES['icon']['name'] ?? '';

    if (empty($serverName)) {
        $_SESSION['message'] = "Nama server wajib diisi!";
        $_SESSION['messageType'] = "error";
    } else {
        // Simulasi proses pembuatan server
        $msg = "Server '$serverName' berhasil dibuat.";
        if (!empty($icon)) {
            $msg .= " Ikon yang diunggah: " . htmlspecialchars($icon);
        }
        $_SESSION['message'] = $msg;
        $_SESSION['messageType'] = "success";
    }

    // Redirect agar form tidak resubmit saat refresh
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Buat Server</title>
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
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
        .btn-back {
            background: #999;
            color: #fff;
        }
        .btn-create {
            background: #5865F2;
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
        <h2>Customize Your Server</h2>
        <p style="text-align:center; font-size:14px; color:#555;">
            Give your new server a personality with a name and an icon. You can always change it later
        </p>

        <?php if (!empty($message)): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label>Upload Icon:</label>
                <input type="file" name="icon" accept="image/*">
            </div>

            <div class="form-group">
                <label>Server Name <span style="color:red">*</span>:</label>
                <input type="text" name="server_name" required>
            </div>

            <div class="btn-group">
                <button type="button" class="btn-back" onclick="window.location.href='dashboard.php'">Back</button>
                <button type="submit" class="btn-create">Create</button>
            </div>
        </form>
    </div>
</body>
</html>
