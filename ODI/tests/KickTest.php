<?php
use PHPUnit\Framework\TestCase;

class KickTest extends TestCase
{
    public function testKickUserBerhasil()
    {
        try {

            $_SERVER['REQUEST_METHOD'] = 'POST';
            $_POST['username'] = 'Cowk';
            $_POST['reason'] = 'Toxic in chat';

            ob_start();
            include __DIR__ . '/../src/kick.php';
            $output = ob_get_clean();

            $this->assertStringContainsString("User 'Cowk' berhasil di-kick", $output);
            $this->assertStringContainsString("success", $output);

            echo "\033[32m✓\033[0m PASS - Kick user berhasil\n";

        } catch (\Exception $e) {
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

            // Cek pesan error
            $this->assertStringContainsString("Username dan alasan wajib diisi!", $output);
            $this->assertStringContainsString("error", $output);

            // Tampilkan centang hijau
            echo "\033[32m✓\033[0m PASS - Kick user gagal karena input kosong\n";

        } catch (\Exception $e) {
            // Tampilkan silang merah kalau gagal
            echo "\033[31m✗\033[0m FAIL - Kick user gagal karena input kosong\n";
            throw $e;
        }
    }
}
