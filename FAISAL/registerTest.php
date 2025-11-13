<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\AssertionFailedError;

require 'register.php';

class RegisterTest extends TestCase
{
    private function runTest($desc, $expected, $callback)
    {
        try {
            $result = $callback();
            $this->assertEquals($expected, $result);

            if (str_starts_with($expected, "Error:") ||
                str_contains(strtolower($expected), "invalid") ||
                str_contains(strtolower($expected), "must") ||
                str_contains(strtolower($expected), "already") ||
                str_contains(strtolower($expected), "you must")) {
                echo "\033[31mX\033[0m FAIL - {$desc}\n";
            } else {
                echo "\033[32m✓\033[0m PASS - {$desc}\n";
            }

        } catch (AssertionFailedError $e) {
            echo "\033[31mX\033[0m FAIL - {$desc}\n";
        } catch (Exception $e) {
            echo "\033[31mX\033[0m ERROR - {$desc}\n";
        }
    }

    public function testRegisterSuccess()
    {
        $this->runTest(
            "Registrasi dengan data valid",
            "Registration success",
            fn() => register('oddiizuzuzu@gmail.com', 'odiodiddong', 'odoii', 'odisukagilang', '2005-12-07')
        );
    }

    public function testRegisterShortPassword()
    {
        $this->runTest(
            "Password terlalu pendek",
            "Password must be at least 8 characters",
            fn() => register('oddiizuzuzu@gmail.com', 'odiodiddong', 'odoii', 'odisuka', '2005-12-07')
        );
    }

    public function testRegisterUnderage()
    {
        $this->runTest(
            "Usia di bawah 13 tahun",
            "You must be at least 13 years old",
            fn() => register('oddiizuzuzu@gmail.com', 'odiodiddong', 'odoii', 'odisukagilang', '2021-12-07')
        );
    }

    public function testRegisterInvalidEmail()
    {
        $this->runTest(
            "Format email tidak valid",
            "Invalid email format",
            fn() => register('oddiizuzuzugmail.com', 'odiodiddong', 'odoii', 'odisukagilang', '2005-12-07')
        );
    }

    public function testRegisterDuplicateEmail()
    {
        $this->runTest(
            "Email sudah terdaftar",
            "Email already registered",
            fn() => register('metodiusbudiono@gmail.com', 'odiodiddong', 'odoii', 'odisukagilang', '2005-12-07')
        );
    }

    public function testRegisterOptInMarketing()
    {
        $this->runTest(
            "Opt-in marketing checked",
            "Registration success",
            fn() => register('oddiizuzuzu@gmail.com', 'odiodiddong', 'odoii', 'odisukagilang', '2005-12-07', true)
        );
    }
}
