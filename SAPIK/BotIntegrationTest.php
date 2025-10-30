<?php

use PHPUnit\Framework\TestCase;

define('PHPUNIT_RUNNING', true);
require_once __DIR__ . '/botIntegration.php';

/**
 * @outputBuffering disabled
 */
class BotIntegrationTest extends TestCase
{
    public function testBerhasilMenambahkanBot(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $post = ['server' => 'Server PPL'];
        $session = [];

        $message = handleAddBotForm($post, $session);

        echo "\n[✅] testBerhasilMenambahkanBot => $message\n";

        $this->assertEquals(
            "Bot berhasil ditambahkan ke server Server PPL.",
            $message
        );
    }

    // public function testGagalKarenaTidakPilihServer(): void
    // {
    //     $_SERVER['REQUEST_METHOD'] = 'POST';
    //     $post = ['server' => ''];
    //     $session = [];

    //     $message = handleAddBotForm($post, $session);

    //     echo "\n[⚠️] testGagalKarenaTidakPilihServer => $message\n";

    //     $this->assertEquals(
    //         "Silakan pilih server terlebih dahulu.",
    //         $message
    //     );
    // }

    // public function testTidakAdaRequestPost(): void
    // {
    //     $_SERVER['REQUEST_METHOD'] = 'GET';
    //     $post = [];
    //     $session = [];

    //     $message = handleAddBotForm($post, $session);

    //     echo "\n[ℹ️] testTidakAdaRequestPost => '$message'\n";

    //     $this->assertEmpty($message);
    // }
}
