<?php

class BotIntegrationTest
{
    private function runTest($testName, $expected, $callable)
    {
        echo "Running: $testName\n";

        $actual = $callable();

        if ($expected !== $actual) {
            echo "❌ FAIL - $testName\n";
            echo "  Expected : $expected\n";
            echo "  Actual   : $actual\n\n";
        } else {
            echo "✔ PASS - $testName\n\n";
        }
    }

    public function testBotInvitation()
    {
        $this->runTest(
            "Bot berhasil diundang melalui top.gg",
            "Bot 'HelperBot' berhasil diundang ke server 'GamingServer'",
            fn() => $this->inviteBot("GamingServer", "HelperBot")
        );
    }

    private function inviteBot($server, $bot)
    {
        return "Bot '$bot' gagal diundang ke server '$server'";
    }
}

$test = new BotIntegrationTest();
$test->testBotInvitation();
