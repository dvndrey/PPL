<?php
use PHPUnit\Framework\TestCase;

class JoinServerTest extends TestCase
{
    public function testInitialPageHasNoMessage()
    {
        try {
            $_SERVER['REQUEST_METHOD'] = 'GET';
            $_POST = [];

            ob_start();
            include __DIR__ . '/../src/join.php';
            $output = ob_get_clean();

            $this->assertStringNotContainsString("Kamu berhasil join server", $output);
            echo "\033[32m✓\033[0m PASS - Initial page has no message\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Initial page has no message\n";
            throw $e;
        }
    }

    public function testJoinServerSuccessMessage()
    {
        try {
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $_POST = [];

            ob_start();
            include __DIR__ . '/../src/join.php';
            $output = ob_get_clean();

            // Hilangkan tag HTML supaya tidak memenuhi terminal
            $cleanOutput = strip_tags($output);

            // Pastikan pesan sukses muncul
            $this->assertStringContainsString(
    "Kamu berhasil join server 'CIHUY GRUB'",
    $cleanOutput,
    "Pesan sukses tidak ditemukan di halaman join server."
);


            echo "\033[32m✓\033[0m PASS - Join server success message\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Join server success message\n";
            throw $e;
        }
    }
}
