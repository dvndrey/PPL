<?php
use PHPUnit\Framework\TestCase;

require 'register.php';

class RegisterTest extends TestCase
{
    // TC-01: Data valid
    public function testRegisterSuccess()
    {
        try {
            $result = register('oddiizuzuzu@gmail.com', 'odiodiddong', 'odoii', 'odisukagilang', '2005-12-07');
            $this->assertEquals("Registration success", $result);
            echo "\033[32m✓\033[0m PASS - Registrasi dengan data valid\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Registrasi dengan data valid\n";
            throw $e;
        }
    }

    // TC-02: Password terlalu pendek
    public function testRegisterShortPassword()
    {
        try {
            $result = register('oddiizuzuzu@gmail.com', 'odiodiddong', 'odoii', 'odisuka', '2005-12-07');
            $this->assertEquals("Password must be at least 8 characters", $result);
            echo "\033[32m✓\033[0m PASS - Registrasi gagal (no HP sudah terdaftar)\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Registrasi gagal (no HP sudah terdaftar)\n";
            throw $e;
        }
    }

    // TC-03: Usia < 13 tahun
    public function testRegisterUnderage()
    {
        try {
            $result = register('oddiizuzuzu@gmail.com', 'odiodiddong', 'odoii', 'odisukagilang', '2021-12-07');
            $this->assertEquals("You must be at least 13 years old", $result);
            echo "\033[32m✓\033[0m PASS - Validasi input salah (password & no HP pendek)\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Validasi input salah (password & no HP pendek)\n";
            throw $e;
        }
    }

    // TC-04: Format email tidak valid
    public function testRegisterInvalidEmail()
    {
        try {
            $result = register('oddiizuzuzugmail.com', 'odiodiddong', 'odoii', 'odisukagilang', '2005-12-07');
            $this->assertEquals("Invalid email format", $result);
            echo "\033[32m✓\033[0m PASS - Format email tidak valid\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Format email tidak valid\n";
            throw $e;
        }
    }

    // TC-05: Email sudah terdaftar
    public function testRegisterDuplicateEmail()
    {
        try {
            $result = register('metodiusbudiono@gmail.com', 'odiodiddong', 'odoii', 'odisukagilang', '2005-12-07');
            $this->assertEquals("Email already registered", $result);
            echo "\033[32m✓\033[0m PASS - Email sudah terdaftar\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Email sudah terdaftar\n";
            throw $e;
        }
    }

    // TC-06: Opt-in marketing checked
    public function testRegisterOptInMarketing()
    {
        try {
            $result = register('oddiizuzuzu@gmail.com', 'odiodiddong', 'odoii', 'odisukagilang', '2005-12-07', true);
            $this->assertEquals("Registration success", $result);
            echo "\033[32m✓\033[0m PASS - Opt-in marketing checked\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Opt-in marketing checked\n";
            throw $e;
        }
    }
}
?>