<?php
// serverManagement.php

class ServerManagement
{
    private $servers = [];
    private $channels = [];

    // Membuat server baru
    public function createServer($template, $name)
    {
        if (empty($name)) {
            return "Error: Please enter a server name";
        }

        if (strlen($name) > 100) {
            return "Error: Server name too long";
        }

        $this->servers[] = [
            'template' => $template,
            'name' => $name,
        ];

        return "Server '{$name}' berhasil dibuat dengan kategori {$template}";
    }

    // Membuat channel baru
    public function createChannel($serverName, $channelName, $type = 'text')
    {
        if (empty($channelName)) {
            return "Error: Please enter a channel name";
        }

        $this->channels[] = [
            'server' => $serverName,
            'name' => $channelName,
            'type' => $type,
        ];

        return "Channel {$type} '{$channelName}' berhasil dibuat di server '{$serverName}'";
    }
}
