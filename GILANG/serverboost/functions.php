<?php

// Gunakan variabel global untuk file path (bisa di-override di test)
if (!defined('SERVER_FILE')) {
    define('SERVER_FILE', __DIR__ . '/server.json');
}

function getServerData()
{
    $default = [
        'level' => 0,
        'total_boosts' => 0,
        'boosters' => []
    ];

    if (!file_exists(SERVER_FILE)) {
        saveServerData($default);
        return $default;
    }

    $content = file_get_contents(SERVER_FILE);
    $data = json_decode($content, true);

    if (!is_array($data)) {
        saveServerData($default);
        return $default;
    }

    $data = array_merge($default, $data);
    if (!is_array($data['boosters'])) {
        $data['boosters'] = [];
    }
    return $data;
}

function saveServerData($data)
{
    $default = ['level' => 0, 'total_boosts' => 0, 'boosters' => []];
    $data = array_merge($default, $data);
    if (!is_array($data['boosters'])) {
        $data['boosters'] = [];
    }
    file_put_contents(SERVER_FILE, json_encode($data, JSON_PRETTY_PRINT));
}

// Fungsi addBooster menerima user_id sebagai parameter (bukan dari session)
function addBooster($user_id)
{
    if (!$user_id) return false;

    $server = getServerData();
    $server['boosters'][] = $user_id;
    $server['total_boosts']++;
    $server['level'] = floor($server['total_boosts'] / 2);

    saveServerData($server);
    return true;
}

function generateUserId()
{
    return md5(uniqid() . time());
}
