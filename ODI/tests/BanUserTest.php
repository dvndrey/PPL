<?php
use PHPUnit\Framework\TestCase;

class BanUserTest extends TestCase
{
    public function testFormFieldsAreRequired()
    {
        try {
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $_POST = ['username' => '', 'reason' => ''];

            ob_start();
            include __DIR__ . '/../src/ban.php';
            $output = ob_get_clean();

            $this->assertStringContainsString('Username dan alasan wajib diisi!', $output);
            echo "\033[32m✓\033[0m PASS - Form fields are required\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Form fields are required\n";
            throw $e;
        }
    }

    public function testSuccessMessageIsDisplayed()
    {
        try {
            $_SERVER['REQUEST_METHOD'] = 'POST';
            $_POST = ['username' => 'Odi123', 'reason' => 'Melanggar aturan'];

            ob_start();
            include __DIR__ . '/../src/ban.php';
            $output = ob_get_clean();

            $this->assertStringContainsString("User 'Odi123' berhasil di-ban", $output);
            echo "\033[32m✓\033[0m PASS - Success message is displayed\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Success message is displayed\n";
            throw $e;
        }
    }
}