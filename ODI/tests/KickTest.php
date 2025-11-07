<?php
use PHPUnit\Framework\TestCase;

class KickTest extends TestCase
{
    public function testKickUserBerhasil()
    {
        // Simulasi POST data
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['username'] = 'Cowk';
        $_POST['reason'] = 'Toxic in chat';

        // Tangkap output (karena kick.php mencetak HTML)
        ob_start();
        include __DIR__ . '/../src/kick.php';
        $output = ob_get_clean();

        // Periksa apakah pesan sukses muncul
        $this->assertStringContainsString("User 'Cowk' berhasil di-kick", $output);
        $this->assertStringContainsString("success", $output);
    }

    public function testKickUserGagalKarenaInputKosong()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['username'] = '';
        $_POST['reason'] = '';

        ob_start();
        include __DIR__ . '/../src/kick.php';
        $output = ob_get_clean();

        $this->assertStringContainsString("Username dan alasan wajib diisi!", $output);
        $this->assertStringContainsString("error", $output);
    }
}
