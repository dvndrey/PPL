<?php
session_start();

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function login($email, $password) {
    // Dummy registered users untuk Discord
    $users = [
        'discord.user@example.com' => 'DiscordPass123!',
        'gamer@example.com' => 'Gaming2024!',
        'test.user@example.com' => 'TestPass99!'
    ];
    
    // Check if email format is valid
    if (!validateEmail($email)) {
        return ['success' => false, 'message' => 'Please enter a valid email'];
    }
    
    // Check if email is registered
    if (!isset($users[$email])) {
        return ['success' => false, 'message' => 'Email not registered'];
    }
    
    // Check if password is correct
    if ($users[$email] === $password) {
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $email;
        return ['success' => true, 'message' => 'Login berhasil, diarahkan ke dashboard Discord'];
    } else {
        return ['success' => false, 'message' => 'Invalid password'];
    }
}

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $result = login($email, $password);
    $message = $result['message'];
    $messageType = $result['success'] ? 'success' : 'error';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Discord - Welcome back!</title>
    <style>
        body {
            font-family: 'Whitney', 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: #36393f;
            padding: 32px;
            border-radius: 5px;
            box-shadow: 0 2px 10px 0 rgba(0,0,0,.2);
            width: 100%;
            max-width: 480px;
        }
        h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 8px;
        }
        .subtitle {
            color: #b9bbbe;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #b9bbbe;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #202225;
            border-radius: 3px;
            background-color: #202225;
            color: #dcddde;
            font-size: 16px;
        }
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #00b0f4;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #5865F2;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            margin-top: 20px;
        }
        button:hover {
            background-color: #4752C4;
        }
        .message {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 3px;
            text-align: center;
            font-size: 14px;
        }
        .success {
            background-color: #3ba55d;
            color: white;
        }
        .error {
            background-color: #ed4245;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome back!</h2>
        <p class="subtitle">We're so excited to see you again!</p>
        
        <?php if ($message): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label>Email or Phone Number *</label>
                <input type="text" name="email" required>
            </div>
            
            <div class="form-group">
                <label>Password *</label>
                <input type="password" name="password" required>
            </div>
            
            <button type="submit">Log In</button>
        </form>
    </div>
</body>
</html>