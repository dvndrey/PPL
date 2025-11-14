<?php
use PHPUnit\Framework\TestCase;

require 'roles.php';

class RolesTest extends TestCase
{
    public function testOwnerFullAccess()
    {
        try {
            $this->assertTrue(hasAccess('Owner', 'Admin Panel'));
            $this->assertTrue(hasAccess('Owner', 'Manage Server'));
            $this->assertTrue(hasAccess('Owner', 'Any Other Menu'));
            echo "\033[32m✓\033[0m PASS - Owner full access\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Owner full access\n";
            throw $e;
        }
    }

    public function testManageServerByAdmin()
    {
        try {
            $result = manageServer('Admin', 'New Server Name', 'Asia', 'icon.png');
            $this->assertEquals("Server updated successfully", $result);
            echo "\033[32m✓\033[0m PASS - Manage server by admin\n";
        } catch (Exception $e) {
            echo "\033[31m✗\033[0m FAIL - Manage server by admin\n";
            throw $e;
        }
    }
}
?>