<?php
session_start();

// Ambil pesan dari session jika ada
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['server']) && !empty($_POST['server'])) {
        $_SESSION['message'] = "Bot berhasil ditambahkan ke server " . htmlspecialchars($_POST['server']) . ".";
    } else {
        $_SESSION['message'] = "Silakan pilih server terlebih dahulu.";
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Bot to Server</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 30px;
            width: 400px;
            text-align: center;
        }
        h2 {
            margin-top: 0;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
            padding: 10px;
            margin: 15px 0;
        }
        select {
            padding: 8px;
            width: 100%;
            margin-top: 8px;
        }
        .buttons {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .btn-cancel {
            background-color: #888;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-cancel:hover {
            background-color: #777;
        }
        .btn-continue {
            background-color: #d33;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-continue:hover {
            background-color: #b22;
        }
        .checkbox {
            text-align: left;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Add Bot to Server</h2>
    <p>This will add <b>Musico</b> bot to your selected Discord server.</p>

    <?php if (!empty($message)): ?>
        <div class="success"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="server"><b>Select Server:</b></label><br>
        <select name="server" id="server" required>
            <option value="">-- Pilih Server --</option>
            <option value="Server PPL">Server PPL</option>
        </select>

        <div class="buttons">
            <button type="button" class="btn-cancel" onclick="window.location.href='dashboard.php'">Cancel</button>
            <button type="submit" class="btn-continue">Continue</button>
        </div>
    </form>
</div>

</body>
</html>
