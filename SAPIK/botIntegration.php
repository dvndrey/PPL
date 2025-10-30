<?php
// botIntegration.php

class BotIntegration
{
    private $servers = [
        [
            'name' => 'Yamete',
            'owner' => 'Syafiq'
        ]
    ];

    // Fungsi untuk mentransfer kepemilikan server
    public function transferOwnership($serverName, $newOwner)
    {
        foreach ($this->servers as &$server) {
            if ($server['name'] === $serverName) {
                $server['owner'] = $newOwner;
                return "Ownership berhasil ditransfer ke user {$newOwner}.";
            }
        }
        return "Error: Server tidak ditemukan.";
    }

    // Fungsi untuk mendapatkan owner saat ini (untuk pengujian)
    public function getOwner($serverName)
    {
        foreach ($this->servers as $server) {
            if ($server['name'] === $serverName) {
                return $server['owner'];
            }
        }
        return null;
    }
}
