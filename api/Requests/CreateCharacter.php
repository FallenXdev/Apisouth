<?php

session_start();
require_once 'vendor/connect.php';

if (!isset($_POST['nick'], $_POST['sex'], $_POST['skin'])) {
    $response = [
        "status" => true,
        "message" => "Ja temos uma conta com essas informaçoes!"
    ];

    echo 1111;
    die();
}


$nick_name = $_POST['nick'];
$sex = $_POST['sex'];
$skin = $_POST['skin'];
$promo = $_POST['promo'];

$check_login = R::findOne('accounts', 'name = ?', [$nick_name]);
if ($check_login) {
    $response = [
        "status" => true,
        "type" => 1,
        "message" => "Seu nick esta fora dos padroes!",
        "fields" => ['nick_name']
    ];

    echo 111;
    die();
}

$error_fields = [];

if ($nick_name === '') {
    $error_fields[] = 'nick_name';
}

if ($sex === '') {
    $error_fields[] = 'sex';
}

if ($skin === '') {
    $error_fields[] = 'skin';
}

if (!empty($error_fields)) {
    $response = [
        "status" => true,
        "fields" => $error_fields
    ];

    echo 11;
    die();
}
else {
	
	$user = R::dispense('accounts');
    $user->name = $nick_name;
    $user->sex = $sex;
	$user->skin = $skin;
	if (isset($_POST['promo'])) {
        $user->promo = $promo;
    }
    R::store($user);

    $response = [
        "status" => true
    ];
    echo 1;
}

?>



