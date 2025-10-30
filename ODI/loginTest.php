<?php
use PHPUnit\Framework\TestCase;

require 'login.php';

class LoginTest extends TestCase
{
    public function testLoginSuccess()
    {
        $this->assertTrue(login('user@example.com', 'password123'));
    }

    public function testLoginFailureWrongPassword()
    {
        $this->assertFalse(login('user@example.com', 'wrongpassword'));
    }

    public function testLoginFailureWrongUsername()
    {
        $this->assertFalse(login('wronguser@example.com', 'password123'));
    }

    public function testLoginFailureEmptyFields()
    {
        $this->assertFalse(login('', ''));
    }
}