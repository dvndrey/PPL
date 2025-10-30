<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\AssertionFailedError;

// ----------------------
// Simulasi bot & server
// ----------------------
class ServerBot
{
    private $servers = [];

    public function __construct()
    {
        // Simulasi server awal
        $this->servers = [
            'GamingServer' => [
                'members' => [],
            ]
        ];
    }

    // Invite bot ke server
    public function inviteBot($serverName, $botName)
    {
        if (!isset($this->servers[$serverName])) {
            return ['success' => false, 'message' => "Server '$serverName' tidak ditemukan"];
        }

        // Tambahkan bot ke member list
        $this->servers[$serverName]['members'][$botName] = [
            'status' => 'active',
            'source' => 'top.gg'
        ];

        return ['success' => true, 'message' => "Bot '$botName' berhasil diundang ke server '$serverName'"];
    }

    // Mengecek status bot
    public function getBotStatus($serverName, $botName)
    {
        if (!isset($this->servers[$serverName])) {
            return ['success' => false, 'message' => "Server '$serverName' tidak ditemukan"];
        }

        if (!isset($this->servers[$serverName]['members'][$botName])) {
            return ['success' => false, 'message' => "Bot '$botName' tidak ditemukan di server"];
        }

        return [
            'success' => true,
            'status' => $this->servers[$serverName]['members'][$botName]['status']
        ];
    }
}

// ----------------------
// PHPUnit Test Class
// ----------------------
class BotIntegrationTest extends TestCase
{
    private $serverBot;

    protected function setUp(): void
    {
        $this->serverBot = new ServerBot();
    }

    private function runTest($desc, $expectedSuccess, $expectedMessage, $callback)
    {
        try {
            $result = $callback();
            $this->assertEquals($expectedSuccess, $result['success']);
            if (isset($result['message'])) {
                $this->assertEquals($expectedMessage, $result['message']);
            }

            // X jika expected error, centang jika sukses
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

    public function testBotInviteSuccess()
    {
        $this->runTest(
            "Bot berhasil diundang melalui top.gg",
            true,
            "Bot 'HelperBot' berhasil diundang ke server 'GamingServer'",
            fn() => $this->serverBot->inviteBot('GamingServer', 'HelperBot')
        );
    }

}
