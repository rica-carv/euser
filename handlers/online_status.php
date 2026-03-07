<?php
// e107_plugins/euser/handlers/online_status.php
///require_once(__DIR__.'/../../../class2.php');
// Substitui o require('../../class2.php'); por isto:
if (!defined('e107_INIT')) 
{
    // Se o ficheiro for chamado diretamente (AJAX), precisamos do class2.php
    $baseDir = realpath(dirname(__FILE__) . '/../../../') . '/';
    if(file_exists($baseDir . 'class2.php')) {
        require_once($baseDir . 'class2.php');
    }
}

header('Content-Type: application/json; charset=utf-8');

// Recebe IDs do AJAX
$ids = isset($_POST['ids']) && is_array($_POST['ids']) ? array_map('intval', $_POST['ids']) : [];

$online = [];

foreach ($ids as $user_id) {
    $userData = e107::user($user_id);

    if (!empty($userData['user_currentvisit']) && intval($userData['user_currentvisit']) > (time() - 300)) {
        $online[$user_id] = 'online';
    } else {
        $online[$user_id] = 'offline';
    }
}

// Retorna JSON
echo json_encode(['success' => true, 'online' => $online]);
exit;
