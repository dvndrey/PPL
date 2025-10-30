<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\AssertionFailedError;

require 'serverManagement.php';

class ServerManagementTest extends TestCase
{
    private $serverManagement;

    protected function setUp(): void
    {
        $this->serverManagement = new ServerManagement();
    }

    private function runTest($desc, $expected, $callback)
    {
        try {
            $result = $callback();
            $this->assertEquals($expected, $result);

            // --- aturan ikon ---
            if (str_starts_with($expected, "Error:")) {
                // kalau expected error → tampilkan X (karena skenario gagal)
                echo "\033[31mX\033[0m FAIL - {$desc}\n";
            } else {
                // kalau expected sukses → tampilkan centang
                echo "\033[32m✓\033[0m PASS - {$desc}\n";
            }

        } catch (AssertionFailedError $e) {
            echo "\033[31mX\033[0m FAIL - {$desc}\n";
        } catch (Exception $e) {
            echo "\033[31mX\033[0m ERROR - {$desc}\n";
        }
    }

    public function testCreateServerSuccess()
    {
        $this->runTest(
            'Server berhasil dibuat',
            "Server 'MyServer' berhasil dibuat dengan kategori Gaming",
            fn() => $this->serverManagement->createServer('Gaming', 'MyServer')
        );
    }

    public function testCreateServerEmptyName()
    {
        $this->runTest(
            'Nama server kosong terdeteksi',
            "Error: Please enter a server name",
            fn() => $this->serverManagement->createServer('Music', '')
        );
    }

    public function testCreateServerNameTooLong()
    {
        $longName = str_repeat('A', 101);
        $this->runTest(
            'Nama server terlalu panjang terdeteksi',
            "Error: Server name too long",
            fn() => $this->serverManagement->createServer('Chat', $longName)
        );
    }

    public function testCreateChannelSuccess()
    {
        $this->runTest(
            'Channel berhasil dibuat',
            "Channel text 'general' berhasil dibuat di server 'MyServer'",
            fn() => $this->serverManagement->createChannel('MyServer', 'general')
        );
    }

    public function testCreateChannelEmptyName()
    {
        $this->runTest(
            'Nama channel kosong terdeteksi',
            "Error: Please enter a channel name",
            fn() => $this->serverManagement->createChannel('MyServer', '')
        );
    }

    public function testCreateVoiceChannel()
    {
        $this->runTest(
            'Channel voice berhasil dibuat',
            "Channel voice 'Lobby' berhasil dibuat di server 'MyServer'",
            fn() => $this->serverManagement->createChannel('MyServer', 'Lobby', 'voice')
        );
    }
}
