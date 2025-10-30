<?php
// BotIntegrationTest.php
use PHPUnit\Framework\TestCase;
require_once 'botIntegration.php';

class BotIntegrationTest extends TestCase
{
    private $bot;

    protected function setUp(): void
    {
        $this->bot = new BotIntegration();
    }

    // TC-20 : Melakukan transfer kepemilikan server
    public function test_TC_20_Melakukan_transfer_kepemilikan_server()
    {
        try {
            $result = $this->bot->transferOwnership('Yamete', 'Cowk');
            $this->assertStringContainsString('Ownership berhasil ditransfer ke user Cowk.', $result);
            $currentOwner = $this->bot->getOwner('Yamete');
            $this->assertEquals('Cowk', $currentOwner);
            echo "\033[32m✓\033[0m PASS - TC 20 Melakukan transfer kepemilikan server\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - TC 20 Melakukan transfer kepemilikan server\n";
            throw $e;
        }
    }
}