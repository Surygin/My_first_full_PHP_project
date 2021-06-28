<?php

session_start();

include('../db/db-connect.php');
include('functions.php');

$user_id = $_SESSION['user_id'];
$profile_id = $_POST['profile_id'];

$msg_danger = 'Ошибка данных';
$msg_success = 'Аватар загружен';

$avatar = $_FILES['img']['name'];
$img_path  =  $_FILES['img']['tmp_name'];

#var_dump($user_id); echo "<br>";
#var_dump($profile_id); echo "<br>";

$avatar_name = name_for_avatar($avatar);

if ($user_id == $profile_id or $_SESSION['user_role'] == 'admin'){
  add_user_avatar($avatar_name, $profile_id);
  move_uploaded_file($img_path, '../' . $avatar_name);
  set_flash_message($msg_success);
  set_flash_message_status(true);
  header('Location:http://localhost:8888/dz-php/dz1/users.php');
}
else {
  set_flash_message($msg_danger);
  set_flash_message_status(false);
};
