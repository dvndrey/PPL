<?php
// serverOwnershipTest.php
use PHPUnit\Framework\TestCase;
require_once 'serverOwnership.php';

class ServerOwnershipTest extends TestCase
{
    private $ownership;

    protected function setUp(): void
    {
        $this->ownership = new ServerOwnership();
    }

    public function test_TC_20_Melakukan_transfer_kepemilikan_server()
    {
        try {
            $result = $this->ownership->transferOwnership('MyGamingServer', 'Cowk');
            $this->assertStringContainsString(
                "Ownership server 'MyGamingServer' berhasil ditransfer ke user 'Cowk'",
                $result
            );
            // Verifikasi tambahan: owner baru harus sesuai
            $this->assertEquals('Cowk', $this->ownership->getOwner('MyGamingServer'));
            echo "\033[32m✓\033[0m PASS - TC 20 Melakukan transfer kepemilikan server\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - TC 20 Melakukan transfer kepemilikan server\n";
            throw $e;
        }
    }

    public function test_TC_20_Gagal_transfer_ke_user_yang_tidak_ada()
    {
        try {
            $result = $this->ownership->transferOwnership('MyGamingServer', 'Budi');
            $this->assertEquals("Error: User 'Budi' bukan member server ini", $result);
            echo "\033[32m✓\033[0m PASS - TC 20 Gagal transfer ke user yang tidak ada\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - TC 20 Gagal transfer ke user yang tidak ada\n";
            throw $e;
        }
    }

    public function test_TC_20_Gagal_transfer_pada_server_tidak_ada()
    {
        try {
            $result = $this->ownership->transferOwnership('ServerTidakAda', 'Cowk');
            $this->assertEquals("Error: Server 'ServerTidakAda' tidak ditemukan", $result);
            echo "\033[32m✓\033[0m PASS - TC 20 Gagal transfer pada server tidak ada\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - TC 20 Gagal transfer pada server tidak ada\n";
            throw $e;
        }
    }
}