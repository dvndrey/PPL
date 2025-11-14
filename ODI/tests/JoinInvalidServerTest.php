<?php
use PHPUnit\Framework\TestCase;

class JoinInvalidServerTest extends TestCase
{
    public function testInvalidInviteShowsError()
    {
        try {
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $_POST['invite_link'] = 'https://discord.gg/SALAH';

            ob_start();
            include __DIR__ . '/../src/join_invalid.php';
            $output = ob_get_clean();

            $this->assertStringContainsString("Link undangan tidak valid atau sudah kadaluarsa ", $output);
            echo "\033[32m✓\033[0m PASS - Invalid invite shows error\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Invalid invite shows error\n";
            throw $e;
        }
    }

    public function testValidInviteShowsSuccess()
    {
        try {
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $_POST['invite_link'] = 'https://discord.gg/CIHUY';

            ob_start();
            include __DIR__ . '/../src/join_invalid.php';
            $output = ob_get_clean();

            $this->assertStringContainsString("Kamu berhasil join server 'CIHUY GRUB' ", $output);
            echo "\033[32m✓\033[0m PASS - Valid invite shows success\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Valid invite shows success\n";
            throw $e;
        }
    }
}