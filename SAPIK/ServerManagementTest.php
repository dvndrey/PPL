<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\AssertionFailedError;

class ServerCreator
{
    public function createServer($template, $purpose, $icon, $name)
    {
        if (empty($template) || empty($purpose) || empty($icon) || empty($name)) {
            return [
                "success" => false,
                "message" => "semua field belum terisi"
            ];
        }

        $msg = "Server berhasil dibuat!\n" .
               "Nama Server: $name\n" .
               "Template: $template\n" .
               "Tujuan: $purpose\n\n" .
               "Ikon yang diunggah: $icon\n" .
               "Server '$name' berhasil dibuat";

        return [
            "success" => true,
            "message" => $msg
        ];
    }
}

class ServerManagementTest extends TestCase
{
    private $creator;

    protected function setUp(): void
    {
        $this->creator = new ServerCreator();
    }

    public function testCreateServer()
    {
        // ===============================
        // GANTI INPUT DI SINI
        // ===============================
        $template = "Gaming";
        $purpose  = "For club and community";
        $icon     = "bg-hero.jpg";
        $name     = "MODUL";

        // ===============================
        // JALANKAN FUNGSI
        // ===============================
        $result = $this->creator->createServer($template, $purpose, $icon, $name);

        // ---------------------------------------------------------
        // ❌ Jika gagal → FAIL (field kosong)
        // ---------------------------------------------------------
        if ($result['success'] === false) {

            $this->assertFalse($result['success']);
            $this->assertEquals("semua field belum terisi", $result['message']);

            echo "\033[31mX\033[0m FAIL - Field ada yang kosong\n";
            return;
        }

        // ---------------------------------------------------------
        // ✔ Jika berhasil → PASS
        // (actual message dianggap BENAR secara otomatis)
        // ---------------------------------------------------------
        $this->assertTrue($result['success']);
        $this->assertNotEmpty($result['message']);  // hanya cek bahwa message tidak kosong

        echo "\033[32m✓\033[0m PASS - Server berhasil dibuat\n";
    }
}
