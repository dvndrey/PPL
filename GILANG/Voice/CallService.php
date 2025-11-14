<?php
class CallService
{
    private $users;

    public function __construct($users = [])
    {
        $this->users = $users;
    }

    public function voiceCall($userId)
    {
        if (!isset($this->users[$userId])) {
            return "User not found.";
        }
        return "📞 Voice call with " . $this->users[$userId]['name'] . " is connected! Mic aktif 🔊";
    }

    public function videoCall($userId)
    {
        if (!isset($this->users[$userId])) {
            return "User not found.";
        }
        return "✅ Video call with " . $this->users[$userId]['name'] . " has started! Camera on 🎥";
    }

    public function screenShare($userId, $screen = "Browser")
    {
        if (!isset($this->users[$userId])) {
            return "User not found.";
        }
        return "🖥️ Screen sharing ($screen) started for " . $this->users[$userId]['name'] . ". Layar tampil ke member lain.";
    }
}
