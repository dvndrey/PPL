<?php

use PHPUnit\Framework\TestCase;

class KickTest extends TestCase
{
    public function testKickUserBerhasil()
    {
        try {
            // Simulasi POST data
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $_POST['username'] = 'Cowk';
            $_POST['reason'] = 'Toxic in chat';

            // Tangkap output (karena kick.php mencetak HTML)
            ob_start();
            include __DIR__ . '/../src/kick.php';
            $output = ob_get_clean();

            // Assertion utama
            $this->assertStringContainsString("User 'Cowk' berhasil di-kick", $output);
            $this->assertStringContainsString("success", $output);

            // Jika tidak ada error → PASS
            echo "\033[32m✓\033[0m PASS - Kick user berhasil\n";
        } catch (Throwable $e) {
            // Jika ada error → FAIL
            echo "\033[31m✗\033[0m FAIL - Kick user berhasil\n";
            throw $e;
        }
    }

    public function testKickUserGagalKarenaInputKosong()
    {
        try {
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $_POST['username'] = '';
            $_POST['reason'] = '';

            ob_start();
            include __DIR__ . '/../src/kick.php';
            $output = ob_get_clean();

            $this->assertStringContainsString("Username dan alasan wajib diisi!", $output);
            $this->assertStringContainsString("error", $output);

            echo "\033[32m✓\033[0m PASS - Kick user gagal karena input kosong\n";
        } catch (Throwable $e) {
            echo "\033[31m✗\033[0m FAIL - Kick user gagal karena input kosong\n";
            throw $e;
        }
    }
}
