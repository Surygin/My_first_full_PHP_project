<?php

session_start();

include('../db/db-connect.php');
include('functions.php');

$login = $_POST['email'];
$psw = md5($_POST['psw']);
$msg_danger = 'Этот эл. адрес уже занят другим пользователем.';
$msg_success = 'Регистрация прошла успешно.';

$data = get_id_by_email($login);

if (!empty($data)){
    set_flash_message($msg_danger);
    set_flash_message_status(false);
    header('Location:'.$_SERVER['HTTP_REFERER'].'');
    exit;
};

add_user($login, $psw);
#var_dump(add_user($login, $psw));
set_flash_message($msg_success);
set_flash_message_status(true);
header('Location:'.$_SERVER['HTTP_REFERER'].'');

?>