<?php
use PHPUnit\Framework\TestCase;

// Import functions from addFriend.php
function validateDiscordTag($tag) {
    if (empty($tag)) {
        return false;
    }
    
    if (strpos($tag, '#') !== false) {
        $parts = explode('#', $tag);
        if (count($parts) !== 2) {
            return false;
        }
        $username = $parts[0];
        $discriminator = $parts[1];
        
        if (strlen($username) < 2 || strlen($username) > 32) {
            return false;
        }
        if (!preg_match('/^\d{4}$/', $discriminator)) {
            return false;
        }
    } else {
        if (strlen($tag) < 2 || strlen($tag) > 32) {
            return false;
        }
    }
    
    return true;
}

function addFriend($tag) {
    $registeredUsers = [
        'gilangdafa_09'
    ];
    
    if (!validateDiscordTag($tag)) {
        return ['success' => false, 'message' => 'Friend request failed'];
    }
    
    if (!in_array($tag, $registeredUsers)) {
        return ['success' => false, 'message' => 'Friend request failed'];
    }
    
    return ['success' => true, 'message' => "Success! Your friend request to {$tag} was sent."];
}

class AddFriendTest extends TestCase
{
    // TC-07: Menambahkan teman dengan tag valid
    // Expected: Permintaan terkirim
    public function testAddFriendWithValidTag()
    {
        try {
            $result = addFriend('gilangdafa_09');
            $this->assertTrue($result['success']);
            $this->assertStringContainsString('Success', $result['message']);
            $this->assertStringContainsString('friend request', $result['message']);
            echo "\033[32m✓\033[0m PASS - Add friend with valid tag\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Add friend with valid tag\n";
            throw $e;
        }
    }
    
    
    // TC-02c: Username tidak ditemukan
    // Expected: Error "friend request failed"
    public function testAddFriendWithUserNotFound()
    {
        try {
            $result = addFriend('gilangdaf4');
            $this->assertFalse($result['success']);
            $this->assertEquals('Friend request failed', $result['message']);
            echo "\033[32m✓\033[0m PASS - Add friend with user not found\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Add friend with user not found\n";
            throw $e;
        }
    }
}
?>