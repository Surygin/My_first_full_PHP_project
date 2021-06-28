<?php

session_start();

include('../db/db-connect.php');
include('functions.php');

$msg_danger = 'Ошибка данных';
$msg_success = 'Профиль удален';

$user_id = $_SESSION['user_id'];
$profile_user_id = $_GET['id'];

$user = get_user_by_id($profile_user_id);
$user_avatar = '../' . $user[0]['img'];

#var_dump($profile_user_id); echo '<br>';
#var_dump($user_avatar);

delete_avatar_file($user_avatar);
user_delete($profile_user_id);

if ($user_id == $profile_id or $_SESSION['user_role'] == 'admin'){
  delete_avatar_file($user_avatar);
  user_delete($profile_user_id);
  set_flash_message($msg_success);
  set_flash_message_status(true);
  header('Location:http://localhost:8888/dz-php/dz1/users.php');
}
else {
  set_flash_message($msg_danger);
  set_flash_message_status(false);
};