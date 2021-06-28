<?php

session_start();

include('../db/db-connect.php');
include('functions.php');

$login = $_POST['email'];
$psw = md5($_POST['psw']);
$msg_danger = 'Неверный логин или пароль';
$msg_success = 'Вы успешно авторизированы';

$user_id = autorization_user($login, $psw);

set_id_user($user_id);

if ($user_id){
    $_SESSION['msg'] = $msg_success;
    set_flash_message_status(true);
    header('Location:http://localhost:8888/dz-php/dz1/users.php');
    exit;
}
else {
    $_SESSION['msg'] = $msg_danger;
    set_flash_message_status(false);
    header('Location:'.$_SERVER['HTTP_REFERER'].'');
    exit;
};

header('Location:'.$_SERVER['HTTP_REFERER'].'');

?>