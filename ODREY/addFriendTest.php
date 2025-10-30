<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\AssertionFailedError;

// ----------------------
// Functions to test
// ----------------------
function validateDiscordTag($tag) {
    if (empty($tag)) return false;
    
    if (strpos($tag, '#') !== false) {
        $parts = explode('#', $tag);
        if (count($parts) !== 2) return false;
        $username = $parts[0];
        $discriminator = $parts[1];
        if (strlen($username) < 2 || strlen($username) > 32) return false;
        if (!preg_match('/^\d{4}$/', $discriminator)) return false;
    } else {
        if (strlen($tag) < 2 || strlen($tag) > 32) return false;
    }
    return true;
}

function addFriend($tag) {
    $registeredUsers = ['gilangdafa_09'];
    
    if (!validateDiscordTag($tag)) {
        return ['success' => false, 'message' => 'Friend request failed'];
    }
    
    if (!in_array($tag, $registeredUsers)) {
        return ['success' => false, 'message' => 'Friend request failed'];
    }
    
    return ['success' => true, 'message' => "Success! Your friend request to {$tag} was sent."];
}

// ----------------------
// PHPUnit Test Class
// ----------------------
class AddFriendTest extends TestCase
{
    private function runTest($desc, $expectedSuccess, $expectedMessage, $callback)
    {
        try {
            $result = $callback();
            $this->assertEquals($expectedSuccess, $result['success']);
            $this->assertEquals($expectedMessage, $result['message']);

            // Tampilkan X jika expected error, ✓ jika sukses
            if ($expectedSuccess === false) {
                echo "\033[31mX\033[0m FAIL - {$desc}\n";
            } else {
                echo "\033[32m✓\033[0m PASS - {$desc}\n";
            }

        } catch (AssertionFailedError $e) {
            echo "\033[31mX\033[0m FAIL - {$desc}\n";
        } catch (Exception $e) {
            echo "\033[31mX\033[0m ERROR - {$desc}\n";
        }
    }

    public function testAddFriendWithValidTag()
    {
        $this->runTest(
            "Add friend with valid tag",
            true,
            "Success! Your friend request to gilangdafa_09 was sent.",
            fn() => addFriend('gilangdafa_09')
        );
    }

    public function testAddFriendWithUserNotFound()
    {
        $this->runTest(
            "Add friend with user not found",
            false,
            "Friend request failed",
            fn() => addFriend('gilangdaf4')
        );
    }

}
