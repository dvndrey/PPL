<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Voice/CallService.php';

class CallServiceTest extends TestCase
{
    private $callService;

    protected function setUp(): void
    {
        $this->callService = new CallService([
            1 => ['name' => 'CowK', 'avatar' => 'pp.jpg'],
        ]);
    }

    /** @test */
    public function testVoiceCall()
    {
        try {
            $result = $this->callService->voiceCall(1);
            $this->assertStringContainsString("📞 Voice call with CowK is connected!", $result);
            echo "\033[32m✅\033[0m PASS - Voice call\n";
        } catch (Exception $e) {
            echo "\033[31m❌\033[0m FAIL - Voice call\n";
            throw $e;
        }
    }

    /** @test */
    public function testVideoCall()
    {
        try {
            $result = $this->callService->videoCall(1);
            $this->assertStringContainsString("✅ Video call with CowK has started!", $result);
            echo "\033[32m✅\033[0m PASS - Video call\n";
        } catch (Exception $e) {
            echo "\033[31m❌\033[0m FAIL - Video call\n";
            throw $e;
        }
    }

    /** @test */
    public function testScreenShare()
    {
        try {
            $result = $this->callService->screenShare(1, "Browser");
            $this->assertStringContainsString("🖥️ Screen sharing (Browser) started for CowK", $result);
            echo "\033[32m✅\033[0m PASS - Screen share\n";
        } catch (Exception $e) {
            echo "\033[31m❌\033[0m FAIL - Screen share\n";
            throw $e;
        }
    }

    /** @test */
    // public function testUserNotFound()
    // {
    //     try {
    //         $result = $this->callService->voiceCall(99);
    //         $this->assertEquals("User not found.", $result);
    //         echo "\033[32m✅\033[0m PASS - User not found\n";
    //     } catch (Exception $e) {
    //         echo "\033[31m❌\033[0m FAIL - User not found\n";
    //         throw $e;
    //     }
    // }
}
