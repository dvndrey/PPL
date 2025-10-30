<?php
class ChatService
{
    private $users;
    private $channels;

    public function __construct($users = [], $channels = [])
    {
        $this->users = $users;
        $this->channels = $channels;
    }

    // Kirim DM
    public function sendDM($fromUserId, $toUserId, $message)
    {
        if (!isset($this->users[$fromUserId]) || !isset($this->users[$toUserId])) {
            return "User not found.";
        }

        if (trim($message) === "") {
            return "❌ Cannot send empty message.";
        }

        return "DM from " . $this->users[$fromUserId]['name'] . " to " . $this->users[$toUserId]['name'] . ": " . $message;
    }

    // Kirim pesan di channel server
    public function sendChannelMessage($fromUserId, $channelId, $message)
    {
        if (!isset($this->users[$fromUserId])) {
            return "User not found.";
        }
        if (!isset($this->channels[$channelId])) {
            return "Channel not found.";
        }

        if (trim($message) === "") {
            return "❌ Cannot send empty message.";
        }

        return "[" . $this->channels[$channelId]['name'] . "] "
            . $this->users[$fromUserId]['name'] . ": " . $message;
    }

    // Kirim file
    public function sendFile($fromUserId, $channelId, $filename)
    {
        $blockedExtensions = ['exe', 'bat', 'sh', 'js'];

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (in_array(strtolower($ext), $blockedExtensions)) {
            return "❌ File format not supported.";
        }

        return "📁 File $filename uploaded to channel " . $this->channels[$channelId]['name'];
    }
}
