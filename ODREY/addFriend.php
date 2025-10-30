<?php
session_start();

function validateDiscordTag($tag) {
    // Discord username format: username#1234 (4 digit discriminator)
    // atau new format: just username (no discriminator)
    if (empty($tag)) {
        return false;
    }
    
    // Check if it's old format (username#1234) or new format (username)
    if (strpos($tag, '#') !== false) {
        // Old format validation
        $parts = explode('#', $tag);
        if (count($parts) !== 2) {
            return false;
        }
        $username = $parts[0];
        $discriminator = $parts[1];
        
        // Username: 2-32 characters, discriminator: exactly 4 digits
        if (strlen($username) < 2 || strlen($username) > 32) {
            return false;
        }
        if (!preg_match('/^\d{4}$/', $discriminator)) {
            return false;
        }
    } else {
        // New format: 2-32 characters, lowercase, numbers, underscore, period
        if (strlen($tag) < 2 || strlen($tag) > 32) {
            return false;
        }
    }
    
    return true;
}

function addFriend($tag) {
    // Dummy registered users
    $registeredUsers = [
        'cowk3837',
        'testuser#1234',
        'alice#5678',
        'bob2024'
    ];
    
    // Check if tag format is valid
    if (!validateDiscordTag($tag)) {
        return ['success' => false, 'message' => 'Friend request failed'];
    }
    
    // Check if user exists
    if (!in_array($tag, $registeredUsers)) {
        return ['success' => false, 'message' => 'Friend request failed'];
    }
    
    // Success
    return ['success' => true, 'message' => "Success! Your friend request to {$tag} was sent."];
}

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tag = $_POST['tag'] ?? '';
    
    $result = addFriend($tag);
    $message = $result['message'];
    $messageType = $result['success'] ? 'success' : 'error';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Discord - Add Friend</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #36393f;
            color: #dcddde;
        }
        h2 {
            color: #fff;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #b9bbbe;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #202225;
            border-radius: 3px;
            background-color: #40444b;
            color: #dcddde;
        }
        button {
            padding: 10px 20px;
            background-color: #5865F2;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
        }
        button:hover {
            background-color: #4752C4;
        }
        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 3px;
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
    <h2>Add Friend</h2>
    <p>You can add friends with their Discord username.</p>
    
    <?php if ($message): ?>
        <div class="message <?php echo $messageType; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="">
        <div class="form-group">
            <label>Discord Username:</label>
            <input type="text" name="tag" placeholder="Enter username or username#1234" required>
        </div>
        
        <button type="submit">Send Friend Request</button>
    </form>
</body>
</html>