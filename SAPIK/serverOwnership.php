<?php
// serverOwnership.php
session_start();

class ServerOwnership
{
    private $servers = [];

    public function __construct()
    {
        // Simulasi server awal
        $this->servers = [
            'MyGamingServer' => [
                'owner' => 'Andi',
                'members' => ['Andi', 'Cowk', 'Rina']
            ]
        ];
    }

    public function transferOwnership($serverName, $newOwner)
    {
        // Cek apakah server ada
        if (!isset($this->servers[$serverName])) {
            return "Error: Server '$serverName' tidak ditemukan";
        }

        // Cek apakah user ada di daftar member
        if (!in_array($newOwner, $this->servers[$serverName]['members'])) {
            return "Error: User '$newOwner' bukan member server ini";
        }

        // Lakukan transfer
        $this->servers[$serverName]['owner'] = $newOwner;
        return "Ownership server '$serverName' berhasil ditransfer ke user '$newOwner'";
    }

    // (Opsional) Method untuk mendapatkan owner saat ini
    public function getOwner($serverName)
    {
        if (!isset($this->servers[$serverName])) {
            return "Error: Server '$serverName' tidak ditemukan";
        }

        return $this->servers[$serverName]['owner'];
    }
}
