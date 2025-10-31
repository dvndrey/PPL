<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Chat/ChatService.php';

class ChatServiceTest extends TestCase
{
    private ChatService $chatService;

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

    private function pass(string $name): void
    {
        echo "\033[32m✅ PASS - {$name}\033[0m\n";
        flush();
    }

    private function showFail(string $name): void
    {
        echo "\033[31m❌ FAIL - {$name}\033[0m\n";
        flush();
    }

    /** @test */
    public function testSendDM(): void
    {
        try {
            $result = $this->chatService->sendDM(1, 2, "Halo");
            $this->assertStringContainsString("DM from Gilang to CowK: Halo", $result);
            $this->pass('Send DM');
        } catch (Throwable $e) {
            $this->showFail('Send DM');
            throw $e;
        }
    }

    /** @test */
    public function testSendEmptyDM(): void
    {
        try {
            $result = $this->chatService->sendDM(1, 2, "");
            $this->assertEquals("❌ Cannot send empty message.", $result);
            $this->pass('Send empty DM');
        } catch (Throwable $e) {
            $this->showFail('Send empty DM');
            throw $e;
        }
    }

    /** @test */
    public function testSendChannelMessage(): void
    {
        try {
            $result = $this->chatService->sendChannelMessage(1, 1, "Halo");
            $this->assertStringContainsString("[#general] Gilang: Halo", $result);
            $this->pass('Send channel message');
        } catch (Throwable $e) {
            $this->showFail('Send channel message');
            throw $e;
        }
    }

    /** @test */
    public function testSendFileBlocked(): void
    {
        try {
            $result = $this->chatService->sendFile(1, 1, "malware.exe");
            $this->assertEquals("❌ File format not supported.", $result);
            $this->pass('Send file blocked');
        } catch (Throwable $e) {
            $this->showFail('Send file blocked');
            throw $e;
        }
    }
}
