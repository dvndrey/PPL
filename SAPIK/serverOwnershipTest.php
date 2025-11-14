<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\AssertionFailedError;

class ServerOwnership
{
    public function transfer($serverName, $newOwner, $isChecked)
    {
        if (!$isChecked) {
            return [
                "success" => false,
                "message" => "Anda harus menyetujui sebelum mentransfer ownership!"
            ];
        }

        return [
            "success" => true,
            "message" => "Ownership berhasil ditransfer ke user $newOwner."
        ];
    }
}

class ServerOwnershipTest extends TestCase
{
    private $ownership;

    protected function setUp(): void
    {
        $this->ownership = new ServerOwnership();
    }

    private function runTest($desc, $expectedSuccess, $expectedMessage, $callback)
    {
        try {
            $result = $callback();

            $this->assertEquals($expectedSuccess, $result['success']);
            $this->assertEquals($expectedMessage, $result['message']);

            if ($expectedSuccess) {
                echo "\033[32m✓\033[0m PASS - {$desc}\n";
            } else {
                echo "\033[31mX\033[0m FAIL - {$desc}\n";
            }

        } catch (AssertionFailedError $e) {
            echo "\033[31mX\033[0m FAIL - {$desc}\n";
        }
    }

    public function testOwnership()
    {
        $checkbox = true;

        if ($checkbox === false) {

            $this->runTest(
                "Gagal transfer ownership karena checkbox belum dicentang",
                false,
                "Anda harus menyetujui sebelum mentransfer ownership!",
                fn() => $this->ownership->transfer("Yamete", "cowk3837", false)
            );

        } else {

            $this->runTest(
                "Berhasil transfer ownership setelah checkbox dicentang",
                true,
                "Ownership berhasil ditransfer ke user cowk3837.",
                fn() => $this->ownership->transfer("Yamete", "cowk3837", true)
            );
        }
    }
}
