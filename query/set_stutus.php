<?php

session_start();

include('../db/db-connect.php');
include('functions.php');

$user_id = $_SESSION['user_id'];

#var_dump($user_id);

$msg_danger = 'У вас нет прав на редактирование данного профиля!';
$msg_success = 'Статус установлен';

$is_form_id = $_POST['id'];
$status = $_POST['status'];

$status_new = convert_status($status);

#var_dump($status_new);

if ($user_id == $is_form_id or $_SESSION['user_role'] == 'admin'){
  add_user_info_status($status_new, $is_form_id);
  set_flash_message($msg_success);
  set_flash_message_status(true);
  header('Location:http://localhost:8888/dz-php/dz1/users.php');
}
else {
  set_flash_message($msg_danger);
  set_flash_message_status(false);
};
