<?php

session_start();

include('../db/db-connect.php');
include('functions.php');

$user_id = $_SESSION['user_id'];


$msg_danger = 'Ошибка данных';
$msg_success = 'Запись обновлена';

$status = $_POST['user_status'];

$update_user = [
  'id'      =>  $_POST['user_id'],
  'name'    =>  $_POST['user_name'],
  'job'     =>  $_POST['user_job'],
  'phone'   =>  $_POST['user_phone'],
  'geo'     =>  $_POST['geo'],
];

#var_dump($update_user);


if ($user_id == $update_user['id'] or admin_or_not($_SESSION['user_role'])){
  add_user_info_main($update_user['name'], $update_user['job'], $update_user['phone'], $update_user['geo'], $update_user['id']);
  set_flash_message($msg_success);
  set_flash_message_status(true);
  header('Location:../users.php');
}
else {
  set_flash_message($msg_danger);
  set_flash_message_status(false);
};
