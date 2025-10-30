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

}