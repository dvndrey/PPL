<?php

use PHPUnit\Framework\TestCase;

// Override file path untuk testing
define('SERVER_FILE', __DIR__ . '/test_server.json');

require_once __DIR__ . '/../serverboost/functions.php';



class ServerBoostTest extends TestCase
{
    protected function setUp(): void
    {
        // Hapus file test sebelum tiap test
        if (file_exists(SERVER_FILE)) {
            unlink(SERVER_FILE);
        }
    }

    protected function tearDown(): void
    {
        // Bersihkan file setelah test
        if (file_exists(SERVER_FILE)) {
            unlink(SERVER_FILE);
        }
    }

    /** @test */
    public function test_level_increases_every_two_boosts()
    {
        try {
            $userId = 'fc0184d34f1af01c742a1e0e457bcf26';

            addBooster($userId); // 1 boost
            $data = getServerData();
            $this->assertEquals(0, $data['level']); // floor(1/2) = 0

            addBooster($userId); // 2 boosts
            $data = getServerData();
            $this->assertEquals(1, $data['level']); // floor(2/2) = 1

            addBooster($userId); // 3 boosts
            $data = getServerData();
            $this->assertEquals(1, $data['level']); // floor(3/2) = 1

            addBooster($userId); // 4 boosts
            $data = getServerData();
            $this->assertEquals(2, $data['level']); // floor(4/2) = 2

            echo "\033[32m✅\033[0m PASS - Level increases every two boosts\n";
        } catch (Exception $e) {
            echo "\033[31m❌\033[0m FAIL - Level increases every two boosts\n";
            throw $e;
        }
    }
}
