<?php

session_start();
require_once 'vendor/connect.php';

$nick_name = $_POST['name'];

$user_data = R::findOne('accounts', 'name = ?', [$nick_name]);

if ($user_data) {
    $response = array();
    $response[0] = [
        "skin" => $user_data->skin,
        "cash" => $user_data->cash,
        "donate" => $user_data->donate
    ];
 echo json_encode($response, JSON_UNESCAPED_UNICODE);
    // Дополнительные поля могут быть добавлены в соответствии с вашей схемой базы данных
} else {
    $response[0] = [
        "skin" => 0,
        "cash" => 0,
        "donate" => 0
    ];
}
?>