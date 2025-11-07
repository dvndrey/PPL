<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Chat/ChatService.php';

class ChatServiceTest extends TestCase
{
    private $chatService;

    protected function setUp(): void
    {
        $this->chatService = new ChatService(
            [
                1 => ['name' => 'Gilang'],
                2 => ['name' => 'CowK']
            ],
            [
                1 => ['name' => '#general']
            ]
        );
    }

    /** @test */
    public function testSendDM()
    {
        try {
            $result = $this->chatService->sendDM(1, 2, "Halo");
            $this->assertStringContainsString("DM from Gilang to CowK: Halo", $result);
            echo "\033[32m✓\033[0m PASS - Send DM\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Send DM\n";
            throw $e;
        }
    }

    /** @test */
    public function testSendEmptyDM()
    {
        try {
            $result = $this->chatService->sendDM(1, 2, "");
            $this->assertEquals("âŒ Cannot send empty message.", $result);
            echo "\033[32m✓\033[0m PASS - Send empty DM\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Send empty DM\n";
            throw $e;
        }
    }

    /** @test */
    public function testSendChannelMessage()
    {
        try {
            $result = $this->chatService->sendChannelMessage(1, 1, "Halo");
            $this->assertStringContainsString("[#general] Gilang: Halo", $result);
            echo "\033[32m✓\033[0m PASS - Send channel message\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Send channel message\n";
            throw $e;
        }
    }

    /** @test */
    public function testSendFileBlocked()
    {
        try {
            $result = $this->chatService->sendFile(1, 1, "malware.exe");
            $this->assertEquals("âŒ File format not supported.", $result);
            echo "\033[32m✓\033[0m PASS - Send file blocked\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Send file blocked\n";
            throw $e;
        }
    }
}