<?php
session_start();

function hasAccess($role, $menu) {
    $permissions = [
        'Owner' => ['All', 'Manage Server', 'Admin Panel'],
        'Admin' => ['Manage Server', 'Member List'],
        'Member' => ['Chat', 'Voice'],
        'Guest' => ['View Only']
    ];

    if (isset($permissions[$role])) {
        return in_array('All', $permissions[$role]) || in_array($menu, $permissions[$role]);
    }

    return false;
}

function manageServer($role, $serverName, $region, $iconFile) {
    if (!hasAccess($role, 'Manage Server')) {
        return "Access Denied";
    }

    // Simulasi perubahan server tersimpan
    $_SESSION['server'] = [
        'name' => $serverName,
        'region' => $region,
        'icon' => $iconFile
    ];

    return "Server updated successfully";
}
?>
